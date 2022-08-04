<?php
 
require '../assets/functions/function.php';

if( isset($_POST["register"]) ) {

    if( add_admin($_POST) > 0 ) {
        echo "
            <script>
                alert('user berhasil ditambahkan!');
                document.location.href = '';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('user gagal ditambahkan!');
                document.location.href = '';
            </script>
        ";

        // echo mysqli_error($koneksi);
    }

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
    <title>ADMIN - Tambah User</title>
</head>
<body>
    <a href="tabel-user.php">
        <span class="iconify btn-back" data-icon="bi:arrow-left" data-inline="false"></span>
    </a>

    <div class="container">
        <div class="logo">
            <img src="../assets/image/logo12.png" alt="">
        </div>

        <h1 class="tittle">TAMBAH AKUN</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">

                <label for="foto">foto</label> 
                <div class="input">
                    <input type="file" name="gambar4" id="gambar4" required>
                </div>

                <label for="nama">Nama</label> 
                <div class="input">
                    <input type="text" name="nama" id="nama" required>
                </div>

                <label for="nis">username</label> 
                <div class="input">
                    <input type="text" name="username" id="username" required>
                </div>

                <label for="password">password</label> 
                <div class="input">
                    <input type="password" name="password" id="password" required>
                </div>
                
                <label for="password1">Confirm Password</label> 
                <div class="input"> 
                    <input type="password" name="password1" id="password1" required>
                </div>
               
                
                <a href="index.php">a</a>
                <button class="btn-primary" type="submit" name="register">Register</button>
            </div>
        </form>
    </div>


    
    <script src="../../assets/js/show-hide.js"></script>
</body>
</html>