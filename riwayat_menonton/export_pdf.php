<?php
require_once '../database/koneksi.php';
require('../asset_adminlte/fpdf19/fpdf.php');

$user = $_SESSION['user'];
$nama_user = $_SESSION['nama'];

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->Image('../asset_adminlte/dist/img/LogoUniv.png', 10, 12, 20);

        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);

        // Move to the right
        $this->Cell(80);

        // Title
        $this->Cell(30, 8, 'Fakultas Sains Dan Teknologi', 0, 2, 'C');
        $this->Cell(30, 6, 'Prodi Informatika', 0, 2, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(30, 4, 'Jalan Raya Pagojengan KM 3, Kecamatan Paguyangan, Kab. Brebes', 0, 2, 'C');
        $this->Cell(30, 4, 'Provinsi Jawa Tengah, 52274', 0, 0, 'C');
        $this->SetLineWidth(1);
        $this->Line(10, 35, 200, 35);
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 6, 'DATA RIWAYAT KEHADIRAN SIDANG', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(15, 6, 'NIM', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'C');
$pdf->Cell(100, 6, $user, 0, 1, 'L');

$pdf->Cell(15, 6, 'Nama', 0, 0, 'L');
$pdf->Cell(5, 6, ':', 0, 0, 'C');
$pdf->Cell(100, 6, $nama_user, 0, 1, 'L');
$pdf->Ln(3);

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
$pdf->Cell(20, 6, 'Jam', 1, 0, 'C');
$pdf->Cell(60, 6, 'Mahasiswa', 1, 0, 'C');
$pdf->Cell(25, 6, 'Jenis Sidang', 1, 0, 'C');
$pdf->Cell(20, 6, 'Ruang', 1, 0, 'C');
$pdf->Cell(25, 6, 'Status', 1, 1, 'C');

$pdf->SetFont('Times', '', 10);

$cek_query = mysqli_query($db, "SELECT * FROM tbl_presensi WHERE nim = '$user' ORDER BY tgl ASC") or die(mysqli_error($db));

$rv = mysqli_num_rows($cek_query);
$no = 1;

if ($rv > 0) {
    while ($data = mysqli_fetch_array($cek_query)) {
        $tanggal_format = date('d M Y', strtotime($data['tgl']));
        $jam_format = date('H:i', strtotime($data['jam_mulai'])) . '-' . date('H:i', strtotime($data['jam_selesai']));
        
        $nama_penyaji = (strlen($data['nama']) > 25) ? substr($data['nama'], 0, 25) . '...' : $data['nama'];
        
        $status = ucwords(str_replace('_', ' ', $data['status_kehadiran']));

        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(30, 6, $tanggal_format, 1, 0, 'C');
        $pdf->Cell(20, 6, $jam_format, 1, 0, 'C');
        $pdf->Cell(60, 6, $nama_penyaji, 1, 0, 'L');
        $pdf->Cell(25, 6, $data['jenis_sidang'], 1, 0, 'C');
        $pdf->Cell(20, 6, $data['nama_ruangan'], 1, 0, 'C');
        $pdf->Cell(25, 6, $status, 1, 1, 'C'); 
    }
} else {
    $pdf->Cell(190, 6, 'Belum ada riwayat kehadiran.', 1, 1, 'C');
}

$pdf->Output('I', 'Riwayat_Kehadiran_'.$user.'.pdf');
?>