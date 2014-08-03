***REMOVED***

    // configuration
    require("../includes/config.php"); 

    date_default_timezone_set("Europe/Amsterdam");

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	if (empty($_POST["spend_name"]))
    	{
    		errorMsg("Please fill in a name for what you bought.");
    	}
        // check if form has at least 2 alphabetic characters in it.
        if (!preg_match("/([A-Za-z])\w+/", $_POST["spend_name"]))
        {
            errorMsg("This looks a bit unclear for your roommates. Maybe you can think of a clearer name?");
        }

        // check if costs are filled in properly
    	if (empty($_POST["spend_cost_whole"]) && 
            empty($_POST["spend_cost_cents"]))
    	{
    		errorMsg("Please fill what you spent.");
    	}
        else if (!is_numeric($_POST["spend_cost_whole"]) && 
                 $_POST["spend_cost_whole"] != 0)
        {
            errorMsg("Please fill in the cost as digits only.");
        }

        if (!empty($_POST["spend_cost_cents"]) && 
            !is_numeric($_POST["spend_cost_cents"]))
        {
            errorMsg("Please fill in the cost as digits only.");
        }

        // check who spend is for
        if (empty($_POST["check_list"]))
        {
            errorMsg("Please check at least one roommate who the spend is for.");
        }

        // if from shoplist, set item as solved 
        if (isset($_POST["from-shoplist"]))
        {
            $itemID = (int)$_POST["from-shoplist"];

            $storePurchase = query('UPDATE  shoplist
                                    SET     solve_date = NOW(),
                                            user_id_solver = ?
                                    WHERE   item_id = ?', 
                                    $_SESSION["user_id"], $itemID);
            if ($storePurchase === false)
            {
                errorMsg("Something went wrong while storing your action. Please try again.");
            }
        }

        $wholes = $_POST["spend_cost_whole"];
        $cents = $_POST["spend_cost_cents"];

        if ($cents < 10)
        {
            // add 0 before digit
            $cents = sprintf("%02s", $cents);
        }

        $cost = $wholes . 
                '.' . 
                $cents;

        $payerIDs = $_POST["check_list"];

        $numPayers = count($payerIDs);
        
        // if user bought item for himself only
        if ($numPayers == 1 && 
            in_array($_SESSION["user_id"], $_POST["check_list"]))
        {
            // balances stay exactly like they are
        }
        else
        {
            // divide costs
            $costPerRM = $cost / $numPayers;

            // if user bought item but does not share the costs
            if(($key = array_search($_SESSION["user_id"], $payerIDs)) === false)
            {
                $credit = $cost;
            }
            else
            {
                $credit = $cost - $costPerRM;
                unset($payerIDs[$key]);
            };

            $updateBalanceUser = query(
                "UPDATE users
                 SET    cash_balance = cash_balance + ?
                 WHERE  user_id = ?",
                 $credit, $_SESSION["user_id"]);

            if ($updateBalanceUser === false)
            {
                // query failed
                errorMsg("Something went wrong while storing your spend. Please try again.");
            }      

            
            // create string of all payerIDs
            $payersStr = implode(',', $payerIDs);           

            $updateBalancePayers = query(
                "UPDATE users
                 SET    cash_balance = cash_balance - ?
                 WHERE  user_id in ({$payersStr})",
                 $costPerRM);

            if ($updateBalancePayers === false)
            {
                // query failed
                errorMsg("Something went wrong while storing your spend. Please try again.");
            } 
        }

        // store spend in db
        $storeAction = query("INSERT INTO finances (
            spend_name,
            spend_cost,
            user_id_poster
            ) VALUES (?, ?, ?)", 
            $_POST["spend_name"],
            $cost,
            $_SESSION["user_id"]);

        if ($storeAction === false)
        {
            // INSERT failed
            errorMsg("Something went wrong while storing your spend. Please try again.");
        }
        
        // refresh page
        redirect("finances.php");  	
    }

    // get current user's dorm
    $dorm = query(" SELECT  dorm_id 
                    FROM    users 
                    WHERE   user_id = ?", 
                            $_SESSION["user_id"]);

    // get roommates and their cash balances
    $roommates = query("SELECT      user_id,
                                    first_name,
                                    last_name,
                                    cash_balance
                        FROM        users
                        WHERE       dorm_id = ?
                        ORDER BY    first_name ASC",
                                $dorm[0]["dorm_id"]);

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
                                $dorm[0]["dorm_id"]);

    render("showfinances.php", [
		"user_id" => $_SESSION["user_id"],
		"spends" => $spends,
		"roommates" => $roommates
    	]);
***REMOVED***