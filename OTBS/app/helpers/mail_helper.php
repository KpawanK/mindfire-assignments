<?php 
    require_once ($_SERVER["DOCUMENT_ROOT"].'/public/PHPMailer/src/PHPMailer.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/public/PHPMailer/src/Exception.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/public/PHPMailer/src/SMTP.php');

    function send_mail($subject,$body,$to){
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "pawankunu@gmail.com";
        $mail->Password = "p@w@n@6500#";
        $mail->setfrom( 'noreply@no-reply.com' ,"OTBS");
        $mail->Subject = $subject;
        $mail->Body = 'You one time verification Code is '.$body;
        $mail->addaddress($to);
        if(!$mail->Send()) {
           return false;
        } else {
            return true;
        }
    }
    
    
    
    
    
    
    
    
