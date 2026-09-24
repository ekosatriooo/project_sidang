<?php
require_once '../database/koneksi.php';

$kode = $_GET['kode'];
if (isset($kode)) {
    $query_hapus_akademik = mysqli_query($db, "DELETE FROM tbl_akademik WHERE kode_akd = '$kode'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data akademik berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>