<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require '../assets/functions/function.php';
global $conn;
$id = $_GET['id_nasabah'];
$query = mysqli_query($conn, "SELECT * FROM rekening WHERE id_nasabah = '$id' ");
if( isset($_POST["submit"]) ) {

    if( setor_tunai($_POST) > 0 ) {
        echo "
            <script>
                alert('Transaksi berhasil ');
            </script>
        ";
    } else {
        var_dump(mysqli_error($conn));
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
</head>
<body>

<?php 
       include '../component/sidebar.php';
    ?>

    <main>
        <section>
        <div class="container">
        <p class="title">Setor tunai</p>
            <form action="" method="post" enctype="multipart/form-data">
            <?php
                foreach($query as $data):
            ?>
            <div class="form-group">
            <input type="hidden" name="id" id="id" value="<?=$data['id_nasabah'];?>" required>
                    <label for="tujuan">Nomor Rekening</label> 
                    <div class="input">
                        <input type="text" name="norek" id="norek" value="<?=$data['no_rekening'];?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tujuan">Nama</label> 
                    <div class="input">
                        <input type="text" name="nama" id="nama" value="<?=$data['nama'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">Nominal</label> 
                            <div class="input">
                                <input type="number" name="nominal" id="nominal" required>
                            </div>

                        </div>

                        <div class="col">
                            <label for="kodesurat">Note </label> 
                            <div class="input">
                                <input type="text" name="note" id="note" required>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="tanggal">Teller : <?= $_SESSION["nama"]; ?> </label> 
                            <div class="input">
                                <input hidden type="text" name="teller" id="teller" value="<?= $_SESSION["nama"]; ?>" placeholder="<?= $_SESSION["nama"]; ?>" >
                            </div>
                        </div>
                      
                        </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Setor</button>
                </div>
            </form>
        </div>
        </section>
    </main>

</body>
</html>