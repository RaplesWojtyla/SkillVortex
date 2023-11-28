<?php
    require '../includes/function.php';

    if (isset($_POST['uploadbtn']))
    {
        $kodeMateri = $_POST['kode'];
        $judulMateri = $_POST['judul'];
        $namaFile = $_FILES['berkas']['name'];
        $deskripsiMateri = $_POST['deskripsi'];
        $tipe = $_POST['tipe_materi'];
        $ukuranFile = $_FILES['berkas']['size'];
        $tmpFile = $_FILES['berkas']['tmp_name'];

        $dir = '../materi/';
        $fileLoc = $dir.$namaFile;

        $uploaded = move_uploaded_file($tmpFile, $fileLoc);

        $dataAssoc = array(
            'kodeMateri' => $kodeMateri,
            'judulMateri' => $judulMateri,
            'namaFile' => $namaFile,
            'deskripsi' => $deskripsiMateri,
            'tipe' => $tipe,
            'ukuranFile' => $ukuranFile,
            'fileLoc' => $fileLoc
        );

        if ($uploaded and insertFileData($dataAssoc) == 1)
        {
            echo"
                <script>
                    alert('File berhasil diupload!')
                    window.location = './course.php'
                </script>
            ";
        }
    }

?>