<?php
    /*************************************************
     *  finances.php
     *
     *  Shows:
     *  -   a list with items that have been bought for
     *      use by one or more roommates. shows:
     *      -   the registry date
     *      -   the item's name (as entered by the user)
     *      -   the name of the roommate that made the purchase
     *      -   the costs of the spend
     *  -   a table with all the roommate's balances of 
     *      money spent - costs made. 
     *      
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	checkIfEmpty($_POST["spend_name"], "Please fill in a name for what you bought.");

        // check if form has at least 2 alphabetic characters in it.
        if (!preg_match("/([A-Za-z])\w+/", $_POST["spend_name"]))
        {
            errorMsg("This looks a bit unclear for your roommates. Maybe you can think of a clearer name?");
        }

        checkInputSpendCosts($_POST["spend_cost_whole"], $_POST["spend_cost_cents"]);

        // check who spend is for
        checkIfEmpty($_POST["check_list"], "Please check at least one roommate who the spend is for.");

        // if from shoplist, set item as solved 
        if (isset($_POST["from-shoplist"]))
        {
            $itemID = (int)$_POST["from-shoplist"];

            $storePurchase = query('UPDATE  shoplist
                                    SET     solve_date = NOW(),
                                            user_id_solver = ?
                                    WHERE   item_id = ?', 
                                    $_SESSION["user_id"], $itemID);


            $addScore = query(" UPDATE  users
                                SET     shoplist_score = shoplist_score + 1
                                WHERE   user_id = ?",
                                        $_SESSION["user_id"]);

            if ($addScore === false)
            {
                // INSERT failed
                errorMsg("Something went wrong while storing your action. Please try again.");
            }
            else if ($storePurchase === false)
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

        $cost = $wholes . '.' . $cents;

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

        $spendName = checkInput($_POST["spend_name"]);

        // store spend in db
        $storeAction = query("INSERT INTO finances (
            spend_name,
            spend_cost,
            user_id_poster
            ) VALUES (?, ?, ?)", 
            $spendName,
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

    render("showfinances.php", [
        "title" => "Dorm finances"
    	]);
?>