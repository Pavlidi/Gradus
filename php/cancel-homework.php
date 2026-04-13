<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit();
}

$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

$submission_id = (int)$_POST['submission_id'];

// 1. Получаем файлы
$result = $conn->query("
    SELECT file_path FROM submission_files
    WHERE submission_id = $submission_id
");

while ($row = $result->fetch_assoc()) {
    $file = "../" . $row['file_path'];
    if (file_exists($file)) {
        unlink($file); // удаляем файл с сервера
    }
}

// 2. Удаляем записи файлов
$conn->query("
    DELETE FROM submission_files
    WHERE submission_id = $submission_id
");

// 3. Удаляем саму отправку
$conn->query("
    DELETE FROM homework_submissions
    WHERE id = $submission_id
");

// готово
header("Location: ../account.php");
exit();