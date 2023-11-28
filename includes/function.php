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
    $getMaxID    = query("SELECT MAX(id_users) as id FROM users");
    $maxID   = mysqli_fetch_array($getMaxID);
    $user_id = $maxID['id'];
    $user_id += 1;

    $fullname  = mysqli_real_escape_string(conn(), $data['fullname']);
    $username  = mysqli_real_escape_string(conn(), $data['username']);
    $email     = $data['email'];
    $password1 = mysqli_real_escape_string(conn(), $data['password1']);
    $password2 = mysqli_real_escape_string(conn(), $data['password2']);


    $res = query("SELECT email FROM users WHERE email = '$email'"); 
    if (mysqli_num_rows($res) > 0)
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

function insertFileData($data)
{
    $kodeMateri = $data['kodeMateri'];
    $judulMateri = $data['judulMateri'];
    $namaFile = $data['namaFile'];
    $deskripsi = $data['deskripsi'];
    $tipe = $data['tipe'];
    $ukuranFile = $data['ukuranFile'];
    $fileLoc = $data['fileLoc'];

    $res = query("INSERT INTO materi (kode_course, judul, nama_file, deskripsi, type, size, berkas) VALUES ('$kodeMateri', '$judulMateri', '$namaFile', '$deskripsi', '$tipe', '$ukuranFile', '$fileLoc')");
    if ($res)
    {
        return 1;
    }
    else 
    {
        return 0;
    }
}

function insertQuizData($data)
{
    $getMaxID    = query("SELECT MAX(id_quiz) as id FROM quiz");
    $maxID   = mysqli_fetch_array($getMaxID);
    $id_quiz = $maxID['id'];
    $id_quiz++;

    $kode_course = $_POST['kode_course'];
    $kode_quiz = $_POST['kode_quiz'];
    $nama_quiz = $_POST['nama_quiz'];
    $deskripsi_quiz = $_POST['deskripsi'];
    $type = $_POST['tipe_materi'];
    $durasi = $_POST['durasi'];

    $res = query("INSERT INTO quiz VALUES ('$id_quiz', '$kode_course', '$kode_quiz', '$nama_quiz', '$deskripsi_quiz', '$type', '$durasi', current_timestamp())");
    if ($res)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function generateCode() // Generate nomor acak
{
    return random_int(100000, 999999);
}

function sendCode($code, $toEmail)
{
    // Mengirim kode verifikasi melalui email
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