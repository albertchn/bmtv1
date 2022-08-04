<?php 

session_start();

if( !isset($_SESSION["login_adm"]) ) {
    header("Location: login_adm.php"); 
    exit;
}

require '../assets/functions/function.php';

global $conn;
$id = $_GET['id_nasabah'];
$query = mysqli_query($conn, "SELECT * FROM rekening WHERE id_nasabah = '$id' ");
$data = mysqli_fetch_array($query);

if( isset($_POST["submit"]) ) {

    if( edit_rekening($_POST) > 0 ) {
        echo "
            <script>
                alert('Rekening berhasil dibuat');
            </script>
        ";
    } else {
        echo "
            <script>
                alert('nomor gagal diminta!');
                document.location.href = 'minta-nomorsurat.php';
            </script>
        ";
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
    <link rel="stylesheet" href="../assets/css/minta-nomorsurat.css">
    <title>Edit Rekening</title>
</head>
<body>

<section class="sidebar">
        <div class="menu">
            <div class="profile">
                <div class="gambar">
                    <img src="../assets/img_admin/<?= $_SESSION["foto"]; ?>" alt="">
                </div>

                <div class="nama">
                <p>
                        <?= $_SESSION["nama"]; ?> <br>
                        <span><?= $_SESSION["role"]; ?></span>
                    </p>
                </div>
            </div>

            <ul>
                <p>Menu</p>
                <a href="data-teller.php">
                    <li class="side-active">
                        <span class="iconify" data-icon="ic:outline-email" data-inline="false"></span>
                        Table data teller
                    </li>
                </a>
                <a href="data-nasabah.php">
                    <li>
                        <span class="iconify" data-icon="mdi:timetable" data-inline="false"></span>
                        Table Data nasabah
                    </li>
                </a>
                <a href="">
                    <li>
                        <span class="iconify" data-icon="bx:bx-help-circle" data-inline="false"></span>
                        Bantuan
                    </li>
                </a>
            </ul>

            <ul>
                <p>Akun</p>
                <a href="ubah-profil.php">
                    <li>
                        <span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span>
                        Ubah Profil
                    </li>
                </a>
                <a href="../assets/functions/logout.php" onclick="return confirm('Anda ingin keluar?');">
                    <li>
                        <span class="iconify" data-icon="ic:baseline-logout" data-inline="false"></span>
                        Keluar
                    </li>
                </a>
            </ul>
        </div>

        <div class="copyright">
            <p>Powered By</p>
            <img src="../assets/image/logo-semudah.png" alt="">
            <p>Created By <a href="https://muhamadasaddullah.github.io/">M05X</a></p>
        </div>
    </section>

    <main>
        <section>
        <div class="container">
        <p class="title">Buka Rekening</p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tujuan">Nama</label> 
                    <div class="input">
                        <input type="text" name="nama" id="nama" value="<?=$data['nama'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">kelas</label> 
                            <div class="input">
                                <input type="text" name="kelas" id="kelas" value="<?=$data['kelas'];?>" required>
                            </div>

                        </div>

                        <div class="col">
                            <label for="kodesurat">NIS</label> 
                            <div class="input">
                                <input type="text" name="nis" id="nis" value="<?=$data['nis'];?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">Tanggal lahir</label> 
                            <div class="input">
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?=$data['tanggal_lahir'];?>" required     >
                            </div>
                        </div>
                        <div class="col">
                            <label for="kodesurat">saldo</label> 
                            <div class="input">
                                <input type="text" name="saldo" id="saldo" value="<?=$data['saldo'];?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan">Foto</label> 
                    <div class="input">
                        <input type="file" name="gambar" id="gambar" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">Pertanyaan Keamanan</label> 
                            <div class="input">
                                <input type="text" name="pertanyaan" id="pertanyaan" value="<?=$data['pertanyaan'];?>" required     >
                            </div>
                        </div>
                        <div class="col">
                            <label for="kodesurat">jawaban</label> 
                            <div class="input">
                                <input type="text" name="jawaban" id="jawaban" value="<?=$data['jawaban'];?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">Nama Ibu</label> 
                            <div class="input">
                                <input type="text" name="ibu" id="ibu" value="<?=$data['ibu'];?>" required     >
                            </div>
                        </div>
                        <div class="col">
                            <label for="kodesurat">Tanggal Lahir ibu</label> 
                            <div class="input">
                                <input type="date" name="tanggal_ibu" id="tanggal_ibu" value="<?=$data['tanggal_ibu'];?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan">Foto Tanda tangan</label> 
                    <div class="input">
                        <input type="file" name="gambar2" id="gambar2" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan">Teller</label> 
                    <div class="input">
                        <input type="text" name="teller" id="teller" value="<?= $_SESSION["nama"]; ?>" placeholder="<?= $_SESSION["nama"]; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Buka Rekening</button>
                </div>
            </form>
        </div>
        </section>
    </main>

</body>
</html>