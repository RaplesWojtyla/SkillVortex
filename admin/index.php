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
    <title>Dashboard Admin Skill Vortex</title>

    <link rel="shortcut icon" href="../dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

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
                                                <h5 class="mb-1"><?=$data['nama_pengirim']?></h5>
                                                <h6 class="text-muted mb-0"><?=$data['e_pengirim']?></h6>
                                            </div>
                                        </div>

                                    <?php } ?>

                                    </div>

                                    <div class="px-4">
                                        <a href="serv.php" class='btn btn-block btn-xl btn-outline-primary font-bold my-3'>Start Conversation</a>
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
                                    <div class="card-footer d-flex justify-content-center">
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