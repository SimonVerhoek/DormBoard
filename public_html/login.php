<?php
    /*************************************************
     *  login.php
     *
     *  Processes login requests.
     *  If no login request has been done, visitor is
     *  redirected to homepage (home.php).
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["email"]))
        {
            errorMsg("You must provide your email address.");
        }
        else if (empty($_POST["password"]))
        {
            errorMsg("You must provide your password.");
        }

        login($_POST["email"], $_POST["password"]);

        // else apologize
        errorMsg("Invalid email and/or password.");
    }
    else
    {
        // else render homepage
        render("home.php");
    }

?>