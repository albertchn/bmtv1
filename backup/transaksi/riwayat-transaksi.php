<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost" , "root" , "" , "bmt12");
$id = $_GET['id_nasabah'];

$query = mysqli_query($conn, "SELECT * FROM rekening WHERE id_nasabah = $id");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="../assets/css/riwayat-persuratan.css">
    <title>Riwayat Persuratan</title>
</head>
<body>

<?php 
       include '../component/sidebar.php';
    ?>

    <main>
        <section>
        <div class="container">
            <?php foreach($query as $data) : ?> 
            <p class="title">Riwayat transaksi <?=$data['nama'];?></p>
            <?php endforeach; ?> 
            <div class="navi">
                <form action="" method="post" class="cari">
                    <input type="text" name="keyword" class="input-cari" placeholder="Pencarian">
                    <button type="submit" name="cari">
                        <span class="iconify" data-icon="ph:magnifying-glass-bold" data-inline="false"></span>
                    </button>
                    <!-- <p class="note">*/u bulan atau tahun pilih salah satu<p> -->
                </form>

                <a href="../assets/functions/ekspor-surat.php">
                    <button class="btn-ekspor" target="_blank">
                        <span class="iconify" data-icon="carbon:document-export" data-inline="false"></span>
                        Ekspor
                    </button>
                </a>
            </div>

            <div class="table">
            <table>
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Teller</th>
                    <th>Keterangan</th>
                    </tr>
                </thead>

                

                <tbody>
                    <?php 
                    include '../assets/functions/function.php';
                    $jumlahdataperhalaman = 100;
                    $jumlahdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekening"));
                    $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
                    $halamanaktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
                    $awaldata = ( $jumlahdataperhalaman * $halamanaktif ) - $jumlahdataperhalaman;


                    $no = 1;
                    $data = mysqli_query($conn, "SELECT tanggal, kode_transaksi, catatan, transaksi.teller as teller, debit as jumlah_debit, kredit as jumlah_kredit from rekening JOIN transaksi WHERE rekening.id_nasabah = transaksi.id_nasabah && transaksi.id_nasabah = $id ORDER BY tanggal DESC");
                    // ORDER BY id DESC = untuk mengurutkan tabel bersadarkan data yang terbaru
                    
                    if( isset($_POST["cari"]) ) {
                        $data = cari($_POST["keyword"]);
                    }
                    
                    while($d = mysqli_fetch_array($data)) {

                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        
                        <td class="tanggal"><?= $d["kode_transaksi"]; ?></td>
                        <td class="kodesurat"><?= $d["tanggal"]; ?></td>
                        <td class="ket"><?= $d['jumlah_debit'] ?></td>
                        <td class="ket"><?= $d['jumlah_kredit'] ?></td>
                        <td class="ket"><?= $d["teller"]; ?></td>
                        <td class="ket"><?= $d["catatan"]; ?></td>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>
            
            <div class="halaman">
                <div class="kembali">
                    <?php if($halamanaktif > 1 ) : ?>
                        <a href="?halaman=<?= $halamanaktif - 1; ?>">
                            <span class="iconify" data-icon="eva:arrow-ios-back-fill" data-inline="false"></span>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="no-halaman">
                    <?php for( $i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
                        <?php if( $i == $halamanaktif ) : ?>
                            <a href="?halaman=<?= $i; ?>" class="halamanaktif"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                
                <div class="lanjut">
                    <?php if($halamanaktif < $jumlahhalaman ) : ?>
                        <a href="?halaman=<?= $halamanaktif + 1; ?>">
                        <span class="iconify" data-icon="eva:arrow-ios-forward-fill" data-inline="false"></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        </section>
    </main>

</body>
</html>