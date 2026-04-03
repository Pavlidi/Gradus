<?php
$conn = new mysqli("localhost", "root", "root", "test");

$filePath = null;

if (!empty($_FILES['file']['name'])) {
    $fileName = time() . "_" . $_FILES['file']['name'];

    $serverPath = "../../uploads/homeworks/" . $fileName;
    $dbPath = "uploads/homeworks/" . $fileName;

    move_uploaded_file($_FILES['file']['tmp_name'], $serverPath);

    $filePath = $dbPath;
}

$stmt = $conn->prepare("
    INSERT INTO homeworks (title, homework_date, file_path, target_type, target_value, subject)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssss",
    $_POST['title'],
    $_POST['homework_date'],
    $filePath,
    $_POST['target_type'],
    $_POST['target_value'],
    $_POST['subject']   // 👈 ВОТ ОНО
);

$stmt->execute();
$conn->close();

header("Location: ../add-task.php");
exit();