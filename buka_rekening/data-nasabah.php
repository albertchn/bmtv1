<?php

session_start();

if( !isset($_SESSION["login_topup"]) ) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="../assets/css/riwayat-persuratan.css">
    <title>Data Nasabah</title>
</head>
<body>

<?php 
       include '../component/sidebar.php';
    ?>

    <main>
        <section>
        <div class="container">

            <p class="title">Data nasabah</p>

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
                    <tr >
                    <th  style="background-color:#e0e0e0;">No</th>
                    <th  style="background-color:#e0e0e0;" class="ket">Foto</th>
                    <th  style="background-color:#e0e0e0;" class="divisi">Nama</th>
                    <th  style="background-color:#e0e0e0;" class="tanggal">Kelas</th>
                    <th  style="background-color:#e0e0e0;" class="kodesurat">No Rekening</th>
                    <th  style="background-color:#e0e0e0;" class="nosurat">Tanggal lahir</th>
                    <th  style="background-color:#e0e0e0;" class="ket">Teller</th>
                    <th  style="background-color:#e0e0e0;" class="ket">Aksi</th>
                    <!-- <th class="tabel-aksi">Aksi</th> -->
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
                    // $data = mysqli_query($conn, "SELECT transaksi.id_nasabah, nama, no_rekening, kelas, tanggal_lahir, foto, foto_ttd, rekening.teller as teller, sum(debit) as jumlah_debit, sum(kredit) as jumlah_kredit from rekening JOIN transaksi WHERE rekening.id_nasabah = transaksi.id_nasabah GROUP BY transaksi.id_nasabah");
                    // $data = mysqli_query($conn, "SELECT * FROM rekening");
                    // ORDER BY id DESC = untuk mengurutkan tabel bersadarkan data yang terbaru
                    $data = mysqli_query($conn, "SELECT * FROM rekening"); 
                    if( isset($_POST["cari"]) ) {
                        $search = $_POST["keyword"];
                        $data = mysqli_query($conn, "SELECT * FROM rekening WHERE no_rekening = '$search'");
                    }else{
                        $data = mysqli_query($conn, "SELECT * FROM rekening");
                    }
                    
                    while($d = mysqli_fetch_array($data)) {

                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td > <img height="80px" src="../assets/img_nasabah/<?= $d["foto"]; ?>" alt="">   </td>
                        <td ><?= $d["nama"]; ?></td>
                        
                        <td ><?= $d["kelas"]; ?></td>
                        <td ><?= $d["no_rekening"]; ?></td>
                        <td ><?=  $d["tanggal_lahir"]; ?></td>
                        <td ><?= $d["teller"]; ?></td>
                        <td><a  href="../transaksi/setor-tunai.php?id_nasabah=<?=$d['id_nasabah']?>"> <button  style="background-color:#0062ff;border-radius:5px;padding:4px; color:white;border:none;" > Setor tunai</button></a></td>
                        <!-- <td class="ket">
                            <a href="" class="btn-ubah">Hapus</a>
                            <a href="edit-rekening.php?id_nasabah=<?=$d['id_nasabah']?>" class="btn-ubah">edit</a>
                        </td> -->
                       
                    </tr>
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