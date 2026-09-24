<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah'])) {
    $nama = trim(mysqli_real_escape_string($db, $_POST['nama']));
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $peran = trim(mysqli_real_escape_string($db, $_POST['peran']));
    $pin = "12345";
    $sandi = sha1($username);
    $query_cek = mysqli_query($db, "SELECT username FROM tbl_pengguna WHERE username = '$username' ") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data pengguna sudah terdaftar")</script>';
        echo '<script>window.location.href="tambah.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_pengguna VALUES (NULL, '$username', '$sandi', '$peran', '$nama', '$pin') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data pengguna berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';

    }
}
?>