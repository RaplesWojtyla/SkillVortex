<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }

    if (!empty($_GET["kode_course"]))
    {
        $_SESSION['kode_course'] = $_GET["kode_course"];
    }

    $sql = query("SELECT * FROM vw_courses_student WHERE kode_course = '$_SESSION[kode_course]'");
    $res = mysqli_fetch_assoc($sql);
    $judul_course = $res['judul_course'];
    $nama_teacher = $res['nama_teacher'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$judul_course?> - Student Skill Vortex</title>

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
                                <h2>Course</h2>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row" id="table-striped-dark">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <?=$judul_course?>
                                        </h3>
                                    </div>
                                    <div class="card-content">
                                        <form method="GET">
                                            <div class= "card-body">
                                                <a href="participant.php?kode_course=<?=$_SESSION['kode_course']?>" class="btn btn-primary">
                                                    Participants
                                                </a>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Unenroll
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah anda yakin untuk berhenti mengikuti course <?=$judul_course?> oleh <?=$nama_teacher?>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button name="unenrollBtn" type="submit" class="btn btn-primary">Unenroll</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                                if (isset($_GET['unenrollBtn']))
                                                {
                                                    $res = query("DELETE FROM my_courses WHERE kode_course = '$_SESSION[kode_course]' and e_student = '$_SESSION[email]'");
                                                    if ($res)
                                                    {
                                                        echo"
                                                            <script>
                                                                window.location = './index.php'
                                                            </script>
                                                        ";
                                                    }
                                                }
                                            ?>
                                        </form>
                                        
                                        <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                                            <!-- Table Materi -->
                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseOne"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                        <h5>MATERI</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseOne"
                                                    class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>JUDUL</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>FILE</th>
                                                                        <th class="text-center">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $res = query("SELECT * FROM materi WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_materi"); 
                                                                        
                                                                        foreach($res as $data)
                                                                        {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-bold-500">
                                                                            <?=$data['judul']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <?=$data['deskripsi']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <a href="./download_file.php?url=<?=$data['berkas']?>"><?=$data['nama_file']?></a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <!-- Download Button-->
                                                                            <form action="./download_file.php" method="GET">
                                                                                <input name="url" type="text" value="<?=$data['berkas']?>" hidden>
                                                                                <button name="mdownloadbtn" type="submit" class="btn btn-primary"><i class="badge-circle font-medium-1" data-feather="download"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Table Quiz -->
                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseTwo"
                                                        aria-expanded="false"
                                                        aria-controls="panelsStayOpen-collapseTwo">
                                                        <h5>QUIZ</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseTwo"
                                                    class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>JUDUL</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>Total Soal</th>
                                                                        <th>DURASI</th>
                                                                        <th class="text-center">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $res_quiz = query("SELECT * FROM quiz WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_quiz"); 
                                                                        
                                                                        foreach($res_quiz as $data_quiz)
                                                                        {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-bold-500">
                                                                            <a href="./single_quiz_scoreboard.php?kode_quiz=<?=$data_quiz['kode_quiz']?>"><?=$data_quiz['nama_quiz']?></a>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <?=$data_quiz['deskripsi']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <?=$data_quiz['jumlah_soal']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <?=$data_quiz['durasi']?> Menit
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="./quiz_prepare.php?kode_quiz=<?=$data_quiz['kode_quiz']?>" class="btn btn-primary"><i class="badge-circle font-medium-2" data-feather="play-circle"></i> Start</a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseThree"
                                                        aria-expanded="false"
                                                        aria-controls="panelsStayOpen-collapseThree">
                                                        <h5>TUGAS</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseThree"
                                                    class="accordion-collapse collapse">
                                                    <div class="accordion-body">
														<div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>JUDUL</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>FILE</th>
                                                                        <th>Tanggal Dibuat</th>
                                                                        <th>Tenggat Waktu</th>
                                                                        <th class="text-center">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $res = query("SELECT * FROM tugas WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_tugas"); 
                                                                        
                                                                        foreach($res as $data_tugas)
                                                                        {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-bold-500">
                                                                            <?=$data_tugas['nama_tugas']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <?=$data_tugas['deskripsi']?>
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            <a href="./download_file.php?url=<?=$data_tugas['berkas']?>"><?=$data_tugas['nama_file']?></a>
                                                                        </td>
                                                                        <td class="text-bold-500"><?=date('d-m-Y H:i:s', strtotime($data_tugas['date_added']))?></td>
                                                                        <td class="text-bold-500"
                                                                        <?php
                                                                            $res = query("SELECT * FROM submit_tugas WHERE kode_tugas = '$data_tugas[kode_tugas]' AND email = '$_SESSION[email]'");
                                                                            $current_date = new DateTime(date('Y-m-d H:i:s'));
                                                                            $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($data_tugas['date_collected'])));

                                                                            if ($current_date > $date_collected and (mysqli_num_rows($res) == 0 or mysqli_fetch_assoc($res)['status'] == 'late'))
                                                                            {
                                                                                echo 'style="color: red;"';
                                                                            }
                                                                        ?>
                                                                        ><?=date('d-m-Y H:i:s', strtotime($data_tugas['date_collected']))?></td>
                                                                        <td class="text-center">
                                                                            <!-- Submit Tugas Button-->
                                                                            <form action="./submission_info.php" method="POST">
                                                                                <input name="kode_tugas" type="text" value="<?=$data_tugas['kode_tugas']?>" hidden>
                                                                                <input name="nama_tugas" type="text" value="<?=$data_tugas['nama_tugas']?>" hidden>
                                                                                <input name="deadline" type="text" value="<?=$data_tugas['date_collected']?>" hidden>
                                                                                <button name="uTugasModalBtn" type="submit" class="btn btn-primary">
                                                                                    <i class="badge-circle font-medium-1" data-feather="eye"></i>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
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

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>


    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>

</body>

</html>