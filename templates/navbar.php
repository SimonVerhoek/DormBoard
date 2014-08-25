<!--
 |
 |	shows welcome message and navigation bar.
 |
 -->

<?php 
	//show navbar only when logged in
	if (!preg_match("{(?:login|register|getdorm)\.php$}", $_SERVER["PHP_SELF"]))
	{
		// query user's data
		$user = query("	SELECT 	first_name,
								last_name,
								cash_balance,
								dorm_id 
						FROM 	users 
						WHERE 	user_id = ?", 
						$_SESSION["user_id"]);

		// query all users that are member of same dorm
		$rows = query("	SELECT 	first_name, 
								last_name 
						FROM 	users 
						WHERE 	dorm_id = ?", 
						$user[0]["dorm_id"]);

		// query dorm name
		$dorm = query("	SELECT 	dorm_name 
						FROM 	dorms 
						WHERE 	dorm_id =?", 
						$user[0]["dorm_id"]);

		$roomMates = [];

		// for each roommate
		foreach ($rows as $roomMate)
		{
			$roomMates[] = [
			"first_name" => $roomMate["first_name"],
			"last_name" => $roomMate["last_name"]
			]; 
		}

		build("../templates/shownavbar.php", [
			"dorm" => $dorm,
			"roomMates" => $roomMates,
			]);
	}

	// place dashboard tabs at the right of the navigation bar
	if (!preg_match("{(?:login|register)\.php$}", $_SERVER["PHP_SELF"]))
	{
		echo("<div class='col-md-10 column'>");
	}
?>

