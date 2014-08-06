***REMOVED***
	// configuration
    require("../includes/config.php"); 

    // if user has opted to leave his dorm
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	// validate entries
    	if(empty($_POST["password-old"]))
    	{
    		errorMsg("Please fill in your old password.");
    	}
    	if(empty($_POST["password-new"]))
    	{
    		errorMsg("Please fill in a new password.");
    	}
    	if(empty($_POST["password-new-confirm"]))
    	{
    		errorMsg("Please confirm your new password.");
    	}

    	// compare new passwords
    	if ($_POST["password-new"] != $_POST["password-new-confirm"])
        {
            errorMsg('Make sure that what you fill in at "new password" and "confirm new password" are equal to each other!');
        }

        $users = query("SELECT 	hash
        				FROM 	users
    					WHERE 	user_id = ?",
    							$_SESSION["user_id"]);

        if (count($users) == 1)
        {
        	$user = $users[0];

        	// compare hashes
        	if (crypt($_POST["password-old"], $user["hash"]) == $user["hash"])
        	{
        		// hash new password
        		$newHash = crypt($_POST["password-new"]);

        		// replace old hash with new hash
        		$updatePassword = query("	UPDATE 	users
        									SET 	hash = ?",
        									$newHash);

        		if ($updatePassword === false)
        		{
        			errorMsg("Failed to set new password. Please try again.");
        		}
        		else
        		{
        			redirect("profile.php");
        		}
        	}
        }

    }
***REMOVED***