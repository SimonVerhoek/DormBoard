<!--
 |
 |	shows welcome message and navigation bar.
 |
 -->

<?php 
	//show navbar only when logged in
	if (!preg_match("{(?:login|register|getdorm)\.php$}", $_SERVER["PHP_SELF"]))
	{
		// get roommate data
		$roommatesList = getRoommateData($_SESSION["user_id"], 1);

		build("../templates/shownavbar.php", [
			"dormName" => $_SESSION["dorm_name"],
			"roommatesList" => $roommatesList
			]);
	}
?>

