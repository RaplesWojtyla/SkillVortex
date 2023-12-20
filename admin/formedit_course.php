<?php

    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ./error-403.html");
    }

    if (!empty($_POST['id_course']))
    {
        $courseID = $_POST['id_course'];
        $_SESSION['id_course'] = $courseID;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit - Admin Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>

    <div id="app" class="mystyle">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php include("navbar.php"); ?>
            </header>
            <div class="col-md-6 col-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Course</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php

                                $res = query("SELECT * FROM courses WHERE id_course = '$_SESSION[id_course]'");

                                foreach($res as $data)
                                {
                            
                            ?>
                            <form action="" method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <input name="id" type="number" value="<?=$data['id_course']?>" hidden>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal-icon">Kode Course</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="kode_course" type="text" class="form-control" value="<?=$data['kode_course']?>"
                                                        id="first-name-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-code-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="judul">Judul Course</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="judul" type="text" class="form-control" value="<?=$data['judul_course']?>"
                                                        id="judul">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-journals"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal-icon">Email</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input name="email" type="email" class="form-control" value="<?=$data['e_teacher']?>"
                                                        id="email-horizontal-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-5">
                                            <button name="updatebtn" type="submit" class="btn btn-success me-1 mb-1">Update</button>
                                            <button name="cancelbtn" type="submit" class="btn btn-danger me-1 mb-1">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>


                            <?php                               
                                if (isset($_POST['updatebtn']))
                                {
                                    $id_course = $_POST['id'];
                                    $kode_course = $_POST['kode_course'];
                                    $judul_course = $_POST['judul'];
                                    $e_teacher = $_POST['email'];

                                    $is_e_teacher = query("SELECT * FROM users WHERE email = '$e_teacher'");
                                    if (mysqli_num_rows($is_e_teacher) > 0)
                                    {
                                        if (mysqli_fetch_assoc($is_e_teacher)['level'] == 2)
                                            {
                                            $sql = query("UPDATE courses SET kode_course = '$kode_course', judul_course = '$judul_course', e_teacher = '$e_teacher' WHERE id_course = '$id_course'");
                                            if ($sql)
                                            {
                                                echo"
                                                    <script>
                                                        alert('Data berhasil diubah')
                                                        window.location = './management_course.php'
                                                    </script>
                                                ";
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo"
                                            <script>
                                                alert('Email tidak ditemukan atau itu bukan email seorang guru.')
                                                window.location = './formedit_course.php'
                                            </script>
                                        ";
                                    }
                                }
                                else if (isset($_POST['cancelbtn']))
                                {
                                    echo"
                                        <script>
                                            window.location = './management_course.php'
                                        </script>
                                    ";
                                }
                            ?>
                            
                        </div>
                    </div>
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