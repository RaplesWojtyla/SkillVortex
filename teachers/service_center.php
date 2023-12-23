<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Teacher')
    {
        header("Location: ./error-403.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Center - Teacher Skill Vortex</title>

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
                                                <tr> 
                                                    <td>
                                                        <div class="recent-message d-flex px-1 py-3">
                                                            <div class="avatar avatar-lg">
                                                                <img src="../dist/assets/compiled/jpg/2.jpg">
                                                            </div>
                                                            <div class="name ms-3">
                                                                <a style="cursor: pointer;" onclick="loadChat('skillvortex4@gmail.com')" class="mb-1">Skill Vortex - Admin</a><br>
                                                                <a style="cursor: pointer;" onclick="loadChat('skillvortex4@gmail.com')" class="text-muted mb-0">skillvortex4@gmail.com</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php include("../includes/faq.php"); ?>
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