<?php
    require '../includes/function.php';

    if (isset($_POST['uploadbtn']))
    {
        $e_pengirim = $_POST['e_pengirim'];
        $e_penerima = $_POST['e_penerima'];
        $isi_request = $_POST['isi_request'];
        $level = $_POST['level'];

        $namaFile1 = $_FILES['berkas1']['name'];
        $ukuranFile1 = $_FILES['berkas1']['size'];
        $tmpFile1 = $_FILES['berkas1']['tmp_name'];

        $namaFile2 = $_FILES['berkas2']['name'];
        $ukuranFile2 = $_FILES['berkas2']['size'];
        $tmpFile2 = $_FILES['berkas2']['tmp_name'];

        $namaFile3 = $_FILES['berkas3']['name'];
        $ukuranFile3 = $_FILES['berkas3']['size'];
        $tmpFile3 = $_FILES['berkas3']['tmp_name'];

        $dir = '../request/';
        $fileLoc1 = $dir.$namaFile1;
        $fileLoc2 = $dir.$namaFile2;
        $fileLoc3 = $dir.$namaFile3;

        $uploaded1 = move_uploaded_file($tmpFile1, $fileLoc1);
        $uploaded2 = move_uploaded_file($tmpFile2, $fileLoc2);
        $uploaded3 = move_uploaded_file($tmpFile3, $fileLoc3);

        $dataAssoc = array(
            'e_pengirim' => $e_pengirim,
            'e_penerima' => $e_penerima,
            'isi_request' => $isi_request,
            'level' => $level,
            'namaFile1' => $namaFile1,
            'namaFile2' => $namaFile2,
            'namaFile3' => $namaFile3,
            'ukuranFile1' => $ukuranFile1,
            'ukuranFile2' => $ukuranFile2,
            'ukuranFile3' => $ukuranFile3,
            'fileLoc1' => $fileLoc1,
            'fileLoc2' => $fileLoc2,
            'fileLoc3' => $fileLoc3
        );

        if ($uploaded1 and $uploaded2 and $uploaded3 and insertFileRequest($dataAssoc) == 1)
        {
            echo"
                <script>
                    alert('Request berhasil dikirim!')
                    window.location = './req_student.php'
                </script>
            ";
        }
    }

?>