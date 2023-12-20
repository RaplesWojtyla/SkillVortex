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
    <title>Form Edit - Admin Skill Vortex</title>

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
                            $no_soal = $_GET['no_soal'];
                            $res = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' and no_soal = '$no_soal'");

                            foreach($res as $data) {
                        ?>
                        <div class="card mb-10">
                            <div class="card-header">
                                <h3 class="card-title">Edit Soal</h3>
                            </div>
                            <div class="card-body">
                                <input type="number" name="no_soal" value="<?=$no_soal?>" hidden>
                                <h4>Edit Soal</h4>
                                <div class"form-group">
                                    <textarea name="question" type="text" class="ckeditor">
                                        <?=$data['soal']?>
                                    </textarea>
                                </div>
                            </div>
                            <?php for ($i = 1; $i <= 4; $i++) {?>
                            <div class="card-body">
                                <h6>Option <?=$i?></h6>
                                <div class"form-group">
                                    <textarea name="opt<?=$i?>" type="text" class="ckeditor">
                                        <?=$data["opt$i"]?>
                                    </textarea>
                                </div>
                            </div>
                            <?php } ?> <!-- Tutup for ($i = 1; $i <= 4; $i++) -->
                            <div class="card-body">
                                <h5>Jawaban</h5>
                                <div class"form-group">
                                    <textarea name="jawaban" type="text" class="ckeditor">
                                        <?=$data['jawaban']?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <?php } ?> <!-- Tutup foreach($res as $data) { -->
                        
                        <?php 
                            $to_get_nama_quiz = query("SELECT * FROM quiz WHERE kode_quiz = '$_SESSION[kode_quiz]'");
                            $nama_quiz = mysqli_fetch_assoc($to_get_nama_quiz)['nama_quiz'];
                        ?>

                        <div class="form-group mx-3">
                            <label for="helperText">Nama Quiz</label>
                            <input name="nama_quiz" type="text" id="helperText" class="form-control"
                            value="<?=$nama_quiz?>" disabled>
                        </div>
                        <div class="form-group mx-3">
                            <label for="helperText">Kode Quiz</label>
                            <input name="kode_quiz" type="text" id="helperText" class="form-control"
                            value="<?=$_SESSION['kode_quiz']?>" disabled>
                        </div>
                        <button name="cquestion" type="submit" class="btn btn-primary mx-3">Change Question</button>
                    </form>
                    <button class="btn btn-danger mx-3 mt-3 mb-3" onclick="window.location='./add_questions.php'">Cancel</button>

                    <?php
                        if (isset($_POST['cquestion']))
                        {
                            $dataArr = array(
                                'kode_quiz' => $_SESSION['kode_quiz'],
                                'no_soal' => $_POST['no_soal'],
                                'question' => $_POST['question'],
                                'opt1' => $_POST['opt1'],
                                'opt2' => $_POST['opt2'],
                                'opt3' => $_POST['opt3'],
                                'opt4' => $_POST['opt4'],
                                'jawaban' => $_POST['jawaban']
                            );

                            if (updateQuizQuestions($dataArr))
                            {
                                echo"
                                    <script>
                                        alert('Soal berhasil diubah')
                                        window.location = './course.php'
                                    </script>
                                ";
                            }
                            else
                            {
                                echo"
                                    <script>
                                        alert('Terjadi kesalahan saat mengubah soal. Harap Coba lagi')
                                        window.location = './course.php'
                                    </script>
                                ";
                            }
                        }
                    ?>
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