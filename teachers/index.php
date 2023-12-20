<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Teacher Skill Vortex</title>

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
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>My Courses</h3>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <?php
                                $e_teacher = $_SESSION['email'];
                                $res = query("SELECT * FROM vw_courses_teacher WHERE e_teacher='$e_teacher' ");

                                foreach($res as $data)
                                {
                            ?>
                            <div class="col-xl-3 col-md-6 col-sm-12 mr-1">
                                <!-- untuk card -->
                                <div class="card ">
                                    <form action="./course.php" method ="POST">
                                        <div class="card-content">
                                            <a>
                                                <img src="../dist/assets/compiled/cards/abs<?=$data['id_course'] % 21?>.jpg" class="card-img-top img-fluid"
                                                alt="singleminded">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">[<?=$data['kode_course']?>] - <?=$data['judul_course']?></h5>
                                                <h6 class="mt-3"><?=$data['nama_lengkap']?></h6>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-center">
                                            <input name="kode_course1" value="<?=$data['kode_course']?>" type="text" hidden>
                                            <button name="slearnbtn" type="submit" class="btn btn-primary btn-block">Manage Course</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        
    </div>
    </div>
    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>


    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>