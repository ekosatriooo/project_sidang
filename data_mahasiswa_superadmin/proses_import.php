<?php
require_once '../database/koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['btn-import'])) {
    $file = $_FILES['file_mahasiswa']['name'];
    // pisahkan ekstensi dengan titik dari nama file
    $ekstensi = explode('.', $file);
    // membuat nama file unik
    $nama_file = 'file-'.round(microtime(true)).'.'.end($ekstensi);

    // mengambil alamat sumber (temporary atau sementara)
    $alamat_sumber = $_FILES['file_mahasiswa']['tmp_name'];
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
        $nama = $row[2];
        $kontak = $row[3];
        $email = $row[4];
        $kelamin = $row[5];

        // cek jika data kosong
        if ($nim == '' OR $nama == '' OR $kontak == '' OR $email == '' OR $kelamin == '') {
            continue; // skip perulangan
        }
        // cek data jurusan dari database (ambil data)
        $query_cek = mysqli_query($db, "SELECT * FROM tbl_mahasiswa WHERE nim = '$nim'") or die(mysqli_error($db));
        $rv = mysqli_num_rows($query_cek); // ambil jumlah data
        // cek jika datanya tidak ada di database
        if ($rv == 0) {
            $sandi = sha1($nim);
            $peran = "M";
            $pin = "12345";
            // simpan ke database
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_mahasiswa VALUES ('$nim', '$nama', '$kontak', '$email', '$kelamin', null)") or die(mysqli_error($db));
            $query_cek_pengguna = mysqli_query($db, "SELECT username FROM tbl_pengguna WHERE username = '$nim'") or die(mysqli_error($db));
            $rv_pengguna = mysqli_num_rows($query_cek_pengguna);
            if ($rv_pengguna == 0) {
                $query_simpan_pengguna = mysqli_query($db, "INSERT INTO tbl_pengguna VALUES (NULL, '$nim', '$sandi', '$peran', '$nama', '$pin')") or die(mysqli_error($db));
            }
        }
    }
    unlink($alamat_tujuan); // hapus file
    echo '<script>alert ("Data mahasiswa berhasil diimport")</script>';
    echo '<script>window.location.href="index.php"</script>';
}
?>