<?php
ob_start();
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

if (!isset($_POST['submission_id'])) {
    die('Ошибка: submission_id не передан');
}

$submission_id = (int)$_POST['submission_id'];

$student = $_POST['student_name'] ?? 'student';
$subject = $_POST['subject'] ?? 'subject';
$title = $_POST['title'] ?? 'homework';

$result = $conn->query("
    SELECT file_path 
    FROM submission_files 
    WHERE submission_id = {$submission_id}
    AND file_type = 'solution'
");

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = __DIR__ . "/../../" . $row['file_path'];
}

require_once(__DIR__ . '/lib/fpdf.php');

$pdf = new FPDF();

foreach ($images as $img) {
    if (!file_exists($img)) continue;

    $pdf->AddPage();
    $pdf->Image($img, 10, 10, 190);
}

// имя файла
$fileName = $student . '_' . $subject . '_' . $title . '.pdf';
$fileName = preg_replace('/[^A-Za-zА-Яа-я0-9_.]/u', '_', $fileName);

// ВАЖНО — корректная отдача файла


$pdfContent = $pdf->Output('S');

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$fileName.'"');
header('Content-Length: ' . strlen($pdfContent));

echo $pdfContent;

ob_end_flush();
exit;