<?php
ob_start();

$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

if (!isset($_GET['submission_id'])) {
    die('Ошибка');
}

$submission_id = (int)$_GET['submission_id'];

// получаем файлы
$result = $conn->query("
    SELECT file_path 
    FROM submission_files
    WHERE submission_id = $submission_id
    AND file_type = 'checked'
");

$images = [];

while ($row = $result->fetch_assoc()) {
    $images[] = __DIR__ . "/../" . $row['file_path'];
}

// если нет файлов
if (empty($images)) {
    die('Файлы не найдены');
}

// подключаем FPDF
require_once(__DIR__ . '/../admin/php/lib/fpdf.php');

$pdf = new FPDF();

foreach ($images as $img) {

    if (!file_exists($img)) continue;

    $pdf->AddPage();
    $pdf->Image($img, 10, 10, 190);
}

// генерируем PDF
$pdfContent = $pdf->Output('S');

// 🔥 открываем в браузере (НЕ скачиваем)
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="checked_homework.pdf"');
header('Content-Length: ' . strlen($pdfContent));

echo $pdfContent;

ob_end_flush();
exit;