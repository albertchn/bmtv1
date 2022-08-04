<?php

$conn = mysqli_connect("localhost" , "root" , "" , "database_bmt");

function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yg diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang Anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img_nasabah/' . $namaFileBaru);

    return $namaFileBaru;

}
function upload_tanda_tangan() {

    $namaFile = $_FILES['gambar2']['name'];
    $ukuranFile = $_FILES['gambar2']['size'];
    $error = $_FILES['gambar2']['error'];
    $tmpName = $_FILES['gambar2']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yg diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang Anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img_tandatangan_nasabah/' . $namaFileBaru);

    return $namaFileBaru;

}




function tambah_rekening($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $kelas = htmlspecialchars($data["kelas"]);
    $nis = htmlspecialchars($data["nis"]);
    $saldo = htmlspecialchars($data["saldo"]);
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
    $ibu = htmlspecialchars($data["ibu"]);
    $tanggal_ibu = htmlspecialchars($data["tanggal_ibu"]);
    $teller = htmlspecialchars($data["teller"]);
    var_dump($teller) and die;
    $pertanyaan = htmlspecialchars($data["pertanyaan"]);
    $jawaban = htmlspecialchars($data["jawaban"]);
    $pin = htmlspecialchars($data["pin"]);
    $rekening = "BMT-" . rand(10000000, 99999999);


    $seleksi1 = mysqli_query($conn, "SELECT nis FROM rekening WHERE nis = '$nis' ");

    if (mysqli_fetch_assoc($seleksi1)) {
        echo "<script>
                alert('nis already exist');
             </script>";

        return false;
    }

    $seleksi2 = mysqli_query($conn, "SELECT no_rekening FROM rekening WHERE no_rekening = '$rekening' ");

    if (mysqli_fetch_assoc($seleksi1)) {
        echo "<script>
                alert('no rekening already exist');
             </script>";

        return false;
    }

    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }
    $gambar2 = upload_tanda_tangan();
    if ( !$gambar ) {
        return false;
    }
    $pin = password_hash($pin, PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "INSERT INTO rekening VALUES ('','$nama','$rekening','$pin','$saldo',now(),
                                                        '$teller','$gambar','$kelas','$nis','$tanggal_lahir','$ibu','$tanggal_ibu','$pertanyaan','$jawaban','$gambar2')");


    
    return mysqli_affected_rows($conn);

}


function upload_profil_teller() {

    $namaFile = $_FILES['gambar3']['name'];
    $ukuranFile = $_FILES['gambar3']['size'];
    $error = $_FILES['gambar3']['error'];
    $tmpName = $_FILES['gambar3']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }
    
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang Anda upload bukan gambar!');
            </script>";
        return false;
    }
    
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }
   
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img_teller/' . $namaFileBaru);

    return $namaFileBaru;
}

function add_teller($data){
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $nis = htmlspecialchars($data['nis']);
    $kelas = htmlspecialchars($data['kelas']);
    $password = mysqli_real_escape_string($conn,$data['password']);
    $password1 = mysqli_real_escape_string($conn,$data['password1']);
 
    $seleksi1 = mysqli_query($conn, "SELECT nis FROM teller WHERE nis = '$nis' ");

    if (mysqli_fetch_assoc($seleksi1)) {
        echo "<script>
                alert('nis already exist');
             </script>";

        return false;
    }

    $seleksi2 = mysqli_query($conn, "SELECT nama FROM teller WHERE nama = '$nama' ");

    if (mysqli_fetch_assoc($seleksi2)) {
        echo "<script>
                alert('nama already exist');
             </script>";

        return false;
    }

    if ($password !== $password1) {
        echo "<script>
                alert('Confirm password tidak sesuai');
             </script>";

        return false;
    }

    $gambar = upload_profil_teller();
    if ( !$gambar ) {
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "INSERT INTO teller VALUES('', '$nama', '$nis', '$password', '$kelas', '$gambar')");

    return mysqli_affected_rows($conn);
    
}

function upload_profil_admin() {

    $namaFile = $_FILES['gambar4']['name'];
    $ukuranFile = $_FILES['gambar4']['size'];
    $error = $_FILES['gambar4']['error'];
    $tmpName = $_FILES['gambar4']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }
    
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang Anda upload bukan gambar!');
            </script>";
        return false;
    }
    
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }
   
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img_admin/' . $namaFileBaru);

    return $namaFileBaru;
}
function add_admin($data){
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = mysqli_real_escape_string($conn,$data['password']);
    $password1 = mysqli_real_escape_string($conn,$data['password1']);
 
    $seleksi1 = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username' ");

    if (mysqli_fetch_assoc($seleksi1)) {
        echo "<script>
                alert('nis already exist');
             </script>";

        return false;
    }

    $seleksi2 = mysqli_query($conn, "SELECT nama FROM admin WHERE nama = '$nama' ");

    if (mysqli_fetch_assoc($seleksi2)) {
        echo "<script>
                alert('nama already exist');
             </script>";

        return false;
    }

    if ($password !== $password1) {
        echo "<script>
                alert('Confirm password tidak sesuai');
             </script>";

        return false;
    }

    $gambar = upload_profil_admin();
    if ( !$gambar ) {
        return false;
    }
    $role = "Administrator";
    $password = password_hash($password, PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "INSERT INTO admin VALUES('', '$nama', '$username', '$password', '$gambar', '$role')");

    return mysqli_affected_rows($conn);
    
}
function edit_teller($data){
    global $conn;
    $nama = $data['nama'];
    $nis = $data['nis'];
    $kelas = $data['kelas'];
    $foto = $data['foto'];
    
    $query = mysqli_query($conn, "UPDATE teller SET nama='$nama', nis='$nis', kelas='$kelas', foto='$foto'");

    return mysqli_affected_rows($conn);
}

function setor_tunai($data){
    global $conn;
    
    $nama = htmlspecialchars($data['nama']);
    $rekening = htmlspecialchars($data['norek']);
    $saldo = htmlspecialchars($data['nominal']);
    $note = htmlspecialchars($data['note']);
    $teller = htmlspecialchars($data['teller']);
    $kode = "T-" . rand(10000000, 99999999);

    $id_nasabah = htmlspecialchars($data['id']);

    $query = mysqli_query($conn, "INSERT INTO transaksi VALUES('','$kode','$id_nasabah','$saldo',0,now(),'$teller','$note' )");

    return mysqli_affected_rows($conn);
}

function tarik_tunai($data){
    global $conn;
    
    $nama = htmlspecialchars($data['nama']);
    $rekening = htmlspecialchars($data['norek']);
    $saldo = htmlspecialchars($data['nominal']);
    $note = htmlspecialchars($data['note']);
    $teller = htmlspecialchars($data['teller']);
    $kode = "T-" . rand(10000000, 99999999);

    $id_nasabah = htmlspecialchars($data['id']);

    $query = mysqli_query($conn, "INSERT INTO transaksi VALUES('','$kode','$id_nasabah',0,'$saldo',now(),'$teller','$note' )");

    return mysqli_affected_rows($conn);
}
