<?php
$conn = new mysqli("localhost", "root", "root", "test");

$homework_id = $_POST['homework_id'];
$student_name = $_POST['student_name'];

// 👉 1. получаем subject из homeworks
$stmt = $conn->prepare("
    SELECT subject FROM homeworks WHERE id = ?
");
$stmt->bind_param("i", $homework_id);
$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();
$subject = $result['subject'] ?? '';

$stmt->close();


// 👉 2. проверяем — есть ли уже submission
$stmt = $conn->prepare("
    SELECT id FROM homework_submissions
    WHERE homework_id = ? AND student_name = ?
    LIMIT 1
");

$stmt->bind_param("is", $homework_id, $student_name);
$stmt->execute();

$result = $stmt->get_result();
$existing = $result->fetch_assoc();

$stmt->close();


// 👉 3. создаём или используем существующий
if ($existing) {
    $submission_id = $existing['id'];
} else {
    $stmt = $conn->prepare("
        INSERT INTO homework_submissions (homework_id, student_name, subject, status)
        VALUES (?, ?, ?, 'не проверено')
    ");

    $stmt->bind_param("iss", $homework_id, $student_name, $subject);
    $stmt->execute();

    $submission_id = $conn->insert_id;

    $stmt->close();
}


// 👉 4. сохраняем файлы (ВАЖНО: только файлы, без INSERT submission)
foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {

    if (empty($_FILES['photos']['name'][$key])) continue;

    $fileName = uniqid() . "_" . $_FILES['photos']['name'][$key];

    $serverPath = "../uploads/solutions/" . $fileName;
    $dbPath = "uploads/solutions/" . $fileName;

    move_uploaded_file($tmpName, $serverPath);

    $stmt = $conn->prepare("
        INSERT INTO submission_files (submission_id, file_path, file_type)
        VALUES (?, ?, 'solution')
    ");

    $stmt->bind_param("is", $submission_id, $dbPath);
    $stmt->execute();

    $stmt->close();
}

header("Location: ../account.php");
exit();