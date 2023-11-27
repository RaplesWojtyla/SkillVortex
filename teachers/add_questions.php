<?php

    require '../includes/function.php';

    $kode_course = $_POST['kode'];
    $judulQuiz = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tipe = $_POST['tipe_materi'];

    query("INSERT INTO materi (kode_course, judul, nama_file, deskripsi, type, size, berkas) VALUES ('$kode_course', '$judulQuiz', '', '$deskripsi', '$tipe', '', '')");

?>

