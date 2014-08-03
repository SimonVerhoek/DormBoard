***REMOVED***
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

		echo 	"<div id='session' class='text-right'>";

		echo		"<p>" .
						"You are logged in as:<br>" .
						"<strong>" . 
							$user[0]["first_name"] . 
							" " .
							$user[0]["last_name"] .
						"</strong>" .
					"</p>";

		echo 		"<a href='profile.php'>" .
					'<button type="button" class="btn btn-primary">Profile</button>' .
					"</a>";

		echo 		'<a href="../public_html/logout.php">' .
						'<button type="button" class="btn btn-primary">Log Out</button>' .
					'</a>';

		echo 	"</div>";

	}
***REMOVED***

        </div> <!-- closes sessioncorner -->
    </div> <!-- closes row  -->
</div> <!-- closes header -->

<div id="middle">