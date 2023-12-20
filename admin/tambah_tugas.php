<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas - Admin Skill Vortex</title>

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
                                        <h5 class="card-title">Upload Tugas</h5>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form action="./upload_tugas.php" method="POST" enctype="multipart/form-data">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <div class="form-group " hidden>
                                                            <input name="kode_course" type="text" class="form-control" id="helpInputTop" value="<?=$_SESSION['kode_course']?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Kode Tugas</label>
                                                            <input name="kode_tugas" type="text" id="helperText" class="form-control"
                                                            placeholder="Kode Tugas" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="helperText">Nama Tugas</label>
                                                            <input name="nama_tugas" type="text" id="helperText" class="form-control"
                                                            placeholder="Nama Tugas" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="helperText">Deskripsi</label>
                                                            <input name="deskripsi" type="text" id="helperText" class="form-control"
                                                            placeholder="Deskripsi Singkat" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="helperText">Tenggat Waktu (Hari)</label>
                                                            <small
                                                                class="text-muted"> Format: (DD-MM-YYYY)
                                                            </small>
                                                            <input name="date_collected" value="<?=date('d-m-Y', strtotime(date('d-m-Y') . "+1 days"))?>" type="text" id="helperText" class="form-control" required>
                                                        </div> 
                                                        
                                                        <div class="form-group"
                                                            <label for="helperText">Tenggat Waktu (Jam)</label>
                                                            <small
                                                                class="text-muted"> Format: (Jam:Menit:Detik)
                                                            </small>
                                                            <input name="hour_collected" value="<?=date('H:i:s', strtotime(date('H:i:s') . "+1 hours"))?>" type="text" id="helperText" class="form-control" required>
                                                        </div> 

                                                        <div class="form-group">
                                                            <label for="helperText">File Tugas</label>
                                                            <small
                                                                class="text-muted"> <i>Opsional</i>
                                                            </small>
                                                            <input name="berkas" type="file" class="basic-filepond">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mt-5">
                                                    <button name="tuploadbtn" type="submit" class="btn btn-primary">Upload</button>
                                                    <button name="cancelbtn" onclick="window.location='./course.php'" class="btn btn-danger mx-3">Cancel</button>
                                                </div>
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