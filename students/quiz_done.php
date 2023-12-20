<?php
    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Has Been Done - Student Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php include("navbar.php"); ?>
            </header>
            <div class="content-wrapper container">
                <div class="page-heading">

                    <section id="multiple-column-form ">
                        <div class="row match-height d-flex justify-content-center">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title text-center">
                                            <?=$_SESSION['nama_quiz']?>
                                        </h2>
                                        <h4 class="card-title text-center">
                                            Quiz Has Been Done
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p style="font-size: 1.2rem; text-align: center;">Anda telah mengerjakan quiz ini. Silahkan kembali ke halaman materi untuk mengecek quiz lainnya atau melihat scoreboard</p>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 10px; margin-bottom: 35px;">
                                            <a href="./materi.php" class="btn btn-primary" style="margin-right: 15px;">Course</a>
                                            <a href="./single_quiz_scoreboard.php?kode_quiz=<?=$_SESSION['kode_quiz']?>" class="btn btn-primary">Scoreboard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>


    </div>
    </div>

    <script src="../includes/quizFunction.js"></script>

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>


    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>