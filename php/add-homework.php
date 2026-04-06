<?php
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

$filePath = null;

if (!empty($_FILES['file']['name'])) {
    $fileName = time() . "_" . $_FILES['file']['name'];
    $filePath = "uploads/homeworks/" . $fileName;

    move_uploaded_file($_FILES['file']['tmp_name'], "../" . $filePath);
}

$stmt = $conn->prepare("
    INSERT INTO homeworks (title, homework_date, file_path, target_type, target_value)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "sssss",
    $_POST['title'],
    $_POST['homework_date'],
    $filePath,
    $_POST['target_type'],
    $_POST['target_value']
);

$stmt->execute();
$conn->close();

header("Location: ../add-task.php");
exit();