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
    <title>Request - Admin Skill Vortex</title>

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
                                <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">

                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                <h4>Request Masuk</h4>
                                            </button>
                                        </h5>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
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
                                                            <th colspan="2" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $res = query("SELECT * FROM request WHERE level = 'Student' AND status = 'Belum Disetujui' ORDER BY id_request DESC");
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
                                                            <td class='text-center'>
                                                                <form method='POST' onsubmit="return confirm(`Apakah anda yakin melakukan Approve ?`)">
                                                                    <input type='email' hidden name='email' value=<?=$data['e_pengirim']?>>
                                                                    <input type='text' hidden name='id' value=<?=$data['id_request']?>>
                                                                    <button name='btnapprove' type='submit' class='btn icon icon-left btn-success'><i data-feather='check-circle'></i> Setujui</button>
                                                                </form>
                                                            </td>
                                                            <!--Delete Button-->
                                                            <td class='text-center'>
                                                                <form method='POST' onsubmit="return confirm(`Apakah anda yakin ingin menolak requestnya ?`)">
                                                                    <input type='text' hidden name='id' value=<?=$data['id_request']?>>
                                                                    <button name='btntolak' type='submit' class='btn icon icon-left btn-danger'><i data-feather='x'></i> Tolak</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        <?php
                                                            if (isset($_POST['btnapprove']))
                                                            {
                                                                $email = $_POST['email'];
                                                                $id = $_POST['id'];
                                                                query("UPDATE users SET level = 2 WHERE email = '$email'");
                                                                query("UPDATE request SET status = 'Disetujui' WHERE id_request = '$id'");
                                                                echo"
                                                                    <script>
                                                                        window.location = './req_students.php'
                                                                    </script>
                                                                ";
                                                            }

                                                            if (isset($_POST['btntolak']))
                                                            {
                                                                $id = $_POST['id'];
                                                                query("UPDATE request SET status = 'Ditolak' WHERE id_request = '$id'");
                                                                echo"
                                                                    <script>
                                                                        window.location = './req_students.php'
                                                                    </script>
                                                                ";
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                                <h4>Request Disetujui</h4>
                                            </button>
                                        </h5>
                                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <table class="table table-striped" id="table2">
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

                                                            $res = query("SELECT * FROM request WHERE level = 'Student' AND status = 'Disetujui' ORDER BY id_request DESC");
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
                                    </div>

                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                                <h4>Request Ditolak</h4>
                                            </button>
                                        </h5>
                                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <table class="table table-striped" id="table3">
                                                    <thead>
                                                        <tr>
                                                            <th>Email</th>
                                                            <th>Isi Request</th>
                                                            <th>Level</th>
                                                            <th>Berkas 1</th>
                                                            <th>Berkas 2</th>
                                                            <th>Berkas 3</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $res = query("SELECT * FROM request WHERE level = 'Student' AND status = 'Ditolak' ORDER BY id_request DESC");
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
                                                                    <!--Delete Button-->

                                                                    <!--Delete Button-->
                                                            <td>
                                                                <form method='POST' onsubmit="return confirm(`Apakah anda yakin ingin membatalkan penolakan request ?`)">
                                                                    <input type='text' hidden name='id' value=<?=$data['id_request']?>>
                                                                    <button name='btnbatal' type='submit' class='btn icon icon-left btn-danger'><i data-feather='trash'></i> Batalkan</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>

                                                        <?php
                                                            if (isset($_POST['btnbatal']))
                                                            {
                                                                $id = $_POST['id'];
                                                                query("UPDATE request SET status = 'Belum Disetujui' WHERE id_request = '$id'");
                                                                echo"
                                                                    <script>
                                                                        window.location = './req_students.php'
                                                                    </script>
                                                                ";
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