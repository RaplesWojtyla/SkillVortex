<?php

    require '../includes/function.php';
    if (isset($_POST['registerbtn'])) 
    {
        $userCode = $_POST['code'];

        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        $sql = query("SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($sql) == 0)
        {
            if (!empty($userCode) and $userCode == $_SESSION['verifCode']) 
            {

                if (validatePassword($password1))
                {
                    if ($password1 != $password2)
                    {
                        $passwordError = 'Password Tidak Sama';
                    }
                    else if ($password1 == $password2 and register($_POST)) 
                    {
                        $_SESSION['verifCode'] = '';
                        echo "
                            <script>
                                alert('Akun anda berhasil terdaftar!')
                                window.location = './login.php'
                            </script>
                        ";
                    }
                    else
                    {
                        echo "
                            <script>
                                alert('Terjadi kesalahan. Silahkan coba lagi')
                                window.location = './register.php'
                            </script>
                        ";
                    }
                }
                else 
                    $passwordError = 'Password harus terdiri dari minimal 8 karakter, minimal satu huruf besar, satu huruf kecil, dan satu simbol';
            } 
            else 
            {
                $verificationCodeError = 'Kode verifikasi salah';
            }
        }
        else
            $emailError = 'Email Telah Terdaftar';

    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="../dist/assets/compiled/css/auth.css" />
    <link rel="stylesheet" href="../dist/assets/extensions/sweetalert2/sweetalert2.min.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="../dist/assets/compiled/svg/logo.svg" alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">
                        Input your data to register to our website.
                    </p>

                    <form method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="fullname" type="text" class="form-control form-control-xl"
                                placeholder="Full Name" value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>" required />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="username" type="text" class="form-control form-control-xl"
                                placeholder="Username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" id="email" type="email" class="form-control form-control-xl" placeholder="Email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required />
                            <p style="color: red;"><?= isset($emailError) ? $emailError : ''; ?></p>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                                
                            <input name="path" id="path" type="text" class="form-control form-control-xl"
                                value="register" hidden/>
                            <input type="button" id="sendCode" onclick="sendEmail('email', 'path', 'sendCode')" class="btn btn-primary mt-3" value="Send Code">
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="code" id="code" type="text" class="form-control form-control-xl"
                                placeholder="Verification Code" required />
                            <span style="color: red;"><?= isset($verificationCodeError) ? $verificationCodeError : ''; ?></span>
                            <div class="form-control-icon">
                                <i class="bi bi-code"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password1" id="password" type="password" class="form-control form-control-xl" placeholder="Password" required value="<?= isset($_POST['password1']) ? htmlspecialchars($_POST['password1']) : ''; ?>" />
                            <span style="color: red;"><?= isset($passwordError) ? $passwordError : ''; ?></span>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="form-check mt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" onclick="showPassword()" class="form-check-input form-check-primary form-check-glow" name="pass2" id="showpassword1">
                                    <label class="form-check-label" for="showpassword1">Show Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password2" id="password2" type="password" class="form-control form-control-xl" placeholder="Confirm Password" value="<?= isset($_POST['password2']) ? htmlspecialchars($_POST['password2']) : '' ?>" required />
                            <span style="color: red;"><?= isset($passwordError) ? $passwordError : ''; ?></span>
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

                        <input type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="registerbtn" value="Sign Up">
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Already have an account?
                            <a href="login.php" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script src="../includes/function.js"></script>

    <script>
        
    </script>

    <script src="../distassets/static/js/components/dark.js"></script>
    <script src="../distassets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>

    <script src="../dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../dist/assets/static/js/pages/sweetalert2.js"></script>

</body>

</html>