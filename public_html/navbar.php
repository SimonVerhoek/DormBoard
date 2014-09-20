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
		$roomMates = query("	SELECT 	first_name, 
										last_name 
								FROM 	users 
								WHERE 	dorm_id = ?", 
										$_SESSION["dorm_id"]);

		build("../templates/shownavbar.php", [
			"dormName" => $_SESSION["dorm_name"],
			"roomMates" => $roomMates
			]);
	}
?>

