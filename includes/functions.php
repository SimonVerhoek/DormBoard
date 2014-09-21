<?php

    /**
     * functions.php
     *
     * Programmeren 2 - Final Project
     * Made by Simon Verhoek.
     *
     * Helper functions.
     */ 

    require_once("constants.php");

    /**
     * Apologizes to user with message.
     */
    function errorMsg($message)
    {
        render("error.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    /*
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }
    */

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render session
            require("../public_html/session.php");

            // render navigation bar
            require("../public_html/navbar.php");

            // render template
            require("../templates/$template");

            // render footer
            //require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    /**
     * Renders template without any additional html, passing in values. 
     * Used for:
     *  - showing multiple things on dashboard (found in navbar.php)
     */
    function build($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render template
            require("../templates/$template");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    /**
     * Creates a dropdown menu for picking a date of birth.
     */
    date_default_timezone_set("Europe/Amsterdam");

    function date_dropdown($year_limit = 1900)
    {
        $html_output = '<div id="date_select" >'."\n";

        // days
        $html_output .= '<select name="date_day" id="day_select">'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '<option>' . $day . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        // months
        $html_output .= '<select name="date_month" id="month_select" >'."\n";
        $months = array("", "January", "February", "March", "April", 
                            "May", "June", "July", "August", 
                            "September", "October", "November", "December");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '<option value="' . $month . '">' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        // years
        $html_output .= '<select name="date_year" id="year_select">'."\n";
            for ($year = date("Y"); $year >= $year_limit; $year--) {
                $html_output .= '<option>' . $year . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        $html_output .= '</div>'."\n";
        return $html_output;
    }

    /**
     * Gets user data and stores it in session.
     */
    function getUserData($userID)
    {
        $userData = query(" SELECT  first_name,
                                    last_name,
                                    birth_date,
                                    cash_balance,
                                    dorm_id,
                                    shoplist_score
                            FROM    users 
                            WHERE   user_id = ?",
                                    $userID);

        if (count($userData) == 1)
        {
            $userData = $userData[0];

            $_SESSION["first_name"]     = $userData["first_name"];
            $_SESSION["last_name"]      = $userData["last_name"];
            $_SESSION["birth_date"]     = $userData["birth_date"];
            $_SESSION["cash_balance"]   = $userData["cash_balance"];
            $_SESSION["dorm_id"]        = $userData["dorm_id"];
            $_SESSION["shoplist_score"] = $userData["shoplist_score"];

            $dormData = query(" SELECT  dorm_name
                                FROM    dorms 
                                WHERE   dorm_id = ?",
                                        $userData["dorm_id"]);

            if (count($dormData) == 1)
            {
                $dormData = $dormData[0];

                $_SESSION["dorm_name"] = $dormData["dorm_name"];
            }
            else
            {
                errorMsg("Something went wrong while logging in to your account. Please try again.");
            }
        } 
        else
        {
            errorMsg("Something went wrong while logging in to your account. Please try again.");
        }
        
    }

    /**
     * Gets roommate data of user. 
     * 
     * Output depends on where the request comes from ($queryID):
     *  - navbar / roommates list   == 1
     *  - shoplist / buyer rankings == 2
     *  - finances / cash balances  == 3
     */
    function getRoommateData($userID, $queryID)
    {
        switch ($queryID) 
        {
            // navbar
            case 1:
                $colums = " first_name, 
                            last_name";
                $order = "  last_name ASC";
                break;

            // buyer rankings
            case 2:
                $colums = " user_id,
                            first_name,
                            last_name,
                            shoplist_score";
                $order = "  shoplist_score DESC";
                break;

            // cash balances
            case 3:
                $colums = " user_id,
                            first_name,
                            last_name,
                            cash_balance";
                $order = "  cash_balance DESC";
                break;
        }

        $roommateData = query(" SELECT      $colums
                                FROM        users
                                WHERE       dorm_id = ?
                                ORDER BY    $order",
                                            $_SESSION["dorm_id"]);
        if ($roommateData === false)
        {
            errorMsg("test");
        }

        return $roommateData;
    }
?>
