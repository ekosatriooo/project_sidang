<?php
require_once '../database/koneksi.php';

$kode_ruangan = $_GET['kode_ruangan'];
if (isset($kode_ruangan)) {
    $query_hapus_ruangan = mysqli_query($db, "DELETE FROM tbl_ruangan WHERE kode_ruangan = '$kode_ruangan'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data ruangan berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>