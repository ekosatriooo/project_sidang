<?php
require_once '../database/koneksi.php';

if(isset($_GET['id_sidang'])) {
    $hasil_scan = mysqli_real_escape_string($db, $_GET['id_sidang']);
    $nim = $_SESSION['user'];

    $pecah_data = explode("-", $hasil_scan);
    $id_sidang_asli = $pecah_data[0];
    $token_qr = isset($pecah_data[1]) ? $pecah_data[1] : '';

    if (empty($token_qr)) {
        echo '<script>alert("Gagal: Format QR Code tidak valid!");</script>';
        echo '<script>window.location.href="index.php"</script>';
        exit;
    }

    $token_sekarang = floor(time() / 60);
    
    if ($token_qr < ($token_sekarang - 1) || $token_qr > $token_sekarang) {
        echo '<script>alert("Gagal: QR Code sudah kadaluarsa! Silakan scan QR Code terbaru di layar.");</script>';
        echo '<script>window.location.href="index.php"</script>';
        exit; 
    }
    
    $query_ambil_status_pertemuan = mysqli_query($db, "SELECT status FROM tbl_sidang WHERE id = '$id_sidang_asli'")or die(mysqli_error($db));
    $data = mysqli_fetch_array($query_ambil_status_pertemuan);
    
    if ($data['status'] == 0) { 
        echo '<script>alert ("Presensi ini ditutup")</script>';
        echo '<script>window.location.href="index.php"</script>';
    } else {
        $query_status_kehadiran = mysqli_query($db, "SELECT status_kehadiran FROM tbl_presensi WHERE nim = '$nim' AND id_sidang = '$id_sidang_asli'")or die(mysqli_error($db));
        $data_presensi = mysqli_fetch_array($query_status_kehadiran);
        
        $kehadiran = isset($data_presensi['status_kehadiran']) ? $data_presensi['status_kehadiran'] : '';
        
        if ($kehadiran == 'hadir') {
            echo '<script>alert ("Kamu telah melakukan presensi ini")</script>';
            echo '<script>window.location.href="index.php"</script>';
        } else {
            $status_hadir = 'hadir';
            $query_update_kehadiran = mysqli_query($db, "UPDATE tbl_presensi SET status_kehadiran = '$status_hadir' WHERE nim = '$nim' AND id_sidang = '$id_sidang_asli'")or die(mysqli_error($db));
            
            if ($query_update_kehadiran) {
                echo '<script>alert ("Presensi berhasil")</script>';
            } else {
                echo '<script>alert ("Presensi gagal disimpan")</script>';
            }
            echo '<script>window.location.href="index.php"</script>';
        }
    }
}
?>