<?php
    /*************************************************
     *  dinner.php
     *
     *  Shows:
     *  -  a table containing the upfollowing days
     *     as columns
     *  -  roommates and their "dinner actions" (cook,
     *     join dinner, NOT join dinner) for these days
     *     per row.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    // number of days shown in dinner schedule
    define("NRDAYSINCALENDAR", 6);

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
            action_date, 
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

        // if user opted to cook, send roommates an email notification
        else if ($_POST["what"] == "1" ) 
        {
            // save opted date into session
            $_SESSION["date_cooking"] = $_POST["when"];

            redirect("dinner-email.php");
        }
        else
        {
            // refresh page
            redirect("dinner.php");
        }
    }

    // get who his roommates are
    $roommates = query("SELECT 	user_id, 
    							first_name, 
    							last_name 
                        FROM    users 
                        WHERE   dorm_id = ?", 
                                $_SESSION["dorm_id"]);

    // get statuses of all user's roommates
    $rmList = [];

    foreach ($roommates as $roommate) 
    {
    	array_push($rmList, $roommate["user_id"]);
    }
    $usersStr = implode(',', $rmList);

    $statuses = query(" SELECT  user_id, 
                                action_date, 
                                status 
                        FROM    dinner 
                        WHERE   user_id 
                        in      ({$usersStr})");

    // create dates of upcoming days
	$days = new DatePeriod(new DateTime, new DateInterval('P1D'), NRDAYSINCALENDAR);

    render("showdinner.php", [
        "title" => "Dinner schedule",
		"user_id" => $_SESSION["user_id"],
		"days" => $days,
		"roommates" => $roommates,
		"statuses" => $statuses
    	]);
?>