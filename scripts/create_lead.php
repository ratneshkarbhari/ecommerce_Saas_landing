<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    $first_name = $_POST['contact-name-first'];
    $last_name = $_POST['contact-name-last'];
    $email = $_POST['contact-email'];
    $phone = $_POST['contact-phone'];
    // $budget = $_POST['contact-budget'];
    $description = $_POST['contact-description'];
    
    $emailBody = 'New Enquiry for android App.: <br>';

    $emailBody.='<br>First Name: '.$first_name;
    $emailBody.='<br>Last Name: '.$last_name;
    $emailBody.='<br>Email: '.$email;
    $emailBody.='<br>Phone: '.$phone;
    $emailBody.='<br>Requirement Description: '.$description;    
    // $emailBody.='<br>Budget: ₹ '.$budget;    


    
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'codesevaco@gmail.com';                     // SMTP username
        $mail->Password   = 'andapavsauce';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('codesevaco@gmail.com', 'Code Seva Co. New Enquiry');
        $mail->addAddress('contact@codesevaco.tech', 'Ratnesh Karbhari');     // Add a recipient
        $mail->addReplyTo('noreply@gmail.com', 'Information');


        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Enquiry from Website';
        $mail->Body    = $emailBody;
        $mail->AltBody = str_replace('<br>','
        ',$emailBody);

        $mail->send();

        header('Location: '.'../thank-you.html');

        die();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit('failure');
    }