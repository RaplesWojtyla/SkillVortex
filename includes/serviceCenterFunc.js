let updated = 0

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

    xmlhttp.open("GET", `../ajax/load_chat.php?email=${email}`)
    xmlhttp.send()
}


function sendMessage()
{
    let isiPesan = document.getElementById('isi_msg').value
    let e_pengirim = document.getElementById('email_pengirim').value

    let xmlhttp = new XMLHttpRequest()
    
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById('isi_msg').value = ""

            updated = 1
            loadChat(e_pengirim)
        }
    }

    xmlhttp.open("GET", `../ajax/send_message.php?message=${isiPesan}`)
    xmlhttp.send()
}