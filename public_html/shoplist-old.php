sho<!--
 |
 |  Shows a list with groceries and other articles 
 |	that have to be bought for dorm use.
 |
 -->

 ***REMOVED***

    // configuration
    require("../includes/config.php"); 

    date_default_timezone_set("Europe/Amsterdam");

    // get current user's dorm
    $dorm = query(" SELECT dorm_id 
					FROM   users 
					WHERE  user_id = ?", 
					$_SESSION["user_id"]);

	// get all dorm's item data
    $items = query("SELECT 	shoplist.item_id,
                            shoplist.item_name,
							shoplist.post_date,
                            shoplist.solve_date,
                            shoplist.user_id_solver,
							users.first_name,
							users.last_name
    						FROM shoplist
    						INNER JOIN users
    						ON shoplist.user_id_poster = users.user_id
    						WHERE users.dorm_id = ?
                            ORDER BY shoplist.post_date DESC",
    						$dorm[0]["dorm_id"]);

    $itemsBought = query("SELECT    shoplist.item_id,
                                    shoplist.solve_date,
                                    users.first_name,
                                    users.last_name
                                    FROM shoplist
                                    INNER JOIN users
                                    ON shoplist.user_id_solver = users.user_id
                                    WHERE users.dorm_id = ?
                                    ORDER BY shoplist.post_date DESC",
                                    $dorm[0]["dorm_id"]);

    // make array of solved and unsolved item ids
    $unsolvedItems = [];
    $solvedItems = [];

    foreach ($items as $i => $item) 
    {
        // if item is unsolved
        if (empty($items[$i]["user_id_solver"]))
        {
            array_push($unsolvedItems, $item["item_id"]);
        }
        // if item is solved
        else
        {
            array_push($solvedItems, $item["item_id"]);
        }

    }
    $unsolvedItemsStr = implode(',', $unsolvedItems);


    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	// if user entered a new item
        if (isset($_POST["item_name"]))
        {
            // insert new item
            $storeAction = query("INSERT INTO shoplist (
                dorm_id,
                item_name,
                post_date,
                user_id_poster
                ) VALUES (?, ?, NOW(), ?)",
                    $dorm[0]["dorm_id"],
                    $_POST["item_name"],
                    $_SESSION["user_id"]
            );

            if ($storeAction === false)
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

            $storeAction = query('  UPDATE  shoplist 
                                    SET     solve_date = NOW(),
                                            user_id_solver = ?
                                    WHERE   item_id = ?', 
                                    $_SESSION["user_id"], $itemID);
            if ($storeAction === false)
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
    
    render("showshoplist.php", [
		"user_id" => $_SESSION["user_id"],
		"items" => $items,
        "itemsBought" => $itemsBought
    	]);
***REMOVED***