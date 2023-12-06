<?php
    require '../includes/function.php';

    if (isset($_POST['tuploadbtn']))
    {
        $kode_tugas = $_POST['kode_tugas'];
        $kode_course = $_SESSION['kode_course'];
        $nama_tugas = $_POST['nama_tugas'];
        $deskripsi = $_POST['deskripsi'];
        $date_collected = $_POST['date_collected'];
        $hour_collected = $_POST['hour_collected'];
        $nama_file = $_FILES['berkas']['name'];
        $size = "";
        $tmp_file = "";
        
        $dir = '../tugas/';
        $fileLoc = "";
        
        if (!empty($_FILES['berkas']['name']))
        {
            $nama_file = $_FILES['berkas']['name'];
            $size = $_FILES['berkas']['size'];
            $tmp_file = $_FILES['berkas']['tmp_name'];
            $fileLoc = $dir.$nama_file;
        }
        

        $uploaded = move_uploaded_file($tmp_file, $fileLoc);

        $dataArr = array(
            'kode_tugas' => $kode_tugas,
            'kode_course' => $kode_course,
            'nama_tugas' => $nama_tugas,
            'deskripsi' => $deskripsi,
            'nama_file' => $nama_file,
            'size' => $size,
            'berkas' => $fileLoc,
            'date_collected' => $date_collected,
            'hour_collected' => $hour_collected
        );

        if (insertTugasData($dataArr) or $uploaded)
        {
            echo"
                <script>
                    alert('Tugas berhasil diupload!')
                    window.location = './course.php'
                </script>
            ";
        }
        else
        {
            echo"
                <script>
                    alert('Tugas gagal diupload!')
                    window.location = './course.php'
                </script>
            ";
        }

    }
?>