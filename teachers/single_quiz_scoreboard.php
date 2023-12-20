<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

    if (!empty($_GET["kode_quiz"]))
    {
        $_SESSION['kode_quiz'] = $_GET["kode_quiz"];
    }

    $result = query("SELECT * FROM quiz WHERE kode_course = '$_SESSION[kode_course]' AND kode_quiz = '$_SESSION[kode_quiz]' ");
    $nama_quiz = mysqli_fetch_assoc($result)['nama_quiz'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard - Teacher Skill Vortex</title>

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
                

                    <section class="section">
                        <div class="row" id="table-striped-dark">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3 class="card-title">Hasil Quis</h3>
                                    </div>
                                    <br>
                                    <h4 class="card-title"><?=$nama_quiz?></h4>
                                    <div class="card-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover mb-4">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Total Soal</th>
                                                        <th>Benar</th>
                                                        <th>Salah</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $res2 = query("SELECT * FROM vw_quiz_result WHERE kode_course = '$_SESSION[kode_course]' AND kode_quiz = '$_SESSION[kode_quiz]' ORDER BY nilai DESC"); 
                                                        
                                                        foreach($res2 as $data2)
                                                        {
                                                            $angka_format = number_format($data2['nilai'], 2, '.', '');
                                                    ?>
                                                    <tr>
                                                        <td class="text-bold-500"><?=$data2['nama_lengkap']?></td>
                                                        <td class="text-bold-500"><?=$data2['total_question']?></td>
                                                        <td class="text-bold-500"><?=$data2['correct_answer']?></td>
                                                        <td class="text-bold-500"><?=$data2['wrong_answer']?></td>
                                                        <td class="text-bold-500"><?=$angka_format?></td>
                                                    </tr>

                                                    <?php } ?>
                                                </tbody>
                                            </table>
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