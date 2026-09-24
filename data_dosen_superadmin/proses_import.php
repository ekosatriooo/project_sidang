<?php
require_once '../database/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['btn-import'])) {
    $file = $_FILES['file_dosen']['name'];
    // pisahkan ekstensi dengan titik dari nama file
    $ekstensi = explode('.', $file);
    // membuat nama file unik
    $nama_file = 'file-'.round(microtime(true)).'.'.end($ekstensi);

    // mengambil alamat sumber (temporary atau sementara)
    $alamat_sumber = $_FILES['file_dosen']['tmp_name'];
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
        $nik = $row[1];
        $nama = $row[2];
        $kontak = $row[3];
        $email = $row[4];
        $kelamin = $row[5];

        // cek jika data kosong
        if ($nik == '' OR $nama == '' OR $kontak == '' OR $email == '' OR $kelamin == '') {
            continue; // skip perulangan
        }
        // cek data jurusan dari database (ambil data)
        $query_cek = mysqli_query($db, "SELECT * FROM tbl_dosen WHERE nik = '$nik'") or die(mysqli_error($db));
        $rv = mysqli_num_rows($query_cek); // ambil jumlah data
        // cek jika datanya tidak ada di database
        if ($rv == 0) {
            $sandi = sha1($nik);
            $peran = "D";
            $pin = "12345";
            // simpan ke database
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_dosen VALUES ('$nik', '$nama', '$kontak', '$email', '$kelamin', null)") or die(mysqli_error($db));
            $query_cek_pengguna = mysqli_query($db, "SELECT username FROM tbl_pengguna WHERE username = '$nik'") or die(mysqli_error($db));
            $rv_pengguna = mysqli_num_rows($query_cek_pengguna);
            if ($rv_pengguna == 0) {
                $query_simpan_pengguna = mysqli_query($db, "INSERT INTO tbl_pengguna VALUES (NULL, '$nik', '$sandi', '$peran', '$nama', '$pin')") or die(mysqli_error($db));
            }
        }
    }
    unlink($alamat_tujuan); // hapus file
    echo '<script>alert ("Data dosen berhasil diimport")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>