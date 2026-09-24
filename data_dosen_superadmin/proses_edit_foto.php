<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit-foto'])) {
    $nik = trim(mysqli_real_escape_string($db, $_POST['nik']));
    $file = $_FILES['foto']['name'];
    $ekstensi = explode('.', $file);
    $nama_file = 'foto-dsn'.round(microtime(true)).'.'.end($ekstensi);
    
    $alamat_sumber = $_FILES['foto']['tmp_name'];
    $alamat_tujuan = '../asset_adminlte/img/'.$nama_file;
    move_uploaded_file($alamat_sumber, $alamat_tujuan);
    $query_edit_foto = mysqli_query($db, "UPDATE tbl_dosen SET img = '$alamat_tujuan' WHERE nik = '$nik'") or die(mysqli_error($db));
    echo '<script>alert ("Edit foto dosen telah berhasil")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>