<?php
    /*************************************************
     *  index.php
     *
     *  Redirects user on first visit (after a while).
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 
	
	// check if user is already member of a dorm first
	redirect("getdorm.php");

?>


