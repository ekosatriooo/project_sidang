<?php
require_once '../database/koneksi.php';

if (isset($_GET['id_sidang']) && isset($_GET['status_baru'])) {
    
    $id_sidang = mysqli_real_escape_string($db, $_GET['id_sidang']);
    $status_baru = mysqli_real_escape_string($db, $_GET['status_baru']);

    $query_update = mysqli_query($db, "UPDATE tbl_sidang SET status = '$status_baru' WHERE id = '$id_sidang'") or die(mysqli_error($db));

    if ($query_update) {
        echo '<script>alert("Status sidang berhasil diperbarui menjadi: ' . strtoupper($status_baru) . '");</script>';
        
        echo '<script>window.location.href="presensi.php?id_sidang=' . $id_sidang . '";</script>';
    } else {
        echo '<script>alert("Gagal mengubah status sidang!");</script>';
        echo '<script>window.location.href="presensi.php?id_sidang=' . $id_sidang . '";</script>';
    }
} else {
    echo '<script>window.location.href="index.php";</script>';
}
?>