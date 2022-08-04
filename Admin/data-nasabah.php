<?php

session_start();

if( !isset($_SESSION["login_adm"]) ) {
    header("Location: login_adm.php"); 
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
                    <li>
                        <span class="iconify" data-icon="ic:outline-email" data-inline="false"></span>
                        Table data teller
                    </li>
                </a>
                <a href="data-nasabah.php">
                    <li class="side-active">
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
                    <tr>
                    <th style="background-color:#e0e0e0;">No</th>
                    <th style="background-color:#e0e0e0;" class="divisi">Nama</th>
                    <th style="background-color:#e0e0e0;" class="tanggal">Kelas</th>
                    <th style="background-color:#e0e0e0;" class="kodesurat">NIS</th>
                    <th style="background-color:#e0e0e0;" class="nosurat">Tanggal lahir</th>
                    <th style="background-color:#e0e0e0;" class="ket">Foto</th>
                    <th style="background-color:#e0e0e0;" class="ket">saldo</th>
                    <th style="background-color:#e0e0e0;" class="ket">foto ttd</th>
                    <th style="background-color:#e0e0e0;" class="ket">Teller</th>
                    <th style="background-color:#e0e0e0;" class="tabel-aksi">Aksi</th>
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
                    $data = mysqli_query($conn, "SELECT * FROM rekening ORDER BY id_nasabah DESC LIMIT $awaldata, $jumlahdataperhalaman");
                    // ORDER BY id DESC = untuk mengurutkan tabel bersadarkan data yang terbaru
                    
                    if( isset($_POST["cari"]) ) {
                        $data = cari($_POST["keyword"]);
                    }
                    
                    while($d = mysqli_fetch_array($data)) {

                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="divisi">
                            <?= $d["nama"]; ?> 
                            
                        </td>
                        <td ><?= $d["kelas"]; ?></td>
                        <td ><?= $d["no_rekening"]; ?></td>
                        <td ><?=  $d["tanggal_lahir"]; ?></td>
                        <td > <img height="50px" src="../assets/img_nasabah/<?= $d["foto"]; ?>" alt=""> </td>
                        <td ><?= $d["saldo"]; ?></td>
                        <td > <img height="50px" src="../assets/img_tandatangan_nasabah/<?= $d["foto_ttd"]; ?>" alt=""> </td>
                        <td ><?= $d["teller"]; ?></td>
                        <td >
                            <a href="" class="btn-ubah">Hapus</a>
                            <!-- <a href="edit-rekening.php?id_nasabah=<?=$d['id_nasabah']?>" class="btn-ubah">edit</a> -->
                        </td>
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