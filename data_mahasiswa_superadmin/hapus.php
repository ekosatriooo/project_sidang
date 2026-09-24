<?php
// panggil koneksi
require_once '../database/koneksi.php';

// tampung nim dari url
$nim = $_GET['nim'];
if (isset($nim)) { // ketika nim nya ada atau terisi
// hapus data dari tbl berdasarkan nim (unik tblnya)
    $query_hapus_mhs = mysqli_query($db, "DELETE FROM tbl_mahasiswa WHERE nim = '$nim'") or die(mysqli_error($db));
    $query_hapus_pengguna = mysqli_query($db, "DELETE FROM tbl_pengguna WHERE username = '$nim'") or die(mysqli_error($db));
    // tampilkan alert dan diarahkan ke index
        echo '<script>alert ("Hapus data mahasiswa berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>