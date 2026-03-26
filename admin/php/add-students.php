<?php
// ================================
// 1. Проверяем, была ли отправлена форма
// ================================
if (!isset($_POST['submit'])) {
    // Если кто-то открыл файл напрямую — отправляем назад
    header("Location: ../add-student.php");
    exit();
}


// ================================
// 2. Подключение к базе данных
// ================================
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "test";

// Создаем соединение
$conn = new mysqli($host, $user, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


// ================================
// 3. Получаем данные из формы
// ================================
// htmlspecialchars защищает от XSS
$parent_lastname   = htmlspecialchars($_POST['parent_lastname']);
$parent_firstname  = htmlspecialchars($_POST['parent_firstname']);
$parent_middlename = htmlspecialchars($_POST['parent_middlename']);
$parent_phone      = htmlspecialchars($_POST['parent_phone']);

$student_lastname   = htmlspecialchars($_POST['student_lastname']);
$student_firstname  = htmlspecialchars($_POST['student_firstname']);
$student_middlename = htmlspecialchars($_POST['student_middlename']);
$student_phone      = htmlspecialchars($_POST['student_phone']);
$student_class = !empty($_POST['student_class']) ? (int)$_POST['student_class'] : 0;

$study_format = htmlspecialchars($_POST['study_format']);
$group_number = !empty($_POST['group_number']) ? (int)$_POST['group_number'] : 0;

$subject_1 = htmlspecialchars($_POST['subject_1']);



// ================================
// 4. Проверка (пример базовой валидации)
// ================================
if (empty($student_firstname)) {
    die("Ошибка: имя и фамилия ученика обязательны");
}


// ================================
// 5. Подготовленный SQL запрос (ВАЖНО — защита от SQL-инъекций)
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


// ================================
// 6. Привязка параметров
// ================================
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
// 7. Выполнение запроса
// ================================
if ($stmt->execute()) {

    // Успех — редиректим (например на список учеников)
    header("Location: ../index.php");
    exit();

} else {
    echo "Ошибка: " . $stmt->error;
}


// ================================
// 8. Закрытие соединений
// ================================
$stmt->close();
$conn->close();