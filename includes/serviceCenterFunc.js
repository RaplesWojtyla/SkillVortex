function loadChat(email)
{
    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById('chat').innerHTML = this.responseText
        }
    }

    xmlhttp.open("GET", `../ajax/service_center.php?email=${email}`)
    xmlhttp.send()
}


function sendMessage()
{
    let isi_pesan = document.getElementById('isi_msg').value
    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            
        }
    }

    xmlhttp.open("GET", `../ajax/send_message.php?message=${isi_pesan}`)
    xmlhttp.send()
}