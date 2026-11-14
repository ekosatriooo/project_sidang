<?php
require_once '../database/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['btn-import'])) {
    $file = $_FILES['file_sidang']['name'];
    // pisahkan ekstensi dengan titik dari nama file
    $ekstensi = explode('.', $file);
    // membuat nama file unik
    $nama_file = 'file-'.round(microtime(true)).'.'.end($ekstensi);

    // mengambil alamat sumber (temporary atau sementara)
    $alamat_sumber = $_FILES['file_sidang']['tmp_name'];
    // membuat alamat tujuan atau alamat file disimpan
    $alamat_tujuan = 'template/'.$nama_file;
    // upload file (pindahkan file dari alamat sumber)
    move_uploaded_file($alamat_sumber, $alamat_tujuan);

    // membaca file excel
    $spreadsheet = IOFactory::load($alamat_tujuan);
    // membaca sheet yang aktif
    $sheet = $spreadsheet->getActiveSheet();
    // tampung data jadikan array
    $data = $sheet->toArray();

    $berhasil = 0;
    $gagal = 0;
    // print_r($data);
    // perulangan membaca array
    foreach ($data as $indeks => $row) {
        // cek ini kolom judul
        if ($indeks == 0) {
            continue; // skip perulangan
        }
        // tampung data dari excel ke variabel berdasarkan kolom
        $kode_ruangan = $row[1];
        $nim = $row[2];
        $jurusan = $row[3];
        $tgl = $row[4];
        $nik_pembimbing = $row[5];
        $nik_penguji = $row[6];
        $jam_mulai = $row[7];
        $jam_selesai = $row[8];
        $status = $row[9];
        $judul = $row[10];

        // cek jika data kosong
        if ($kode_ruangan == '' OR $nim == '' OR $jurusan == '' OR $tgl == '' OR $nik_pembimbing == '' OR $nik_penguji == '' OR $jam_mulai == '' OR $jam_selesai == '' OR $status == '' OR $judul == '') {
            continue; // skip perulangan
        }

        $cek_info = mysqli_query($db, "SELECT nik_pembimbing, jurusan FROM tbl_info WHERE nim = '$nim'") or die(mysqli_error($db));
        if (mysqli_num_rows($cek_info) == 0) {
            $gagal++;
            continue;
        }
        $data_info      = mysqli_fetch_assoc($cek_info);
        $nik_pembimbing = $data_info['nik_pembimbing'];
        $jurusan        = $data_info['jurusan'];

        $cek_nim_sidang = mysqli_query($db, "SELECT nim FROM tbl_sidang WHERE nim = '$nim'") or die(mysqli_error($db));
        if (mysqli_num_rows($cek_nim_sidang) > 0) {
            $gagal++;
            continue;
        }

        $cek_ruangan = mysqli_query($db, "SELECT kode_ruangan FROM tbl_ruangan WHERE kode_ruangan = '$kode_ruangan'") or die(mysqli_error($db));
        if (mysqli_num_rows($cek_ruangan) == 0) {
            $gagal++;
            continue;
        }

        $cek_penguji = mysqli_query($db, "SELECT nik FROM tbl_dosen WHERE nik = '$nik_penguji'") or die(mysqli_error($db));
        if (mysqli_num_rows($cek_penguji) == 0 || $nik_pembimbing == $nik_penguji) {
            $gagal++;
            continue;
        }

        $query_cek = mysqli_query($db, "SELECT * FROM tbl_sidang WHERE kode_ruangan = '$kode_ruangan' AND tgl = '$tgl' AND ('$jam_mulai' < jam_selesai AND '$jam_selesai' > jam_mulai)") or die(mysqli_error($db));
        if (mysqli_num_rows($query_cek) > 0) {
            $gagal++;
            continue;
        }

        $query_simpan = mysqli_query($db, "INSERT INTO tbl_sidang VALUES (null, '$kode_ruangan', '$nim', '$jurusan', '$tgl', '$nik_pembimbing', '$nik_penguji', '$jam_mulai', '$jam_selesai', '$status', '$judul')") or die(mysqli_error($db));
        if ($query_simpan) {
            $berhasil++;
        }
    }
    unlink($alamat_tujuan); // hapus file
    echo '<script>alert ("Data jadwal sidang berhasil diimport")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>