<?php

    require '../includes/function.php';
    
    if (session_destroy())
    {
        header("Location: ../authentication/login.php");
    }

?>