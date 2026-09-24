<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah'])) {
    $kode = trim(mysqli_real_escape_string($db, $_POST['kode']));
    $semester = trim(mysqli_real_escape_string($db, $_POST['semester']));
    $tahun = trim(mysqli_real_escape_string($db, $_POST['tahun']));
    $status = trim(mysqli_real_escape_string($db, $_POST['status']));
    $query_cek = mysqli_query($db, "SELECT * FROM tbl_akademik WHERE kode_akd = '$kode' ") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data akademik sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_akademik VALUES ('$kode', '$semester', '$tahun', '$status') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data akademik berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';

    }
}
?>