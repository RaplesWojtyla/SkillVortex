function setTimer()
{
    let xmlhttp = new XMLHttpRequest()
    
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            window.location = "../ajax/set_timer.php"
        }
    }

    xmlhttp.open("GET", "../ajax/set_timer.php")
    xmlhttp.send()
}

let nomor_soal = 1
loadQuestion(nomor_soal)

function loadQuestion(noSoal)
{
    let xmlhttp = new XMLHttpRequest()
    
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            if (this.responseText == "done")
            {
                window.location = "../students/quiz_result.php"
            }
            else
            {
                document.getElementById('current_question_num').innerHTML = nomor_soal
                document.getElementById('load_question').innerHTML = this.responseText
            }
        }
    }

    xmlhttp.open("GET", `../ajax/load_questions.php?no_soal=${noSoal}`)
    xmlhttp.send()
}

function selectOption(noSoal, value)
{
    let xmlhttp = new XMLHttpRequest()

    xmlhttp.open("GET", `../ajax/save_answer.php?value=${value}&noSoal=${noSoal}`)
    xmlhttp.send()
}

function previous_question()
{
    if (nomor_soal == 1)
    {
        loadQuestion(nomor_soal)
    }
    else
    {
        nomor_soal -= 1;
        document.getElementById('nextbtn').value = "Next"
        loadQuestion(nomor_soal)
    }
}

function next_question(totalSoal)
{   
    if (nomor_soal == totalSoal)
    {
        if (confirm("Apakah anda yakin sudah menjawab semua soal yang ada dengan benar, dan ingin mengakhiri quiz saat ini?"))
        {
            window.location = "../students/quiz_result.php"
        }
    }
    else
    {
        nomor_soal += 1;
        if (nomor_soal == totalSoal)
        {
            document.getElementById('nextbtn').value = "Selesai"
        }
        
        loadQuestion(nomor_soal)
    }
}