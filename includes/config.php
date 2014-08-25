<?php

    /**
     * config.php
     *
     * Programmeren 2 - Final Project
     * Made by Simon Verhoek.
     *
     * Configures pages.
     */ 

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
