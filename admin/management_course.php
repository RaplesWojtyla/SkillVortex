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
    <title>Data Course - Admin Skill Vortex</title>

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
                                <h3>Data Teachers</h3>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <a href="tambah_course1.php" class="btn btn-primary">Tambah Course</a>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Kode Course</th>
                                            <th>Judul Course</th>
                                            <th>Email</th>
                                            <th>Nama Teacher</th>
                                            <th colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $res = query("SELECT * FROM vw_courses_teacher");
                                            foreach($res as $data)
                                            {     
                                        ?>       
                                        <tr>
                                            <td><?=$data['kode_course']?></td>
                                            <td><?=$data['judul_course']?></td>
                                            <td><?=$data['e_teacher']?></td>
                                            <td><?=$data['nama_lengkap']?></td>
                                            <td class='text-center'>
                                                <form method='POST' action='./formedit_course.php'>
                                                    <input type='text' hidden name='id_course' value=<?=$data['id_course']?>>
                                                    <button name='btnedit' type='submit' class='btn icon icon-left btn-success'><i data-feather='edit'></i> Edit</button>
                                                </form>
                                            </td>

                                            <!--Delete Button-->
                                            <td class='text-center'>
                                                <form method='POST' onsubmit="return confirm(`Apakah anda yakin ingin menghapus course <?=$data['judul_course']?>\nBy: <?=$data['nama_lengkap']?>`)">
                                                    <input type='text' hidden  name='kode_course1' value=<?=$data['kode_course']?>>
                                                    <button name='btndelete' type='submit' class='btn icon icon-left btn-danger'><i data-feather='trash'></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        <?php
                                            if (isset($_POST['btndelete']))
                                            {
                                                $kode_course = $_POST['kode_course1'];
                                                query("DELETE FROM courses WHERE kode_course = '$kode_course'");
                                                echo"
                                                    <script>
                                                        window.location = './management_course.php'
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