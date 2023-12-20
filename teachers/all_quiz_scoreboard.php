<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

    if (!empty($_GET["kode_course"]))
    {
        $_SESSION['kode_course'] = $_GET["kode_course"];
    }


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
                                    <div class="card-content">
                                        <?php 
                                            $res1 = query("SELECT * FROM quiz WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_quiz "); 
                                            
                                            foreach($res1 as $data1)
                                            {
                                        ?>

                                        <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                                            <!-- Table Materi -->
                                            <div class="accordion-item">
                                                <h5 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?=$data1['kode_quiz']?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                                        <h5><?= $data1['nama_quiz'] ?></h5>
                                                    </button>
                                                </h5>
                                                <div id="<?=$data1['kode_quiz']?>" class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover mb-0">
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
                                                                        $kode_quiz = $data1['kode_quiz'];
                                                                        $res2 = query("SELECT * FROM vw_quiz_result WHERE kode_course = '$_SESSION[kode_course]' AND kode_quiz = '$kode_quiz' ORDER BY nilai DESC"); 
                                                                        
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

                                        <?php } ?>
                                        
                                        
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