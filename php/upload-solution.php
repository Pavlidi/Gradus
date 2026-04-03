<?php
$conn = new mysqli("localhost", "root", "root", "test");

$homework_id = $_POST['homework_id'];
$student_name = $_POST['student_name'];

// создаём submission
$stmt = $conn->prepare("
    INSERT INTO homework_submissions (homework_id, student_name, status)
    VALUES (?, ?, 'не проверено')
");
$stmt->bind_param("is", $homework_id, $student_name);
$stmt->execute();

$submission_id = $conn->insert_id;

// сохраняем файлы
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
}

header("Location: ../account.php");
exit();