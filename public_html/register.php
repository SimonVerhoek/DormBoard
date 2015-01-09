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
        registerNewUser(
            $_POST["firstname"], 
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
