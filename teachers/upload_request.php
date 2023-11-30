<?php
    require '../includes/function.php';

    if (isset($_POST['uploadbtn']))
    {
        $e_pengirim = $_POST['e_pengirim'];
        $e_penerima = $_POST['e_penerima'];
        $isi_request = $_POST['isi_request'];
        $level = $_POST['level'];
        $status = 'Belum Disetujui';

        $res = query("INSERT INTO request (e_pengirim , e_penerima , isi_request , level , status) VALUES ('$e_pengirim' ,'$e_penerima' ,'$isi_request' ,'$level' ,'$status')");

        if ($res)
        {
            echo"
                <script>
                    alert('Request berhasil dikirim!')
                    window.location = './req_teacher.php'
                </script>
            ";
        }
        else 
        {
            echo"
                <script>
                    alert('Request Gagal / Error !')
                    window.location = './request.php'
                </script>
            ";
        }
    }

?>