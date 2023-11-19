<?php

    require_once('./includes/koneksi.php');
    require('../includes/function.php');
    
    $code = generateCode();
    $_SESSION['verifCode'] = $code;
    $email = $_POST['email'];

    sendCode($code, $email);

?>