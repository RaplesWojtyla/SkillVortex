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
                                                                            <?=$data_quiz['nama_quiz']?>
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