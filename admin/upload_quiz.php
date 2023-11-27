<?php
    require '../includes/function.php';

    if (isset($_POST['uploadbtn']))
    {
        $kodeQuiz = $_POST['kode_quiz'];
        $kodeCourse = $_POST['kode'];
        $judulMateri = $_POST['judul'];
        $deskripsiMateri = $_POST['deskripsi'];
        $tipe = $_POST['tipe_materi'];
        $durasi = $_POST['durasi'];

        //ini belum beres
        $dataAssoc = array(
            'kodeMateri' => $kodeMateri,
            'judulMateri' => $judulMateri,
            'namaFile' => $namaFile,
            'deskripsi' => $deskripsiMateri,
            'tipe' => $tipe,
            'ukuranFile' => $ukuranFile,
            'fileLoc' => $fileLoc
        );

        if ($uploaded and insertData($dataAssoc) == 1)
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