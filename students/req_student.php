<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request - Student Skill Vortex</title>

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
                                <h3>Request Students</h3>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <a href="request.php" class="btn btn-primary">Tambah Request</a>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Isi Request</th>
                                            <th>Level</th>
                                            <th>Berkas 1</th>
                                            <th>Berkas 2</th>
                                            <th>Berkas 3</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $res = query("SELECT * FROM request WHERE e_pengirim = '$_SESSION[email]'  ORDER BY id_request DESC");
                                            foreach($res as $data)
                                            {     
                                        ?>       
                                        <tr>
                                            <td><?=$data['e_pengirim']?></td>
                                            <td><?=$data['isi_request']?></td>
                                            <td><?=$data['level']?></td>
                                            <td><a href="./download_file.php?url=<?=$data['berkas1']?>"><?=$data['nama_file1']?></a></td>
                                            <td><a href="./download_file.php?url=<?=$data['berkas2']?>"><?=$data['nama_file2']?></a></td>
                                            <td><a href="./download_file.php?url=<?=$data['berkas3']?>"><?=$data['nama_file3']?></a></td>
                                            <td><?=$data['status']?></td>
                                        </tr>
                                        <?php } ?>
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