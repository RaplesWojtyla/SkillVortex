<?php
    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Teacher')
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
    <title>Add Question - Admin</title>

    <link rel="shortcut icon" href="../dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

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
                                <h3 class="card-title">Soal nomor
                                    <?=$nomor_soal?>
                                </h3>
                            </div>
                            <div class="card-body">
                                <input type="number" name="no_soal[]" value="<?=$max_number?>" hidden>
                                <h4>Masukkan Soal</h4>
                                <div class"form-group">
                                    <textarea name="question[]" type="text" class="ckeditor"></textarea>
                                </div>
                            </div>
                            <?php for ($i = 1; $i <= 4; $i++) {?>
                            <div class="card-body">
                                <h6>Option
                                    <?=$i?>
                                </h6>
                                <div class"form-group">
                                    <textarea name="opt<?=$i?>[]" type="text" class="ckeditor"></textarea>
                                </div>
                            </div>
                            <?php } ?> <!-- Tutup for ($i = 1; $i <= 4; $i++) -->
                            <div class="card-body">
                                <h5>Jawaban</h5>
                                <div class"form-group">
                                    <textarea name="jawaban[]" type="text" class="ckeditor">
                                        <p>Untuk menghindari typo, harap copas jawaban yang benar dari option di
                                    atas</p>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <?php } ?> <!-- Tutup while ($nomor_soal < $jumlah_soal) -->
                        
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
                        <button name="addquestions" type="submit" class="btn btn-primary mb-5 mx-3">Add Questions</button>

                        <?php
                            if (isset($_POST['addquestions']))
                            {
                                $is_success = 0;
                                for ($i = 0; $i < $jumlah_soal - $banyak_soal; $i++)
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
                                                        </script>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-danger mx-3 mt-3 mb-3" onclick="window.location = './course.php'">Cancel</button>
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