<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }

    if (!empty($_POST["kode_course1"]))
    {
        $_SESSION['kode_course'] = $_POST["kode_course1"];
    }

    $result = query("SELECT * FROM courses WHERE kode_course = '$_SESSION[kode_course]'");
    $judul_course = mysqli_fetch_assoc($result)['judul_course'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$judul_course?> - Admin Skill Vortex</title>

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
                                <h2>Courses</h2>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row" id="table-striped-dark">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?=$judul_course?></h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Tambah Data
                                            </button>
                                            <a href="participant.php?kode_course=<?=$_SESSION['kode_course']?>" class="btn btn-primary mx-2">
                                                Participants
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Pilih Menu</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-around">
                                                            <a href=".\tambah_materi.php?kode_course=<?=$_SESSION['kode_course']?>" class="btn btn-primary">Materi</a>
                                                            <a href=".\tambah_quiz.php?kode_course=<?=$_SESSION['kode_course']?>" class="btn btn-primary">Quiz</a>
                                                            <a href=".\tambah_tugas.php?kode_course=<?=$_SESSION['kode_course']?>" class="btn btn-primary">Tugas</a>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                                            <!-- Table Materi -->
                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                        <h5>MATERI</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>JUDUL</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>NAMA FILE</th>
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
                                                                        <td class="text-bold-500"><?=$data['judul']?></td>
                                                                        <td class="text-bold-500"><?=$data['deskripsi']?></td>
                                                                        <td class="text-bold-500"><a href="./download_file.php?url=<?=$data['berkas']?>"><?=$data['nama_file']?></a></td>
                                                                        <td class="text-center">
                                                                            <!-- Materi - Edit Button-->
                                                                            <form action="./edit_materi.php" method="POST">
                                                                                <input name="id_materi" type="text" value="<?=$data['id_materi']?>" hidden>
                                                                                <button name="meditbtn" type="submit" class="btn btn-success"><i class="badge-circle font-medium-1" data-feather="edit"></i></button>
                                                                            </form>
                                                                            
                                                                            <!-- Materi - Delete Button -->
                                                                            <form onsubmit="return confirm(`Apakah anda yakin ingin menghapus file materi <?=$data['nama_file']?>`)" method="POST">
                                                                                <input name="id" type="text" value="<?=$data['id_materi']?>" hidden>
                                                                                <input name="judul" type="text" value="<?=$data['judul']?>" hidden>
                                                                                <button name="mdeletebtn" type="submit" class="btn btn-danger mt-3"><i class="badge-circle font-medium-1" data-feather="trash"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>

                                                                    <?php
                                                                        if (isset($_POST['mdeletebtn']))
                                                                        {
                                                                            $id_course = $_POST['id'];
                                                                            $judul = $_POST['judul'];
                                                                            $res = query("DELETE FROM materi WHERE id_materi = '$id_course'");
                                                                            if ($res)
                                                                            {
                                                                                echo"
                                                                                    <script>
                                                                                        alert(`Materi $judul berhasil dihapus`)
                                                                                        window.location = './course.php'
                                                                                    </script>
                                                                                ";
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Table Quiz -->
                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                        <h5>QUIZ</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>JUDUL</th>
                                                                        <th>DESKRIPSI</th>
                                                                        <th>Jumlah Soal</th>
                                                                        <th>DURASI</th>
                                                                        <th class="text-center">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $res_quiz = query("SELECT * FROM quiz WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_quiz "); 
                                                                        
                                                                        foreach($res_quiz as $data_quiz)
                                                                        {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-bold-500"><?=$data_quiz['nama_quiz']?></td>
                                                                        <td class="text-bold-500"><?=$data_quiz['deskripsi']?></td>
                                                                        <td class="text-bold-500"><?=$data_quiz['jumlah_soal']?></td>
                                                                        <td class="text-bold-500"><?=$data_quiz['durasi']?> Menit</td>
                                                                        <td class="text-center">
                                                                            <!-- Quiz - Add Questions Button -->
                                                                            <form action="./add_questions.php" method="POST">
                                                                                <input name="kode_quiz" type="text" value="<?=$data_quiz['kode_quiz']?>" hidden>
                                                                                <button name="qeditbtn" type="submit" class="btn btn-success"><i class="badge-circle font-medium-1" data-feather="edit"></i></button>
                                                                            </form>
                                                                            
                                                                            <!-- Quiz - Delete Button -->
                                                                            <form onsubmit="return confirm(`Apakah anda yakin ingin menghapus quiz <?=$data_quiz['nama_quiz']?>`)" method="POST">
                                                                                <input name="kode_quiz" type="text" value="<?=$data_quiz['kode_quiz']?>" hidden>
                                                                                <input name="nama_quiz" type="text" value="<?=$data_quiz['nama_quiz']?>" hidden>
                                                                                <button name="qdeletebtn" type="submit" class="btn btn-danger mt-3"><i class="badge-circle font-medium-1" data-feather="trash"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>

                                                                    <?php
                                                                        if (isset($_POST['qdeletebtn']))
                                                                        {
                                                                            $kode_quiz = $_POST['kode_quiz'];
                                                                            $nama_quiz = $_POST['nama_quiz'];
                                                                            $res1 = query("DELETE FROM quiz WHERE kode_quiz = '$kode_quiz'");
                                                                            $res2 = query("DELETE FROM questions WHERE kode_quiz = '$kode_quiz' AND kode_course = '$_SESSION[kode_course]'");

                                                                            if ($res1 and $res2)
                                                                            {
                                                                                echo"
                                                                                    <script>
                                                                                        alert(`Quiz $nama_quiz berhasil dihapus.`) 
                                                                                        window.location = './course.php'
                                                                                    </script>
                                                                                ";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo"
                                                                                    <script>
                                                                                        alert(`Quiz $nama_quiz gagal dihapus.`) 
                                                                                        window.location = './course.php'
                                                                                    </script>
                                                                                ";
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                                        <h5>TUGAS</h5>
                                                    </button>
                                                </h5>
                                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                    <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nama Tugas</th>
                                                                        <th>Deskripsi</th>
                                                                        <th>Nama File</th>
                                                                        <th>Tanggal Dibuat</th>
                                                                        <th>Tenggat Waktu</th>
                                                                        <th class="text-center">ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                        $res_tugas = query("SELECT * FROM tugas WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_tugas"); 
                                                                        
                                                                        foreach($res_tugas as $data_tugas)
                                                                        {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-bold-500"><a href="./assignment_submission.php?kode_tugas=<?=$data_tugas['kode_tugas']?>&nama_tugas=<?=$data_tugas['nama_tugas']?>"><?=$data_tugas['nama_tugas']?></a></td>
                                                                        <td class="text-bold-500"><?=$data_tugas['deskripsi']?></td>
                                                                        <td class="text-bold-500"><a href="./download_file.php?url=<?=$data_tugas['berkas']?>"><?=$data_tugas['nama_file']?></a></td>
                                                                        <td class="text-bold-500"><?=date('d-m-Y H:i:s', strtotime($data_tugas['date_added']))?></td>
                                                                        <td class="text-bold-500"><?=date('d-m-Y H:i:s', strtotime($data_tugas['date_collected']))?></td>
                                                                        <td class="text-center">
                                                                            <!-- Tugas - Edit Button -->
                                                                            <form action="./edit_submission.php" method="POST">
                                                                                <input name="kode_tugas" type="text" value="<?=$data_tugas['kode_tugas']?>" hidden>
                                                                                <input name="id_tugas" type="text" value="<?=$data_tugas['id_tugas']?>" hidden>
                                                                                <button name="teditbtn" type="submit" class="btn btn-success"><i class="badge-circle font-medium-1" data-feather="edit"></i></button>
                                                                            </form>
                                                                            
                                                                            <!--Tugas - Delete Button -->
                                                                            <form onsubmit="return confirm(`Apakah anda yakin ingin menghapus tugas <?=$data_tugas['nama_tugas']?>`)" method="POST">
                                                                                <input name="kode_tugas" type="text" value="<?=$data_tugas['kode_tugas']?>" hidden>
                                                                                <input name="id_tugas" type="text" value="<?=$data_tugas['id_tugas']?>" hidden>
                                                                                <button name="tdeletebtn" type="submit" class="btn btn-danger mt-3"><i class="badge-circle font-medium-1" data-feather="trash"></i></button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>

                                                                    <?php
                                                                        if (isset($_POST['tdeletebtn']))
                                                                        {
                                                                            $kode_tugas = $_POST['kode_tugas'];
                                                                            $nama_tugas = $_POST['nama_tugas'];
                                                                            $res = query("DELETE FROM tugas WHERE kode_tugas = '$kode_tugas'");

                                                                            if ($res)
                                                                            {
                                                                                echo"
                                                                                    <script>
                                                                                        alert(`Tugas $nama_tugas berhasil dihapus.`) 
                                                                                        window.location = './course.php'
                                                                                    </script>
                                                                                ";
                                                                            }
                                                                            else
                                                                            {
                                                                                echo"
                                                                                    <script>
                                                                                        alert(`Tugas $nama_tugas gagal dihapus.`) 
                                                                                        window.location = './course.php'
                                                                                    </script>
                                                                                ";
                                                                            }
                                                                        }
                                                                    ?>
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