<?php
    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }

    if (!empty($_GET['kode_quiz']))
        $_SESSION['kode_quiz'] = $_GET['kode_quiz'];

    // Pengen buat sesi aja biar gampang nampilin nama quiz dan set timer dengan sesi durasi
    $res = query("SELECT * FROM quiz WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]'");
    while ($row = mysqli_fetch_assoc($res))
    {
        $_SESSION['nama_quiz'] = $row['nama_quiz'];
        $_SESSION['durasi'] = $row['durasi'];
    }

    // Ngecek apakah quiz itu sudah pernah dikerjakan atau belum
    $res2 = query("SELECT * FROM quiz_result WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]' AND e_student = '$_SESSION[email]'");
    $res3 = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]'");
    if (mysqli_num_rows($res2) == 1)
    {
        echo"
            <script>
                window.location = './quiz_done.php'
            </script>
        ";
    }
    else if (mysqli_num_rows($res3) == 0)
    {
        echo"
            <script>
                alert('Teacher masih belum membuat soal untuk quiz ini')
                window.location = './materi.php'
            </script>
        ";
    }
    else
    {
        $_SESSION['jumlah_soal'] = mysqli_num_rows($res3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Prepare - Skill Vortex</title>

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
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title text-center">
                                            <?=$_SESSION['nama_quiz']?>
                                        </h2>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p style="font-size: 1.2rem;">Quiz ini terdiri dari <span
                                                    style="font-weight: bold;">
                                                    <?=$_SESSION['jumlah_soal']?>
                                                </span> soal.Waktu pengerjaan quiz ini adalah
                                                <span style="color: red; font-weight: bold;">
                                                    <?=$_SESSION['durasi']?> menit
                                                </span>
                                            </p>
                                            <p style="font-size: 1.2rem;"><i><span
                                                        style="font-weight: bold;">WARNING!</span> Quiz ini akan
                                                    berakhir saat waktu pada pojok kiri atas halaman web habis atau
                                                    apabila anda mengklik tombol next pada soal terkahir.</i></p>
                                            <p style="font-size: 1.2rem;">Klik tombol di bawah ini jika anda merasa
                                                sudah siap</p>
                                            <!-- Button trigger modal -->
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop" style="padding: 8px 15px;">
                                                    Start
                                                </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Klik tombol <i>start</i> di bawah ini, jika anda benar-benar sudah yakin untuk memulai quiz <span style="font-weight: bold;"><?=$_SESSION['nama_quiz']?></span>.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button onclick="setTimer()" class="btn btn-primary">Start</button>
                                                        </div>
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

    <script src="../includes/quizFunction.js"></script>

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>


    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>
<?php } ?>