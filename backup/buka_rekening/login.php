<?php
session_start();

if ( isset($_SESSION["login"]) ) {
    header("Location: buka-rekening.php");
    exit; 
}


require '../assets/functions/function.php';
global $conn;
if( isset($_POST["login"]) ) {

    // $divisi = "Kearsipan";
    $nis = $_POST["nis"];
    $password = $_POST["password1"];

    $result = mysqli_query($conn, "SELECT * FROM teller WHERE nis = '$nis'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // ambil data berdasarkan username
        $data = mysqli_fetch_assoc($result);

        // session profile
        $_SESSION["id_teller"] = $data['id_teller'];
        $_SESSION["nama"] = $data['nama'];
        $_SESSION["nis"] = $data['nis'];
        $_SESSION["kelas"] = $data['kelas'];
        $_SESSION["foto"] = $data['foto'];

        // cek password dan divisi
        if( password_verify($password, $data["password"])) {

            $_SESSION["login"] = true;

            header("Location: buka-rekening.php");
            exit;

            // echo "<script>
            //         alert('Login Berhasil!');
            //         document.location.href = 'tabel-nomorsurat.php';
            //     </script>";
            // } else {
            //     echo "<script>
            //         document.location.href = 'login.php';
            //     </script>"; 

            }
    }

    $error = true;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="assets/css/semudah.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login BMT12.php</title>
</head>
<body>
    <a href="../index.php">
        <span class="iconify btn-back" data-icon="bi:arrow-left" data-inline="false"></span>
    </a>

    <div class="container">
        <div class="logo">
            <img src="../assets/image/logo12.png" alt="">
        </div>

        <h1 class="tittle">BUKA REKENING BMT</h1>
        <form action="" method="post">
            <div class="form-group">

                <label for="username">nis</label> 
                <div class="input">
                    <input type="text" name="nis" id="nis" required>
                </div>

                <label for="password1">Password</label> 
                <div class="input-pw">
                    <input type="password" name="password1" id="password1" required>
                    <span id="btn-showhide1" onclick="change1()">
                        <span class="iconify" data-icon="fluent:eye-show-20-regular" data-inline="false"></span>
                    </span>
                </div>
                
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>


    
    <script src="../assets/js/show-hide.js"></script>
</body>
</html>