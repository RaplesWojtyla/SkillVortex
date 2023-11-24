<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION)) 
{
    session_start();
}

function conn()
{  
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'skill_vortex';

    return mysqli_connect($host, $user, $pass, $database);
}

function query($query)
{
    return mysqli_query(conn(), $query);
}

function register($data)
{
    $sql1    = query("SELECT MAX(id_users) as id FROM users");
    $maxID   = mysqli_fetch_array($sql1);
    $user_id = $maxID['id'];
    $user_id += 1;

    $fullname  = mysqli_real_escape_string(conn(), $data['fullname']);
    $username  = mysqli_real_escape_string(conn(), $data['username']);
    $email     = $data['email'];
    $password1 = mysqli_real_escape_string(conn(), $data['password1']);
    $password2 = mysqli_real_escape_string(conn(), $data['password2']);


    $sql = query("SELECT email FROM users WHERE email = '$email'"); 
    if (mysqli_num_rows($sql) > 0)
    {
        echo"
            <script>
                alert('Email telah terdaftar!')
            </script>
        ";

        return false;
    }

    if ($password1 == $password2)
    {
        // $password = password_hash($password1, PASSWORD_DEFAULT);
        query("INSERT INTO users (id_users, username, nama_lengkap, email, password, level) VALUES ('$user_id', '$username', '$fullname', '$email', '$password1', 3)");

        return true;
    }
    else
    {
        echo"
            <script>
                alert('Password tidak sama')
            </script>
        ";

        return false;   
    }
}

function insertData($data)
{
    $kodeMateri = $data['kodeMateri'];
    $judulMateri = $data['judulMateri'];
    $namaFile = $data['namaFile'];
    $ukuranFile = $data['ukuranFile'];
    $fileLoc = $data['fileLoc'];

    $res = query("INSERT INTO materi (kode_course, judul, nama_file, size, berkas) VALUES ('$kodeMateri', '$judulMateri', '$namaFile', '$ukuranFile', '$fileLoc')");
    if ($res)
    {
        return 1;
    }
    else 
    {
        return 0;
    }
}

function generateCode()
{
    return random_int(100000, 999999);
}

function sendCode($code, $toEmail)
{
    require '../vendor/autoload.php';

    $email    = 'skillvortex4@gmail.com';
    $password = 'hdvmnyycuhzgwodv';

    $mail = new PHPMailer(true);

    try {
        // setting
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // bagian isi email
        $mail->setFrom($email, 'Skill Vortex');
        $mail->addAddress($toEmail);
        $mail->Subject = 'Verification Code';
        $mail->Body = $code;

        $mail->send(); // Mengirim email
    } catch (Exception) {
        die("Gagal mengirim email. Error: {$mail->ErrorInfo}");
    }
}
?>