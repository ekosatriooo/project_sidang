<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $kode = trim(mysqli_real_escape_string($db, $_POST['kode']));
    $nama_jurusan = trim(mysqli_real_escape_string($db, $_POST['nama_jurusan']));

    $query_edit_pengguna = mysqli_query($db, "UPDATE tbl_jurusan SET nama_jurusan = '$nama_jurusan' WHERE kode_jurusan = '$kode'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data pengguna berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>