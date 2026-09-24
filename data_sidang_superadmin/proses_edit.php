<?php
require_once '../database/koneksi.php';
if (isset($_POST['btn-edit'])) {
    $id_sidang = trim(mysqli_real_escape_string($db, $_POST['id_sidang']));
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
    $status = trim(mysqli_real_escape_string($db, $_POST['status']));
    $catatan = trim(mysqli_real_escape_string($db, $_POST['catatan']));

    $query_edit_ruangan = mysqli_query($db, "UPDATE tbl_sidang SET kode_akd = '$kode_akd', kode_jurusan = '$kode_jurusan', kode_ruangan = '$kode_ruangan', nim = '$mahasiswa', nik_pembimbing_1 = '$pembimbing1', nik_pembimbing_2 = '$pembimbing2', nik_penguji_1 = '$penguji1', nik_penguji_2 = '$penguji2', tgl = '$tanggal', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', jenis_sidang = '$jenis_sidang', status = '$status', catatan = '$catatan' WHERE id = '$id_sidang'") or die(mysqli_error($db));
        echo '<script>alert ("Edit data sidang berhasil")</script>';
        echo '<script>window.location.href="index.php"</script>';
}
?>