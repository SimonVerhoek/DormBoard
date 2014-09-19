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

    date_default_timezone_set("Europe/Amsterdam");

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // insert new item
        $storeNewItem = query("INSERT INTO shoplist (
            dorm_id,
            item_name,
            post_date,
            user_id_poster
            ) VALUES (?, ?, NOW(), ?)",
                $_SESSION["dorm_id"],
                $_POST["item_name"],
                $_SESSION["user_id"]
        );

        if ($storeNewItem === false)
        {
            // INSERT failed
            errorMsg("Something went wrong while storing your action. Please try again.");
        }
        else
        {
            // refresh page
            redirect("shoplist.php");
        }
    }
    
	$listItems = query("SELECT      item_id,
                                    item_name,
                                    post_date,
                                    solve_date,
                                    user_id_poster,
                                    user_id_solver
                        FROM        shoplist
                        WHERE       dorm_id = ?
                        ORDER BY    post_date DESC",
                                    $_SESSION["dorm_id"]);

    $roommates = query("SELECT      user_id,
                                    first_name,
                                    last_name,
                                    shoplist_score
                        FROM        users
                        WHERE       dorm_id = ?
                        ORDER BY    shoplist_score DESC",
                                    $_SESSION["dorm_id"]);

    // make array of unsolved item ids
    $unsolvedItems = [];

    foreach ($listItems as $i => $item) 
    {
        // if item is unsolved
        if (empty($items[$i]["user_id_solver"]))
        {
            array_push($unsolvedItems, $item["item_id"]);
        }
    }

    render("showshoplist.php", [
        "title" => "Shopping list",
		"user_id" => $_SESSION["user_id"],
        "roommates" => $roommates,
		"listItems" => $listItems
    	]);
?>