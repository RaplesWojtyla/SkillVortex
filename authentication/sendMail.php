<?php

    require('../includes/function.php');
    
    $code = generateCode();
    $_SESSION['verifCode'] = $code;
    
    $path = $_POST['path'];
    $toEmail = $_POST['email'];
    
    if ($path == 'register')
    {
        $fromEmail = 'skillvortex4@gmail.com';
        $name = 'Skill Vortex';
        $subject = 'Register - Verification Code';
        $message = $code;
    }
    else if ($path == 'forgot_password')
    {
        $fromEmail = 'skillvortex4@gmail.com';
        $name = 'Skill Vortex';
        $subject = 'Forgot Password - Verification Code';
        $message = $code;
    }
    else if ($path == 'remainder')
    {
        $fromEmail = $_SESSION['email'];
        $name = $_SESSION['fullname'];
        $subject = 'Send Your Homework!';
        $message = 'Do your homework!';
    }
    sendCode($fromEmail, $name, $toEmail, $subject, $message);

?>