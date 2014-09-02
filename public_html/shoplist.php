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

    // get current user's dorm
    $dorm = query(" SELECT dorm_id 
                    FROM   users 
                    WHERE  user_id = ?", 
                           $_SESSION["user_id"]);

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if user entered a new item
        if (isset($_POST["item_name"]))
        {
            // insert new item
            $storeNewItem = query("INSERT INTO shoplist (
                dorm_id,
                item_name,
                post_date,
                user_id_poster
                ) VALUES (?, ?, NOW(), ?)",
                    $dorm[0]["dorm_id"],
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
        
        // if user bought an item
        else if (in_array($_POST["solve"], $unsolvedItems))
        {
            $itemID = (int)$_POST["solve"];

            $storePurchase = query('UPDATE  shoplist
                                    SET     solve_date = NOW(),
                                            user_id_solver = ?
                                    WHERE   item_id = ?', 
                                            $_SESSION["user_id"], 
                                            $itemID);

            if ($storePurchase === false)
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
        else
        {
            errorMsg("Something went wrong while storing your action. Please try again.");
        }

    }
    
	$listItems = query("SELECT  item_id,
                                item_name,
                                post_date,
                                solve_date,
                                user_id_poster,
                                user_id_solver
                        FROM    shoplist
                        WHERE   dorm_id = ?
                        ORDER BY post_date DESC",
                                $dorm[0]["dorm_id"]);

    $roommates = query("SELECT      user_id,
                                    first_name,
                                    last_name,
                                    shoplist_score
                        FROM        users
                        WHERE       dorm_id = ?
                        ORDER BY    shoplist_score DESC",
                                    $dorm[0]["dorm_id"]);

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