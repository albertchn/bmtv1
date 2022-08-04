<section class="sidebar">
        <div class="menu">
            <div class="profile">
                <div class="gambar">
                    <img src="../assets/img_teller/<?= $_SESSION["foto"]; ?>" alt="">
                </div>

                <div class="nama">
                <p>
                        <?= $_SESSION["nama"]; ?> <br>
                        <span><?= $_SESSION["nis"]; ?></span>
                    </p>
                </div>
            </div>

            <ul>
                <p>Menu</p>
                <a href="../buka_rekening/buka-rekening.php">
                    <li>
                        <span class="iconify" data-icon="ic:outline-email" data-inline="false"></span>
                        Buka Rekening
                    </li>
                </a>
                <a href="../buka_rekening/data-nasabah.php">
                    <li >
                        <span class="iconify" data-icon="mdi:timetable" data-inline="false"></span>
                        Table Data nasabah
                    </li>
                </a>
                <a href="../transaksi/transaksi.php">
                    <li >
                    <span class="iconify" data-icon="ant-design:dollar-circle-outlined"></span>
                        Transaksi 
                    </li>
                </a>
                <br><br>
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
            <p>Created By :</p>
            <p>12xCode</p>
            
        </div>
    </section>