<?php
    /*************************************************
     *  verify.php
     *
     *  Shows:
     *  -  a table containing the upfollowing days
     *     as columns
     *  -  roommates and their "dinner actions" (cook,
     *     join dinner, NOT join dinner) for these days
     *     per row.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php"); 

    if (isset($_GET["email"]) && !empty($_GET["email"]) AND 
        isset($_GET["hash"]) && !empty($_GET["hash"])) 
    {
        checkInput($_GET["email"]);
        checkInput($_GET["hash"]);

        $newUsers = query(" SELECT  email,
                                    hash,
                                    active 
                            FROM    users 
                            WHERE   email = ?",
                                    $_GET["email"]);

        if (count($newUsers) == 1) 
        {
            $newUser = $newUsers[0];

            echo $newUser;
        }
        else
        {
            errorMsg("multiple accounts found for this email @@@");
        }


    }
    else
    {
        errorMsg("oops!");
    }

    
?>