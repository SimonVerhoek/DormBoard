***REMOVED***

    // configuration
    require("../includes/config.php"); 

    date_default_timezone_set("Europe/Amsterdam");

    // if user posted form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        // get action input
        if (empty($_POST["what"]))
        {
            errorMsg("Please choose what you would like to do.");
        }
        if (empty($_POST["when"]))
        {
            errorMsg("Please choose when you want to do this.");
        }

        // update or insert user's status input
        $storeAction = query("INSERT INTO dinner (
            user_id, 
            date, 
            status
            ) VALUES (
            '" . $_SESSION["user_id"] . "', 
            '" . $_POST["when"] . "', 
            '" . $_POST["what"] . "'
            ) ON DUPLICATE KEY UPDATE 
                status = '" . $_POST["what"] . "'
        ");

        if ($storeAction === false)
        {
            // INSERT failed
            errorMsg("Something went wrong while storing your action. Please try again.");
        }
        else
        {
            // refresh page
            redirect("dinner.php");
        }
    }

    // get current user's'dorm
    $user = query(" SELECT  dorm_id 
                    FROM    users 
                    WHERE   user_id = ?", 
                            $_SESSION["user_id"]);

    // get who his roommates are
    $roommates = query("SELECT 	user_id, 
    							first_name, 
    							last_name 
                        FROM    users 
                        WHERE   dorm_id = ?", 
                                $user[0]["dorm_id"]);

    // get statuses of all user's roommates
    $rmList = [];

    foreach ($roommates as $roommate) 
    {
    	array_push($rmList, $roommate["user_id"]);
    }
    $usersStr = implode(',', $rmList);

    $statuses = query(" SELECT  user_id, 
                                date, 
                                status 
                        FROM    dinner 
                        WHERE   user_id 
                        in      ({$usersStr})");

    // create dates of upcoming days
    $nrDays = 6;
	$days = new DatePeriod(new DateTime, new DateInterval('P1D'), $nrDays);

    render("showdinner.php", [
		"user_id" => $_SESSION["user_id"],
		"days" => $days,
		"roommates" => $roommates,
		"statuses" => $statuses
    	]);
***REMOVED***