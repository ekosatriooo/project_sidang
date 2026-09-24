<?php
require_once "../database/koneksi.php";
// panggil library
require '../vendor/autoload.php'; 

// pangil fungsi dari phpspreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// buka buffering
ob_start();

// buat nama file
$nama_file = "Data-Dosen-" . date('Y-m-d');
// ambil data jurusan dari database
$query_panggil_dosen = mysqli_query($db, "SELECT * FROM tbl_dosen")or die(mysqli_error($db));
// buat spreadsheet dari fungsi phpsreadsheet
$spreadsheet = new Spreadsheet();
// ambil sheet yang aktif
$sheet = $spreadsheet->getActiveSheet();
// ubah judul sheet
$sheet->setTitle('Data Dosen');

// Set header cells
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nik');
$sheet->setCellValue('C1', 'Nama');
$sheet->setCellValue('D1', 'Kontak');
$sheet->setCellValue('E1', 'Email');
$sheet->setCellValue('F1', 'Jenis Kelamin');
// konfigurasi styling cell 
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['rgb' => '808080'],
        ],
    ],
];
// aplikasi dari konfigurasi styling style
$sheet->getStyle('A1:F1')->applyFromArray($styleArray);
// styling font menjadi bold pada cell yang dituju
$sheet->getStyle('A1:F1')->getFont()->setBold(true);
// styling lebar size mjd auto (sesuai panjang teks data)
foreach (array('A', 'B', 'C', 'D', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

$no = 1; // bikin nomor
$baris = 2; // bikin baris
// perulangan ambil data
while ($data = mysqli_fetch_assoc($query_panggil_dosen)) {
    // tampung data dari database
    $nik = $data['nik'];
    $nama = $data['nama'];
    $kontak = $data['kontak'];
    $email = $data['email'];
    $kelamin = $data['kelamin'];

    // isi nilai cell dengan data
    $sheet->setCellValue("A" . $baris, $no);
    $sheet->setCellValue("B" . $baris, $nik);
    $sheet->setCellValue("C" . $baris, $nama);
    $sheet->setCellValue("D" . $baris, $kontak);
    $sheet->setCellValue("E" . $baris, $email);
    $sheet->setCellValue("F" . $baris, $kelamin == ('L') ? 'Laki-Laki' : 'Perempuan');
    $baris++;
    $no++;
}

// Buat file excel
$filename = $nama_file . ".xlsx";
$writer = new Xlsx($spreadsheet);

ob_end_clean(); // Bersihkan output buffer

// Atur header untuk pengunduhan file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit();
?>