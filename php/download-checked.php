<?php
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

if (!isset($_GET['submission_id'])) {
    die('Ошибка');
}

$submission_id = (int)$_GET['submission_id'];

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
// ✅ ЕСЛИ 1 ФАЙЛ → ОТКРЫТЬ
// ==========================
if (count($files) == 1) {

    $file = $files[0];

    if (!file_exists($file)) {
        die('Файл не найден');
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="checked.pdf"');

    readfile($file);
    exit;
}

// ==========================
// ⚠️ ЕСЛИ НЕСКОЛЬКО → ZIP
// ==========================
$zip = new ZipArchive();
$zipName = __DIR__ . "/checked_" . $submission_id . ".zip";

$zip->open($zipName, ZipArchive::CREATE);

foreach ($files as $file) {
    if (file_exists($file)) {
        $zip->addFile($file, basename($file));
    }
}

$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="checked_'.$submission_id.'.zip"');

readfile($zipName);
unlink($zipName);
exit;