<?php

    // configuration
    require("../includes/config.php");

    // if user is already member of a dorm, query dorm id
    $existingDormId = query("	SELECT 	dorm_id
								FROM 	users 
								WHERE 	user_id = ?", 
										$_SESSION["user_id"]);

    // if user posted dorm form
    if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// if joining existing dorm
		if (isset($_POST['join'])) 
		{
			// validate submission
			if (empty($_POST["dormname"]))
			{
	            errorMsg("You must fill in the name of the dorm you want to join!");
            }
	        if (empty($_POST["dormpassword"]))
        	{
	            errorMsg("You must provide the dorm's password.");
            }

	    	// search for dorms that match data
	        $dorms = query("SELECT 	dorm_id,
	        						hash 
	        				FROM 	dorms 
        					WHERE 	dorm_name = ?", 
        							$_POST["dormname"]);

	        // make sure only one dorm is selected
	        if (count($dorms) == 1)
        	{
        		$dorm = $dorms[0];

        		// compare hash of user's input against hash that's in database
	            if (crypt($_POST["dormpassword"], $dorm["hash"]) == $dorm["hash"])
	            {
	                // add dorm_id to user
	                $joinDorm = query("	UPDATE 	users 
	                					SET 	dorm_id = ? 
	                					WHERE 	user_id = ?", 
	                							$dorm["dorm_id"], 
	                							$_SESSION["user_id"]);

	                // redirect to dashboard
	                redirect("dinner.php");
	            }
	            else
	            {
	            	errorMsg("Could not join dorm. Are you sure the password is correct?");
	            }
        	}
        	else
        	{
        		echo errorMsg("No dorms were found. Are you sure you spelled the name correctly?");
        	}
		}
		// if creating new dorm
		else if (isset($_POST['create'])) 
		{
			// validate submission
			if (empty($_POST["dormname"]))
			{
	            errorMsg("You must fill in the name of the dorm you want to join!");
            }
	        if (empty($_POST["dormpassword"]))
        	{
	            errorMsg("You must give your dorm a password!");
            }
	        if ($_POST["dormpassword"] != $_POST["confirmation"])
        	{
            	errorMsg("You filled in two different passwords!");
        	}

	    	// store data
            $createNewDorm = query("INSERT INTO dorms (
            	dorm_name, 
            	hash
            	) VALUES(?, ?)", 
            	$_POST["dormname"],
            	crypt($_POST["dormpassword"]));

            $dorms = query("SELECT 	dorm_id 
            				FROM 	dorms 
            				WHERE 	dorm_name = ?", 
            						$_POST["dormname"]);

            if ($dorms === false)
        	{
	        	// dorm not found
                errorMsg("Something went wrong while creating your dorm. Please try again.");
            }

            // make sure only one dorm is selected
	        if (count($dorms) == 1)
        	{
        		$dorm = $dorms[0];

            	// add dorm_id to user
            	$joinDorm = query("	UPDATE 	users 
            						SET 	dorm_id = ? 
            						WHERE 	user_id = ?", 
            								$dorm["dorm_id"], 
            								$_SESSION["user_id"]);
        	}

            if ($createNewDorm === false)
        	{
				// INSERT failed
                errorMsg("Something went wrong while creating your dorm. Please try again.");
            }

	    	// redirect to dashboard
	    	redirect("dinner.php");
		}
	}
	// if user is already member of a dorm, render dashboard
	else if (!empty($existingDormId[0]["dorm_id"]))
	{
		redirect("dinner.php");
	}
	// else render dorm form
	else
	{
		render("getdorm_form.php");
	}
?>
