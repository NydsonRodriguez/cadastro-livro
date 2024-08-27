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
$sheet->setCellValue('B1', 'Título');// This is where you set the column header
$sheet->setCellValue('C1', 'Editora');// This is where you set the column header
$sheet->setCellValue('D1', 'Edição');// This is where you set the column header
$sheet->setCellValue('E1', 'Ano Publicação');// This is where you set the column header
$sheet->setCellValue('F1', 'Autor');// This is where you set the column header
$sheet->setCellValue('G1', 'Assunto');// This is where you set the column header
$row = 2;// Initialize row counter

// This is the loop to populate data
$res = \App\Models\Livro::with('autor', 'assunto')->get()->toArray();
foreach ($res as $val) {
    $sheet->setCellValue('A' . $row, $val["Codl"]);
    $sheet->setCellValue('B' . $row, $val["Titulo"]);
    $sheet->setCellValue('C' . $row, $val["Editora"]);
    $sheet->setCellValue('D' . $row, $val["Edicao"]);
    $sheet->setCellValue('E' . $row, $val["AnoPublicacao"]);

    // Autor
    if(count($val["autor"]) > 0) {
        $nomeAutor = "";
        foreach ($val["autor"] as $autor) {
            $nomeAutor .= $autor["Nome"] . ', ';
        }

        $sheet->setCellValue('F' . $row, $nomeAutor);
    }

    // Assunto
    if(count($val["assunto"]) > 0 && isset($val["assunto"][0])) {
        $sheet->setCellValue('G' . $row, $val["assunto"][0]["Descricao"]);
    }

    $row++;
}

$writer = new Xlsx($spreadsheet);
$fileName = "relatorio-livro.xlsx";
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"$fileName\"");
$writer->save("php://output");
exit();

// $res = \App\Models\Livro::with('autor', 'assunto')->get()->toArray();
// foreach ($res as $val) {
//     if(count($val["autor"]) > 0) {
//         foreach ($val["autor"] as $autor) {
//             $autor["Nome"] . ', ';
//         }
//     }

//     if(count($val["assunto"]) > 0 && isset($val["assunto"][0])) {
//         $val["assunto"][0]["Descricao"];
//     }

// }
?>



