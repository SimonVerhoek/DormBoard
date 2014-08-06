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

    	// if old password is correct
    		// hash new password
        	// replace old hash with new hash


    }
***REMOVED***