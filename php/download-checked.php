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

$files = [];

while ($row = $result->fetch_assoc()) {
    $files[] = __DIR__ . "/../" . $row['file_path'];
}

// если нет файлов
if (empty($files)) {
    die('Файлы не найдены');
}

// ==========================
// 🔥 ЕСЛИ 1 ФАЙЛ И ЭТО PDF → ОТКРЫВАЕМ
// ==========================
if (count($files) == 1) {

    $file = $files[0];

    if (!file_exists($file)) {
        die('Файл не найден');
    }

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if ($ext === 'pdf') {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="checked.pdf"');
        readfile($file);
        exit;
    }
}

// ==========================
// 📸 СОБИРАЕМ PDF ИЗ КАРТИНОК
// ==========================

// подключаем FPDF
require_once($_SERVER['DOCUMENT_ROOT'] . '/admin/php/lib/fpdf.php');

$pdf = new FPDF();

$hasImages = false;

foreach ($files as $file) {

    if (!file_exists($file)) continue;

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) continue;

    $hasImages = true;

    $pdf->AddPage();
    $pdf->Image($file, 10, 10, 190);
}

// если нет изображений → fallback
if (!$hasImages) {
    die('Нет поддерживаемых изображений');
}

// генерируем PDF
$pdfContent = $pdf->Output('S');

// открываем в браузере
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="checked_homework.pdf"');
header('Content-Length: ' . strlen($pdfContent));

echo $pdfContent;

ob_end_flush();
exit;