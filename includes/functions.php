***REMOVED***

***REMOVED***
***REMOVED*** functions.php
***REMOVED***
***REMOVED*** Programmeren 2 - Final Project
***REMOVED*** Made by Simon Verhoek.
***REMOVED***
***REMOVED*** Helper functions.
***REMOVED***/ 

    require_once("constants.php");

***REMOVED***
***REMOVED*** Apologizes to user with message.
***REMOVED***/
    function errorMsg($message)
    {
        render("error.php", ["message" => $message]);
        exit;
    }

***REMOVED***
***REMOVED*** Facilitates debugging by dumping contents of variable
***REMOVED*** to browser.
***REMOVED***/
    /*
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }
    */

***REMOVED***
***REMOVED*** Logs out current user, if any.  Based on Example #1 at
***REMOVED*** http://us.php.net/manual/en/function.session-destroy.php.
***REMOVED***/
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

***REMOVED***
***REMOVED*** Executes SQL statement, possibly with parameters, returning
***REMOVED*** an array of all rows in result set or false on (non-fatal) error.
***REMOVED***/
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

***REMOVED***
***REMOVED*** Redirects user to destination, which can be
***REMOVED*** a URL or a relative path on the local host.
***REMOVED***
***REMOVED*** Because this function outputs an HTTP header, it
***REMOVED*** must be called before caller outputs any HTML.
***REMOVED***/
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

***REMOVED***
***REMOVED*** Renders template, passing in values.
***REMOVED***/
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

***REMOVED***
***REMOVED*** Renders template without any additional html, passing in values. 
***REMOVED*** Used for:
***REMOVED***  - showing multiple things on dashboard (found in navbar.php)
***REMOVED***/
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

***REMOVED***
***REMOVED*** Creates a dropdown menu for picking a date of birth.
***REMOVED***/
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
***REMOVED***
