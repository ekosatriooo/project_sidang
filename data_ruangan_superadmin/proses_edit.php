<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $kode_ruangan = trim(mysqli_real_escape_string($db ,$_POST['kode_ruangan']));
    $nama_ruangan = trim(mysqli_real_escape_string($db ,$_POST['nama_ruangan']));
    $gedung = trim(mysqli_real_escape_string($db ,$_POST['gedung']));
    $kuota = trim(mysqli_real_escape_string($db ,$_POST['kuota']));

    $query_edit_ruangan = mysqli_query($db, "UPDATE tbl_ruangan SET gedung = '$gedung', nama_ruangan = '$nama_ruangan', kuota = '$kuota' WHERE kode_ruangan = '$kode_ruangan'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data ruangan berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>