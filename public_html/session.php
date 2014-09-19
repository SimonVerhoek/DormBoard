<?php
	// if on register page, show nothing
	if (preg_match("{(?:register)\.php$}", $_SERVER["PHP_SELF"]))
	{
		// show nothing
	}
	else if (empty($_SESSION["user_id"]))
	{ 
		// show login form
		build("login_form.php");
	}
	else
	{
		$userName = $_SESSION["first_name"] . 
					" " . 
					$_SESSION["first_name"];

		// show dropdown menu
		build("../templates/showuser.php", [
			"userName" => $userName
			]);
	}
?>
    </nav> <!-- closes header --> 
</div> <!-- closes header -->

<div class="container">

	<div id="middle">