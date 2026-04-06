<?php
// ================================
// 1. Проверка отправки формы
// ================================
if (!isset($_POST['submit'])) {
    header("Location: ../add-student.php");
    exit();
}


// ================================
// 2. Подключение к БД
// ================================
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


// ================================
// 3. Получение данных
// ================================
$parent_lastname   = htmlspecialchars($_POST['parent_lastname']);
$parent_firstname  = htmlspecialchars($_POST['parent_firstname']);
$parent_middlename = htmlspecialchars($_POST['parent_middlename']);
$parent_phone      = htmlspecialchars($_POST['parent_phone']);

$student_lastname   = htmlspecialchars($_POST['student_lastname']);
$student_firstname  = htmlspecialchars($_POST['student_firstname']);
$student_middlename = htmlspecialchars($_POST['student_middlename']);
$student_phone      = htmlspecialchars($_POST['student_phone']);
$student_class      = !empty($_POST['student_class']) ? (int)$_POST['student_class'] : 0;

$study_format = htmlspecialchars($_POST['study_format']);
$group_number = !empty($_POST['group_number']) ? (int)$_POST['group_number'] : 0;

$subject_1 = htmlspecialchars($_POST['subject_1']);


// ================================
// 4. Валидация
// ================================
if (empty($student_firstname) || empty($student_lastname)) {
    die("Ошибка: имя и фамилия ученика обязательны");
}


// ================================
// 5. Добавление ученика
// ================================
$stmt = $conn->prepare("
    INSERT INTO users_info (
        parent_lastname,
        parent_firstname,
        parent_middlename,
        parent_phone,
        student_lastname,
        student_firstname,
        student_middlename,
        student_phone,
        student_class,
        study_format,
        group_number,
        subject_1
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssssssss",
    $parent_lastname,
    $parent_firstname,
    $parent_middlename,
    $parent_phone,
    $student_lastname,
    $student_firstname,
    $student_middlename,
    $student_phone,
    $student_class,
    $study_format,
    $group_number,
    $subject_1
);


// ================================
// 6. Выполнение
// ================================
if ($stmt->execute()) {

    // ID нового ученика
    $student_id = $stmt->insert_id;

    // ФИО
    $student_name = $student_lastname . ' ' . $student_firstname;
    $student_name = $conn->real_escape_string($student_name);

    // ================================
    // 7. Определяем таблицу
    // ================================
    $isEge = $student_class > 9;

    if ($isEge && $subject_1 == 'Математика') {
        $table = 'ege_math';
    } elseif ($isEge) {
        $table = 'ege_physics';
    } elseif ($subject_1 == 'Математика') {
        $table = 'oge_math';
    } else {
        $table = 'oge_physics';
    }

    // ================================
    // 8. Создаём запись заданий
    // ================================
    $conn->query("
        INSERT INTO $table (student_id, student_name)
        VALUES ($student_id, '$student_name')
    ");

    // ================================
    // 🔥 8. Создаём запись в test_results
    // ================================

    $stmt2 = $conn->prepare("
        INSERT INTO test_results (student_lastname, student_firstname, subject)
        VALUES (?, ?, ?)
    ");

    $stmt2->bind_param("sss", $student_lastname, $student_firstname, $subject_1);
    $stmt2->execute();
    $stmt2->close();

    // ================================
    // 9. Редирект
    // ================================
    header("Location: ../index.php");
    exit();

} else {
    echo "Ошибка: " . $stmt->error;
}


// ================================
// 10. Закрытие
// ================================
$stmt->close();
$conn->close();
?>