<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah-peserta'])) {
    $id_sidang = trim(mysqli_real_escape_string($db, $_POST['id_sidang']));
    $nim = trim(mysqli_real_escape_string($db, $_POST['nim']));

    $query_cek = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE nim = '$nim' AND id_sidang = '$id_sidang'") or die(mysqli_error($db));
    $rv = mysqli_num_rows($query_cek);
    
    if ($rv > 0) {
        echo '<script>
                alert("Mahasiswa sudah terdaftar di sidang");
                window.location.href="presensi.php?id_sidang='.$id_sidang.'";
              </script>';
    } else {
        $query_detail = mysqli_query($db, "SELECT s.*, m.nama AS nama_mhs, r.nama_ruangan 
            FROM tbl_sidang s 
            JOIN tbl_mahasiswa m ON s.nim = m.nim 
            JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan 
            WHERE s.id = '$id_sidang'") or die(mysqli_error($db));
            
        $data_detail = mysqli_fetch_array($query_detail);

        if ($data_detail) {
            $tgl = $data_detail['tgl'];
            $jam_mulai = $data_detail['jam_mulai'];
            $jam_selesai = $data_detail['jam_selesai'];
            $jenis = $data_detail['jenis_sidang'];
            $nama = $data_detail['nama_mhs'];
            $judul = mysqli_real_escape_string($db, $data_detail['judul']);
            $ruangan = $data_detail['nama_ruangan'];
            $status_kehadiran = 'tidak_hadir';
            
            $query_simpan = mysqli_query($db, "INSERT INTO tbl_presensi 
            (id, nim, nama, judul, nama_ruangan, status_kehadiran, tgl, jam_mulai, jam_selesai, jenis_sidang, id_sidang) 
            VALUES 
            (NULL, '$nim', '$nama', '$judul', '$ruangan', '$status_kehadiran', '$tgl', '$jam_mulai', '$jam_selesai', '$jenis', '$id_sidang')") 
            or die(mysqli_error($db));
            
            if($query_simpan) {
                echo '<script>
                        alert("Berhasil menambahkan peserta");
                        window.location.href="presensi.php?id_sidang='.$id_sidang.'";
                      </script>';
            }
        }
    }
}
?>