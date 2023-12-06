<?php
    require '../includes/function.php';

    $_SESSION['end_time'] = date("H:i:s", strtotime(date("H:i:s") . "+$_SESSION[durasi] minutes"));

?>

<script>
    window.location = '../students/quiz.php'
</script>