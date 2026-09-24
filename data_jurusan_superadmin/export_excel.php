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
$nama_file = "Data-Jurusan-" . date('Y-m-d');
// ambil data jurusan dari database
$query_panggil_jurusan = mysqli_query($db, "SELECT * FROM tbl_jurusan")or die(mysqli_error($db));
// buat spreadsheet dari fungsi phpsreadsheet
$spreadsheet = new Spreadsheet();
// ambil sheet yang aktif
$sheet = $spreadsheet->getActiveSheet();
// ubah judul sheet
$sheet->setTitle('Data Jurusan');

// Set header cells
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Kode Jurusan');
$sheet->setCellValue('C1', 'Nama Jurusan');
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
$sheet->getStyle('A1:C1')->applyFromArray($styleArray);
// styling font menjadi bold pada cell yang dituju
$sheet->getStyle('A1:C1')->getFont()->setBold(true);
// styling lebar size mjd auto (sesuai panjang teks data)
foreach (array('A', 'B', 'C') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

$no = 1; // bikin nomor
$baris = 2; // bikin baris
// perulangan ambil data
while ($data = mysqli_fetch_assoc($query_panggil_jurusan)) {
    // tampung data dari database
    $kode = $data['kode_jurusan'];
    $nama = $data['nama_jurusan'];

    // isi nilai cell dengan data
    $sheet->setCellValue("A" . $baris, $no);
    $sheet->setCellValue("B" . $baris, $kode);
    $sheet->setCellValue("C" . $baris, $nama);
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