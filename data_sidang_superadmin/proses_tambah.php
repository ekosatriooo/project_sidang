<?php
require_once '../database/koneksi.php';

if(isset($_POST['btn-tambah'])) {
    $kode_akd = trim(mysqli_real_escape_string($db, $_POST['kode_akd']));
    $kode_jurusan = trim(mysqli_real_escape_string($db, $_POST['kode_jurusan']));
    $kode_ruangan = trim(mysqli_real_escape_string($db, $_POST['kode_ruangan']));
    $mahasiswa = trim(mysqli_real_escape_string($db, $_POST['mahasiswa']));
    $pembimbing1 = trim(mysqli_real_escape_string($db, $_POST['pembimbing1']));
    $pembimbing2 = trim(mysqli_real_escape_string($db, $_POST['pembimbing2']));
    $penguji1 = trim(mysqli_real_escape_string($db, $_POST['penguji1']));
    $penguji2 = trim(mysqli_real_escape_string($db, $_POST['penguji2']));
    $tanggal = trim(mysqli_real_escape_string($db, $_POST['tanggal']));
    $jam_mulai = trim(mysqli_real_escape_string($db, $_POST['jam_mulai']));
    $jam_selesai = trim(mysqli_real_escape_string($db, $_POST['jam_selesai']));
    $jenis_sidang = trim(mysqli_real_escape_string($db, $_POST['sidang']));
    $judul = trim(mysqli_real_escape_string($db, $_POST['judul']));
    $status = "Dijadwalkan";

    $query_cek = mysqli_query($db, "SELECT * FROM tbl_sidang WHERE kode_akd = '$kode_akd' AND kode_jurusan = '$kode_jurusan' AND kode_ruangan = '$kode_ruangan' AND nim = '$mahasiswa' AND jenis_sidang = '$jenis_sidang' AND tgl = '$tanggal' AND nik_pembimbing_1 = '$pembimbing1' AND nik_pembimbing_2 = '$pembimbing2' AND nik_penguji_1 = '$penguji1' AND nik_penguji_2 = '$penguji2' AND jam_mulai = '$jam_mulai' AND jam_selesai = '$jam_selesai' AND status = '$status'") or die (mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    if ($rv > 0) {
        echo '<script>alert ("Data sidang sudah terdaftar")</script>';
        echo '<script>window.location.href="index.php"</script>';
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_sidang VALUES (null , '$kode_akd', '$kode_jurusan', '$kode_ruangan', '$mahasiswa', '$jenis_sidang', '$tanggal', '$pembimbing1', '$pembimbing2', '$penguji1', '$penguji2', '$jam_mulai', '$jam_selesai', '$status', '$judul') ") or die(mysqli_error($db));
            echo '<script>alert ("Tambah data sidang berhasil")</script>';
            echo '<script>window.location.href="index.php"</script>';
    }
            
}
?>