<?php

    require('../includes/function.php');
    $code = generateCode();
    $_SESSION['vCode'] = $code;
    $email = $_POST['email'];

    sendCode($code, $email);

?>