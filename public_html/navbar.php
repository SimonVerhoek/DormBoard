<!--
 |
 |	shows welcome message and navigation bar.
 |
 -->

<?php 
	//show navbar only when logged in
	if (!preg_match("{(?:login|register|getdorm)\.php$}", $_SERVER["PHP_SELF"]))
	{
		// query all users that are member of same dorm
		$rows = query("	SELECT 	first_name, 
								last_name 
						FROM 	users 
						WHERE 	dorm_id = ?", 
						$_SESSION["dorm_id"]);

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
			"dormName" => $_SESSION["dorm_name"],
			"roomMates" => $roomMates
			]);
	}
?>

