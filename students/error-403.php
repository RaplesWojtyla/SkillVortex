<?php
    require '../includes/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=($_SESSION['banned'] == 'Banned') ? "Your Account Has Been Banned" : "Error 403" ?> Error - Skill Vortex</title>


    <?php include("../includes/logo.php"); ?>
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/error.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="../dist/assets/compiled/svg/error-403.svg" alt="Not Found">
                    <h1 class="error-title">Forbidden</h1>
                    <p class='fs-5 text-gray-600'>
                        <?=(isset($_SESSION['banned'])) ? "Your Account Has Been Banned" : "You are unauthorized to see this page." ?>
                    </p>
                    <button onclick="window.location = '../authentication/login.php'"
                        class="btn btn-lg btn-outline-primary mt-3">Go Home</button>
                </div>
            </div>
        </div>
    </div>
</body>

<?php session_destroy() ?>

</html>