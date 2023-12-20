<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

    if (!empty($_GET['kode_tugas']) and !empty($_GET['nama_tugas']))
    {
        $_SESSION['kode_tugas'] = $_GET['kode_tugas'];
        $_SESSION['nama_tugas'] = $_GET['nama_tugas'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Submission - Teacher Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">


    <link rel="stylesheet" href="../dist/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/table-datatable.css">
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
                                <h3><a href="./course.php"><i class="bi bi-arrow-left"></i></a></h3>
                                <h3><?=$_SESSION['nama_tugas']?></h3>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Grade</th>
                                            <th>Submission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $res = query("SELECT * FROM vw_courses_student WHERE kode_course = '$_SESSION[kode_course]'");
                                            foreach($res as $data1)
                                            {  
                                                $res2 = query("SELECT * FROM vw_tugas WHERE kode_course = '$_SESSION[kode_course]' AND kode_tugas = '$_SESSION[kode_tugas]' AND email = '$data1[e_student]'");
                                                if (mysqli_num_rows($res2) > 0){
                                                    $data2 = mysqli_fetch_assoc($res2);
                                                  
                                        ?>       
                                        <tr>
                                            <td><?=$data1['nama_student']?></td>
                                            <td><?=$data1['e_student']?></td>
                                            <td
                                            <?php

                                                if ($data2['status'] == 'early')
                                                    echo 'style="color: green;"';
                                                else
                                                    echo 'style="color: red;"';
                                                
                                            ?>
                                            ><?=ucfirst($data2['status'])?></td>
                                            <td>
                                            <?php 
                                                if ($data2['nilai'] == 0)
                                                    echo "Not Graded";
                                                else
                                                    echo $data2['nilai'];
                                            ?>
                                            </td>
                                            <td>
                                                <a name="seeSubmission" href="./submission_info.php?id_submit=<?=$data2['id_submit']?>&nama_tugas=<?=$data2['nama_tugas']?>" class="btn btn-primary">
                                                    <i class="badge-circle font-medium-1" data-feather="eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } else {?>
                                            <tr>
                                            <td><?=$data1['nama_student']?></td>
                                            <td><?=$data1['e_student']?></td>
                                            <td>Not Submitted</td>
                                            <td>Not Graded</td>
                                            <td>
                                                <input id="path" type="text" value="remainder" hidden>
                                                <input id="email" type="text" value="<?=$data1['e_student']?>" hidden>
                                                <button type="button" name="sendRemainder" onclick="sendMail()" class="btn btn-danger">
                                                    <i class="bi bi-exclamation-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        <?php }} ?> <!-- End of Nested foreach -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
            
        </div>
    </div>
    
    <script src="../includes/function.js"></script>

    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>

    <script src="../dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>
    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>

    <script src="../dist/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../dist/assets/static/js/pages/simple-datatables.js"></script>

</body>

</html>