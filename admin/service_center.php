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
    <title>Service Center - Admin Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/ui-widgets-chatbox2.css">


    <link rel="stylesheet" href="../dist/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/table-datatable.css">

    <style>   
        #card-body2 {
            height: 300px; 
            overflow-y: auto; 
        }
        #card-body1 {
            height: 477px; 
            overflow-y: auto; 
        }
    </style>
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body" id="card-body1">
                                        <table class="table" >
                                            
                                            <tbody>
                                                <?php

                                                    $res = query("SELECT * FROM vw_service_center WHERE e_pengirim != 'skillvortex4@gmail.com' AND id_service IN (SELECT MAX(id_service) FROM vw_service_center GROUP BY e_pengirim) ORDER BY id_service DESC");
                                                    
                                                    foreach($res as $data)
                                                    {     
                                                ?>       
                                                <tr>  
                                                    <td>
                                                        <div class="recent-message d-flex px-1 py-3">
                                                            <div class="avatar avatar-lg">
                                                                <img src="../dist/assets/compiled/jpg/2.jpg">
                                                            </div>
                                                            <div class="name ms-3">
                                                                <a style="cursor: pointer;" onclick="loadChat('<?=$data['e_pengirim']?>')" class="mb-1"><?=$data['nama_pengirim']?></a><br>
                                                                <a style="cursor: pointer;" onclick="loadChat('<?=$data['e_pengirim']?>')" class="text-muted mb-0"><?=$data['e_pengirim']?></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }

                                                    $res2 = query("SELECT * FROM users");
                                                    foreach ($res2 as $data2)
                                                    {
                                                        $sql = query("SELECT * FROM vw_service_center WHERE (e_penerima = '$data2[email]' AND e_pengirim = '$_SESSION[email]') OR (e_penerima = '$_SESSION[email]' AND e_pengirim = '$data2[email]')");
                                                        if (mysqli_num_rows($sql) == 0 and $data2['email'] != 'skillvortex4@gmail.com')
                                                        {
                                                    
                                                ?>
                                                <tr>  
                                                    <td>
                                                        <div class="recent-message d-flex px-1 py-3">
                                                            <div class="avatar avatar-lg">
                                                                <img src="../dist/assets/compiled/jpg/2.jpg">
                                                            </div>
                                                            <div class="name ms-3">
                                                                <a style="cursor: pointer;" onclick="loadChat('<?=$data2['email']?>')" class="mb-1"><?=$data2['nama_lengkap']?></a><br>
                                                                <a style="cursor: pointer;" onclick="loadChat('<?=$data2['email']?>')" class="text-muted mb-0"><?=$data2['email']?></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card" id="chat">
                                    
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

    <script src="../includes/serviceCenterFunc.js"></script>

</body>

</html>