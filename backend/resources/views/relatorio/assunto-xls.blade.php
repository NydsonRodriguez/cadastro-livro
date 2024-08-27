<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Sheet 1'); // This is where you set the title
$sheet->setCellValue('A1', 'ID'); // This is where you set the column header
$sheet->setCellValue('B1', 'Descrição');// This is where you set the column header
$row = 2;// Initialize row counter

// This is the loop to populate data
$res = DB::table('Assunto')->select('CodAs','Descricao')->get()->toArray();
foreach ($res as $val) {
    $sheet->setCellValue('A' . $row, $val->CodAs);
    $sheet->setCellValue('B' . $row, $val->Descricao);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$fileName = "relatorio-assunto.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"$fileName\"");
$writer->save("php://output");
exit();
?>
