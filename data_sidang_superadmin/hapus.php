<?php
require_once '../database/koneksi.php';

$id_sidang = $_GET['id_sidang'];
if (isset($id_sidang)) {
    $query_hapus_sidang = mysqli_query($db, "DELETE FROM tbl_sidang WHERE id = '$id_sidang'") or die(mysqli_error($db));
        echo '<script>alert ("Hapus data sidang  berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>