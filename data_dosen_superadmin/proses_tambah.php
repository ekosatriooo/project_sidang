<?php
// panggi koneksi database
require_once '../database/koneksi.php';

// cek tombol ketika ditekan
if (isset($_POST['btn-tambah'])) {
    // menampung data dari input nama ke variabel nama 
    $nama = trim(mysqli_real_escape_string($db, $_POST['nama']));
    $nik = trim(mysqli_real_escape_string($db, $_POST['nik']));
    $kontak = trim(mysqli_real_escape_string($db, $_POST['kontak']));
    $email = trim(mysqli_real_escape_string($db, $_POST['email']));
    $kelamin = trim(mysqli_real_escape_string($db, $_POST['kelamin']));

    // mengambil data di tbl berdasarkan nik (unik tabelnya)
    $query_cek = mysqli_query($db, "SELECT nik FROM tbl_dosen WHERE nik = '$nik' ") or die (mysqli_error($db));
    // mengambil jumlah data dari query dan ditampung ke variabel rv
    $rv = mysqli_num_rows($query_cek);
    // jika datanya > 0 (ada datanya)
    if ($rv > 0) {
        // tampilkan alert dan arahkan pengguna ke form tambah
        echo '<script>alert ("Data dosen sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else { // jika data = 0 atau tidak lebih dari 0 (tidak ada datanya)
            $sandi = sha1($nik);
            $peran = "D";
            $pin = "12345";
        // buat simpan data input ke database
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_dosen VALUES ('$nik' , '$nama', '$kontak', '$email', '$kelamin', NULL) ") or die(mysqli_error($db));
            $query_cek_pengguna = mysqli_query($db, "SELECT username FROM tbl_pengguna WHERE username = '$nik'") or die(mysqli_error($db));
            $rv_pengguna = mysqli_num_rows($query_cek_pengguna);
            if ($rv_pengguna == 0) {
                $query_simpan_pengguna = mysqli_query($db, "INSERT INTO tbl_pengguna VALUES (NULL, '$nik', '$sandi', '$peran', '$nama', '$pin')") or die(mysqli_error($db));
            }
            // tampilkan alert dan diarahkan ke tampilan index
            echo '<script>alert ("Tambah data dosen berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
    }
}
?>