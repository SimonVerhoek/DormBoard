***REMOVED***
    // configuration
    require("../includes/config.php");

    date_default_timezone_set("Europe/Amsterdam");

    // include PHPMailer 
    require_once("libs/PHPMailer/PHPMailerAutoload.php");
    
    $user = query(" SELECT  first_name,
                            dorm_id
                    FROM    users  
                    WHERE   user_id = ?",
                            $_SESSION["user_id"]);

    $roommates = query("SELECT  user_id,
                                first_name,
                                last_name,
                                email
                        FROM    users
                        WHERE   dorm_id = ?",
                                $user[0]["dorm_id"]);

    // instantiate mailer
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    
    $mail->SMTPDebug  = 1;

    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = DINNER_EMAIL_ADDRESS;  
    $mail->Password = DINNER_EMAIL_PASSWORD;          

    // set From:
    $mail->SetFrom("dormboardmail@gmail.com", "Dormboard");

    // set To:
    $mail->AddAddress("saverhoek@gmail.com");

    foreach ($roommates as $roommate) 
    {
        // join first and last name into one variable
        $fullname = $roommate["first_name"] . " " . $roommate["last_name"];

        $mail->AddAddress($roommate["email"], $fullname);
    }

    // set Subject:
    $mail->Subject = "Somebody's cooking tonight!";

    // set body
    $mail->msgHTML(file_get_contents('../templates/dinner_email.html'), dirname(__FILE__));;

    // send mail
    if ($mail->Send() === false)
        die($mail->ErrorInfo . "\n");
    
    redirect("dinner.php");
***REMOVED***