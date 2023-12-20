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
    <title>Tambah Quiz - Teacher Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">

    <link rel="stylesheet" href="../dist/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="../dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="../dist/assets/extensions/toastify-js/src/toastify.css">
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
                                <h3>Courses</h3>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Upload Quiz</h5>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group " hidden>
                                                            <input name="kode_course" type="text" class="form-control" id="helpInputTop" value="<?=$_SESSION['kode_course']?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Kode Quiz</label>
                                                            <input name="kode_quiz" type="text" id="helperText" class="form-control"
                                                            placeholder="Kode Quiz" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Judul Quiz</label>
                                                            <input name="nama_quiz" type="text" id="helperText" class="form-control"
                                                            placeholder="Judul Quiz" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="helperText">Deskripsi</label>
                                                            <input name="deskripsi" type="text" id="helperText" class="form-control"
                                                            placeholder="Deskripsi Singkat">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Tipe</label>
                                                            <input name="tipe_materi" type="text" id="helperText" class="form-control"
                                                            value="Quiz" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Jumlah Soal</label>
                                                            <input name="jumlah_soal" type="number" id="helperText" class="form-control" min="1" placeholder="Jumlah Soal">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Durasi</label>
                                                            <input name="durasi" type="number" id="helperText" class="form-control" min="1" placeholder="In-minute">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mt-5">
                                                    <button name="quploadbtn" type="submit" class="btn btn-primary">Upload</button>
                                                    <button name="cancelbtn" onclick="window.location='./course.php'" class="btn btn-danger mx-3">Cancel</button>
                                                </div>

                                                <?php
                                                    if (isset($_POST['quploadbtn']))
                                                    {
                                                        $_SESSION['kode_quiz'] = $_POST['kode_quiz'];
                                                        if (insertQuizData($_POST))
                                                        {
                                                            echo "
                                                                <script>
                                                                    alert('Silahkan buat soal untuk quiz anda')
                                                                    window.location = './add_questions.php'
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

    <script
        src="../dist/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script
        src="../dist/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="../dist/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script
        src="../dist/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="../dist/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="../dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="../dist/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="../dist/assets/extensions/filepond/filepond.js"></script>
    <script src="../dist/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="../dist/assets/static/js/pages/filepond.js"></script>

</body>

</html>