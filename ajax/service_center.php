<?php
    require '../includes/function.php';

    if (!empty($_GET['email']))
    {
        $_SESSION['e_pengirim'] = $_GET['email'];
    }

    if (!empty($_SESSION['e_pengirim']))
    {
        $res = query("SELECT nama_lengkap FROM users WHERE email = '$_SESSION[e_pengirim]'");
        $nama_lengkap = mysqli_fetch_assoc($res)['nama_lengkap'];
    }

?>
<div class="card-header">
    <div class="media d-flex align-items-center">
        <div class="avatar me-3">
            <img src="../dist/assets/compiled/jpg/2.jpg" alt="" srcset="">
            <span class="avatar-status bg-success"></span>
        </div>
        <div class="name flex-grow-1">
            <h6 class="mb-0"><?=$nama_lengkap?></h6>
            <span class="text-xs">Online</span>
        </div>
        <button class="btn btn-sm">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
<div class="card-body pt-4 bg-grey" id="card-body2">
    <?php
        if (isset($_SESSION['e_pengirim']))
        {
            $res2 = query("SELECT * FROM service_center WHERE (e_penerima ='$_SESSION[e_pengirim]' AND e_pengirim ='$_SESSION[email]') OR (e_pengirim ='$_SESSION[e_pengirim]' AND e_penerima ='$_SESSION[email]') ");

            foreach($res2 as $data)
            {
    ?>
    <div class="chat-content">
        <?php 
            if ($data['e_pengirim'] == $_SESSION['e_pengirim'] )
            {
        ?>
                <div class="chat chat-left">
                    <div class="chat-body">
                        <div class="chat-message"><?= $data['isi_pesan'] ?></div>
                        <div id="email_pengirim" hidden><?= $_SESSION['e_pengirim'] ?></div>
                    </div>
                </div>
                
        <?php } else { ?>
                <div class="chat">
                    <div class="chat-body">
                        <div class="chat-message"><?= $data['isi_pesan'] ?></div>
                    </div>
                </div>
        <?php }?> <!-- End of Else -->
    </div>

    <?php }}?> <!-- End of if (isset($_SESSION['e_pengirim'])) and end of foreach -->
</div>
<div class="card-footer">
    <div class="message-form d-flex flex-direction-column align-items-center">
        <div class="d-flex flex-grow-1 ms-4">
            <input id="isi_msg" type="text" class="form-control" placeholder="Type your message..">
            <button type="button" onclick="sendMessage()" style="margin-left: 20px;" class="btn btn-primary"><i class="bi bi-send"></i></button>
        </div>
    </div>
    <?php
        if (isset($_POST['sendMsg']))
        {
            echo "
                <script>
                    alert('sdfvg')
                </script>
            ";
            $e_pengirim = $_SESSION['email'];
            $isi_pesan = $_POST['isi_msg'];
            $e_penerima = $_SESSION['e_pengirim'];
            
        }
    ?>
</div>

<script src="../includes/serviceCenterFunc.js"></script>