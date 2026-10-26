<?php
require_once '../database/koneksi.php';

if (isset($_POST['btn-tambah-peserta'])) {
    $id_sidang = trim(mysqli_real_escape_string($db, $_POST['id_sidang']));
    $nim_peserta = trim(mysqli_real_escape_string($db, $_POST['nim'])); 

    $query_kuota = mysqli_query($db, "SELECT r.kuota 
        FROM tbl_sidang s 
        JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan 
        WHERE s.id = '$id_sidang'") or die(mysqli_error($db));
    $data_kuota = mysqli_fetch_array($query_kuota);
    $batas_kuota = $data_kuota['kuota'];

    $query_hitung = mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_presensi WHERE id_sidang = '$id_sidang'") or die(mysqli_error($db));
    $data_hitung = mysqli_fetch_array($query_hitung);
    $total_peserta = $data_hitung['total'];

    if ($total_peserta >= $batas_kuota) {
        echo '<script>
                alert("Gagal menambahkan peserta: Kuota ruangan penuh!");
                window.location.href="presensi.php?id_sidang='.$id_sidang.'";
              </script>';
        exit; 
    }

    $query_sidang = mysqli_query($db, "SELECT s.tgl, s.jam_mulai, s.jam_selesai, s.jenis_sidang, s.judul, r.nama_ruangan 
        FROM tbl_sidang s 
        JOIN tbl_ruangan r ON s.kode_ruangan = r.kode_ruangan 
        WHERE s.id = '$id_sidang'") or die(mysqli_error($db));
    $data_sidang = mysqli_fetch_array($query_sidang);

    $query_mhs = mysqli_query($db, "SELECT nama FROM tbl_mahasiswa WHERE nim = '$nim_peserta'");
    $data_mhs = mysqli_fetch_array($query_mhs);

    if ($data_sidang && $data_mhs) {
        $nama_peserta = $data_mhs['nama'];
        $judul = mysqli_real_escape_string($db, $data_sidang['judul']);
        $ruangan = $data_sidang['nama_ruangan'];
        $tgl = $data_sidang['tgl'];
        $jam_mulai = $data_sidang['jam_mulai'];
        $jam_selesai = $data_sidang['jam_selesai'];
        $jenis = $data_sidang['jenis_sidang'];
        $status_kehadiran = 'tidak_hadir';
        
        $query_simpan = mysqli_query($db, "INSERT INTO tbl_presensi 
        (id, nim, nama, judul, nama_ruangan, status_kehadiran, tgl, jam_mulai, jam_selesai, jenis_sidang, id_sidang) 
        VALUES 
        (NULL, '$nim_peserta', '$nama_peserta', '$judul', '$ruangan', '$status_kehadiran', '$tgl', '$jam_mulai', '$jam_selesai', '$jenis', '$id_sidang')") 
        or die(mysqli_error($db));
        
        if($query_simpan) {
            $sisa_kuota = $batas_kuota - $total_peserta - 1;
            echo '<script>
                    alert("Berhasil menambahkan peserta");
                    window.location.href="presensi.php?id_sidang='.$id_sidang.'";
                  </script>';
        }
    }
}
?>