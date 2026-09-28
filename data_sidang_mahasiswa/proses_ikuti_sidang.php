<?php
require_once '../database/koneksi.php';

if (isset($_GET['id_sidang'])) {
    $id_sidang = $_GET['id_sidang'];
    $nama_user = $_SESSION['nama'];

    $cek_sidang = mysqli_query($db, "SELECT status FROM tbl_sidang WHERE id = '$id_sidang'") or die(mysqli_error($db));
    $data_sidang = mysqli_fetch_array($cek_sidang);

    if ($data_sidang['status'] == 'selesai') {
        echo '<script>alert("Sidang telah selesai. Anda tidak dapat bergabung lagi.");</script>';
        echo '<script>window.location.href="index.php"</script>';
    }

    $query_mhs = mysqli_query($db, "SELECT nim FROM tbl_mahasiswa WHERE nama = '$nama_user'")or die(mysqli_error($db));
    $data_mhs = mysqli_fetch_array($query_mhs);

    if($data_mhs) {
        $nim = $data_mhs['nim'];

        $cek_absen = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE id_sidang = '$id_sidang' AND nim = '$nim'")or die(mysqli_error($db));
        $rv = mysqli_num_rows($cek_absen);

        if ($rv == 0) {
            mysqli_query($db, "INSERT INTO tbl_presensi (id, nim, status_kehadiran, id_sidang) VALUES (NULL, '$nim', 'tidak_hadir', '$id_sidang')");
        }
    }

    echo '<script>window.location.href="presensi.php?id_sidang='.$id_sidang.'"</script>';
}
?>