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
		$roommatesList = getRoommateData($_SESSION["user_id"], 1);

		build("../templates/shownavbar.php", [
			"dormName" => $_SESSION["dorm_name"],
			"roommatesList" => $roommatesList
			]);
	}
?>

