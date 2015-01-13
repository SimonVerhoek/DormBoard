 <?php

    /*************************************************
     *   shoplist.php
     *
     *   Shows:
     *   -   a list with groceries and other articles 
     *       that have to be bought for dorm use.
     *   -   a scoreboard with ranking of the roommates'
     *       amount of items bought/solved.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $newItem = checkInput($_POST["item_name"]);

        storeNewShoplistItem($newItem);
        
        // refresh page
        redirect("shoplist.php");
    }

    // get roommate data and buyer rankings
    $roommates = getRoommateData(3);

    render("showshoplist.php", [
        "title" => "Shopping list",
		"user_id" => $_SESSION["user_id"],
        "roommates" => $roommates
    	]);
?>