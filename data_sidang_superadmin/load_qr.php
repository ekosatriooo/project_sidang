<?php
// load_qr.php
require_once '../database/koneksi.php';
include('../asset_adminlte/phpqrcode/qrlib.php');

if (isset($_GET['id_sidang'])) {
    $id_sidang = mysqli_real_escape_string($db, $_GET['id_sidang']);
    
    $token_waktu = floor(time() / 300); 
    
    $isi_qr = $id_sidang . "-" . $token_waktu; 

    $fileName = 'qr_sidang_' . $id_sidang . '.png';
    $alamat_tujuan = 'qr/' . $fileName;

    if (!file_exists('qr')) {
        mkdir('qr', 0777, true);
    }

    if(file_exists($alamat_tujuan)){
        unlink($alamat_tujuan);
    }

    QRcode::png($isi_qr, $alamat_tujuan);

    echo '<img src="'.$alamat_tujuan.'?v='.time().'" alt="QR Code" style="width:200px" class="img-thumbnail">';
    echo '<br><small class="text-danger mt-2 font-weight-bold"><i>*QR Code mereset otomatis 5 menit sekali</i></small>';
}
?>