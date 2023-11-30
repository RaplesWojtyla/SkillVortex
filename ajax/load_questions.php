<?php
    require '../includes/function.php';

    $no_soal = $_GET['no_soal'];
    $user_ans = '';

    if (isset($_SESSION['answer'][$no_soal]))
    {
        $user_ans = $_SESSION['answer'][$no_soal];
    }

    $res = query("SELECT * FROM questions WHERE kode_quiz = '$_SESSION[kode_quiz]' AND kode_course = '$_SESSION[kode_course]' AND no_soal = '$no_soal'");
    $rows = mysqli_num_rows($res);
    if ($rows == 0)
    {
        echo "done";
    }
    else
    {
        while ($row = mysqli_fetch_assoc($res))
        {
            $nomor_soal = $row['no_soal'];
            $soal = $row['soal'];
            for ($i  = 0; $i < 4; $i++)
            {
                $opt[$i] = $row['opt' . $i + 1];
            }
            $jawaban = $row['jawaban'];
        }
?>

<table style="margin-top: 20px;">
    <tr>
        <td style="font-size: 1.1rem;"><span style="margin-right: 10px;"><b>(<?=$nomor_soal?>)</b></span> <?=$soal?></td>
    </tr>
    <?php
        for($i = 0; $i < 4; $i++) {
    ?>
    <tr style="margin-left: 30px;">
        <td style="font-size: 1.1rem;">
            <input style="margin-left: 35px;" type="radio" name="opt" value="<?=$opt[$i]?>" onclick="selectOption(<?=$nomor_soal?>, this.value)"
            <?php 
                if ($user_ans == $opt[$i])
                {
                    echo "checked";
                }
            ?>>
            <span style="margin-left: 5px;"><?=$opt[$i]?></span>
        </td>
    <tr>
    <?php } ?>
</table>

<?php } ?>