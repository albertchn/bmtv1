<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

if( isset($_POST["submit"]) || isset($_POST["submit2"]) ) {
    if( isset($_POST['norek']) ) {
        header('Location: rekap-pdf.php?awal='.$_POST['tanggal_awal'].'&akhir='.$_POST['tanggal_akhir'].'&norek='.$_POST['norek']);
    } else {
        header('Location: rekap-pdf.php?awal='.$_POST['tanggal_awal'].'&akhir='.$_POST['tanggal_akhir']);
    }
}


require '../assets/functions/function.php';
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
        
        <div class="row-form">
            <div class="left">

                <p class="title">Rekap Seluruh Mutasi</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                        <div class="col">
                            <label for="tanggal">Tanggal Awal</label> 
                            <div class="input">
                                <input type="date" name="tanggal_awal" id="tanggal-awal" required>
                            </div>

                        </div>

                        <div class="col">
                            <label for="kodesurat">Tanggal Akhir</label> 
                            <div class="input">
                                <input type="date" name="tanggal_akhir" id="Tanggal Akhir" required>
                            </div>
                        </div>

                        <div class="col">
                            <button type="submit" name="submit">Rekap</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="right">

                <p class="title">Rekap Mutasi Sesuai Rekening</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                    <div class="input">
                        <div class="col">
                            <label for="norek">norek</label> 
                            <div class="input">
                                <input type="text" name="norek" id="norek" required>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal">Tanggal Awal</label> 
                                <div class="input">
                                    <input type="date" name="tanggal_awal" id="tanggal" required>
                                </div>
                                
                            </div>
                            
                            <div class="col">
                                <label for="kodesurat">Tanggal Akhir</label> 
                                <div class="input">
                                    <input type="date" name="tanggal_akhir" id="Tanggal Akhir" required>
                                </div>
                            </div>
                            
                            <div class="col">
                                <button type="submit" name="submit2">Rekap</button>
                            </div>
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>