<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $id_sidang = trim(mysqli_real_escape_string($db, $_POST['id_sidang']));
    $kode_ruangan = trim(mysqli_real_escape_string($db, $_POST['kode_ruangan']));
    $mahasiswa = trim(mysqli_real_escape_string($db, $_POST['mahasiswa']));
    $jurusan = trim(mysqli_real_escape_string($db, $_POST['jurusan']));
    $pembimbing = trim(mysqli_real_escape_string($db, $_POST['pembimbing']));
    $penguji = trim(mysqli_real_escape_string($db, $_POST['penguji']));
    $tanggal = trim(mysqli_real_escape_string($db, $_POST['tanggal']));
    $jam_mulai = trim(mysqli_real_escape_string($db, $_POST['jam_mulai']));
    $jam_selesai = trim(mysqli_real_escape_string($db, $_POST['jam_selesai']));
    $status = trim(mysqli_real_escape_string($db, $_POST['status']));
    $judul = trim(mysqli_real_escape_string($db, $_POST['judul']));

    $query_edit = mysqli_query($db, "UPDATE tbl_sidang SET kode_ruangan = '$kode_ruangan', nim = '$mahasiswa', jurusan = '$jurusan',nik_pembimbing = '$pembimbing', nik_penguji = '$penguji', tgl = '$tanggal', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', status = '$status', judul = '$judul' WHERE id = '$id_sidang'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data sidang berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>