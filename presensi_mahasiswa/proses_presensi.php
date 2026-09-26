<?php
require_once '../database/koneksi.php';

if(isset($_GET['id_pertemuan'])) {
    $id_pertemuan = $_GET['id_pertemuan'];
    $nim = $_SESSION['user'];

    $query_ambil_status_pertemuan = mysqli_query($db, "SELECT status_pertemuan FROM tbl_pertemuan WHERE id = '$id_pertemuan'")or die(mysqli_error($db));
    $data = mysqli_fetch_array($query_ambil_status_pertemuan);
    if ($data == 0) {
        echo '<script>alert ("Presensi ini ditutup")</script>';
        echo '<script>window.location.href="index.php"</script>';
    } else {
        $query_status_kehadiran = mysqli_query($db, "SELECT status_kehadiran FROM tbl_presensi WHERE nim = '$nim' AND id_pertemuan = '$id_pertemuan'")or die(mysqli_error($db));
        $data_presensi = mysqli_fetch_array($query_status_kehadiran);
        $kehadiran = $data_presensi['status_kehadiran'];
        if ($kehadiran == 'hadir') {
            echo '<script>alert ("Kamu telah melakukan presensi ini")</script>';
            echo '<script>window.location.href="index.php"</script>';
        }else {
            $status_hadir = 'hadir';
            $query_update_kehadiran = mysqli_query($db, "UPDATE tbl_presensi SET status_kehadiran = '$status_hadir' WHERE nim = '$nim' AND id_pertemuan = '$id_pertemuan'")or die(mysqli_error($db));
            echo '<script>alert ("Presensi berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
    }
}
?>