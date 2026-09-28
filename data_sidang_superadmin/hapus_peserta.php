<?php
require_once '../database/koneksi.php';

$id_peserta = $_GET['peserta'];
$id_sidang = $_GET['id_sidang'];

if (isset($id_peserta) && isset($id_sidang)) {
    $query_hapus_peserta = mysqli_query($db, "DELETE FROM tbl_presensi WHERE nim = '$id_peserta' AND id_sidang = '$id_sidang'")or die(mysqli_error($db));
    echo '<script>alert ("Hapus data peserta berhasil")</script>';
    echo '<script>window.location.href="presensi.php?id_sidang='.$id_sidang.'";</script>';
}
?>