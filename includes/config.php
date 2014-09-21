<?php

    /*************************************************
     *  config.php
     *
     *  Configures pages.
     *  If user redirects to page that requires
     *  authentication when not logged in, user is
     *  redirected to homepage (login.php).
     *   
     **************************************************/

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("constants.php");
    require("functions.php");

    // enable sessions
    session_start();

    // require authentication for most pages
    if (!preg_match("{(?:login|logout|register)\.php$}", $_SERVER["PHP_SELF"]))
    {
        if (empty($_SESSION["user_id"]))
        {
            redirect("login.php");
        }
    }

?>
