<?php
// panggil koneksi
require_once '../database/koneksi.php';
// cek button sudah ditekan
if (isset($_POST['btn-edit'])) {
    // tampung data input ke variabel
    $nama = trim(mysqli_real_escape_string($db, $_POST['nama']));
    $nik = trim(mysqli_real_escape_string($db, $_POST['nik']));
    $kontak = trim(mysqli_real_escape_string($db, $_POST['kontak']));
    $email = trim(mysqli_real_escape_string($db, $_POST['email']));
    $kelamin = trim(mysqli_real_escape_string($db, $_POST['kelamin']));

    // edit data pengguna berdasarkan nim
    $query_edit_dosen = mysqli_query($db, "UPDATE tbl_dosen SET nama = '$nama', kontak = '$kontak', email = '$email', kelamin = '$kelamin' WHERE nik = '$nik'") or die(mysqli_error($db));
    $query_edit_pengguna = mysqli_query($db, "UPDATE tbl_pengguna SET nama ='$nama' WHERE username = '$nik'") or die(mysqli_error($db));
    // tampilkan alert dan diarahkan ke index
        echo '<script>alert ("Edit data dosen berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>