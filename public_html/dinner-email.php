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
                                email
                        FROM    users
                        WHERE   dorm_id = ?",
                                $user[0]["dorm_id"]);

    // make array of roommates' email addresses
    $emailAddresses = [];

    foreach ($roommates as $roommate) 
    {
        if ($roommate["user_id"] != $_SESSION["user_id"]) 
        {
            array_push($emailAddresses, $roommate["email"]);
        }
    }
    
    // instantiate mailer
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    
    $mail->SMTPDebug  = 1;

    $mail->Port = 465; // was 465
    $mail->SMTPSecure = 'ssl';
    $mail->Username = "dormboardmail@gmail.com";  
    $mail->Password = "ywK-G9s-H5X-hfS";          

    // set From:
    $mail->SetFrom("dormboardmail@gmail.com");

    // set To:
    $mail->AddAddress("saverhoek@gmail.com");

    // set Subject:
    $mail->Subject = "Dormboard: Somebody's cooking tonight!";

    // set body
    $mail->Body = "TEST";

    // send mail
    if ($mail->Send() === false)
        die($mail->ErrorInfo . "\n");
    
    redirect("dinner.php");
***REMOVED***