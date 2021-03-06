<?php
    /*************************************************
     *	getdorm.php
     *
     *  Handles user's dorm information.
     *
     *	Processes:
     *	-	user joining an existing dorm
     *	- 	user creating (and joining) a new dorm
     *
     *	Redirects user:
     * 	- 	if user is member of a dorm 
     *		--> redirect to dinner.php
     *	-	if user is not member of a dorm 
     *		--> redirect to getdorm_form.php
     *   
     **************************************************/

    // configuration
    require("../includes/config.php");

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
                                    dorm_name,
	        						hash 
	        				FROM 	dorms 
        					WHERE 	dorm_name = ?", 
        							$_POST["dormname"]);

	        // make sure only one dorm is selected
	        if (count($dorms) == 0)
	        {
	        	errorMsg("No dorms were found. Are you sure you spelled the name correctly?");
	        }
            else
            {
            	foreach ($dorms as $dorm) 
            	{
            		// compare hash of user's input against hash that's in database
		            if (crypt($_POST["dormpassword"], $dorm["hash"]) == $dorm["hash"])
		            {
		                // add dorm_id to user
		                $joinDorm = query("	UPDATE 	users 
		                					SET 	dorm_id = ? 
		                					WHERE 	user_id = ?", 
		                							$dorm["dorm_id"], 
		                							$_SESSION["user_id"]);
		                if ($joinDorm === false)
			        	{
				        	// dorm not found
			                errorMsg("Something went wrong while joining your dorm. Please try again.");
			            }

                        // save new dorm data in session
                        $_SESSION["dorm_id"] = $dorm["dorm_id"];
                        $_SESSION["dorm_name"] = $dorm["dorm_name"];

		                // redirect to dashboard
		                redirect("dinner.php");
		            }
            	}
            	errorMsg("Could not join dorm. Are you sure you filled in the correct password?");
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
            if ($createNewDorm === false)
            {
                // INSERT failed
                errorMsg("Something went wrong while creating your dorm. Please try again.");
            }

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
                if ($joinDorm === false)
                {
                    // dorm not found
                    errorMsg("Something went wrong while joining your dorm. Please try again.");
                }
        	}

            // save new dorm id in session
            $_SESSION["dorm_id"] = $dorm["dorm_id"];

	    	// redirect to dashboard
	    	redirect("dinner.php");
		}
	}
	// if user is already member of a dorm, render dashboard
	else if (!empty($_SESSION["dorm_id"]))
	{
		redirect("dinner.php");
	}
	// else render dorm form
	else
	{
		render("getdorm_form.php");
	}
?>
