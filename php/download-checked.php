<?php
$conn = new mysqli("localhost", "root", "root", "test");

$submission_id = $_GET['submission_id'];

$result = $conn->query("
    SELECT * FROM submission_files
    WHERE submission_id = $submission_id
    AND file_type = 'checked'
");

$files = [];

while ($row = $result->fetch_assoc()) {
    $files[] = "../" . $row['file_path'];
}

// если один файл — просто скачать
if (count($files) == 1) {
    $file = $files[0];

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);
    exit();
}

// если несколько — архив
$zip = new ZipArchive();
$zipName = "checked_" . $submission_id . ".zip";

$zip->open($zipName, ZipArchive::CREATE);

foreach ($files as $file) {
    $zip->addFile($file, basename($file));
}

$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipName . '"');
readfile($zipName);

unlink($zipName);