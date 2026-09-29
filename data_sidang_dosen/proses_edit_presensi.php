<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {

    $id_presensi = trim(mysqli_real_escape_string($db, $_POST['id_presensi']));
    $kehadiran = trim(mysqli_real_escape_string($db, $_POST['kehadiran']));

    $query_edit_pertemuan = mysqli_query($db, "UPDATE tbl_presensi SET status_kehadiran = '$kehadiran' WHERE id = '$id_presensi'") or die(mysqli_error($db));

    $query_pertemuan = mysqli_query($db, "SELECT id_pertemuan FROM tbl_presensi WHERE id = '$id_presensi'");
    $data_pertemuan = mysqli_fetch_assoc($query_pertemuan);
    $id_pertemuan = $data_pertemuan['id_pertemuan'];
        echo '<script>alert ("Edit data Presensi berhasil")</script>';
        echo '<script>window.location.href="presensi.php?id=' . $id_pertemuan . '"</script>';
}
?>