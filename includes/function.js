function sendMail() {
    const email = document.getElementById('email').value
    const path = document.getElementById('path').value

    let objectData = {
        email: email,
        path: path
    }
    
    let formData = new URLSearchParams()
    for (let key in objectData)
        formData.append(key, objectData[key])
    
    fetch('../authentication/sendMail.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
    })

    if (path == 'register' || path == 'forgot_password')
        alert("Kode Verifikasi telah terkirim, harap cek folder spam.")
    else
        alert("Email telah terkirim!")
}

function showPassword(z = 1)
{
    if (z == 1)
    {
        let x = document.getElementById('password');
        if (x.type === "password")
        {
            x.type = "text"
        }
        else
        {
            x.type = "password"
        }
    }
    else if (z == 2)
    {
        let x = document.getElementById('password2');
        if (x.type === "password")
        {
            x.type = "text"
        }
        else
        {
            x.type = "password"
        }
    }   
}