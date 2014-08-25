<?php

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

        // query database for user
        $rows = query(" SELECT  user_id,
                                hash,
                                first_name,
                                last_name,
                                cash_balance,
                                dorm_id 
                        FROM    users 
                        WHERE   email = ?",
                                $_POST["email"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["user_id"] = $row["user_id"];

                // redirect to dashboard
                redirect("getdorm.php");
            }
        }

        // else apologize
        errorMsg("Invalid email and/or password.");
    }
    else
    {
        // else render homepage
        render("home.php");
    }

?>