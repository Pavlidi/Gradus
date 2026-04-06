<?php
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

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

    $fileName = uniqid() . "_" . $_FILES['checked_files']['name'][$key];

    $serverPath = "../../uploads/checked/" . $fileName;
    $dbPath = "uploads/checked/" . $fileName;

    move_uploaded_file($tmpName, $serverPath);

    // ✅ ВСТАВКА В БД
    $stmt = $conn->prepare("
        INSERT INTO submission_files (submission_id, file_path, file_type)
        VALUES (?, ?, 'checked')
    ");

    $stmt->bind_param("is", $submission_id, $dbPath);
    $stmt->execute();
}
    header("Location: ../check-works.php");
    exit();