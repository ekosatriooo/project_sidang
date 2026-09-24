<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah'])) {
    $kode_ruangan = trim(mysqli_real_escape_string($db ,$_POST['kode_ruangan']));
    $nama_ruangan = trim(mysqli_real_escape_string($db ,$_POST['nama_ruangan']));
    $gedung = trim(mysqli_real_escape_string($db ,$_POST['gedung']));
    $kuota = trim(mysqli_real_escape_string($db ,$_POST['kuota']));

    $query_cek = mysqli_query($db, "SELECT kode_ruangan FROM tbl_ruangan WHERE kode_ruangan = '$kode_ruangan' ") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data Ruangan sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_ruangan VALUES ('$kode_ruangan', '$gedung', '$nama_ruangan', '$kuota') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data ruangan berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
    }
}
?>