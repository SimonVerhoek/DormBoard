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
        // check input
        checkIfEmpty($_POST["firstname"], "Please fill in your first name.");
        checkIfEmpty($_POST["lastname"], "Please fill in your last name.");
        checkIfEmpty($_POST["email"], "Please fill in your email address.");
        checkIfEmpty($_POST["password"], "You must provide a password.");

        if(!preg_match("/^[a-zA-Z -]+$/", $_POST['firstname'] . $_POST['lastname']))
        {
            errorMsg("Please fill in a proper name.");
        }        
        if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST["email"]))
        {
            errorMsg("Please fill in a valid email address.");
        }
        if ($_POST["password"] != $_POST["confirmation"])
        {
            errorMsg("The passwords filled in at the fields 'password' and 'confirmation' must be equal.");
        }

        registerNewUser($_POST["firstname"], 
                        $_POST["lastname"], 
                        $_POST["email"], 
                        $_POST["password"], 
                        $_POST["confirmation"], 
                        $_POST["date_year"], 
                        $_POST["date_month"], 
                        $_POST["date_day"]);
    }
    else
    {
        // else render form
        render("register_form.php", [
            "title" => "Register"
        ]);
    }

?>
