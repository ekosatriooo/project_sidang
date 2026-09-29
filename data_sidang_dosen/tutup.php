<?php
require_once '../database/koneksi.php';

if (isset($_GET['id'])) {

    $id_pertemuan = $_GET['id'];

    $cek_query_status = mysqli_query($db, "SELECT status_pertemuan FROM tbl_pertemuan WHERE id = '$id_pertemuan'")or die(mysqli_error($db));
    $data_pertemuan = mysqli_fetch_array($cek_query_status);
    $status_pertemuan = $data_pertemuan['status_pertemuan'];

    if ($status_pertemuan == 1) {
        $update_status = mysqli_query($db, "UPDATE tbl_pertemuan SET status_pertemuan = '0' WHERE id = '$id_pertemuan'")or die(mysqli_error($db));
        echo "<script>window.location.href = 'presensi.php?id=$id_pertemuan';</script>";
    }

}

?>