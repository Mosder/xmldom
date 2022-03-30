<?php
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="excelus.xlsx"');
header('Cache-Control: max-age=0');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$spreadsheet = new Spreadsheet();

$doc = new DOMDocument();
$doc->load("xmlus.xml");
$sheet = $spreadsheet->getActiveSheet();
$rows = $doc->getElementsByTagName('row');

$sheet->setCellValue('A1', "Name");
$sheet->setCellValue('B1', "Thumbnail");
$sheet->setCellValue('C1', "Author");
$sheet->setCellValue('D1', "Magazine");
function getValue($row, $tagName) {
    return $row->getElementsByTagName($tagName)->item(0)->nodeValue;
}
foreach($doc->getElementsByTagName("row") as $index=>$row) {
  $sheet->setCellValue('A' . ($index + 2), getValue($row, "name"));
  $sheet->setCellValue('B' . ($index + 2), getValue($row, "src"));
  $sheet->setCellValue('C' . ($index + 2), getValue($row, "author"));
  $sheet->setCellValue('D' . ($index + 2), getValue($row, "origin"));

  $comment = $sheet->getComment('B' . ($index + 2));
  if (file_exists('./imgs/' . getValue($row, "src"))) {
    $drawing = new Drawing();
    $drawing->setName('Gfx');
    $drawing->setPath('./imgs/' . getValue($row, "src"));
    $drawing->setHeight(200); // ewentualna wielkość
    $comment->setBackgroundImage($drawing);
    $comment->setSizeAsBackgroundImage(); //jeśli chcemy komentarz wielkości obrazka
  }
  else {
    $comment->getText()->createTextRun("image doesn't exist");
  }
}

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
$sheet->disconnectWorksheets();
