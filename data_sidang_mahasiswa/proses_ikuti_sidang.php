<?php
require_once '../database/koneksi.php';

if (isset($_GET['id_sidang'])) {
    $id_sidang = $_GET['id_sidang'];
    $nama_user = $_SESSION['nama'];

    $query_detail = mysqli_query($db, "SELECT s.*, m.nama AS nama_mhs, r.nama_ruangan 
        FROM tbl_sidang s 
        JOIN tbl_mahasiswa m ON s.nim = m.nim 
        JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan 
        WHERE s.id = '$id_sidang'") or die(mysqli_error($db));
        $data_detail = mysqli_fetch_array($query_detail);

        if ($data_detail['status'] == 'selesai') {
            echo '<script>alert("Sidang telah selesai. Anda tidak dapat bergabung lagi.");</script>';
            echo '<script>window.location.href="index.php"</script>';
            exit;
        }

    $query_mhs = mysqli_query($db, "SELECT nim FROM tbl_mahasiswa WHERE nama = '$nama_user'")or die(mysqli_error($db));
    $data_mhs = mysqli_fetch_array($query_mhs);

    if($data_mhs) {
        $nim = $data_mhs['nim'];
        $cek_absen = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE id_sidang = '$id_sidang' AND nim = '$nim'")or die(mysqli_error($db));
        $rv = mysqli_num_rows($cek_absen);

        if ($rv == 0) {
            $tgl = $data_detail['tgl'];
            $jam_mulai = $data_detail['jam_mulai'];
            $jam_selesai = $data_detail['jam_selesai'];
            $jenis = $data_detail['jenis_sidang'];
            $nama = $data_detail['nama_mhs'];
            $judul = mysqli_real_escape_string($db, $data_detail['judul']);
            $ruangan = $data_detail['nama_ruangan'];
            $status_kehadiran = "tidak_hadir";

            mysqli_query($db, "INSERT INTO tbl_presensi 
            (id, nim, nama, judul, nama_ruangan, status_kehadiran, tgl, jam_mulai, jam_selesai, jenis_sidang, id_sidang) 
            VALUES 
            (NULL, '$nim', '$nama', '$judul', '$ruangan', '$status_kehadiran', '$tgl', '$jam_mulai', '$jam_selesai', '$jenis', '$id_sidang')") 
            or die(mysqli_error($db));
        }
    }
    echo '<script>alert ("Berhasil memasuki sidang")</script>';
    echo '<script>window.location.href="presensi.php?id_sidang='.$id_sidang.'"</script>';
}
?>