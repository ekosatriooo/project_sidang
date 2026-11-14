<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah'])) {
    $mahasiswa = trim(mysqli_real_escape_string($db, $_POST['mahasiswa']));
    $jurusan = trim(mysqli_real_escape_string($db, $_POST['jurusan']));
    $pembimbing = trim(mysqli_real_escape_string($db, $_POST['pembimbing']));

    $query_cek = mysqli_query($db, "SELECT * FROM tbl_info WHERE nim = '$mahasiswa'")or die(mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0 ) {
        echo '<script>alert ("Data sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
    } else {
        $query_simpan = mysqli_query($db, "INSERT INTO tbl_info VALUES (null, '$mahasiswa', '$pembimbing', '$jurusan') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
    }
}

?>