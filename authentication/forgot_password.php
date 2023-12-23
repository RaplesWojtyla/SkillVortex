<?php
    require '../includes/function.php';

    if (isset($_POST['submit']))
    {
        $user_email = $_SESSION['email'];
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        if ($pass1 == $pass2)
        {
            $res = query("UPDATE users SET password = '$pass1' WHERE email = '$user_email'");

            if($res)
            {
                $_SESSION['email'] = '';
                echo"
                    <script>
                        alert('Password anda berhasil diubah, silahkan login')
                        window.location = './login.php'
                    </script>
                ";
            }
            else
            {
                echo"
                    <script>
                        alert('Terjadi kesalahan, silahkan coba lagi')
                        window.location = './forgot_password.php'
                    </script>
                ";
            }
        }
        else
        {
            echo"
                <script>
                    alert('Password tidak sama')
                    window.location = './forgot_password.php'
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



    
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
    <?php include("../includes/logo.php"); ?>
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
                    <p class="auth-subtitle mb-5">Silahkan Buat Password Baru Anda</p>

                    <form method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password1" id="password1" type="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="form-check mt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" onclick="showPassword()" class="form-check-input form-check-primary form-check-glow" name="customCheck" id="showpassword1">
                                    <label class="form-check-label" for="showpassword1">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password2" id="password2" type="password" class="form-control form-control-xl" placeholder="Confirm Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="form-check mt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" onclick="showPassword(2)" class="form-check-input form-check-primary form-check-glow" name="pass2" id="showpassword2">
                                    <label class="form-check-label" for="showpassword2">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Change Password</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Remember your account? <a href="./login.php" class="font-bold">Login</a>.
                        </p>
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

    <script>
        function showPassword(z = 1)
        {
            if (z == 1)
            {
                let x = document.getElementById('password1');
                if (x.type === "password")
                {
                    x.type = "text"
                }
                else
                {
                    x.type = "password"
                }
            }
            else if (z == 2)
            {
                let x = document.getElementById('password2');
                if (x.type === "password")
                {
                    x.type = "text"
                }
                else
                {
                    x.type = "password"
                }
            }
            
        }
    </script>
</body>

</html>