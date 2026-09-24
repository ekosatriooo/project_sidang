<?php
require_once '../database/koneksi.php';

$kode = $_GET['kode'];
if (isset($kode)) {
    $query_hapus_pengguna = mysqli_query($db, "DELETE FROM tbl_jurusan WHERE kode_jurusan = '$kode'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data jurusan berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>