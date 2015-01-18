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
        checkIfEmpty($_POST["email"], "You must provide your email address.");
        checkIfEmpty($_POST["password"], "You must provide your password.");

        login($_POST["email"], $_POST["password"]);
    }
    else
    {
        // else render homepage
        render("home.php");
    }

?>