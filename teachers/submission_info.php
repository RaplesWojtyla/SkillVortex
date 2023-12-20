<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
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
    <title>Submission Info - Teacher Skill Vortex</title>

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
