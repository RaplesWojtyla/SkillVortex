<?php
    require '../includes/function.php';

    if (empty($_SESSION['username']) or $_SESSION['banned'] == 'Banned' or $_SESSION['status'] != 'Student')
    {
        header("Location: ./error-403.php");
    }

    $correct_answer = 0;
    $wrong_answer = 0;
    
    // Untuk menghindari input data ganda saat halaman web direfresh
    $sql = query("SELECT * FROM quiz_result WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]' AND e_student = '$_SESSION[email]'");
    if (mysqli_num_rows($sql) < 1)
    {

        $res = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]'");
        $rows = mysqli_num_rows($res);

        $i = 0;
        while($data = mysqli_fetch_assoc($res))
        {
            $answer[$i] = $data['jawaban'];
            $i++;
        }

        for ($j = 1; $j <= $_SESSION['jumlah_soal']; $j++)
        {
            if (isset($_SESSION['answer'][$j]))
            {
                if ($answer[$j-1] == $_SESSION['answer'][$j])
                {
                    $correct_answer++;
                }
                else
                {
                    $wrong_answer++;
                }
            }
            else
            {
                $wrong_answer++;
            }
        }

        // Kalau laman web direfresh, total jawaban yang benar dan salah tidak menjadi 0
        $_SESSION['score'] = ($correct_answer / $_SESSION['jumlah_soal']) * 100;

        $dataArr = array(
            'email' => $_SESSION['email'],
            'kode_course' => $_SESSION['kode_course'],
            'kode_quiz' => $_SESSION['kode_quiz'],
            'total_questions' => $_SESSION['jumlah_soal'],
            'correct_answer' => $correct_answer,
            'wrong_answer' => $wrong_answer
        );

        insertQuizResult($dataArr);
        unset($_SESSION['answer']); // Untuk menghindari bug di mana saat mulai menjawab quiz, ada momen di mana jawaban sudah terjawab. Ini biasanya terjadi ketika kita baru selesai mengerjakan satu quiz, dan lanjut mengerjakan quiz lainnya
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - Skill Vortex</title>

    <?php include("../includes/logo.php"); ?>

    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/iconly.css">
</head>

<body>
    <script src="../dist/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php include("navbar.php"); ?>
            </header>
            <div class="content-wrapper container">
                <div class="page-heading">

                    <section id="multiple-column-form ">
                        <div style="min-height: 65vh;" class="row match-height d-flex justify-content-center align-items-center">
                            <div class="col-5">
                                <div class="card" style="padding: 40px 10px;">
                                    <div class="card-header">
                                        <h2 class="card-title text-center">
                                            Quiz Result
                                        </h2>
                                        <h3 class="card-title text-center">
                                            <?=$_SESSION['nama_quiz']?>
                                        </h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <input type="number" id="score" value="<?=$_SESSION['score']?>" hidden>
                                            <div id="radialGradient"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 10px;">
                                            <a href="./materi.php" class="btn btn-primary" style="margin-right: 15px;">Course</a>
                                            <a href="./single_quiz_scoreboard.php" class="btn btn-primary">Scoreboard</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="../includes/quizFunction.js"></script>

    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../dist/assets/compiled/js/app.js"></script>
    <script src="../dist/assets/static/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let score = parseInt(document.getElementById('score').value)
        var radialGradientOptions = {
        series: [score],
        chart: {
          height: 300,
          type: "radialBar",
          toolbar: {
            show: true,
          },
        },
        plotOptions: {
          radialBar: {
            startAngle: 0,
            endAngle: 360,
            hollow: {
              margin: 0,
              size: "70%",
              background: "#fff",
              image: undefined,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: "front",
              dropShadow: {
                enabled: true,
                top: 3,
                left: 0,
                blur: 4,
                opacity: 0.24,
              },
            },
            track: {
              background: "#fff",
              strokeWidth: "67%",
              margin: 0, // margin is in pixels
              dropShadow: {
                enabled: true,
                top: -3,
                left: 0,
                blur: 4,
                opacity: 0.35,
              },
            },
      
            dataLabels: {
              show: true,
              name: {
                offsetY: -10,
                show: true,
                color: "#888",
                fontSize: "17px",
              },
              value: {
                formatter: function (val) {
                  return parseInt(val)
                },
                color: "#111",
                fontSize: "36px",
                show: true,
              },
            },
          },
        },
        fill: {
          type: "gradient",
          gradient: {
            shade: "dark",
            type: "horizontal",
            shadeIntensity: 0.5,
            gradientToColors: ["#ABE5A1"],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100],
          },
        },
        stroke: {
          lineCap: "round",
        },
        labels: ["Score"],
    }

    var radialGradient = new ApexCharts(document.querySelector("#radialGradient"), radialGradientOptions)
    radialGradient.render()

    </script>

</body>

</html>