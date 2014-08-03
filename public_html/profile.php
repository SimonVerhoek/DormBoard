***REMOVED***

    // configuration
    require("../includes/config.php");

    $user = query("	SELECT 	user_id,
    						first_name,
    						last_name,
    						cash_balance,
    						dorm_id 
    				FROM 	users 
					WHERE 	user_id = ?", 
					$_SESSION["user_id"]);

    // if user has opted to leave his dorm
    if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$cash = 0;
		$dormId = 0;

		query("	UPDATE 	users 
				SET 	dorm_id = ?,
						cash_balance = $cash 
				WHERE 	user_id = ?", 
						$dormId, 
						$_SESSION["user_id"]);

		redirect("getdorm.php");
	}
	// if user is member of a dorm, show leave dorm option
    else if (!empty($user[0]["dorm_id"]))
	{
		render("profile_form.php");
	}  	
	// if user is not a member of any dorm
	else
	{
		render("getdorm.php");
	}
***REMOVED***