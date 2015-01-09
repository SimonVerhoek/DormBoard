<?php
    /*************************************************
     *  session.php
     *
     *  Shows user data of logged in user at top right.
     *	If no user is logged in, shows:
     *	-	login button
     *	-	signup button
     *   
     **************************************************/

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
		// show dropdown menu
		build("../templates/showuser.php", [
			"userName" => $_SESSION["first_name"]
			]);
	}
?>
    </nav> <!-- closes header --> 
</div> <!-- closes header -->

<div class="container">

	<div id="middle">