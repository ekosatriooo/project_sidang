<?php
require_once '../database/koneksi.php';

if(isset($_POST['btn-tambah'])) {
    $kode_ruangan = mysqli_real_escape_string($db, $_POST['kode_ruangan']);
    $nim = mysqli_real_escape_string($db, $_POST['mahasiswa']);
    $nik_pembimbing = mysqli_real_escape_string($db, $_POST['pembimbing']);
    $nik_penguji = mysqli_real_escape_string($db, $_POST['penguji']);
    $tgl = mysqli_real_escape_string($db, $_POST['tanggal']);
    $jam_mulai = mysqli_real_escape_string($db, $_POST['jam_mulai']);
    $jam_selesai = mysqli_real_escape_string($db, $_POST['jam_selesai']);
    $judul  = mysqli_real_escape_string($db, $_POST['judul']);
    $status = "dijadwalkan";

    if ($nik_pembimbing == $nik_penguji) {
        echo '<script>alert("Data gagal disimpan! Dosen Pembimbing dan Dosen Penguji tidak boleh orang yang sama.")</script>';
        echo '<script>window.location.href="index.php"</script>';
        exit();
    }

    $query_cek = mysqli_query($db, "SELECT * FROM tbl_sidang WHERE kode_ruangan = '$kode_ruangan' AND tgl = '$tgl' AND ('$jam_mulai' < jam_selesai AND '$jam_selesai' > jam_mulai)") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data sidang sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_sidang VALUES (null , '$kode_ruangan', '$nim', '$tgl', '$nik_pembimbing', '$nik_penguji', '$jam_mulai', '$jam_selesai', '$status', '$judul') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data jadwal sidang berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
    }
}
?>