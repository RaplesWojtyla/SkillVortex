function sendEmail(idEmail, idPath, idButton)
{
    const button = document.getElementById(idButton)

    if (!button.disabled)
    {
        handleEmailSubmission(idEmail, idPath)

        disableButton(idButton)

        setTimeout(() => {
            enableButton(idButton)
        }, 30000)   
    }
}

function disableButton(idButton)
{
    const button = document.getElementById(idButton)
    button.disabled = true
}

function enableButton(idButton)
{
    const button = document.getElementById(idButton)
    button.disabled = false
}

function handleEmailSubmission(idEmail, idPath) {
    const email = document.getElementById(idEmail).value
    const path = document.getElementById(idPath).value

    let objectData = {
        email: email,
        path: path
    }
    
    let formData = new URLSearchParams()
    for (let key in objectData)
        formData.append(key, objectData[key])
    
    fetch('../fetchApi/sendMail.php', {
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