<?php
    /*************************************************
     *  account.php
     *
     *  Processes changes in account settings.
     *	Shows following account settings:
     *	-	change password
     *	-	leave dorm
     *   
     **************************************************/

    // configuration
    require("../includes/config.php");

	$passwordUpdated = false;

	// if form posted
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// if user opted to leave dorm
		if (isset($_POST["leave-dorm"]))
		{
			unsetDorm();

			redirect("getdorm.php");
		}
		// if user opted to change his password
		else if (isset($_POST["change-password"]))
		{
			// validate entries
			checkIfEmpty($_POST["password-old"], "Please fill in your old password.");
			checkIfEmpty($_POST["password-new"], "Please fill in a new password.");
			checkIfEmpty($_POST["password-new-confirm"], "Please confirm your new password.");

	    	// compare new passwords
	    	if ($_POST["password-new"] != $_POST["password-new-confirm"])
	        {
	            errorMsg('Make sure that what you fill in at "new password" and "confirm new password" are equal to each other!');
	        }
	        else setNewPassword();
		}
	}
	// if user is member of a dorm, show leave dorm option
    else if (!empty($_SESSION["dorm_id"]))
	{
		render("showaccount.php", [
			"title" => "Your account",
			"passwordUpdated" => $passwordUpdated
			]);
	}  	
	// if user is not a member of any dorm
	else
	{
		redirect("getdorm.php");
	}
		
?>