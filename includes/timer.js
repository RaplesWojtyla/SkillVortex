setInterval(function ()
{
    timer()
}, 1000)

function timer()
{
    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            if (this.responseText == "00:00:00")
            {
                window.location = "../students/materi.php"
            }
            else
            {
                document.getElementById('timer').innerHTML = this.responseText
            }
        }
    }

    xmlhttp.open("GET", "../ajax/timer.php")
    xmlhttp.send()
}