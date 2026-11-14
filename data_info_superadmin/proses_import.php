<?php
require_once '../database/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['btn-import'])) {
    $file = $_FILES['file_info']['name'];
    // pisahkan ekstensi dengan titik dari nama file
    $ekstensi = explode('.', $file);
    // membuat nama file unik
    $nama_file = 'file-'.round(microtime(true)).'.'.end($ekstensi);

    // mengambil alamat sumber (temporary atau sementara)
    $alamat_sumber = $_FILES['file_info']['tmp_name'];
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
    // print_r($data);
    // perulangan membaca array
    foreach ($data as $indeks => $row) {
        // cek ini kolom judul
        if ($indeks == 0) {
            continue; // skip perulangan
        }
        // tampung data dari excel ke variabel berdasarkan kolom
        $nim = $row[1];
        $jurusan = $row[2];
        $nik = $row[3];

        // cek jika data kosong
        if ($nim == '' OR $jurusan == '' OR $nik == '') {
            continue; // skip perulangan
        }
        // cek data dari database (ambil data)
        $cek_mhs   = mysqli_query($db, "SELECT nim FROM tbl_mahasiswa WHERE nim = '$nim'") or die(mysqli_error($db));
        $cek_dosen = mysqli_query($db, "SELECT nik FROM tbl_dosen WHERE nik = '$nik'") or die(mysqli_error($db));
        $rv_mhs = mysqli_num_rows($cek_mhs); // ambil jumlah data
        $rv_dosen = mysqli_num_rows($cek_dosen); // ambil jumlah data
        if ($rv_mhs == 0 || $rv_dosen == 0) {
            continue;
        }
        $cek_info = mysqli_query($db, "SELECT * FROM tbl_info WHERE nim = '$nim'") or die(mysqli_error($db));
        $rv_info = mysqli_num_rows($cek_info);
        if ($rv_info > 0) {
            continue;
        } else {
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_info VALUES (null, '$nim', '$nik', '$jurusan')") or die(mysqli_error($db));
        }
    }
    unlink($alamat_tujuan); // hapus file
    echo '<script>alert ("Data berhasil diimport")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>