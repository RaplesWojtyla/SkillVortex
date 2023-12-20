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
    <title>Banned User - Admin Skill Vortex</title>

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
                                <h3>Banned User</h3>
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
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $res = query("SELECT * FROM users WHERE level  != 1 ORDER BY id_users");
                                            foreach($res as $data)
                                            {     
                                        ?>       
                                        <tr>
                                            <td> <?=$data['nama_lengkap']?></td>
                                            <td><?=$data['username']?></td>
                                            <td><?=$data['email']?></td>
                                            <td><?=($data['level'] == 2) ? "Teacher" : "Student" ?></td>
                                            <!--Banned Button-->
                                            <td>
                                                <form method="GET">
                                                    <!-- Button trigger modal -->
                                                    <input name='id_user' type='text' value="<?=$data['id_users']?>" hidden>
                                                    <input name='status' type='text' value="<?=$data['status']?>" hidden>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?=str_replace(' ', '', $data['username'])?>">
                                                        <?=($data['status'] == Null) ? "Banned" : "Unbanned" ?>
                                                    </button>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="<?=str_replace(' ', '', $data['username'])?>" data-bs-backdrop="static"
                                                        data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel"><?=($data['status'] == Null) ? "Banned" : "Unbanned" ?> User</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Nama Lengkap: <?=$data['nama_lengkap']?></p>
                                                                    <p>Username: <?=$data['username']?></p>
                                                                    <p>Email: <?=$data['email']?></p>
                                                                    <p>Level: <?=($data['level'] == 2) ? "Teacher" : "Student" ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button name="bannedBtn" type="submit" class="btn btn-danger"><?=($data['status'] == Null) ? "Banned" : "Unbanned" ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php } ?>

                                        <?php
                                            if (isset($_GET['bannedBtn']))
                                            {
                                                $id_user = $_GET['id_user'];
                                                $status = $_GET['status'];

                                                if ($status == Null)
                                                {
                                                    query("UPDATE users SET status = 'Banned' WHERE id_users = '$id_user'");
                                                }
                                                else
                                                {
                                                    query("UPDATE users SET status = Null WHERE id_users = '$id_user'");
                                                }
                                                echo "
                                                    <script>
                                                        window.location = './banned_user.php'
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