<?php
    require '../includes/function.php';

    if (isset($_POST['checkbtn']))
    {
        $user_email = $_POST['email'];
        $res = query("SELECT * FROM users WHERE email = '$user_email'");

        if(mysqli_num_rows($res) == 1)
        {
            $user_code = $_POST['code'];
            if ($user_code == $_SESSION['verifCode'])
            {
                $_SESSION['email'] = $user_email;
                header("Location: ./forgot_password.php");
            }
            else 
            {
                echo"
                    <script>
                        alert('Kode verifikasi salah')
                        window.location = './cek_forgot_password.php'
                    </script>
                ";
            }
            $_SESSION['verifCode'] = '';
        }
        else
        {
            echo"
                <script>
                    alert('Email tidak ditemukan')
                    window.location = './cek_forgot_password.php'
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Skill Vortex</title>



    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/auth.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="../index.php"><img src="../gambar/skill.png" alt="Logo" style="width: 181px; height: 57px; "></a>
                    </div>
                    <h1 class="auth-title">Forgot Password</h1>
                    <p class="auth-subtitle mb-5">Kami Akan Mengirim Kode Verifikasi ke Email Anda</p>

                    <form method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" id="email" type="email" class="form-control form-control-xl"
                                placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            
                            <input name="path" id="path" type="text" class="form-control form-control-xl" value="forgot_password" hidden/>
                            <input type="button" name="sendcode" id="sendCode" onclick="sendEmail('email', 'path', 'sendCode')" class="btn btn-outline-info mt-3"
                                value="Send Code" required>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="code" id="code" type="text" class="form-control form-control-xl"
                                placeholder="Verification Code" required>
                            <div class="form-control-icon">
                                <i class="bi bi-code"></i>
                            </div>
                        </div>
                        <button name="checkbtn" type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Check</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Remember your account? <a href="./login.php" class="font-bold">Login</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../dist/assets/compiled/js/app.js"></script>

    <script src="../includes/function.js"></script>
</body>

</html>