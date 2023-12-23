-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 10:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skill_vortex`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `kode_course` varchar(10) NOT NULL,
  `judul_course` varchar(40) NOT NULL,
  `e_teacher` varchar(40) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_course`, `kode_course`, `judul_course`, `e_teacher`, `deskripsi`) VALUES
(2, 'AI001', 'Artificial Inteligent', 'patrarwsinaga04@gmail.com', NULL),
(1, 'BPL001', 'Basic Programming Language', 'patrarwsinaga04@gmail.com', NULL),
(3, 'BWD001', 'Basic Web Development', 'alfioke7@gmail.com', NULL),
(5, 'IPC001', 'Intermediate Programming C', 'patrarwsinaga04@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `e_student` varchar(40) DEFAULT NULL,
  `diskusi` varchar(255) NOT NULL,
  `e_teacher` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `e_pengirim` varchar(40) DEFAULT NULL,
  `isi_pesan` varchar(255) DEFAULT NULL,
  `e_penerima` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `e_pengirim`, `isi_pesan`, `e_penerima`) VALUES
(12, 'rapleswojtyla@gmail.com', 'Gilaa keren banget websitenya minn', 'skillvortex4@gmail.com'),
(13, 'rapleswojtyla@gmail.com', 'GGWP', 'skillvortex4@gmail.com'),
(14, 'rapleswojtyla@gmail.com', 'KERENNNN', 'skillvortex4@gmail.com'),
(15, 'patrarwsinaga04@gmail.com', 'Websitenya keren bangett, mirip E-Learning USU!!', 'skillvortex4@gmail.com'),
(16, 'rapleswojtyla@gmail.com', 'Subarashii!!', 'skillvortex4@gmail.com'),
(17, 'rapleswojtyla@gmail.com', 'Mantap min, terus perkembangkan kemampuanmu!!', 'skillvortex4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_file` varchar(30) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `berkas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `kode_course`, `judul`, `nama_file`, `deskripsi`, `type`, `size`, `berkas`) VALUES
(12, 'WD001', 'PHP', 'Prak PW - Pertemuan 1.pdf', 'PHP', 'Materi', 4794256, '../materi/Prak PW - Pertemuan 1.pdf'),
(15, 'AI001', 'Struct', 'HO 16-Struct (1).pdf', 'Struct C', 'Materi', 673136, '../materi/HO 16-Struct (1).pdf'),
(21, 'BPL001', 'Rekursif', 'HO 12-Fungsi Rekursif (1).pdf', 'Belajar Rekursif dengan bahasa C', 'Materi', 693070, '../materi/HO 12-Fungsi Rekursif (1).pdf'),
(22, 'BPL001', 'Perulangan', 'HO 08-Struktur Perulangan.pdf', 'For, While, Do', 'Materi', 565720, '../materi/HO 08-Struktur Perulangan.pdf'),
(24, 'BPL001', 'Operator', 'HO 05-Operator.pdf', 'Operator dalam Bahasa Pemrograman C', 'Materi', 580456, '../materi/HO 05-Operator.pdf'),
(25, 'BWD001', 'PHP', 'PROWEB-10 (1).pdf', '', 'Materi', 411401, '../materi/PROWEB-10 (1).pdf'),
(28, 'BC001', 'Rekursif', 'HO 12-Fungsi Rekursif (1).pdf', 'AKU CINTA REKURSIF', 'Materi', 693070, '../materi/HO 12-Fungsi Rekursif (1).pdf'),
(31, 'IPC001', 'Rekursif', 'HO 12-Fungsi Rekursif (1).pdf', 'Rekursif C', 'Materi', 693070, '../materi/HO 12-Fungsi Rekursif (1).pdf'),
(32, 'IPC001', 'Struct', 'HO 16-Struct (1).pdf', 'Struct in C', 'Materi', 673136, '../materi/HO 16-Struct (1).pdf'),
(33, 'IPC001', 'Competitive Programming', 'pemrograman-kompetitif-dasar.p', 'Buku yang berisi materi pemrograman kompetitif', 'Materi', 1496250, '../materi/pemrograman-kompetitif-dasar.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `my_courses`
--

CREATE TABLE `my_courses` (
  `id_my_course` int(11) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `e_student` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_courses`
--

INSERT INTO `my_courses` (`id_my_course`, `kode_course`, `e_student`) VALUES
(22, 'IPC002', 'rahmatmaulanamiftah34@gmail.com'),
(28, 'BWD001', 'rapleswojtyla@gmail.com'),
(29, 'UIUX001', 'rapleswojtyla@gmail.com'),
(30, 'IPC001', 'rapleswojtyla@gmail.com'),
(31, 'AI001', 'rapleswojtyla@gmail.com'),
(32, 'BPL001', 'rapleswojtyla@gmail.com'),
(33, 'BWD001', 'rahmatmaulanamiftah34@gmail.com'),
(34, 'AI001', 'rahmatmaulanamiftah34@gmail.com'),
(35, 'BPL001', 'rahmatmaulanamiftah34@gmail.com'),
(36, 'IPC001', 'rahmatmaulanamiftah34@gmail.com'),
(43, 'AI001', 'ertrand865@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `kode_quiz` varchar(10) DEFAULT NULL,
  `no_soal` int(3) DEFAULT NULL,
  `soal` text NOT NULL,
  `opt1` varchar(100) NOT NULL,
  `opt2` varchar(100) NOT NULL,
  `opt3` varchar(100) NOT NULL,
  `opt4` varchar(100) NOT NULL,
  `jawaban` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_question`, `kode_course`, `kode_quiz`, `no_soal`, `soal`, `opt1`, `opt2`, `opt3`, `opt4`, `jawaban`) VALUES
(73, 'BPL001', 'QBPL01', 1, 'Soal nomor 1', 'jawabannya A', 'a', 'A', 'B', 'A'),
(74, 'BPL001', 'QBPL01', 2, 'Nomor 3', 'Salah', 'True', '!False', 'Benar', 'Salah'),
(75, 'BPL001', 'QBPL01', 3, 'Nomor 3', 'Jawabannya benar', 'benar', 'Benar', 'BENAR', 'benar'),
(79, 'AI001', 'QAI02', 1, 'Nomor 1??', 'False', '!False', '!True', '!1', '!False'),
(80, 'AI001', 'QAI02', 2, 'Soal nomor (1+1)?', 'True', '!True', 'False', '!1', 'True'),
(81, 'BPL001', 'Q02BPL001', 1, 'Apa itu &#39;what&#39;', 'Apa', 'Gak tau, males', 'Huh?', 'Iya', 'Apa'),
(86, 'BPL001', 'Q02BPL001', 2, 'aku', 'aku', 'dia', 'saya', 'qwerty', 'aku'),
(87, 'BPL001', 'Q02BPL001', 3, '3', '1', '2', '3', '4', '4'),
(100, 'BPL001', 'Q04BPL001', 1, 'Nomor 1', '11', '22', '13', '14', '11'),
(104, 'BPL001', 'Q04BPL001', 2, 'Nomor 2', '11', '22', '23', '32', '22'),
(105, 'BPL001', 'Q04BPL001', 3, 'Nomor 3', '11', '22', '34', '43', '43');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `kode_quiz` varchar(10) NOT NULL,
  `nama_quiz` varchar(20) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `jumlah_soal` int(3) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `kode_course`, `kode_quiz`, `nama_quiz`, `deskripsi`, `type`, `durasi`, `jumlah_soal`, `date_added`) VALUES
(13, 'BPL001', 'Q02BPL001', 'Quiz 2', 'Ini akan menjadi nilai tambah saat penilaian akhir', 'Quiz', 5, 3, '2023-12-22 07:02:49'),
(14, 'BPL001', 'Q04BPL001', 'Quiz 4', 'Q', 'Quiz', 5, 3, '2023-12-23 19:37:27'),
(11, 'AI001', 'QAI02', 'Apa itu AI', '', 'Quiz', 1, 2, '2023-11-29 02:53:10'),
(12, 'BPL001', 'QBPL01', 'Perulangan', 'Kuis Perulangan C', 'Quiz', 6, 3, '2023-12-20 16:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE `quiz_result` (
  `id_quiz_result` int(11) NOT NULL,
  `e_student` varchar(40) NOT NULL,
  `kode_course` varchar(10) NOT NULL,
  `kode_quiz` varchar(10) NOT NULL,
  `total_question` int(11) NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `wrong_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`id_quiz_result`, `e_student`, `kode_course`, `kode_quiz`, `total_question`, `correct_answer`, `wrong_answer`) VALUES
(128, 'rapleswojtyla@gmail.com', 'BPL001', 'QBPL01', 3, 2, 1),
(129, 'rapleswojtyla@gmail.com', 'BPL001', 'Q02BPL001', 3, 3, 0),
(131, 'rahmatmaulanamiftah34@gmail.com', 'BPL001', 'QBPL01', 3, 1, 2),
(132, 'rahmatmaulanamiftah34@gmail.com', 'BPL001', 'Q02BPL001', 3, 2, 1),
(134, 'rahmatmaulanamiftah34@gmail.com', 'BPL001', 'Q04BPL001', 3, 2, 1),
(135, 'rapleswojtyla@gmail.com', 'BPL001', 'Q04BPL001', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `e_pengirim` varchar(40) DEFAULT NULL,
  `e_penerima` varchar(40) DEFAULT NULL,
  `isi_request` varchar(255) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `nama_file1` varchar(40) DEFAULT NULL,
  `size1` int(11) DEFAULT NULL,
  `berkas1` text DEFAULT NULL,
  `nama_file2` varchar(40) DEFAULT NULL,
  `size2` int(11) DEFAULT NULL,
  `berkas2` text DEFAULT NULL,
  `nama_file3` varchar(40) DEFAULT NULL,
  `size3` int(11) DEFAULT NULL,
  `berkas3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `e_pengirim`, `e_penerima`, `isi_request`, `level`, `status`, `nama_file1`, `size1`, `berkas1`, `nama_file2`, `size2`, `berkas2`, `nama_file3`, `size3`, `berkas3`) VALUES
(1, 'fatimahazzahra0655@gmail.com', NULL, 'Mengubah Status Menjadi Teacher', 'Student', 'Disetujui', 'PANCASILA Dalam Konteks Sejarah.ppt', 1101312, '../request/PANCASILA Dalam Konteks Sejarah.ppt', '[Kuliah 11] Teks Ulasan Buku.pdf', 767188, '../request/[Kuliah 11] Teks Ulasan Buku.pdf', 'Id Card MKWK.pdf', 5517811, '../request/Id Card MKWK.pdf'),
(2, 'patrarwsinaga04@gmail.com', NULL, 'Intermediate Programming', 'Teacher', 'Disetujui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'fatimahazzahra0655@gmail.com', NULL, 'Basic C', 'Teacher', 'Belum Disetujui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'rapleswojtyla@gmail.com', NULL, 'Mengubah Status Menjadi Teacher', 'Student', 'Belum Disetujui', 'Id Card MKWK.odt', 6016774, '../request/Id Card MKWK.odt', 'SURAT PERNYATAAN KIP KULIAH 2023 1 (1).p', 103816, '../request/SURAT PERNYATAAN KIP KULIAH 2023 1 (1).', 'refleksi bahasa indonesia.pdf', 440165, '../request/refleksi bahasa indonesia.pdf'),
(5, 'patrarwsinaga04@gmail.com', NULL, 'Intermediate Programming C', 'Teacher', 'Disetujui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'rapleswojtyla@gmail.com', 'skillvortex4@gmail.com', 'Mengubah Status Menjadi Teacher', 'Student', 'Belum Disetujui', 'KELOMPOK TUBES KOM A 2022 (1).pdf', 118522, '../request/KELOMPOK TUBES KOM A 2022 (1).pdf', 'QUIZ 2 PROWEB 2022 (1).pdf', 527648, '../request/QUIZ 2 PROWEB 2022 (1).pdf', 'KELOMPOK TUBES KOM A 2022 (1).pdf', 118522, '../request/KELOMPOK TUBES KOM A 2022 (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `service_center`
--

CREATE TABLE `service_center` (
  `id_service` int(11) NOT NULL,
  `e_pengirim` varchar(40) DEFAULT NULL,
  `isi_pesan` varchar(255) DEFAULT NULL,
  `e_penerima` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_center`
--

INSERT INTO `service_center` (`id_service`, `e_pengirim`, `isi_pesan`, `e_penerima`) VALUES
(254, 'ertrand865@gmail.com', 'Hi min, saya user baru', 'skillvortex4@gmail.com'),
(255, 'skillvortex4@gmail.com', 'Oh hi', 'ertrand865@gmail.com'),
(256, 'rapleswojtyla@gmail.com', 'Halo min, saya user baru', 'skillvortex4@gmail.com'),
(257, 'patrarwsinaga04@gmail.com', 'Heyyo', 'skillvortex4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `submit_tugas`
--

CREATE TABLE `submit_tugas` (
  `id_submit` int(11) NOT NULL,
  `kode_tugas` varchar(10) DEFAULT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `nama_file` varchar(40) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `berkas` text DEFAULT NULL,
  `date_submitted` datetime DEFAULT NULL,
  `status` varchar(12) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `nilai` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_tugas`
--

INSERT INTO `submit_tugas` (`id_submit`, `kode_tugas`, `kode_course`, `email`, `nama_file`, `size`, `berkas`, `date_submitted`, `status`, `keterangan`, `nilai`) VALUES
(49, 'TBPL01', 'BPL001', 'rapleswojtyla@gmail.com', 'Bukti Kehadiran MKWK Umum Hari Senin - S', 274895, '../tugas_submit/Bukti Kehadiran MKWK Umum Hari Senin - Selasa.pdf', '2023-12-22 12:58:31', 'late', 'Assignment was submitted 0 days 0 hours 58 mins 31 secs late', 95),
(52, 'TBPL02', 'BPL001', 'rapleswojtyla@gmail.com', 'Definisi-Sistem-Basis-Data.pptx', 10236649, '../tugas_submit/Definisi-Sistem-Basis-Data.pptx', '2023-12-22 13:04:55', 'early', 'Assignment was submitted 0 days 0 hours 55 mins 5 secs early', 0),
(53, 'TBPL04', 'BPL001', 'rapleswojtyla@gmail.com', '231402052 - Patra Rafles Wostyla Sinaga.', 62149, '../tugas_submit/231402052 - Patra Rafles Wostyla Sinaga.pdf', '2023-12-24 03:49:24', 'early', 'Assignment was submitted 0 days 6 hours 40 mins 36 secs early', 100),
(54, 'TBPL01', 'BPL001', 'rahmatmaulanamiftah34@gmail.com', 'Challenge-A1-1-Patra Rafles Wostyla Sina', 808890, '../tugas_submit/Challenge-A1-1-Patra Rafles Wostyla Sinaga-231402052-(01).pdf', '2023-12-24 03:52:11', 'late', 'Assignment was submitted 1 days 15 hours 52 mins 11 secs late', 90),
(55, 'TBPL02', 'BPL001', 'rahmatmaulanamiftah34@gmail.com', 'Tugas Matematika - Patra Rafles Wostyla ', 6536409, '../tugas_submit/Tugas Matematika - Patra Rafles Wostyla Sinaga - 231402052.pdf', '2023-12-24 03:53:09', 'late', 'Assignment was submitted 1 days 13 hours 53 mins 9 secs late', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) DEFAULT NULL,
  `kode_tugas` varchar(10) NOT NULL,
  `kode_course` varchar(10) DEFAULT NULL,
  `nama_tugas` varchar(100) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `nama_file` varchar(12) DEFAULT NULL,
  `size` int(12) DEFAULT NULL,
  `berkas` text DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_collected` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `kode_tugas`, `kode_course`, `nama_tugas`, `deskripsi`, `nama_file`, `size`, `berkas`, `date_added`, `date_collected`) VALUES
(6, 'TAI01', 'AI001', 'Pengenalan AI', 'Apa saja yang kamu ketahui tentang AI', 'FINAL PROJEC', 167580, '../tugas/FINAL PROJECT 2022 (1).pdf', '2023-12-07 19:14:46', '2023-12-07 19:18:40'),
(8, 'TBPL01', 'BPL001', 'Tugas 1', 'Kerjakan soal yang ada pada file tersebut', 'Tugas Pemrog', 49620, '../tugas/Tugas Pemrograman 2 (1).pdf', '2023-12-21 00:58:35', '2023-12-22 12:00:00'),
(9, 'TBPL02', 'BPL001', 'Tugas 2', 'Kerjakan soalnya', 'Tugas Pemrog', 28080, '../tugas/Tugas Pemrograman 4 (2).pdf', '2023-12-21 00:59:28', '2023-12-22 14:00:00'),
(10, 'TBPL03', 'BPL001', 'Tugas Pemrograman', 'Kerjakanlah soal yang ada pada file pdf berikut', 'Soal Pemrogr', 56032, '../tugas/Soal Pemrograman 6 (2).pdf', '2023-12-21 01:00:30', '2023-12-22 10:00:00'),
(11, 'TBPL04', 'BPL001', 'Tugas 4', 'Buatlah sebuah program apa aja yang dengan metode rekursif ', '', 0, '', '2023-12-22 13:32:59', '2023-12-24 10:30:00'),
(7, 'TIPL01', 'IPC001', 'OOP', 'Apa itu OOP', 'HO 01-Mengen', 798843, '../tugas/HO 01-Mengenal Dunia Pemrograman (1).pdf', '2023-12-07 19:15:40', '2023-12-07 19:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama_lengkap` varchar(40) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `nama_lengkap`, `email`, `password`, `level`, `status`) VALUES
(7, 'Alfi Ok', 'Alfi Syahrin', 'alfioke7@gmail.com', '$2y$10$dmCjB1eY.llNKZHUOroK/OK7n5XRmhZe2MsIOh.4Xn0LjYyHkF57m', 2, NULL),
(10, 'rand', 'Random12', 'ertrand865@gmail.com', '$2y$10$4vkNdz6CnhvttK1T16MPP.FRFLFT.X3.g2Gr.VtKMqKK1jKYFpqny', 3, NULL),
(9, 'Jarr jarra', 'Fatimah', 'fatimahazzahra0655@gmail.com', '$2y$10$XqJ9393InS1het/Q83e8ouCR2gDpL7CLMEEd9xi7yf7SbukIIZnz2', 2, NULL),
(6, 'Mayad1', 'Mayadi', 'mayadisilalahi@gmail.com', '$2y$10$gLc.QTnIUq28Ekbf/nxayOEIcxPjwFXyZ4kHn.1J7vOH5bn6672Au', 3, NULL),
(2, 'Wojtyla Karma', 'Patra Rafles Wostyla Sinaga', 'patrarwsinaga04@gmail.com', '$2y$10$ekmREwvAWiwpJNsXN50X1O4MnemMQ1.Ozalny5DMl1y1dj/l6ZZfG', 2, NULL),
(12, 'Raples_Wojtyla', 'Wostyla', 'patrrwsinaga@gmail.com', '$2y$10$PQwkBZxNiKwhId1AXejGNufyi9TE.IkqX5V2QGfWrT.QyxDEdnEVu', 3, NULL),
(4, 'Rahmat Visual', 'Rahmat Maulana Miftah', 'rahmatmaulanamiftah34@gmail.com', '$2y$10$nuv0pOKmIhdGLUQbHU/vyu60UlI06DbuQFcWCacryS2hjqa1Y2yBC', 3, NULL),
(8, 'Rahmat VisualS', 'Rahmat S', 'rahmatv@gmail.com', '$2y$10$HMxclWh8N7iJzQzFkh7IAObVQqMQ5onwqLuQQxA61li8IVV0yXlWS', 2, NULL),
(3, 'Wojtyla', 'Raples Wojtyla', 'rapleswojtyla@gmail.com', '$2y$10$vLBLJJ24.n/aGAMK0uGBquh4fgiXvksmBOdQiJkaT5LG8e6rzP3JW', 3, NULL),
(11, 'SkillVortex', 'Skill Vortex', 'skillvortex4@gmail.com', '$2y$10$SMUKQShwNwUHWiJ3tHyXXuihc4Frjn.VXYHviWmEZmsvzbZPeGN3e', 1, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_courses_student`
-- (See below for the actual view)
--
CREATE TABLE `vw_courses_student` (
`id_my_course` int(11)
,`kode_course` varchar(10)
,`judul_course` varchar(40)
,`e_student` varchar(40)
,`username_student` varchar(30)
,`nama_student` varchar(40)
,`e_teacher` varchar(40)
,`username_teacher` varchar(30)
,`nama_teacher` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_courses_teacher`
-- (See below for the actual view)
--
CREATE TABLE `vw_courses_teacher` (
`id_course` int(11)
,`kode_course` varchar(10)
,`judul_course` varchar(40)
,`deskripsi` varchar(100)
,`e_teacher` varchar(40)
,`username` varchar(30)
,`nama_lengkap` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_feedback`
-- (See below for the actual view)
--
CREATE TABLE `vw_feedback` (
`id_feedback` int(11)
,`e_pengirim` varchar(40)
,`isi_pesan` varchar(255)
,`e_penerima` varchar(40)
,`nama_pengirim` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_my_courses`
-- (See below for the actual view)
--
CREATE TABLE `vw_my_courses` (
`id_my_course` int(11)
,`kode_course` varchar(10)
,`judul_course` varchar(40)
,`e_student` varchar(40)
,`username` varchar(30)
,`nama_lengkap` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_quiz_result`
-- (See below for the actual view)
--
CREATE TABLE `vw_quiz_result` (
`id_quiz_result` int(11)
,`e_student` varchar(40)
,`username` varchar(30)
,`nama_lengkap` varchar(40)
,`kode_course` varchar(10)
,`judul_course` varchar(40)
,`kode_quiz` varchar(10)
,`nama_quiz` varchar(20)
,`total_question` int(11)
,`correct_answer` int(11)
,`wrong_answer` int(11)
,`nilai` decimal(17,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_service_center`
-- (See below for the actual view)
--
CREATE TABLE `vw_service_center` (
`id_service` int(11)
,`e_pengirim` varchar(40)
,`isi_pesan` varchar(255)
,`e_penerima` varchar(40)
,`nama_pengirim` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_tugas`
-- (See below for the actual view)
--
CREATE TABLE `vw_tugas` (
`id_submit` int(11)
,`kode_tugas` varchar(10)
,`nama_tugas` varchar(100)
,`date_added` datetime
,`date_collected` datetime
,`date_submitted` datetime
,`kode_course` varchar(10)
,`judul_course` varchar(40)
,`email` varchar(40)
,`nama_lengkap` varchar(40)
,`nama_file` varchar(40)
,`size` int(11)
,`berkas` text
,`status` varchar(12)
,`keterangan` varchar(100)
,`nilai` int(3)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_courses_student`
--
DROP TABLE IF EXISTS `vw_courses_student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_courses_student`  AS SELECT `vw_my_courses`.`id_my_course` AS `id_my_course`, `vw_my_courses`.`kode_course` AS `kode_course`, `vw_my_courses`.`judul_course` AS `judul_course`, `vw_my_courses`.`e_student` AS `e_student`, `vw_my_courses`.`username` AS `username_student`, `vw_my_courses`.`nama_lengkap` AS `nama_student`, `vw_courses_teacher`.`e_teacher` AS `e_teacher`, `vw_courses_teacher`.`username` AS `username_teacher`, `vw_courses_teacher`.`nama_lengkap` AS `nama_teacher` FROM (`vw_my_courses` join `vw_courses_teacher` on(`vw_my_courses`.`kode_course` = `vw_courses_teacher`.`kode_course`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_courses_teacher`
--
DROP TABLE IF EXISTS `vw_courses_teacher`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_courses_teacher`  AS SELECT `courses`.`id_course` AS `id_course`, `courses`.`kode_course` AS `kode_course`, `courses`.`judul_course` AS `judul_course`, `courses`.`deskripsi` AS `deskripsi`, `courses`.`e_teacher` AS `e_teacher`, `users`.`username` AS `username`, `users`.`nama_lengkap` AS `nama_lengkap` FROM (`courses` join `users` on(`courses`.`e_teacher` = `users`.`email`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_feedback`
--
DROP TABLE IF EXISTS `vw_feedback`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_feedback`  AS SELECT `feedback`.`id_feedback` AS `id_feedback`, `feedback`.`e_pengirim` AS `e_pengirim`, `feedback`.`isi_pesan` AS `isi_pesan`, `feedback`.`e_penerima` AS `e_penerima`, `users`.`nama_lengkap` AS `nama_pengirim` FROM (`feedback` join `users` on(`feedback`.`e_pengirim` = `users`.`email`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_my_courses`
--
DROP TABLE IF EXISTS `vw_my_courses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_my_courses`  AS SELECT `my_courses`.`id_my_course` AS `id_my_course`, `my_courses`.`kode_course` AS `kode_course`, `courses`.`judul_course` AS `judul_course`, `my_courses`.`e_student` AS `e_student`, `users`.`username` AS `username`, `users`.`nama_lengkap` AS `nama_lengkap` FROM ((`my_courses` join `users` on(`my_courses`.`e_student` = `users`.`email`)) join `courses` on(`my_courses`.`kode_course` = `courses`.`kode_course`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_quiz_result`
--
DROP TABLE IF EXISTS `vw_quiz_result`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_quiz_result`  AS SELECT `quiz_result`.`id_quiz_result` AS `id_quiz_result`, `quiz_result`.`e_student` AS `e_student`, `users`.`username` AS `username`, `users`.`nama_lengkap` AS `nama_lengkap`, `quiz_result`.`kode_course` AS `kode_course`, `courses`.`judul_course` AS `judul_course`, `quiz_result`.`kode_quiz` AS `kode_quiz`, `quiz`.`nama_quiz` AS `nama_quiz`, `quiz_result`.`total_question` AS `total_question`, `quiz_result`.`correct_answer` AS `correct_answer`, `quiz_result`.`wrong_answer` AS `wrong_answer`, `quiz_result`.`correct_answer`/ `quiz_result`.`total_question` * 100 AS `nilai` FROM (((`quiz_result` join `users` on(`users`.`email` = `quiz_result`.`e_student`)) join `courses` on(`courses`.`kode_course` = `quiz_result`.`kode_course`)) join `quiz` on(`quiz`.`kode_quiz` = `quiz_result`.`kode_quiz`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_service_center`
--
DROP TABLE IF EXISTS `vw_service_center`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_service_center`  AS SELECT `service_center`.`id_service` AS `id_service`, `service_center`.`e_pengirim` AS `e_pengirim`, `service_center`.`isi_pesan` AS `isi_pesan`, `service_center`.`e_penerima` AS `e_penerima`, `users`.`nama_lengkap` AS `nama_pengirim` FROM (`service_center` join `users` on(`service_center`.`e_pengirim` = `users`.`email`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_tugas`
--
DROP TABLE IF EXISTS `vw_tugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_tugas`  AS SELECT `submit_tugas`.`id_submit` AS `id_submit`, `submit_tugas`.`kode_tugas` AS `kode_tugas`, `tugas`.`nama_tugas` AS `nama_tugas`, `tugas`.`date_added` AS `date_added`, `tugas`.`date_collected` AS `date_collected`, `submit_tugas`.`date_submitted` AS `date_submitted`, `submit_tugas`.`kode_course` AS `kode_course`, `courses`.`judul_course` AS `judul_course`, `submit_tugas`.`email` AS `email`, `users`.`nama_lengkap` AS `nama_lengkap`, `submit_tugas`.`nama_file` AS `nama_file`, `submit_tugas`.`size` AS `size`, `submit_tugas`.`berkas` AS `berkas`, `submit_tugas`.`status` AS `status`, `submit_tugas`.`keterangan` AS `keterangan`, `submit_tugas`.`nilai` AS `nilai` FROM (((`submit_tugas` join `tugas` on(`submit_tugas`.`kode_tugas` = `tugas`.`kode_tugas`)) join `courses` on(`submit_tugas`.`kode_course` = `courses`.`kode_course`)) join `users` on(`submit_tugas`.`email` = `users`.`email`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`kode_course`),
  ADD KEY `e_teacher` (`e_teacher`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `e_student` (`e_student`),
  ADD KEY `e_teacher` (`e_teacher`),
  ADD KEY `kode_course` (`kode_course`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `e_pengirim` (`e_pengirim`),
  ADD KEY `e_penerima` (`e_penerima`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `kode_course` (`kode_course`);

--
-- Indexes for table `my_courses`
--
ALTER TABLE `my_courses`
  ADD PRIMARY KEY (`id_my_course`),
  ADD KEY `e_student` (`e_student`),
  ADD KEY `kode_course` (`kode_course`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `kode_course` (`kode_course`),
  ADD KEY `kode_quiz` (`kode_quiz`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`kode_quiz`),
  ADD KEY `kode_course` (`kode_course`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`id_quiz_result`),
  ADD KEY `kode_course` (`kode_course`),
  ADD KEY `e_student` (`e_student`),
  ADD KEY `kode_quiz` (`kode_quiz`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `e_pengirim` (`e_pengirim`),
  ADD KEY `e_penerima` (`e_penerima`);

--
-- Indexes for table `service_center`
--
ALTER TABLE `service_center`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `e_pengirim` (`e_pengirim`),
  ADD KEY `e_penerima` (`e_penerima`);

--
-- Indexes for table `submit_tugas`
--
ALTER TABLE `submit_tugas`
  ADD PRIMARY KEY (`id_submit`),
  ADD KEY `email` (`email`),
  ADD KEY `kode_course` (`kode_course`),
  ADD KEY `kode_tugas` (`kode_tugas`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`kode_tugas`),
  ADD KEY `kode_course` (`kode_course`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `my_courses`
--
ALTER TABLE `my_courses`
  MODIFY `id_my_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
  MODIFY `id_quiz_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_center`
--
ALTER TABLE `service_center`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `submit_tugas`
--
ALTER TABLE `submit_tugas`
  MODIFY `id_submit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`e_pengirim`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`e_penerima`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`e_pengirim`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`e_penerima`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `service_center`
--
ALTER TABLE `service_center`
  ADD CONSTRAINT `service_center_ibfk_1` FOREIGN KEY (`e_pengirim`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `service_center_ibfk_2` FOREIGN KEY (`e_penerima`) REFERENCES `users` (`email`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`kode_course`) REFERENCES `courses` (`kode_course`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
