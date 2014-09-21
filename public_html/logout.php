<?php
    /*************************************************
     *  logout.php
     *
     *  Processes logout requests.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    // log out current user, if any
    logout();

    // redirect user
    redirect("index.php");

?>
