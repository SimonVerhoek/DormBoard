<?php
    /*************************************************
     *   functions.php
     *
     *   Shows all helper functions.
     *   
     **************************************************/

    require_once("constants.php");
    require_once("functions_display.php");

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

        // add empty line as placeholder for solving data
        echo "<br>&nbsp<br>";
    }

    /**
     * Prints checklist for paying roommates in shoplist &
     * finances modal.
     */
    function printRoommatesChecklist()
    {
        $roommates = getRoommateData(2);

        foreach ($roommates as $roommate)
        {
            echo '<div class="checkbox">';

            putCheckbox("check_list[]", $roommate["user_id"], "checked");

            if (checkIfMe($roommate)) 
            {
                echo "Me";
            } 
            else
            {
                echo $roommate["first_name"] . " " . $roommate["last_name"];
            }
            
            echo "</div>";
        }
    }

    /**
     * Checks if given roommate is user himself.
     */
    function checkIfMe($roommate) 
    {
        if ($roommate["user_id"] == $_SESSION["user_id"])
        {
            return true;
        }
        return false;
    }

    /**
     * Prints a list of all spends made by a dorm.
     * 
     * Prints a table row with three table cells,
     * containing:
     *  - the date of posting
     *  - the name given to the spend
     *  - who solved (paid) the spend, and 
     *    how much it cost.
     */
    function printSpends()
    {
        $spends = getSpends();

        foreach ($spends as $spend)
        {
            echo "<tr>";

            // post date
            putTableCell("td-date", 
                    date('l F jS', strtotime($spend["date_added"])) .
                    "<br>" .
                    date('H:i', strtotime($spend["date_added"])));

            // spend name
            putTableCell("td-spendname", $spend["spend_name"]);

            // who paid what
            putTableCell("td-whopaidwhat", 
                $spend["first_name"] . " paid <br>" .
                " $ " . $spend["spend_cost"]);

            echo "</tr>";
        }
    }

    /**
     * Retrieves all spends.
     *
     * Contains three classes:
     *  - negative-balance  turns content red
     *  - positive-balance  turns content green
     *  - neutral-balance   turns content white
     */
    function getSpends()
    {
        // get all dorm's spend data up to a week earlier
        $spends = query("SELECT     finances.spend_id,
                                    finances.spend_name,
                                    finances.date_added,
                                    finances.spend_cost,
                                    finances.user_id_poster,
                                    users.first_name,
                                    users.last_name
                         FROM       finances
                         INNER JOIN users
                         ON         finances.user_id_poster = users.user_id
                         WHERE      users.dorm_id = ?
                         AND        finances.date_added between date_sub(now(),INTERVAL 1 WEEK) and now()
                         ORDER BY   finances.date_added DESC",
                                    $_SESSION["dorm_id"]);

        return $spends;
    }

    /**
     * Prints a table with all roommates' cash balances
     * 
     * First, a table row is created with a class
     * depending on the roommate's balance, to indicate
     * its cells' background color. Then, two cells
     * are printed:
     *  - one with the roommate's first name
     *  - one with the roommate's cash balance.
     */
    function printCashBalances()
    {
        $roommates = getRoommateData(4);

        foreach ($roommates as $roommate) 
        {
            echo '<tr class=' . setCashBalanceClass($roommate["cash_balance"]) . '>'; 

            // print roommate's name and balance with correct color
            putTableCell("", $roommate["first_name"]);
            
            putTableCell("text-right", 
                setCashPrefix($roommate["cash_balance"]) . 
                $roommate["cash_balance"]);
 
            echo "</tr>";
        }
    }

    /**
     * Returns appropriate class for cash balance
     * table row.
     *
     * Contains three classes:
     *  - negative-balance  turns content red
     *  - positive-balance  turns content green
     *  - neutral-balance   turns content white
     */
    function setCashBalanceClass($cashBalance)
    {  
        if ($cashBalance < 0)
        {
            return $class = "negative-balance";
        }
        else if ($cashBalance > 0)
        {
            return $class = "positive-balance";
        }
        else return $class = "neutral-balance";     
    }

    /**
     * Returns appropriate prefix for cash balance
     * table cell, by adding a "+" sign in front 
     * of positive balances.
     */
    function setCashPrefix($cashBalance)
    {
        if ($cashBalance > 0)
        {
            return $prefix = "$ +";
        }
        else return $prefix = "$ ";
    }

    /**
     * Returns whether given day is today or tomorrow.
     *
     * required input: a DateTime variable, formatted
     * as day only ('l').
     */
    function returnDay($day)
    {
        $today = date('l', time());

        $tomorrow = new DateTime('tomorrow');
        $tomorrow = $tomorrow->format('l');

        if ($day == $today)
        {
            return "Today";
        }
        else if ($day == $tomorrow) 
        {
            return "Tomorrow";
        }
        else return $day;
    }

    /**
     * Prints a table with a schedule of all dinner actions.
     * 
     * Prints a table row with on the most-left column/cell
     * the roommate's first name, and the following cells
     * containing any dinner actions this roommate has submitted.
     */
    function printDinnerSchedule()
    {
        $days = getUpcomingDays(6);
        $roommates = getRoommateData(2);
        $statuses = getRoommateDinnerStatuses();

        // for every roommate
        foreach ($roommates as $roommate)
        {
            // print roommate's name
            echo "<tr id='dinner-row'>";

            putTableCell("rm-names", $roommate["first_name"]);

            // for every upcoming day
            foreach ($days as $day) 
            { 
                echo "<td>";

                $today = $day->format('Y-m-d');

                // for every roommate's status
                foreach ($statuses as $status)
                {
                    // if status is from this user &
                    // status is from this day
                    if (($status["user_id"] === $roommate["user_id"]) &&  
                        ($status["action_date"] === $today))
                    {
                        putDinnerIcon($status["status"]);
                    }
                }
                echo "</td>";   
            } 
            echo "</tr>";
        }
    }

    /**
     * Returns the specified number of upcoming days.
     */
    function getUpcomingDays($numberOfDays)
    {
        return new DatePeriod(new DateTime, new DateInterval('P1D'), $numberOfDays);
    }

    /**
     * Returns any saved dinner statuses submitted by roommates.
     */
    function getRoommateDinnerStatuses()
    {
        return $statuses = query(
                "SELECT     dinner.user_id, 
                            dinner.action_date, 
                            dinner.status 
                FROM        dinner 
                INNER JOIN  users
                ON          users.user_id = dinner.user_id
                WHERE       users.dorm_id = ?",
                            $_SESSION["dorm_id"]);

        checkIfQueryFails($statuses, "Something went wrong while getting your roommate's dinner statuses. Please try again.");
    }

    /**
     * Prints the dinner action options inside the dinner modal.
     * 
     * Prints a list of radio buttons with optional dates
     * for choosing a dinner action.
     */
    function printDinnerOptions($numberOfDays)
    {
        $days = getUpcomingDays($numberOfDays);

        foreach ($days as $day) 
        {
            // store day in variable for easy storing in db
            $dayDate = $day->format('y-m-d');

            echo(   '<label class="btn btn-custom-dinner dinner-button">');

            echo(       '<input type="radio" class="dinner-radio-button" name="when"' .
                        'value="' . $dayDate . '">');

            // print day name
            echo         returnDay($day->format('l'));

            // print day date
            echo        " (" . $day->format("F jS") . ")";
            echo    "</label>";
        }
    }

    /**
     * Checks whether given input is empty.
     * If so, returns the given error message.
     */
    function checkIfEmpty($input, $message)
    {
        if (empty($input)) 
        {
            errorMsg($message);
        }
    }

    /**
     * Checks whether given query has failed (returns false).
     * if so, returns given error message.
     */
    function checkIfQueryFails($input, $errorMessage)
    {
        if ($input === false)
        {
            errorMsg($errorMessage);
        }
    }

    /**
     * Checks if the spend costs are filled in correctly.
     * if not, returns error message.
     */
    function checkInputSpendCosts($wholeNumbers, $cents)
    {
        // check if costs are filled in properly
        if (empty($wholeNumbers) && empty($cents))
        {
            errorMsg("Please fill what you spent.");
        }
        else if (!empty($wholeNumbers) && !is_numeric($wholeNumbers))
        {
            errorMsg("Please fill in the cost as digits only.");
        }
        else if (!empty($cents) && !is_numeric($cents))
        {
            errorMsg("Please fill in the cost as digits only.");
        }
    }

    /**
     * Sets the date of solving for given shoplist item. 
     */
    function setShoplistItemSolveDate($itemID)
    {
        $setSolveDate = query(' UPDATE  shoplist
                                SET     solve_date = NOW(),
                                        user_id_solver = ?
                                WHERE   item_id = ?', 
                                $_SESSION["user_id"], $itemID);

        checkIfQueryFails($setSolveDate, "Something went wrong while setting the date of solving. Please try again.");
    }

    /**
     * Updates the user's shoplist score.
     */
    function updateShoplistScore()
    {
        $updateScore = query("  UPDATE  users
                                SET     shoplist_score = shoplist_score + 1
                                WHERE   user_id = ?",
                                        $_SESSION["user_id"]);

        checkIfQueryFails($updateScore, "Something went wrong while updating your shoplist score. Please try again.");
    }

    /**
     * Updates the dorm's finances after a user has 
     * posted a new spend.
     */
    function updateFinances($cost, $postedChecklist, $spendName)
    {
        $numberOfPayers = count($postedChecklist);
        
        // if user bought item for himself only
        if ($numberOfPayers == 1 && 
            in_array($_SESSION["user_id"], $_POST["check_list"]))
        {
            // balances stay exactly like they are
        }
        else
        {
            // divide costs
            $costPerRM = $cost / $numberOfPayers;

            $credit = $cost;

            // if poster also pays for spend, subtract his part
            // from costs refunded.
            if(($key = array_search($_SESSION["user_id"], $postedChecklist)) === true)
            {
                $cost -= $costPerRM;
                unset($postedChecklist[$key]);
            }

            updateBalanceUser($credit);

            updateBalancePayers($postedChecklist, $costPerRM);
        }

        storeNewSpend($spendName, $cost);
    }

    /**
     * Updates the cash balance of the user. 
     * The costs of the spend that the user has posted, are
     * added as a positive number to his cash balance.
     */
    function updateBalanceUser($costsGivenBack)
    {
        $updateBalanceUser = query("    UPDATE  users
                                        SET     cash_balance = cash_balance + ?
                                        WHERE   user_id = ?",
                                                $costsGivenBack, 
                                                $_SESSION["user_id"]);

        checkIfQueryFails($updateBalanceUser, "Something went wrong while updating your cash balance. Please try again.");
    }

    /**
     * Updates the cash balances of all roommates 
     * that are taking part in paying for a spend.
     */
    function updateBalancePayers($postedChecklist, $costPerRM)
    {
        // put all paying roommates in string
        $stringOfPayers = implode(',', $postedChecklist);

        $updateBalancePayers = query("  UPDATE  users
                                        SET     cash_balance = cash_balance - ?
                                        WHERE   user_id 
                                        in      ({$stringOfPayers})",
                                                $costPerRM);

        checkIfQueryFails($updateBalancePayers, "Something went wrong while updating the balances of your roommates. Please try again.");
    }

    /**
     * Puts the posted costs in the right format.
     */
    function formatCost($wholeNumbers, $cents)
    {
        // if user has only filled in one digit for cents,
        // add extra 0 at the right
        if ($cents < 10)
        {
            $cents = sprintf("%02s", $cents);
        }

        return $cost = $wholeNumbers . '.' . $cents;
    }

    /**
     * Stores a new spend in the database.
     */
    function storeNewSpend($spendName, $cost)
    {
        $storeNewSpend = query("INSERT INTO finances (
            spend_name,
            spend_cost,
            user_id_poster
            ) VALUES (?, ?, ?)", 
            $spendName,
            $cost,
            $_SESSION["user_id"]);

        checkIfQueryFails($storeNewSpend, "Something went wrong while storing your spend. Please try again.");
    }

    function unsetDorm()
    {
        $dormId = 0;
        $cash = 0;
        $shoplistScore = 0;

        // erase from session
        unset($_SESSION["dorm_id"]);

        $unsetDorm = query("UPDATE  users 
                            SET     dorm_id = $dormId,
                                    cash_balance = $cash,
                                    shoplist_score = $shoplistScore 
                            WHERE   user_id = ?",
                                    $_SESSION["user_id"]);

        checkIfQueryFails($unsetDorm, "Something went wrong while leaving your dorm. Please try again.");
    }

    function setNewPassword()
    {
        $users = query("SELECT  hash
                        FROM    users
                        WHERE   user_id = ?",
                                $_SESSION["user_id"]);

        if (count($users) == 1)
        {
            $user = $users[0];

            // compare hashes
            if (crypt($_POST["password-old"], $user["hash"]) == $user["hash"])
            {
                // hash new password
                $newHash = crypt($_POST["password-new"]);

                // replace old hash with new hash
                $updatePassword = query("   UPDATE  users
                                            SET     hash = ?",
                                                    $newHash);

                checkIfQueryFails($updatePassword, "Failed to set new password. Please try again.");

                $passwordUpdated = true;

                render("showaccount.php", [
                    "passwordUpdated" => $passwordUpdated
                    ]);
            }
            else
            {
                errorMsg("Wrong password.");
            }
        }
    }

    /**
     * Registers a new user in the database.
     *
     * @@@
     */
    function registerNewUser(   $firstname, 
                                $lastname, 
                                $email, 
                                $password, 
                                $confirmation, 
                                $date_year, 
                                $date_month, 
                                $date_day)
    {
        // check input
        checkIfEmpty($firstname, "Please fill in your first name.");
        checkIfEmpty($lastname, "Please fill in your last name.");
        checkIfEmpty($email, "Please fill in your email address.");
        checkIfEmpty($password, "You must provide a password.");

        if(!preg_match("/^[a-zA-Z -]+$/", $_POST['firstname'] . $_POST['lastname']))
        {
            errorMsg("Please fill in a proper name.");
        }        
        if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["email"]))
        {
            errorMsg("Please fill in a valid email address.");
        }
        if ($_POST["password"] != $_POST["confirmation"])
        {
            errorMsg("The passwords filled in at the fields 'password' and 'confirmation' must be equal.");
        }

        checkIfEmailExists($email);

        $birthday = $_POST["date_year"] . '-' . 
                    $_POST["date_month"] . '-' . 
                    $_POST["date_day"];

        // insert new user into database
        storeNewUser($email, $password, $firstname, $lastname, $birthday);

        // query database for user
        $rows = query(" SELECT  user_id,
                                first_name,
                                last_name,
                                cash_balance,
                                dorm_id 
                        FROM    users 
                        WHERE   email = ?", 
                                $_POST["email"]);
        
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];
            
            // remember that user is now logged in
            $_SESSION["user_id"] = $row["user_id"];

            // redirect to dorm entry
            redirect("getdorm.php");        
        } 
    }

    /**
     * Checks if the given email address is already 
     * registered in the database.
     *
     * - if yes, an error message is returned that 
     *   prompts the new user to pick another email
     *   address.
     * - if not, the function returns false.
     */
    function checkIfEmailExists($email)
    {
        // check if any account is already registered under the entered email address
        $emailFound = query("   SELECT  email 
                                FROM    users
                                WHERE   email = ?",
                                        $email);

        if ($emailFound === false)
        {
            errorMsg("Something went wrong while creating your account. Please try again.");
        } 
        if (count($emailFound) >= 1) 
        {
            errorMsg("This email address is already in use. Please try another email address.");
        }
    }

    /**
     * Stores new user in database.
     */
    function storeNewUser($email, $password, $firstname, $lastname, $birthday)
    {
        $CreateNewUser = query("INSERT INTO users (
            email, 
            hash, 
            first_name, 
            last_name, 
            birth_date, 
            cash_balance
            ) VALUES(?, ?, ?, ?, ?, 0.00)", 
            $email, 
            crypt($password),
            $firstname,
            $lastname,
            $birthday);
        if ($CreateNewUser === false)
        {
            // INSERT failed, presumably because email address already existed
            errorMsg("Something went wrong while creating your account. Maybe try another email address?");
        }
    }

?>
