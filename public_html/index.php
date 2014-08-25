
<?php

    // configuration
    require("../includes/config.php"); 

    
	// query user's data
	$user = query("	SELECT 	user_id,
							first_name,
							last_name,
							cash_balance,
							dorm_id 
					FROM 	users 
					WHERE 	user_id = ?",
					$_SESSION["user_id"]);
	
	render("getdorm.php", [
		"title" => "Dashboard",
		"user" => $user,
		"user_id" => $_SESSION["user_id"]
		]);

?>


