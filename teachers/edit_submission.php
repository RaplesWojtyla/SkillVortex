<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

    if (isset($_POST['teditbtn']))
    {
        $_SESSION['kode_tugas'] = $_POST['kode_tugas'];
        $_SESSION['id_tugas'] = $_POST['id_tugas'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit - Teacher Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">

    <link rel="stylesheet" href="../dist/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="../dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>

    <div id="app" class="mystyle">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php include("navbar.php"); ?>
            </header>
            <div class="col-md-6 col-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Tugas</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php

                                $res = query("SELECT * FROM tugas WHERE id_tugas = '$_SESSION[id_tugas]'");

                                foreach($res as $data)
                                {
                            
                            ?>
                            <form action="" method="POST" class="form form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal-icon">Kode Tugas</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="kode_course" type="text" class="form-control" value="<?=$_SESSION['kode_tugas']?>"
                                                        id="first-name-horizontal-icon" readonly>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-code-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nama_tugas">Nama Tugas</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="nama_tugas" type="text" class="form-control" value="<?=$data['nama_tugas']?>"
                                                        id="nama_tugas">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-journals"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="deskripsi">Deskripsi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="deskripsi" type="text" class="form-control" value="<?=$data['deskripsi']?>"
                                                        id="deskripsi">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-body-text"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tenggat_waktu">Tenggat Waktu (Tanggal)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="date_collected" type="text" class="form-control" value="<?=date('d-m-Y', strtotime($data['date_collected']))?>"
                                                        id="tenggat_waktu">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-calendar-date"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="hour_collected">Tenggat Waktu (Jam)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="hour_collected" type="text" class="form-control" value="<?=date('H:i:s', strtotime($data['date_collected']))?>"
                                                        id="hour_collected">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal-icon">File (Optional)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="berkas" type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <button name="updatebtn" type="submit" class="btn btn-success me-1 mb-1">Update</button>
                                            <button name="cancelbtn" type="button" onclick="window.location='./course.php'" class="btn btn-danger me-1 mb-1">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>


                            <?php                               
                                if (isset($_POST['updatebtn']))
                                {
                                    $nama_tugas = $_POST['nama_tugas'];
                                    $deskripsi = $_POST['deskripsi'];
                                    $date_collected = $_POST['date_collected'];
                                    $hour_collected = $_POST['hour_collected'];
                                    $nama_file = "";
                                    $size = "";
                                    $tmp_file = "";
                                    
                                    $dir = '../tugas/';
                                    $fileLoc = "";
                                    
                                    if (!empty($_FILES['berkas']['name']))
                                    {
                                        $nama_file = $_FILES['berkas']['name'];
                                        $size = $_FILES['berkas']['size'];
                                        $tmp_file = $_FILES['berkas']['tmp_name'];
                                        $fileLoc = $dir.$nama_file;
                                    }
                                    
                                    $uploaded = move_uploaded_file($tmp_file, $fileLoc);

                                    $dataArr = array(
                                        'id_tugas' => $_SESSION['id_tugas'],
                                        'kode_tugas' => $_SESSION['kode_tugas'],
                                        'nama_tugas' => $nama_tugas,
                                        'deskripsi' => $deskripsi,
                                        'nama_file' => $nama_file,
                                        'size' => $size,
                                        'berkas' => $fileLoc,
                                        'date_collected' => $date_collected,
                                        'hour_collected' => $hour_collected
                                    );

                                    if (updateTugasData($dataArr) or $uploaded)
                                    {
                                        echo"
                                            <script>
                                                alert('Data tugas berhasil diupdate!')
                                                window.location = './course.php'
                                            </script>
                                        ";
                                    }
                                    else
                                    {
                                        echo"
                                            <script>
                                                alert('Terjadi kesalahan. Data tugas gagal diupdate!')
                                                window.location = './course.php'
                                            </script>
                                        ";
                                    }
                                }
                            ?>
                            
                        </div>
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