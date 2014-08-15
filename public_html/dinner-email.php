***REMOVED***
    // configuration
    require("../includes/config.php");

    date_default_timezone_set("Europe/Amsterdam");

    // include PHPMailer 
    require_once("libs/PHPMailer/PHPMailerAutoload.php");
    
    $user = query(" SELECT  first_name,
                            last_name,
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

    // get date roommate has opted to cook

    // get today's date
    $today = new DateTime("today");
    $todayFormatOne = $today->format("y-m-d");
    $todayFormatTwo = $today->format("F jS");

    // get tomorrow's date
    $tomorrow = new DateTime("tomorrow");
    $tomorrowFormatOne = $tomorrow->format("y-m-d");
    $tomorrowFormatTwo = $tomorrow->format("F jS");
    
    switch ($_SESSION["date_cooking"]) 
    {
        case $todayFormatOne:
            $dateCooking = "today" . " (" . $todayFormatTwo . ")";
            break;

        case $tomorrowFormatTwo:
            $dateCooking = "tomorrow" . " (" . $tomorrowFormatTwo . ")";
        
        default:
            $dateCooking = date("l (F jS)", strtotime($_SESSION["date_cooking"]));
            break;
    }

    // set variables for html doc 
    $cookingRoommateFirstName = $user[0]["first_name"];

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

    // set Subject:
    $mail->Subject = "Somebody's cooking tonight!";

    // set body
    $body = file_get_contents('../templates/dinner_email.html');
    $body = str_replace('$cookingRoommateFirstName', $cookingRoommateFirstName, $body);
    $body = str_replace('$dateCooking', $dateCooking, $body);

    foreach ($roommates as $roommate) 
    {
        // join first and last name into one variable
        $fullname = $roommate["first_name"] . " " . $roommate["last_name"];

        $mail->AddAddress($roommate["email"], $fullname);
    }

    // test
    $mail->AddAddress("saverhoek@gmail.com"); 

    $mail->msgHTML($body);
    $mail->IsHTML(true); // send as HTML
    $mail->CharSet="utf-8"; // use utf-8 character encoding

    // send mail
    if ($mail->Send() === false)
        die($mail->ErrorInfo . "\n");
    
    redirect("dinner.php");
***REMOVED***