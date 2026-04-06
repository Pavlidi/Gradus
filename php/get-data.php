<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['student_id'])) {
    echo json_encode(["error" => "not_auth"]);
    exit();
}

$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

$student_id = $_SESSION['student_id'];

// 👉 получаем пользователя
$stmt = $conn->prepare("
    SELECT * FROM users_info 
    WHERE id = ?
    LIMIT 1
");
$stmt->bind_param("i", $student_id);
$stmt->execute();

$student = $stmt->get_result()->fetch_assoc();

if (!$student) {
    echo json_encode(["error" => "no_user"]);
    exit();
}

// 👉 базовые данные
$fullName = ($student['student_lastname'] ?? '') . ' ' . ($student['student_firstname'] ?? '');
$group = $student['group_number'] ?? 0;

$subject = $_GET['subject'] ?? $student['subject_1'] ?? 'Математика';

// =====================================
// 📊 СТАТИСТИКА
// =====================================

$lastname = $student['student_lastname'];
$firstname = $student['student_firstname'];

// настройки графика
$stmt = $conn->prepare("
    SELECT lines_count, step 
    FROM test_results
    WHERE student_lastname = ? 
    AND student_firstname = ?
    AND subject = ?
    LIMIT 1
");

$stmt->bind_param("sss", $lastname, $firstname, $subject);
$stmt->execute();

$resultChart = $stmt->get_result()->fetch_assoc();

$linesCount = $resultChart['lines_count'] ?? 10;
$step = $resultChart['step'] ?? 10;

// сами значения
$stmt = $conn->prepare("
    SELECT * 
    FROM test_results
    WHERE student_lastname = ? 
    AND student_firstname = ?
    AND subject = ?
    LIMIT 1
");

$stmt->bind_param("sss", $lastname, $firstname, $subject);
$stmt->execute();

$testData = $stmt->get_result()->fetch_assoc() ?? [];

$monthsKeys = [
    'september',
    'october',
    'november',
    'december',
    'january',
    'february',
    'march',
    'april',
    'may'
];

$chart = [];

foreach ($monthsKeys as $key) {
    $chart[] = intval($testData[$key] ?? 0);
}

// =====================================
// 📚 АКТИВНЫЕ ДОМАШКИ
// =====================================

$active = $conn->prepare("
    SELECT * FROM homeworks h
    WHERE 
        (
            (h.target_type = 'student' AND h.target_value = ?)
            OR
            (h.target_type = 'group' AND h.target_value = ?)
        )
        AND h.subject = ?
        AND NOT EXISTS (
            SELECT 1 FROM homework_submissions hs
            WHERE hs.homework_id = h.id
            AND hs.student_name = ?
        )
    ORDER BY h.homework_date ASC
");

$active->bind_param("ssss", $fullName, $group, $subject, $fullName);
$active->execute();

$activeResult = $active->get_result();

$activeHW = [];

while ($hw = $activeResult->fetch_assoc()) {
    $activeHW[] = [
        "id" => $hw['id'],
        "title" => $hw['title'],
        "date" => $hw['homework_date'],
        "file" => $hw['file_path'] ?? null
    ];
}

// =====================================
// 📦 АРХИВ ДОМАШЕК
// =====================================

$archive = $conn->prepare("
    SELECT hs.*, h.title, h.homework_date
    FROM homework_submissions hs
    JOIN homeworks h ON hs.homework_id = h.id
    WHERE hs.student_name = ?
    AND h.subject = ?
    ORDER BY hs.id DESC
    LIMIT 3
");

$archive->bind_param("ss", $fullName, $subject);
$archive->execute();

$archiveResult = $archive->get_result();

$archiveHW = [];

while ($item = $archiveResult->fetch_assoc()) {

    $archiveHW[] = [
        "id" => $item['id'],
        "title" => $item['title'],
        "date" => $item['homework_date'],
        "status" => $item['status'],
        "percent" => intval($item['completed_tasks'] ?? 0)
    ];
}

// =====================================
// 📤 ОТВЕТ
// =====================================

echo json_encode([
    "subject" => $subject,
    "chart" => $chart,
    "linesCount" => $linesCount,
    "step" => $step,
    "activeHW" => $activeHW,
    "archiveHW" => $archiveHW
]);