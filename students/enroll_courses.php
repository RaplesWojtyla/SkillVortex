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
    <title>Enroll Course - Student Skill Vortex</title>

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
                                <h3>Enroll Courses</h3>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <?php
                                $e_student = $_SESSION['email'];
                                
                                $res = query("SELECT * FROM vw_courses_teacher ORDER BY RAND()");
                                $res2 = query("SELECT * FROM vw_courses_student WHERE e_student = '$e_student' ");

                                foreach($res as $data)
                                {
                                    $enrolled = 0;
                                    foreach($res2 as $data2)
                                    {
                                        if ($data['kode_course'] == $data2['kode_course'])
                                        {
                                            $enrolled = 1;
                                        }
                                    }

                                    if (!$enrolled)
                                    {
                            ?>
                            <div class="col-xl-3 col-md-6 col-sm-12 mr-1">
                                <!-- untuk card -->
                                <div class="card ">
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
                                        
                                        <form method="GET" class="container-fluid">
                                            <input name="kode_course" value="<?=$data['kode_course']?>" type="text" hidden>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#<?=$data['kode_course']?>">
                                                Enroll
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="<?=$data['kode_course']?>" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk mengikuti course <span style="font-weight: bold;"><?=$data['judul_course']?></span> oleh <?=$data['nama_lengkap']?>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button name="enrollBtn" type="submit" class="btn btn-primary">Enroll</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>

                            <?php
                                if(isset($_GET['enrollBtn']))
                                {
                                    $kode_course = $_GET['kode_course'];
                                    
                                    query("INSERT INTO my_courses (kode_course, e_student) VALUES('$kode_course','$e_student')");
                                    echo"
                                        <script>
                                            window.location = './enroll_courses.php'
                                        </script>
                                    ";
                                }
                            ?>
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