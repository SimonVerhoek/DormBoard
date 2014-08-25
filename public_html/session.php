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
		// show current user logged in
		$user = query("	SELECT 	first_name, 
								last_name, 
								dorm_id 
						FROM 	users 
						WHERE 	user_id = ?", 
								$_SESSION["user_id"]);

		$dorm = query("	SELECT 	dorm_name 
						FROM 	dorms 
						WHERE 	dorm_id = ?", 
								$user[0]["dorm_id"]);

		// show dropdown menu
		build("../templates/showuser.php", [
			"user" => $user
			]);
	}
?>
		</div> <!-- closes navbar-collapse -->
    </nav> <!-- closes header --> 
</div> <!-- closes header -->

<div class="container">

	<div id="middle">