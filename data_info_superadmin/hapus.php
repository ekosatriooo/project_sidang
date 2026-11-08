<?php
require_once '../database/koneksi.php';

$id = $_GET['id_info'];
if (isset($id)) {
    $query_hapus_akademik = mysqli_query($db, "DELETE FROM tbl_info WHERE id = '$id'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>