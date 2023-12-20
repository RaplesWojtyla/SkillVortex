<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }
    if (!empty($_GET["kode_course"]))
    {
        $_SESSION['kode_course'] = $_GET["kode_course"];
    }

    $res2 = query("SELECT judul_course FROM courses WHERE kode_course = '$_SESSION[kode_course]' ");
    $judul = mysqli_fetch_assoc($res2)['judul_course'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant - Admin Skill Vortex</title>

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
                                <h4><?=$judul?> - Participants</h4>
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
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $res = query("SELECT * FROM vw_courses_student WHERE kode_course = '$_SESSION[kode_course]' ORDER BY id_my_course");
                                            foreach($res as $data)
                                            {     
                                        ?>       
                                        <tr>
                                            <td><?=$data['nama_student']?></td>
                                            <td><?=$data['username_student']?></td>
                                            <td><?=$data['e_student']?></td>
                                            <td class='text-center'>
                                                <form method='POST' onsubmit="return confirm(`Apakah anda yakin ingin mengeluarkan <?=$data['nama_student']?> dari Course anda`)">
                                                    <input type='text' hidden name='id' value=<?=$data['id_my_course']?>>
                                                    <button name='btndelete' type='submit' class='btn icon icon-left btn-danger'><i data-feather='trash'></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        <?php
                                            if (isset($_POST['btndelete']))
                                            {
                                                $userID = $_POST['id'];
                                                query("DELETE FROM my_courses WHERE id_my_course = '$userID'");
                                                echo"
                                                    <script>
                                                        window.location = './participant.php'
                                                    </script>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
            
        </div>
    </div>
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