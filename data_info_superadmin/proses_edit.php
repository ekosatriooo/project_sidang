<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $id_info = trim(mysqli_real_escape_string($db, $_POST['id_info']));
    $mahasiswa = trim(mysqli_real_escape_string($db, $_POST['mahasiswa']));
    $jurusan = trim(mysqli_real_escape_string($db, $_POST['jurusan']));
    $pembimbing = trim(mysqli_real_escape_string($db, $_POST['pembimbing']));

    $query_edit = mysqli_query($db, "UPDATE tbl_info SET nim = '$mahasiswa', nik_pembimbing = '$pembimbing', jurusan = '$jurusan' WHERE id = '$id_info'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>