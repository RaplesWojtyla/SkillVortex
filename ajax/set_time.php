<?php

    session_start();
    date_default_timezone_set('Asia/Jakarta');

    $set_time = (int)$_GET['time'];
    $_SESSION['end_time'] = date("H:i:s", strtotime(date("H:i:s") . "+$set_time minutes"));

    
?>

<script>
    window.location = '../iseng2.html'
</script>