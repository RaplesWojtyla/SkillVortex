<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.html");
    }

    if (!empty($_GET['id_submit']))
        $_SESSION['id_submit'] = $_GET['id_submit'];   
    
    $res = query("SELECT * FROM vw_tugas WHERE id_submit = '$_SESSION[id_submit]'");
    $data = mysqli_fetch_assoc($res);

    $nama_lengkap = $data['nama_lengkap'];
    $email = $data['email'];
    $nama_tugas = $data['nama_tugas'];   
    $keterangan = $data['keterangan'];   
    $date_submitted = $data['date_submitted'];
    $nama_file = $data['nama_file'];
    $berkas = $data['berkas'];
    
    $submission_status = 'Submitted For Grading';

    if ($data['nilai'] == 0)
        $grade_status = 'Not Graded';
    else
    {
        $grade_status = $data['nilai'];
        $submission_status = 'Graded';
    }

    if ($data['status'] == 'early')
        $color = 'green';
    else
        $color = 'red';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Info - Skill Vortex</title>

    <link rel="shortcut icon" href="../dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

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
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title text-center">
                                            Submission Info
                                        </h2>
                                        <h3 class="card-title text-center">
                                            <?=$nama_tugas?>
                                        </h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p style="font-size: 1.2rem;">
                                                Submission Status <span style="margin-left: 35px;"><?=$submission_status?></span>
                                            </p>
                                            
                                            <p style="font-size: 1.2rem;">
                                                Grading Status <span style="margin-left: 65px;"><?=$grade_status?></span>
                                            </p>
                                            
                                            <p style="font-size: 1.2rem;">
                                                Keterangan <span style="margin-left: 95px; color: <?=$color?>"><?=$keterangan?></span>
                                            </p>
                                            
                                            <p style="font-size: 1.2rem;">
                                                Last Modified <span style="margin-left: 79px;"><?=date('d-m-Y H:i:s', strtotime($date_submitted))?></span>
                                            </p>
                                            
                                            <p style="font-size: 1.2rem;">
                                                File Submission <a href="./download_file.php?url=<?=$berkas?>"><span style="margin-left: 60px;"><?=$nama_file?></span></a>
                                            </p>
                                            
                                            <!-- Button trigger modal -->
                                            <?php
                                                if ($grade_status == 'Not Graded') {
                                            ?>
                                            <div class="d-flex justify-content-center mt-5">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-right: 20px;">
                                                    Add Grade
                                                </button>
                                                <button type="button" onclick="window.location='./assignment_submission.php'" class="btn btn-danger">
                                                    Cancel
                                                </button>
                                            </div>

                                            <?php } else {?>

                                            <div class="d-flex justify-content-center mt-5">
                                                <button style="margin-right: 20px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Change Grade
                                                </button>
                                                <button type="button" onclick="window.location='./assignment_submission.php'" class="btn btn-danger">
                                                    Cancel
                                                </button>
                                            </div>

                                            <?php }?>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Change Grade - <?=$nama_tugas?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- File uploader with multiple files upload -->
                                                                <div class="row d-flex justify-content-center">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group ">
                                                                            <label for="fullname"><h5>Nama Lengkap</h5></label>
                                                                            <input name="nama_lengkap" type="text" class="form-control" id="fullname" value="<?=$nama_lengkap?>" readonly>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="email"><h5>Email</h5></label>
                                                                            <input name="email" type="email" id="email" class="form-control" value="<?=$email?>" readonly>
                                                                        </div>
                                                                        
                                                                        <div class="form-group ">
                                                                            <label for="add_grade"><h5>Tambahkan Nilai</h5></label>
                                                                            <input name="grade" type="number" min="0" max="100" class="form-control" id="add_grade">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button name="addGradeBtn" type="submit" class="btn btn-primary">Upload</button>
                                                            </div>

                                                            <?php
                                                                if (isset($_POST['addGradeBtn']))
                                                                {
                                                                    $grade = $_POST['grade'];
                                                                    $res = query("UPDATE submit_tugas SET nilai = '$grade' WHERE id_submit = '$_SESSION[id_submit]'");

                                                                    if ($res)
                                                                    {
                                                                        echo "
                                                                            <script>
                                                                                window.location = './submission_info.php'
                                                                            </script>
                                                                        ";
                                                                    }
                                                                }
                                                            ?>        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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


    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>


    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>
