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
            setShoplistItemSolveDate($_POST["from-shoplist"]);

            updateShoplistScore();
        }

        $postedChecklist = $_POST["check_list"];

        $spendName = checkInput($_POST["spend_name"]);

        $cost = formatCost($_POST["spend_cost_whole"], $_POST["spend_cost_cents"]);

        updateFinances($cost, $postedChecklist, $spendName);
        
        // refresh page
        redirect("finances.php");  	
    }

    render("showfinances.php", [
        "title" => "Dorm finances"
    	]);
?>