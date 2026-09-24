<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $kode = trim(mysqli_real_escape_string($db, $_POST['kode']));
    $semester = trim(mysqli_real_escape_string($db, $_POST['semester']));
    $tahun = trim(mysqli_real_escape_string($db, $_POST['tahun']));
    $status = trim(mysqli_real_escape_string($db, $_POST['status']));

    $query_edit_pengguna = mysqli_query($db, "UPDATE tbl_akademik SET semester = '$semester', tahun = '$tahun', is_active = '$status' WHERE kode_akd = '$kode'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data akademik berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>