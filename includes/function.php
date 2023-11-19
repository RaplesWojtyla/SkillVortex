<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //
    function generateCode ()
    {
        return random_int(100000, 999999);
    }

    function sendCode($code, $toEmail)
    {
        require '../vendor/autoload.php';

        $email = 'skillvortex4@gmail.com';
        $password = 'hdvmnyycuhzgwodv';
        
        $mail = new PHPMailer(true);
        
        try 
        {
            // setting
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $email;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // bagian isi email
            $mail->setFrom($email, 'Skill Vortex');
            $mail->addAddress($toEmail);
            $mail->Subject = 'Verification Code';
            $mail->Body = $code;

            $mail->send(); // Mengirim email
        }
        catch(Exception)
        {
            die("Gagal mengirim email. Error: {$mail->ErrorInfo}");
        }
    }
?>