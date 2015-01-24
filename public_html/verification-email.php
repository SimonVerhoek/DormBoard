<?php
    /*************************************************
     *  verification-email.php
     *
     *  Sends a verification email to a new user
     *  after he signed up. Contains an activation link
     *  which activates the user's account.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php");

    // include PHPMailer 
    require_once("libs/PHPMailer/PHPMailerAutoload.php");

    $rows = query(" SELECT  first_name,
                            last_name,
                            hash
                    FROM    users
                    WHERE   email = ?",
                            $_SESSION["email"]);

    checkIfQueryFails($rows, "verification email query failed");

    if (count($rows) == 1)
    {
        $user = $rows[0];
    }
    else
    {
        errorMsg("!");
    }


    // set variables for html doc 
    $firstName = $user["first_name"];
    $lastName = $user["last_name"];
    $fullname = $user["first_name"] . " " . $user["last_name"];
    $email = $_SESSION["email"];

    // redirects logo link to dinner tab
    $goToDinner = WEBSITEROOT . "/dinner.php";

    // format verification link
    $activationLink = WEBSITEROOT . "/verify.php?email=" . $_SESSION["email"] . "&hash=" . $user["hash"];

    // instantiate mailer
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.mandrillapp.com";
    
    $mail->SMTPDebug  = 1;

    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = DINNER_EMAIL_ADDRESS;  
    $mail->Password = DINNER_EMAIL_PASSWORD;          

    // set From:
    $mail->SetFrom("dormboardmail@gmail.com", "Dormboard");

    // set To:
    $mail->AddAddress("saverhoek@gmail.com", $firstName);

    // set Subject:
    $mail->Subject = "Welcome to DormBoard!";

    // set body
    $body = file_get_contents('../templates/verification-email.html');
    $body = str_replace('$activationLink', $activationLink, $body);
    $body = str_replace('$goToDinner', WEBSITEROOT, $body);
    $body = str_replace('$firstName', $firstName, $body);

    $mail->msgHTML($body);
    $mail->IsHTML(true); // send as HTML
    $mail->CharSet="utf-8"; // use utf-8 character encoding

    // send mail
    if ($mail->Send() === false)
        die($mail->ErrorInfo . "\n");
    
    //redirect("login.php");
?>