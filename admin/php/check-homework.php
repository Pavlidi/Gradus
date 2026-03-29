<?php
$conn = new mysqli("localhost", "root", "root", "test");

$submission_id = $_POST['submission_id'];

// обновляем статус
$stmt = $conn->prepare("
    UPDATE homework_submissions
    SET status = 'проверено', completed_tasks = ?
    WHERE id = ?
");

$stmt->bind_param("ii", $_POST['completed_tasks'], $submission_id);
$stmt->execute();


// загружаем проверенные файлы
foreach ($_FILES['checked_files']['tmp_name'] as $key => $tmpName) {

    if (empty($_FILES['checked_files']['name'][$key])) continue;

    $fileName = time() . "_" . $_FILES['checked_files']['name'][$key];
    $path = "uploads/checked/" . $fileName;

    move_uploaded_file($tmpName, "../" . $path);

    $stmt = $conn->prepare("
        INSERT INTO submission_files (submission_id, file_path, file_type)
        VALUES (?, ?, 'checked')
    ");

    $stmt->bind_param("is", $submission_id, $path);
    $stmt->execute();

}
    header("Location: ../check-works.php");
    exit();