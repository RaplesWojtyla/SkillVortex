<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }

    if (isset($_POST['uTugasModalBtn']))
    {
        $_SESSION['kode_tugas'] = $_POST['kode_tugas'];
        $_SESSION['nama_tugas'] = $_POST['nama_tugas'];
        $_SESSION['date_collected'] = $_POST['deadline'];
    }

    $_SESSION['method'] = 'Add';
    $id_submit = 0;
    $is_submitted = 0;
    $submission_status = 'No submissions have been made yet';
    $grade_status = 'Not Graded'; // ???

    $res = query("SELECT * FROM submit_tugas WHERE kode_tugas = '$_SESSION[kode_tugas]' AND email = '$_SESSION[email]'");
    $row = mysqli_num_rows($res);

    if($row > 0)
    {
        $data = mysqli_fetch_assoc($res);
        $id_submit = $data['id_submit'];
        $berkas = $data['berkas'];
        
        $submission_status = 'Submitted For Grading';
        $time_remaining = $data['keterangan'];
        $last_modified = $data['date_submitted'];
        $file_submission = $data['nama_file'];

        if ($data['nilai'] == '0')
        {
            $grade_status = 'Not Graded';
        }
        else
        {
            $grade_status = $data['nilai'];
        }

        if ($data['status'] == 'early')
        {
            $color = 'color: green;';
        }
        else
        {
            $color = 'color: red;';
        }

        $is_submitted = 1;
        $_SESSION['method'] = 'Update';
    }
    else
    {
        $current_date = new DateTime(date('Y-m-d H:i:s'));
        $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($_SESSION['date_collected'])));
        
        $diff_time = $current_date->diff($date_collected);
        
        if ($current_date > $date_collected)
        {
            $color = 'color: red;';
            $time_remaining = $diff_time->format('%d Days %h hours %i minutes late');
        }
        else
        {
            $color = 'color: yellow;';
            $time_remaining = $diff_time->format('%d Days %h hours %i minutes remaining');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Info - Student Skill Vortex</title>

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
                            <h2><a href="./materi.php"><i class="bi bi-arrow-left"></i></a></h2>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title text-center">
                                            Submission Info
                                        </h2>
                                        <h3 class="card-title text-center">
                                            <?=$_SESSION['nama_tugas']?>
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
                                                Time Remaining <span style="margin-left: 55px;<?=$color?>"><?=$time_remaining?></span>
                                            </p>
                                            
                                            <?php
                                                if ($is_submitted) {
                                            ?>
                                            <p style="font-size: 1.2rem;">
                                                Last Modified <span style="margin-left: 79px;"><?=date('d-m-Y H:i:s', strtotime($last_modified))?></span>
                                            </p>
                                            
                                            <p style="font-size: 1.2rem;">
                                                File Submission <a href="./download_file.php?url=<?=$berkas?>"><span style="margin-left: 60px;"><?=$file_submission?></span></a>
                                            </p>
                                            
                                            <!-- Button trigger modal -->
                                            <div class="d-flex justify-content-center mt-5">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" style="padding: 8px 15px; margin-right: 10px;">
                                                    Update Submission
                                                </button>
                                                <form onsubmit="return confirm(`Apakah anda yakin menghapus progres tugas anda?`)" method="GET">
                                                    <button name="removeSubmission" type="submit" class="btn btn-outline-primary" style="padding: 8px 15px;">
                                                        Remove Submission
                                                    </button>
                                                    <?php
                                                        if (isset($_GET['removeSubmission']))
                                                        {
                                                            query("DELETE FROM submit_tugas WHERE id_submit = '$id_submit'");

                                                            echo "
                                                                <script>
                                                                    window.location = './submission_info.php'
                                                                </script>
                                                            ";
                                                        }
                                                    ?>
                                                </form>
                                            </div>
                                            <?php 
                                                } //Tutup if ($status == 'submitted')  
                                                else {   
                                            ?>
                                            <div class="d-flex justify-content-center mt-5">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="padding: 8px 15px;">
                                                    Add Submission
                                                </button>
                                            </div>
                                            <?php } ?>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel"><?=$_SESSION['method']?> Submission - <?=$_SESSION['nama_tugas']?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <!-- File uploader with multiple files upload -->
                                                                    <div class="row d-flex justify-content-center">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group ">
                                                                                <label for="fullname"><h5>Nama Lengkap</h5></label>
                                                                                <input name="nama_lengkap" type="text" class="form-control" id="fullname" value="<?=$_SESSION['fullname']?>" readonly>
                                                                            </div>
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="email"><h5>Email</h5></label>
                                                                                <input name="email" value="<?=$_SESSION['email']?>" type="email" id="email" class="form-control" readonly>
                                                                            </div>
                                                                            
                                                                            <div class="form-group ">
                                                                                <label for="tenggat_waktu"><h5>Tenggat Waktu</h5></label>
                                                                                <input name="tenggat_waktu" type="text" class="form-control" id="tenggat_waktu" value="<?=date('d-m-Y H:i:s', strtotime($_SESSION['date_collected']))?>" readonly
                                                                                <?php
                                                                                    $current_date = new DateTime(date('Y-m-d H:i:s'));
                                                                                    $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($_SESSION['date_collected'])));

                                                                                    if ($current_date > $date_collected)
                                                                                    {
                                                                                        echo 'style="color: red;"';
                                                                                    }
                                                                                ?>
                                                                                >
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="inputGroupFile01"><h5>Masukkan File Tugas</h5></label>
                                                                                <small
                                                                                    class="text-muted"> Format File: (NIM - NAMA - TUGASXX)
                                                                                </small>
                                                                                <div class="input-group mb-1">
                                                                                    <input type="file" class="form-control" id="inputGroupFile01" name="berkas" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button name="submitTugas" type="submit" class="btn btn-primary">Upload</button>
                                                            </div>

                                                            <?php
                                                                if (isset($_POST['submitTugas']))
                                                                {
                                                                    $nama_file = $_FILES['berkas']['name'];
                                                                    $size = $_FILES['berkas']['size'];
                                                                    $tmp_file = $_FILES['berkas']['tmp_name'];

                                                                    $dir = '../tugas_submit/';
                                                                    $fileLoc = $dir.$nama_file;

                                                                    $uploaded = move_uploaded_file($tmp_file, $fileLoc);

                                                                    $dataArr = array(
                                                                        'id_submit' => $id_submit,
                                                                        'kode_tugas' => $_SESSION['kode_tugas'],
                                                                        'kode_course' => $_SESSION['kode_course'],
                                                                        'email' => $_SESSION['email'],
                                                                        'nama_file' => $nama_file,
                                                                        'size' => $size,
                                                                        'berkas' => $fileLoc,
                                                                        'date_collected' => $_SESSION['date_collected'],
                                                                        'method' => $_SESSION['method']
                                                                    );

                                                                    if (submit_assignment($dataArr) and $uploaded)
                                                                    {
                                                                        echo"
                                                                            <script>
                                                                                window.location = './submission_info.php'
                                                                            </script>
                                                                        ";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo"
                                                                            <script>
                                                                                alert('Terjadi Kesalahan')
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
