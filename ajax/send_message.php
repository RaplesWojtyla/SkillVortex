<?php
    require '../includes/function.php';
    
    $isi_pesan = $_GET['message'];
    $e_pengirim = $_SESSION['email']; //admin
    $email_penerima = $_SESSION['e_pengirim']; //user
    echo"
        <script>
            alert(`$isi_pesan`)
        </script>
    ";
    query("INSERT INTO service_center VALUES ('', '$e_pengirim', '$isi_pesan', '$e_penerima')");
?>