<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah'])) {
    $kode = trim(mysqli_real_escape_string($db, $_POST['kode']));
    $nama = trim(mysqli_real_escape_string($db, $_POST['nama']));
    $query_cek = mysqli_query($db, "SELECT * FROM tbl_jurusan WHERE kode_jurusan = '$kode' OR nama_jurusan = '$nama' ") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data jurusan sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_jurusan VALUES ('$kode', '$nama') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data jurusan berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';

    }
}
?>