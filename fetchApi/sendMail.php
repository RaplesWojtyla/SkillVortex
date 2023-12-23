<?php

    require('../includes/function.php');
    
    $code = generateCode();
    
    $path = $_POST['path'];
    $toEmail = $_POST['email'];
    
    if ($path == 'register')
    {
        $_SESSION['verifCode'] = $code;
        $fromEmail = 'skillvortex4@gmail.com';
        $name = 'Skill Vortex';
        $subject = 'Register - Verification Code';
        $message = $code;
    }
    else if ($path == 'forgot_password')
    {
        $_SESSION['verifCode'] = $code;
        $fromEmail = 'skillvortex4@gmail.com';
        $name = 'Skill Vortex';
        $subject = 'Forgot Password - Verification Code';
        $message = $code;
    }
    else if ($path == 'remainder')
    {
        $res = (query("SELECT * FROM tugas WHERE kode_tugas = '$_SESSION[kode_tugas]' AND nama_tugas = '$_SESSION[nama_tugas]'"));
        $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime(mysqli_fetch_assoc($res)['date_collected'])));
        $formatted_date_collected = $date_collected->format('d-m-Y H:i:s');

        $current_date = new DateTime(date('Y-m-d H:i:s'));
        $diff_time = $current_date->diff($date_collected);

        if ($current_date > $date_collected)
        {
            $remaining_time = $diff_time->format('%d days %h hours %i minutes %s secs late');
        }
        else
        {
            $remaining_time = $diff_time->format('%d days %h hours %i minutes %s secs');
        }
        

        $fromEmail = $_SESSION['email'];
        $name = $_SESSION['fullname'];
        $subject = 'Submit Your Homework!';
        $message = "Do your homework!\n\nLongest time to submit assignment: $formatted_date_collected\nRemaining Time: $remaining_time";
    }
    sendEmail($fromEmail, $name, $toEmail, $subject, $message);

?>