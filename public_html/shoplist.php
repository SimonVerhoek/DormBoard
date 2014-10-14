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

        // insert new item
        $storeNewItem = query("INSERT INTO shoplist (
            dorm_id,
            item_name,
            post_date,
            user_id_poster
            ) VALUES (?, ?, NOW(), ?)",
                $_SESSION["dorm_id"],
                $newItem,
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

    // get roommate data and buyer rankings
    $roommates = getRoommateData(3);
    
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

    $items = [];

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

    render("showshoplist.php", [
        "title" => "Shopping list",
		"user_id" => $_SESSION["user_id"],
        "roommates" => $roommates,
        "items" => $items
    	]);
?>