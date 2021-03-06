<?php
    /*************************************************
     *  dinner-email.php
     *
     *  Forms and sends dinner email notification.
     *   
     **************************************************/

    // configuration
    require("../includes/config.php");

    // include PHPMailer 
    require_once("libs/PHPMailer/PHPMailerAutoload.php");

    // get roommate data and email addresses
    $roommates = getRoommateData(5);

    // get today's date
    $today = new DateTime("today");
    $todaySQLFormat = $today->format("y-m-d");
    $todayEmailFormat = $today->format("F jS");

    // get tomorrow's date
    $tomorrow = new DateTime("tomorrow");
    $tomorrowSQLFormat = $tomorrow->format("y-m-d");
    $tomorrowEmailFormat = $tomorrow->format("F jS");
    
    switch ($_SESSION["date_cooking"]) 
    {
        case $todaySQLFormat:
            $dateCooking = "today" . " (" . $todayEmailFormat . ")";
            break;

        case $tomorrowSQLFormat:
            $dateCooking = "tomorrow" . " (" . $tomorrowEmailFormat . ")";
            break;
        
        default:
            $dateCooking = date("l (F jS)", strtotime($_SESSION["date_cooking"]));
            break;
    }

    // set variables for html doc 
    $cookingRoommateFirstName = $_SESSION["first_name"];

    // redirect to dinner tab
    $goToDinner = WEBSITEROOT . "/dinner.php";

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

    // set Subject:
    $mail->Subject = "Somebody's cooking tonight!";

    // set body
    $body = file_get_contents('../templates/dinner_email.html');
    $body = str_replace('$cookingRoommateFirstName', $cookingRoommateFirstName, $body);
    $body = str_replace('$dateCooking', $dateCooking, $body);
    $body = str_replace('$goToDinner', WEBSITEROOT, $body);

    foreach ($roommates as $roommate) 
    {
        $fullname = $roommate["first_name"] . " " . $roommate["last_name"];
        $firstName = $roommate["first_name"];

        $mail->AddAddress($roommate["email"], $fullname);     
        $body = str_replace('$firstName', $firstName, $body);
    }

    $mail->msgHTML($body);
    $mail->IsHTML(true); // send as HTML
    $mail->CharSet="utf-8"; // use utf-8 character encoding

    // send mail
    if ($mail->Send() === false)
        die($mail->ErrorInfo . "\n");
    
    redirect("dinner.php");
?>