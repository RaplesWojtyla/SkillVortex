<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Asia/Jakarta');

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
    $email     = mysqli_real_escape_string(conn(), $data['email']);
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
        $hashed_password = password_hash($password1, PASSWORD_BCRYPT);
        query("INSERT INTO users (id_users, username, nama_lengkap, email, password, level) VALUES ('$user_id', '$username', '$fullname', '$email', '$hashed_password', 3)");

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

function changePassword($data)
{
    $old_password = $data['password_lama'];
    $new_password = $data['password_baru'];
    $confirm_new_password = $data['konfirmasi_password_baru'];

    if (password_verify($old_password, $_SESSION['password']))
    {
        if ($new_password == $confirm_new_password)
        {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $sql = query("UPDATE users SET password = '$hashed_password' WHERE email = '$_SESSION[email]'");

            if ($sql)
                return 1;
            else   
                return 0;
        }
        else
        {
            echo"
                <script>
                    alert('Password tidak sama')
                </script>
            ";
        }
    }
    else
    {
        echo"
            <script>
                alert('Password lama salah')
            </script>
        ";
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
function insertFileRequest($data)
{
    $e_pengirim = $data['e_pengirim'];
    $e_penerima = $data['e_penerima'];
    $isi_request = $data['isi_request'];
    $level = $data['level'];
    $status = 'Belum Disetujui';
    $namaFile1 = $data['namaFile1'];
    $namaFile2 = $data['namaFile2'];
    $namaFile3 = $data['namaFile3'];
    $ukuranFile1 = $data['ukuranFile1'];
    $ukuranFile2 = $data['ukuranFile2'];
    $ukuranFile3 = $data['ukuranFile3'];
    $fileLoc1 = $data['fileLoc1'];
    $fileLoc2 = $data['fileLoc2'];
    $fileLoc3 = $data['fileLoc3'];

    $res = query("INSERT INTO request (e_pengirim ,e_penerima ,isi_request ,level ,status , nama_file1, size1, berkas1, nama_file2, size2, berkas2, nama_file3 ,size3, berkas3) VALUES 
                    ('$e_pengirim' , '$e_penerima' , '$isi_request' ,'$level' ,'$status', '$namaFile1' , '$ukuranFile1' ,'$fileLoc1' ,'$namaFile2' , '$ukuranFile2' ,'$fileLoc2' ,'$namaFile3' , '$ukuranFile3' ,'$fileLoc3')");
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
    $getMaxID = query("SELECT MAX(id_quiz) as id FROM quiz");
    $maxID   = mysqli_fetch_array($getMaxID);
    $id_quiz = $maxID['id'];
    $id_quiz++;

    $kode_course = $data['kode_course'];
    $kode_quiz = $data['kode_quiz'];
    $nama_quiz = $data['nama_quiz'];
    $deskripsi_quiz = $data['deskripsi'];
    $type = $data['tipe_materi'];
    $durasi = $data['durasi'];
    $jumlah_soal = $data['jumlah_soal'];
    
    $res = query("INSERT INTO quiz VALUES ('$id_quiz', '$kode_course', '$kode_quiz', '$nama_quiz', '$deskripsi_quiz', '$type', '$durasi', '$jumlah_soal', current_timestamp('DD-MM-YYYY'))");
    if ($res)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function addQuizQuestions($data)
{
    $kode_course = $data['kode_course'];
    $kode_quiz = $data['kode_quiz'];
    $no_soal = $data['no_soal'];
    $soal = $data['question'];
    $opt1 = $data['opt1'];
    $opt2 = $data['opt2'];
    $opt3 = $data['opt3'];
    $opt4 = $data['opt4'];
    $jawaban = $data['jawaban'];

    $res = query("INSERT INTO questions VALUES ('', '$kode_course', '$kode_quiz', '$no_soal', '$soal', '$opt1', '$opt2', '$opt3', '$opt4', '$jawaban')");

    if ($res)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function updateQuizQuestions($data)
{
    $kode_quiz = $data['kode_quiz'];
    $no_soal = $data['no_soal'];
    $soal = $data['question'];
    $opt1 = $data['opt1'];
    $opt2 = $data['opt2'];
    $opt3 = $data['opt3'];
    $opt4 = $data['opt4'];
    $jawaban = $data['jawaban'];

    $res = query("UPDATE questions SET soal = '$soal', opt1 = '$opt1', opt2 = '$opt2', opt3 = '$opt3', opt4 = '$opt4', jawaban = '$jawaban' WHERE kode_quiz = '$kode_quiz' and no_soal = '$no_soal'");

    if ($res)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function insertQuizResult($data)
{
    $email = $data['email'];
    $kode_course = $data['kode_course'];
    $kode_quiz = $data['kode_quiz'];
    $total_questions = $data['total_questions'];
    $correct_answer = $data['correct_answer'];
    $wrong_answer = $data['wrong_answer'];

    $res = query("INSERT INTO quiz_result VALUES ('', '$email', '$kode_course', '$kode_quiz', '$total_questions', '$correct_answer', '$wrong_answer')");
    if($res)
    {
        return true;
    }
    
    return false;
}

function insertTugasData($data)
{
    $getMaxID = query("SELECT MAX(id_tugas) as id FROM tugas");
    $maxID   = mysqli_fetch_array($getMaxID);
    $id_tugas = $maxID['id'];
    $id_tugas++;

    $kode_tugas = $data['kode_tugas'];
    $kode_course = $data['kode_course'];
    $nama_tugas = $data['nama_tugas'];
    $deskripsi = $data['deskripsi'];
    $nama_file = $data['nama_file'];
    $size = $data['size'];
    $berkas = $data['berkas'];

    $current_date = date('Y-m-d H:i:s');
    $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($data['date_collected'] . $data['hour_collected'])));
    $formatted_date_collected = $date_collected->format('Y-m-d H:i:s');

    $res = query("INSERT INTO tugas VALUES ('$id_tugas', '$kode_tugas', '$kode_course', '$nama_tugas', '$deskripsi', '$nama_file', '$size', '$berkas', '$current_date', '$formatted_date_collected')");

    if ($res)
    {
        return true;
    }

    return false;
}

function updateMateriData($data)
{
    $id_materi = $data['id_materi'];
    $judul = $data['judul'];
    $deskripsi = $data['deskripsi'];
    $nama_file = $data['nama_file'];
    $size = $data['size'];
    $berkas = $data['berkas'];

    if (empty($nama_file) or empty($berkas) or $size == 0)
    {
        $res = query("UPDATE materi SET judul = '$judul', deskripsi = '$deskripsi' WHERE id_materi = '$id_materi'");
    }
    else
    {
        $res = query("UPDATE materi SET judul = '$judul', deskripsi = '$deskripsi', nama_file = '$nama_file', size = '$size', berkas = '$berkas' WHERE id_materi = '$id_materi'");
    }

    if ($res)
    {
        return true;
    }

    return false;
}

function updateTugasData($data)
{
    $id_tugas = $data['id_tugas'];
    $kode_tugas = $data['kode_tugas'];
    $nama_tugas = $data['nama_tugas'];
    $deskripsi = $data['deskripsi'];
    $nama_file = $data['nama_file'];
    $size = $data['size'];
    $berkas = $data['berkas'];
    
    $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($data['date_collected'] . $data['hour_collected'])));
    $formatted_date_collected = $date_collected->format('Y-m-d H:i:s');

    if (empty($nama_file) or empty($berkas))
    {
        $res = query("UPDATE tugas SET kode_tugas = '$kode_tugas', nama_tugas = '$nama_tugas', deskripsi = '$deskripsi', date_collected = '$formatted_date_collected' WHERE id_tugas = '$id_tugas'");
    }
    else
    {
        $res = query("UPDATE tugas SET kode_tugas = '$kode_tugas', nama_tugas = '$nama_tugas', deskripsi = '$deskripsi', nama_file = '$nama_file', size = '$size', berkas = '$berkas', date_collected = '$formatted_date_collected' WHERE id_tugas = '$id_tugas'");
    }

    if ($res)
    {
        return true;
    }

    return false;
}

function submit_assignment($data)
{
    $id_submit = $data['id_submit'];
    $kode_tugas = $data['kode_tugas'];
    $kode_course = $data['kode_course'];
    $email = $data['email'];
    $nama_file = $data['nama_file'];
    $size = $data['size'];
    $berkas = $data['berkas'];
    $status = '';
    $keterangan = '';
    $nilai = '';

    $current_date = new DateTime(date('Y-m-d H:i:s'));
    $formatted_current_date = $current_date->format('Y-m-d H:i:s');

    $date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($data['date_collected'])));
    $diff_time = $current_date->diff($date_collected);

    if ($current_date > $date_collected)
    {
        $status = 'late';
        $keterangan = $diff_time->format('Assignment was submitted %d days %h hours %i mins %s secs late');
    }
    else
    {
        $status = 'early';
        $keterangan = $diff_time->format('Assignment was submitted %d days %h hours %i mins %s secs early');
    }
    
    $method = $data['method'];

    if ($method == 'Update')
    {   
        $res = query("UPDATE submit_tugas SET nama_file = '$nama_file', size = '$size', berkas = '$berkas', date_submitted = '$formatted_current_date', status = '$status', keterangan = '$keterangan' WHERE id_submit = '$id_submit'");
    }
    else 
    {
        $res = query("INSERT INTO submit_tugas VALUES ('', '$kode_tugas', '$kode_course', '$email', '$nama_file', '$size', '$berkas', '$formatted_current_date', '$status', '$keterangan', '$nilai')");
    }

    if ($res)
    {
        return true;
    }

    return false;
}

function generateCode() // Generate nomor acak
{
    return random_int(100000, 999999);
}

function sendCode($fromEmail, $name, $toEmail, $subject, $message)
{
    /* Mengirim kode verifikasi melalui email */
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
        $mail->setFrom($fromEmail, $name);
        $mail->addAddress($toEmail);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send(); // Mengirim email
    } catch (Exception) {
        die("Gagal mengirim email. Error: {$mail->ErrorInfo}");
    }
}
?>