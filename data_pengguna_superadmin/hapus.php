<?php
require_once '../database/koneksi.php';

$id = $_GET['id'];
if (isset($id)) {
    $query_hapus_pengguna = mysqli_query($db, "DELETE FROM tbl_pengguna WHERE id = '$id'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data pengguna berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>