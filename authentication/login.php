<?php
    
    require '../includes/function.php';

    if (isset($_POST['loginbtn']))
    {
        $inputEmail = mysqli_real_escape_string(conn(), $_POST['email']);
        $inputPassword = mysqli_real_escape_string(conn(), $_POST['password']);

        $sql = query("SELECT * FROM users WHERE email = '$inputEmail'");
        if (mysqli_num_rows($sql) == 1)
        {
            $row = mysqli_fetch_assoc($sql);

            if (password_verify($inputPassword, $row['password']))
            {
                $_SESSION['fullname'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['banned'] = $row['status'];
                $userLevel = $row['level'];
            
                if ($userLevel == 1)
                {
                    header("Location: ../admin/index.php");
                    $_SESSION['status'] = 'Admin';
                }
                else if ($userLevel == 2)
                {
                    header("Location: ../teachers/index.php");
                    $_SESSION['status'] = 'Teacher'; 
                }
                else if ($userLevel == 3)
                {
                    header("Location: ../students/index.php"); 
                    $_SESSION['status'] = 'Student'; 
                }
            }
            else
            {
                echo"
                    <script>
                        alert('Username atau password tidak ditemukan!!')
                        window.location = './login.php'
                    </script>
                ";
            }
        }
        else
        {
            echo"
                <script>
                    alert('Username atau password tidak ditemukan!')
                    window.location = './login.php'
                </script>
            ";
        }
    }
    else
    {
        if ($_SERVER['PHP_SELF'] == 'login.php') 
        {
            header("Location: ./login.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Skill Vortex</title>


    <link rel="shortcut icon" href="../dist/assets/compiled/svg/logo.png " type="image/x-icon">
    <link rel="shortcut icon"
        href="#"
        type="image/png">
    <link rel="shortcut icon"
        href="#"
        type="image/png">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/auth.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="../index.php"><img src="../gambar/skill.png" alt="Logo" style="width: 181px; height: 57px; "></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="email" type="text" class="form-control form-control-xl" placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input name="password" id="password" type="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="form-check mt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" onclick="showPassword()" class="form-check-input form-check-primary form-check-glow" id="showpassword">
                                    <label class="form-check-label" for="showpassword">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button name="loginbtn" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="register.php" class="font-bold">Signup</a></p>
                        <p><a class="font-bold" href="./cek_forgot_password.php">Forgot password?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>

    </div>

    <script src="../includes/function.js"></script>
</body>

</html>