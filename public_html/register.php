<?php
    /*************************************************
     *  register.php
     *
     *  Processes new user registrations.
     *   
     **************************************************/
	
    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        if (empty($_POST["firstname"])) 
        {
            errorMsg("Please fill in your first name.");
        }
        if (empty($_POST["lastname"])) 
        {
            errorMsg("Please fill in your last name.");
        }
        if(!preg_match("/^[a-zA-Z -]+$/", $_POST['firstname'] . $_POST['lastname']))
        {
            errorMsg("Please fill in a proper name.");
        }
        if (empty($_POST["email"]))
        {
            errorMsg("Please fill in your email address.");
        }
        if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["email"]))
        {
            errorMsg("Please fill in a valid email address.");
        }
        
        // check passwords
        if (empty($_POST["password"]))
        {
            errorMsg("You must provide a password.");
        }
        if ($_POST["password"] != $_POST["confirmation"])
        {
            errorMsg("The passwords filled in at the fields 'password' and 'confirmation' must be equal.");
        }

        // check if any account is already registered under the entered email address
        $emailFound = query("   SELECT  email 
                                AS      nrEmailsFound
                                FROM    users
                                WHERE   email = ?",
                                $_POST["email"]);

        if ($emailFound === false)
        {
            errorMsg("Something went wrong while creating your account. Please try again.");
        } 

        if (count($emailFound) >= 1) 
        {
            errorMsg("This email address is already in use. Please try another email address.");
        }
        else 
        {
            $birthday = $_POST["date_year"] . '-' . 
                        $_POST["date_month"] . '-' . 
                        $_POST["date_day"];

            // insert new user into database
            $CreateNewUser = query("INSERT INTO users (
                email, 
                hash, 
                first_name, 
                last_name, 
                birth_date, 
                cash_balance
                ) VALUES(?, ?, ?, ?, ?, 0.00)", 
                $_POST["email"], 
                crypt($_POST["password"]),
                $_POST["firstname"],
                $_POST["lastname"],
                $birthday);
            if ($CreateNewUser === false)
            {
                // INSERT failed, presumably because email address already existed
                errorMsg("Something went wrong while creating your account. Maybe try another email address?");
            } 
            else
            {
                // query database for user
                $rows = query(" SELECT  user_id,
                                        first_name,
                                        last_name,
                                        cash_balance,
                                        dorm_id 
                                FROM    users 
                                WHERE   email = ?", 
                                        $_POST["email"]);
                
                if (count($rows) == 1)
                {
                    // first (and only) row
                    $row = $rows[0];
                    
                    // remember that user is now logged in
                    $_SESSION["user_id"] = $row["user_id"];

                    // redirect to dorm entry
                    redirect("getdorm.php");
                }               
            }
        } 
    }
    else
    {
        // else render form
        render("register_form.php", [
            "title" => "Register"
        ]);
    }

?>
