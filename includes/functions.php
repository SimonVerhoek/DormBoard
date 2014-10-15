<?php
    /*************************************************
     *   functions.php
     *
     *   Shows all helper functions.
     *   
     **************************************************/

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

            switch (count($dormData)) 
            {
                case 0:
                    // user is not member of a dorm yet
                    // --> do nothing
                    break;

                case 1:
                    $dormData = $dormData[0];

                    $_SESSION["dorm_name"] = $dormData["dorm_name"];
                    break;
                
                default:
                    errorMsg("Something went wrong while logging in to your account. Please try again. 1");
                    break;
            }
        } 
        else
        {
            errorMsg("Something went wrong while logging in to your account. Please try again. 2");
        }
        
    }

    /**
     * Gets roommate data of user. 
     * 
     * Queried columns depend on where the request comes from ($queryID):
     *  - navbar (roommates list)   == case 1
     *  - dinner (dinner schedule)  == case 2
     *  - shoplist (buyer rankings) == case 3
     *  - finances (cash balances)  == case 4
     *  - dinner email              == case 5
     */
    function getRoommateData($queryID)
    {
        switch ($queryID) 
        {
            // navbar
            case 1:
                $columns = "first_name, 
                            last_name";
                $order = "  last_name ASC";
                break;

            // dinner
            case 2:
                $columns = "user_id";
                $order = "  first_name ASC";
                break;

            // buyer rankings
            case 3:
                $columns = "user_id,
                            shoplist_score";
                $order = "  shoplist_score DESC";
                break;

            // cash balances
            case 4:
                $columns = "user_id,
                            cash_balance";
                $order = "  cash_balance DESC";
                break;

            // dinner email
            case 5:
                $columns = "user_id,
                            email";
                $order = "  user_id ASC";
                break;

            // no default case so error is returned when given wrong input
        }

        $roommateData = query(" SELECT      first_name,
                                            last_name,
                                            $columns
                                FROM        users
                                WHERE       dorm_id = ?
                                ORDER BY    $order",
                                            $_SESSION["dorm_id"]);
        if ($roommateData === false)
        {
            errorMsg("Something went wrong while processing your request. Please try again.");
        }

        return $roommateData;
    }

    /**
     * Sanitizes user (string) input.
     * 
     * Clears input from:
     *  - spaces at outer left of right of input
     *  - slashes
     *  - html characters (< and >)
     */
    function checkInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    /**
     * Puts input data in HTML table cell and
     * adds class.
     *
     *  - $class should be a string.
     *  - $text should be the value to output.
     */
    function putTableCell($class, $text)
    {
        print(sprintf("<td class=%s>" . $text . "</td>", $class));
    }

    /**
     * Puts input data in HTML paragraph element.
     *
     *  - $class should be a string.
     *  - $text should be the value to output.
     */
    function putParagraph($class, $text)
    {
        print(sprintf("<p class=%s>" . $text . "</p>", $class));
    }

    /**
     * Prints "Buyer rankings" scoreboard
     * 
     * prints three table cells (placed in separate 
     * functions):
     *  - rank (#1 to #No. of roommates)
     *  - name (first name of roommate)
     *  - score (amount of items solved/bought)
     */
    function printScoreboard()
    {
        $roommates = getRoommateData(3);

        foreach ($roommates as $i => $roommate) 
        {
            $rank = $i + 1;

            echo "<tr>";

            putTableCell("shoplist-scoreboard-rank", $rank);
            putTableCell("shoplist-scoreboard-name", $roommate["first_name"]);
            putTableCell("shoplist-scoreboard-score", $roommate["shoplist_score"]);

            echo "</tr>";
        }
    }

    /**
     * Gets shoplist items. 
     * 
     *  - queries database for shoplist items
     *  - queries database for roommate names
     *  - links roommate names to shoplist items
     *  - returns outcome in multitimensional array $items
     */
    function getShoplistItems()
    {
        $shoplistItems = query("SELECT      item_id,
                                            item_name,
                                            post_date,
                                            solve_date,
                                            user_id_poster,
                                            user_id_solver
                                FROM        shoplist
                                WHERE       dorm_id = ?
                                ORDER BY    post_date DESC",
                                            $_SESSION["dorm_id"]);

        $roommates = getRoommateData(3);

        // preset empty value to prevent undefined error
        $nameSolver = 0;

        foreach ($shoplistItems as $shoplistItem) 
        {
            foreach ($roommates as $roommate) 
            {
                if ($roommate["user_id"] == $shoplistItem["user_id_poster"])
                {
                    $namePoster = $roommate["first_name"];
                }

                if ($roommate["user_id"] == $shoplistItem["user_id_solver"])
                {
                    $nameSolver = $roommate["first_name"];
                }
            }

            $items[] = [
            "item_id" => $shoplistItem["item_id"],
            "item_name" => $shoplistItem["item_name"],
            "post_date" => $shoplistItem["post_date"],
            "solve_date" => $shoplistItem["solve_date"],
            "user_id_poster" => $shoplistItem["user_id_poster"],
            "user_id_solver" => $shoplistItem["user_id_solver"],
            "namePoster" => $namePoster,
            "nameSolver" => $nameSolver
            ];
        }

        return $items;
    }

    /**
     * Prints shopping list.
     * 
     *  - retrieves shoplist items from getShoplistItems()
     *  - formats date of posting and solving
     *  - prints either unsolved or solved item
     */
    function printShoplist()
    {
        $items = getShoplistItems();
        
        foreach ($items as $item) 
        {
            // format dates
            $postDate = strtotime($item["post_date"]);
            $postDate = date('l F jS, H:i', $postDate);

            $solveDate = strtotime($item["solve_date"]);
            $solveDate = date('l F jS, H:i', $solveDate);

            echo "<li><div class='text-holder'>";

            // check if item is solved or not
            if (empty($item["user_id_solver"]))
            {
                putUnsolvedItem(
                    $item["item_name"], 
                    $item["item_id"], 
                    $item["item_name"], 
                    $item["namePoster"], 
                    $postDate);
            }
            else
            {
                putSolvedItem(
                    $item["item_name"], 
                    $item["namePoster"], 
                    $item["nameSolver"], 
                    $postDate, 
                    $solveDate);
            }

            echo "</div></li>";
        }
    }

    /**
     * Returns unsolved item in HTML format.
     *
     * First, a hidden <a> element is created, containing 
     * a data-id ($dataID) and a data-value ($dataValue) 
     * value, that are passed on finances.php when 
     * the item is solved by the user (= solving form is posted).
     * Then, the item's name is printed and the posting data
     * (who & when).
     *
     * Requires:
     *  - $dataID       = string of the item's name (gets shown in modal)
     *  - $dataValue    = the item's ID (gets passed on to finances.php)
     *  - $itemName     = string of the item's name
     *  - $namePoster   = string of the name of the poster
     *  - $postDate     = date of posting in date() format
     */
    function putUnsolvedItem($dataID, $dataValue, $itemName, $namePoster, $postDate)
    {
        echo(
            // hidden element  
            '<a type="submit" href="#myModalCustom" ' .
                'data-id="' . $dataID . '" ' . 
                'data-value="' . $dataValue . '"'  .
                'class="open-modal btn btn-success pull-right checkmark-todo"' . 
                'id="solve-button"' .
                'data-target="#myModalCustom" >' .
                'Check!' .
            '</a>'
        );  

        putParagraph("shoplist-item-name", $itemName);
        putParagraph("shoplist-item-data", "Posted by: " . $namePoster . ", at " . $postDate);

        echo "<br>&nbsp<br>";
    }

    /**
     * Returns solved item in HTML format.
     *
     * Prints a checkmark glyphicon first, then prints the item's name,
     * posting data (who & when) and solving data (who & when).
     *
     * Requires:
     *  - $itemName     = string of the item's name
     *  - $namePoster   = string of the name of the poster
     *  - $nameSolver   = string of the name of the solver
     *  - $postDate     = date of posting in date() format
     *  - $solveDate    = date of solving in date() format
     */
    function putSolvedItem($itemName, $namePoster, $nameSolver, $postDate, $solveDate)
    {
        echo'<span class="glyphicon glyphicon-ok pull-right checkmark-done shoplist-checkmark-done"></span>' ;

        putParagraph("shoplist-item-name", $itemName);
        putParagraph(   "shoplist-item-data", "Posted by: " . $namePoster . ", at " . $postDate .
                        "<br>" .
                        'Bought by: ' . $nameSolver . ', at ' . $solveDate);

        echo(           '</em>' .
                    '</p>' 
        );
    }


?>
