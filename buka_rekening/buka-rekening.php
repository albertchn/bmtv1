<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require '../assets/functions/function.php';

if( isset($_POST["submit"]) ) {

    if( tambah_rekening($_POST) > 0 ) {
        echo "
            <script>
                alert('Rekening berhasil dibuat');
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Rekening gagal dibuat');
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
    <title>Buka Rekening</title>
    <style>
        form {
            width: 920px;
        }

        .row-form {
            grid-gap: 36px;
        }
    </style>
</head>
<body>

<?php 
       include '../component/sidebar.php';
    ?>

    <main>
        <section>
        <div class="container">
            <p class="title">Buka Rekening</p>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="row-form">
                <div class="left">
                    <div class="form-group">
                        <label for="tujuan">Nama</label> 
                        <div class="input">
                            <input type="text" name="nama" id="nama" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">kelas</label> 
                                <div class="input">
                                    <input type="text" name="kelas" id="kelas" required>
                                </div>

                            </div>

                            <div class="col">
                                <label for="kodesurat">NIS</label> 
                                <div class="input">
                                    <input type="text" name="nis" id="nis" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">Tanggal lahir</label> 
                                <div class="input">
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required     >
                                </div>
                            </div>
                            <div class="col">
                                <label for="kodesurat">pin</label> 
                                <div class="input">
                                    <input type="text" name="pin" id="pin" required>
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
                </div>

                <div class="right">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">Pertanyaan Keamanan</label> 
                                <div class="input">
                                    <input type="text" name="pertanyaan" id="pertanyaan" required     >
                                </div>
                            </div>
                            <div class="col">
                                <label for="kodesurat">jawaban</label> 
                                <div class="input">
                                    <input type="text" name="jawaban" id="jawaban" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">Nama Ibu</label> 
                                <div class="input">
                                    <input type="text" name="ibu" id="ibu" required     >
                                </div>
                            </div>
                            <div class="col">
                                <label for="kodesurat">Tanggal Lahir ibu</label> 
                                <div class="input">
                                    <input type="date" name="tanggal_ibu" id="tanggal_ibu" required>
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
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">Teller : <?= $_SESSION["nama"]; ?> </label> 
                                <div class="input">
                                    <input hidden type="text" name="teller" id="teller" value="<?= $_SESSION["nama"]; ?>" placeholder="<?= $_SESSION["nama"]; ?>" >
                                </div>
                            </div>
                            <div class="col">
                                <label for="kodesurat">saldo</label> 
                                <div class="input">
                                    <input type="number" name="saldo" id="saldo" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Buka Rekening</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </section>
    </main>

</body>
</html>