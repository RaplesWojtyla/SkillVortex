<?php
    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }

    if (isset($_POST['qeditbtn']))
    {
        $_SESSION['kode_quiz'] = $_POST['kode_quiz'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question - Admin Skil Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../dist/assets/extensions/toastify-js/src/toastify.css">

    <link rel="stylesheet" href="../dist/assets/extensions/quill/quill.snow.css">
    <link rel="stylesheet" href="../dist/assets/extensions/quill/quill.bubble.css">
</head>

<body>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php include './navbar.php'?>
            </header>

            <div class="page-heading">
                <section class="section">
                    <form action="" method="POST">
                        <?php
                            $to_get_jumlah_soal = query("SELECT * FROM quiz WHERE kode_quiz = '$_SESSION[kode_quiz]'");
                            $jumlah_soal = mysqli_fetch_assoc($to_get_jumlah_soal)['jumlah_soal']; // Total soal
                            
                            $to_get_banyak_soal = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]'");
                            $banyak_soal = mysqli_num_rows($to_get_banyak_soal); // Banyaknya soal saat ini yang telah dibuat

                            if ($banyak_soal < $jumlah_soal)
                            {
                                $max_number = mysqli_fetch_assoc(query("SELECT MAX(no_soal) as no_soal FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]'"))['no_soal'];
                                $nomor_soal = $banyak_soal;

                                while ($nomor_soal < $jumlah_soal)
                                {
                                    $nomor_soal++;
                                    $max_number++;

                        ?>
                        <div class="card mb-10">
                            <div class="card-header">
                                <h4 class="mb-3">Ada sebanyak <?=$jumlah_soal - $banyak_soal?> yang belum anda buat</h4>
                            </div>
                            <div class="card-body">
                                <input type="number" name="no_soal[]" value="<?=$max_number?>" hidden>
                                <h4>Tambahkan Soal Nomor <?=$nomor_soal?></h4>
                                <div class"form-group" required>
                                    <textarea name="question[]" type="text" class="ckeditor" required></textarea>
                                </div>
                            </div>
                            <?php for ($i = 1; $i <= 4; $i++) {?>
                            <div class="card-body">
                                <h6>Tambahkan Opsi Jawaban <?=$i?></h6>
                                <div class"form-group">
                                    <textarea name="opt<?=$i?>[]" type="text" class="ckeditor" required></textarea>
                                </div>
                            </div>
                            <?php } ?> <!-- Tutup for ($i = 1; $i <= 4; $i++) -->
                            <div class="card-body">
                                <h5>Tambahkan Jawaban Yang Benar</h5>
                                <small class="font-bold-600">Untuk menghindari typo, harap copas jawaban yang benar dari option di
                                    atas</small>
                                <div class"form-group" required>
                                    <textarea name="jawaban[]" type="text" class="ckeditor" required></textarea>
                                </div>
                            </div>
                        </div>
                        <?php } ?> <!-- Tutup while ($nomor_soal < $jumlah_soal) -->
                        <button name="addquestions" type="submit" class="btn btn-primary mb-5">Add Questions</button>

                        <?php
                            if (isset($_POST['addquestions']))
                            {
                                $is_success = 0;
                                for ($i = 0; $i < $jumlah_soal - $banyak_soal; $i++)
                                {
                                    if (!empty($_POST['question'][$i]) and !empty($_POST['opt1'][$i]) and !empty($_POST['opt2'][$i]) and !empty($_POST['opt3'][$i]) and !empty($_POST['opt4'][$i]) and !empty($_POST['jawaban'][$i]))
                                    {
                                        $dataArr = array(
                                            'kode_course' => $_SESSION['kode_course'],
                                            'kode_quiz' => $_SESSION['kode_quiz'],
                                            'no_soal' => $_POST['no_soal'][$i],
                                            'question' => $_POST['question'][$i],
                                            'opt1' => $_POST['opt1'][$i],
                                            'opt2' => $_POST['opt2'][$i],
                                            'opt3' => $_POST['opt3'][$i],
                                            'opt4' => $_POST['opt4'][$i],
                                            'jawaban' => $_POST['jawaban'][$i]
                                        );

                                        if (addQuizQuestions($dataArr))
                                        {
                                            $is_success = 1;
                                        }
                                        else
                                        {
                                            $is_success = 0;
                                            break;
                                        }
                                    }
                                    else
                                    {
                                        echo"
                                            <script>
                                                alert(`Anda belum membuat soal atau anda belum mengisi semua opsi jawaban atau jawaban yang benar untuk soal nomor ` + eval($i+1))
                                                window.location = './add_questions.php'
                                            </script>
                                        ";
                                    }
                                }

                                if ($is_success == 1)
                                {
                                    echo"
                                        <script>
                                            alert('Semua soal berhasil ditambahkan')
                                            window.location = './course.php'
                                        </script>
                                    ";
                                }
                                else
                                {
                                    echo"
                                        <script>
                                            alert('Terjadi kesalahan saat menambahkan soal. Harap Coba lagi')
                                            window.location = './course.php'
                                        </script>
                                    ";
                                }
                            }
                        ?>
                        <?php }?>  <!--Tutup dari if($banyak_soal < $jumlah_soal) -->
                    </form>
                </section>

                <section class="section">
                    <div class="col-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Soal</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                </div>
                                <!-- table bordered -->
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Soal</th>
                                                <th>Opsi 1</th>
                                                <th>Opsi 2</th>
                                                <th>Opsi 3</th>
                                                <th>Opsi 4</th>
                                                <th>Jawaban</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $res = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' ORDER BY no_soal");
                                                $no_soal = 0;

                                                foreach($res as $dataQuestions)
                                                {
                                                    $no_soal++;
                                            ?>
                                            <tr>
                                                <td><?=$no_soal?></td>
                                                <td><?=$dataQuestions['soal']?></td>
                                                <td><?=$dataQuestions['opt1']?></td>
                                                <td><?=$dataQuestions['opt2']?></td>
                                                <td><?=$dataQuestions['opt3']?></td>
                                                <td><?=$dataQuestions['opt4']?></td>
                                                <td><?=$dataQuestions['jawaban']?></td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <form action="./edit_questions.php" method="GET">
                                                        <input name="no_soal" type="text" value="<?=$dataQuestions['no_soal']?>" hidden>
                                                        <button name="qeditbtn" type="submit" class="btn btn-success"><i class="badge-circle font-medium-1" data-feather="edit"></i></button>
                                                    </form>
                                                    
                                                    <!-- Delete Button -->
                                                    <form onsubmit="return confirm(`Apakah anda yakin akan menghapus soal <?=$dataQuestions['soal']?>`)" method="POST">
                                                        <input name="no_soal" type="text" value="<?=$dataQuestions['no_soal']?>" hidden>
                                                        <button name="qdeletebtn" type="submit" class="btn btn-danger mt-3"><i class="badge-circle font-medium-1" data-feather="trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php } ?> <!--Tutup foreach($res as $dataQuestions) -->

                                            <?php
                                                if (isset($_POST['qdeletebtn']))
                                                {
                                                    query("DELETE FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' and no_soal = '$_POST[no_soal]'");
                                                    echo"
                                                        <script>
                                                            window.location = './add_questions.php'
                                                            // alert(`$_SESSION[kode_quiz]`)
                                                        </script>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-danger mx-2 mt-3 mb-3" onclick="window.location = './course.php'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>

    <script src="../dist/assets/extensions/quill/quill.min.js"></script>
    <script src="../dist/assets/static/js/pages/quill.js"></script>
</body>

</html>