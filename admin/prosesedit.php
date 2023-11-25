<?php
    require '../includes/function.php';

    $user_level = $_POST['user_level'];
    
    if (isset($_POST['updatebtn']))
    {
        $userID = $_POST['id'];
        $fullname = $_POST['namaLengkap'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = query("UPDATE users SET username = '$username', nama_lengkap = '$fullname', email = '$email', password = '$password' WHERE id_users = '$userID'");
        if ($sql)
        {
            if ($user_level == 2)
            {
                echo"
                    <script>
                        alert('Data berhasil diubah')
                        window.location = './data_teachers.php'
                    </script>
                ";
            }
            else if ($user_level == 3)
            {
                echo"
                    <script>
                        alert('Data berhasil diubah')
                        window.location = './data_students.php'
                    </script>
                ";
            }
        }
    }
    else if (isset($_POST['cancelbtn']))
    {
        if ($user_level == 2)
        {
            header("Location: ./data_teachers.php");
        }
        else if ($user_level == 3)
        {
            header("Location: ./data_students.php");
        }
    }

?>