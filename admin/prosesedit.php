<?php
    require '../includes/function.php';

    if (isset($_POST['updatebtn']))
    {
        $userID = $_POST['id'];
        $fullname = $_POST['namaLengkap'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userLevel = $_POST['user_level'];

        $sql = query("UPDATE users SET username = '$username', nama_lengkap = '$fullname', email = '$email', password = '$password' WHERE id_users = '$userID'");
        if ($sql)
        {
            if ($userLevel == 2)
            {
                echo"
                    <script>
                        alert('Data berhasil diubah')
                        window.location = './data_teachers.php'
                    </script>
                ";
            }
            else 
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

?>