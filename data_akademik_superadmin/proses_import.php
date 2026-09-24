<?php
require_once '../database/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['btn-import'])) {
    $file = $_FILES['file_akademik']['name'];
    // pisahkan ekstensi dengan titik dari nama file
    $ekstensi = explode('.', $file);
    // membuat nama file unik
    $nama_file = 'file-'.round(microtime(true)).'.'.end($ekstensi);

    // mengambil alamat sumber (temporary atau sementara)
    $alamat_sumber = $_FILES['file_akademik']['tmp_name'];
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
        $kode_akd = $row[1];
        $semester = $row[2];
        $tahun = $row[3];
        $status = $row[4];

        // cek jika data kosong
        if ($kode_akd == '' OR $semester == '' OR $tahun == '' OR $status == '') {
            continue; // skip perulangan
        }
        // cek data akademik dari database (ambil data)
        $query_cek = mysqli_query($db, "SELECT * FROM tbl_akademik WHERE kode_akd = '$kode_akd'") or die(mysqli_error($db));
        $rv = mysqli_num_rows($query_cek); // ambil jumlah data
        // cek jika datanya tidak ada di database
        if ($rv == 0) {
            // simpan ke database
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_akademik VALUES ('$kode_akd', '$semester', '$tahun', '$status')") or die(mysqli_error($db));
        }
    }
    unlink($alamat_tujuan); // hapus file
    echo '<script>alert ("Data akademik berhasil diimport")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>