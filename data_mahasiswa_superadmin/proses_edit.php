<?php
// panggil koneksi
require_once '../database/koneksi.php';
// cek button sudah ditekan
if (isset($_POST['btn-edit'])) {
    // tampung data input ke variabel
    $nama = trim(mysqli_real_escape_string($db, $_POST['nama']));
    $nim = trim(mysqli_real_escape_string($db, $_POST['nim']));
    $kontak = trim(mysqli_real_escape_string($db, $_POST['kontak']));
    $email = trim(mysqli_real_escape_string($db, $_POST['email']));
    $kelamin = trim(mysqli_real_escape_string($db, $_POST['kelamin']));

    // edit data pengguna berdasarkan nim
    $query_edit_mhs = mysqli_query($db, "UPDATE tbl_mahasiswa SET nama = '$nama', kontak = '$kontak', email = '$email', kelamin = '$kelamin' WHERE nim = '$nim'") or die(mysqli_error($db));
    $query_edit_pengguna = mysqli_query($db, "UPDATE tbl_pengguna SET nama ='$nama' WHERE username = '$nim'") or die(mysqli_error($db));
    // tampilkan alert dan diarahkan ke index
        echo '<script>alert ("Edit data mahasiswa berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>