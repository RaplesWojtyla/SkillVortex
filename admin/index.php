<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }

?>

<?php
    $jum_siswa = mysqli_num_rows (query("SELECT * FROM users WHERE level = 3 "));
    $jum_guru = mysqli_num_rows (query("SELECT * FROM users WHERE level = 2 "));
    $jum_course = mysqli_num_rows (query("SELECT * FROM courses "));
    $jum_feedback = mysqli_num_rows (query("SELECT * FROM feedback "));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>
        
    <link rel="stylesheet" href="assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">

    <style>   
        
        #rec_message {
            height: 161px; 
            overflow-y: auto; 
        }
    </style>

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
                                <h3>Dashboard</h3>
                            </div>
                        </div>
                    </div>
                </div>

                    <section id="groups">
                        <div class="row " >
                            <div class="col-9">
                                <div class="card-group">
                                    
                                    <div class="card">
                                        <div class="card-content">
                                            <img class="card-img-top img-fluid" src="../dist/assets/compiled/png/1.png"
                                                alt="Card image cap" />
                                            <div class="card-body">
                                                <h4 class="card-text">
                                                    Student    
                                                </h4>
                                                <h2 class="card-title"><?=$jum_siswa?></h2>
                                                <div class="icon">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <a href="data_students.php" class="btn btn-primary btn-block">More Info</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <img class="card-img-top img-fluid" src="../dist/assets/compiled/png/2.png" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-text">
                                                    Teacher    
                                                </h4>
                                                <h2 class="card-title"><?=$jum_guru?></h2>
                                                <a href="data_teachers.php" class="btn btn-primary btn-block">More Info</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <img class="card-img-top img-fluid" src="../dist/assets/compiled/png/3.png" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-text">
                                                    Course    
                                                </h4>
                                                <h2 class="card-title"><?=$jum_course?></h2>
                                                <a href="management_course.php" class="btn btn-primary btn-block">More Info</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-content">
                                            <img class="card-img-top img-fluid" src="../dist/assets/compiled/png/4.png" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-text">
                                                    Feedback    
                                                </h4>
                                                <h2 class="card-title"><?=$jum_feedback?></h2>
                                                <a href="feedback.php" class="btn btn-primary btn-block">More Info</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Recent Messages</h3>
                                    </div>
                                    <div class="card-content pb-4" id="rec_message">

                                    <?php

                                        $res = query("SELECT * FROM vw_service_center WHERE e_pengirim != 'skillvortex4@gmail.com' AND id_service IN (SELECT MAX(id_service) FROM vw_service_center GROUP BY e_pengirim) ORDER BY id_service DESC");
                                        foreach($res as $data)
                                        {     
                                    ?>  

                                        <div class="recent-message d-flex px-2 py-3">
                                            <div class="avatar avatar-lg">
                                                <img src="../dist/assets/compiled/jpg/2.jpg">
                                            </div>
                                            <div class="name ms-3">
                                                <a style="cursor: pointer;" class="mb-1 font-bold" href="service_center.php"><?=$data['nama_pengirim']?></a>
                                                <a style="cursor: pointer;" class="text-muted mb-0" href="service_center.php"><?=$data['e_pengirim']?></a>
                                            </div>
                                        </div>

                                    <?php } ?>

                                    </div>

                                    <div class="px-4">
                                        <a href="service_center.php" class='btn btn-block btn-xl btn-outline-primary font-bold my-3'>Start Conversation</a>
                                    </div>
                                </div> 
                            </div>

                        </div>
                    </section>
                    

                        <div class="page-title">
                            <div class="row">
                                <div class="col-12 col-md-6 order-md-1 my-2 order-last">
                                    <h3>Courses</h3>
                                </div>
                            </div>
                        </div>


                    <section class="section">
                        

                        <div class="row">
                            <?php
                                $res = query("SELECT * FROM vw_courses_teacher ORDER BY RAND()");

                                foreach($res as $data)
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
                                    <div class="card-footer d-flex justify-content-center ">
                                        <form action="./course.php" method ="POST">
                                            <input name="kode_course1" value="<?=$data['kode_course']?>" type="text" hidden>
                                            <button name="slearnbtn" type="submit" class="btn btn-light-primary btn-block">Manage Course</button>
                                        </form>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center">
                                        <form onsubmit="return confirm(`Apakah anda yakin akan menghapus\nCourse: <?=$data['judul_course']?>\nBy: <?=$data['nama_lengkap']?>`)" method ="POST">
                                            <input name="kode_course1" value="<?=$data['kode_course']?>" type="text" hidden>
                                            <button name="deletebtn" type="submit" class="btn btn-light-danger btn-block">Delete Course</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php
                                if(isset($_POST['deletebtn']))
                                {
                                    $kode_course = $_POST['kode_course1'];
                                    query("DELETE FROM courses WHERE kode_course = '$kode_course'");
                                    echo"
                                        <script>
                                            window.location = './index.php'
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
    
    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>

    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>