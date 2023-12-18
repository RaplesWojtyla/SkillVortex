<?php
    require '../includes/function.php';
    
    $isi_pesan = $_GET['message'];
    $e_pengirim = $_SESSION['email']; //admin
    $email_penerima = $_SESSION['e_pengirim']; //user
    query("INSERT INTO service_center VALUES ('', '$e_pengirim', '$isi_pesan', '$email_penerima')");
?>