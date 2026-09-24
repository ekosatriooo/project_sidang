<?php
require_once '../database/koneksi.php';
require('../asset_adminlte/fpdf19/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../asset_adminlte/img/logo.png', 10, 12, 40);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 8, 'Fakulitas Sains Dan Teknologi', 0, 2, 'C');
        $this->Cell(30, 6, 'Prodi Informatika', 0, 2, 'C');

        $this->SetFont('Arial', '', 9);
        $this->Cell(30, 4, 'Jalan Raya Pagojengan KM 3, Kecamatan Paguyangan, Kab. Brebes', 0, 2, 'C');
        $this->Cell(30, 4, 'Provinsi Jawa Tengah, 52274', 0, 0, 'C');
        $this->SetLineWidth(1);
        $this->Line(10, 35, 200, 35);
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(80);
$pdf->Cell(30, 4, 'Data Dosen', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Times', '', 10);
$pdf->Cell(15, 6, 'No', 1, 0, 'C');
$pdf->Cell(25, 6, 'Nik', 1, 0, 'C');
$pdf->Cell(40, 6, 'Nama', 1, 0, 'C');
$pdf->Cell(35, 6, 'Kontak', 1, 0, 'C');
$pdf->Cell(50, 6, 'Email', 1, 0, 'C');
$pdf->Cell(30, 6, 'Jenis Kelamin', 1, 1, 'C');
$query_panggil_dosen = mysqli_query($db, "SELECT * FROM tbl_dosen")or die(mysqli_error($db));
$rv = mysqli_num_rows($query_panggil_dosen);
$no = 1;
if ($rv > 0) {
    while ($data = mysqli_fetch_array($query_panggil_dosen)) {
        $pdf->Cell(15, 6, $no++, 1, 0, 'C');
        $pdf->Cell(25, 6, $data['nik'] , 1, 0, 'L');
        $pdf->Cell(40, 6, $data['nama'], 1, 0, 'C');    
        $pdf->Cell(35, 6, $data['kontak'], 1, 0, 'C');    
        $pdf->Cell(50, 6, $data['email'], 1, 0, 'C');    
        $pdf->Cell(30, 6, $data['kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan', 1, 1, 'C');    
    }
}
$pdf->Output();
?>

