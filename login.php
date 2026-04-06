<?php
session_start();

$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

$error = "";
$success = "";

// очистка телефона
function cleanPhone($phone) {
    return '+' . preg_replace('/\D/', '', $phone);
}

if (isset($_POST['login'])) {

    $phone = isset($_POST['phone']) ? cleanPhone($_POST['phone']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!$phone || !$password) {
        $error = "Заполните все поля";
    } else {

        $stmt = $conn->prepare("
            SELECT * FROM users_info 
            WHERE parent_phone = ? OR student_phone = ?
            LIMIT 1
        ");
        $stmt->bind_param("ss", $phone, $phone);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {

            $isParent = ($user['parent_phone'] === $phone);
            $isStudent = ($user['student_phone'] === $phone);

            $valid = false;

            // 🔥 1. АДМИН (приоритет)
            if (!empty($user['admin_password']) && $user['admin_password'] === $password) {
                $valid = true;
                $_SESSION['role'] = 'admin';
            }

            // 🔥 2. РОДИТЕЛЬ
            elseif ($isParent && $user['parent_password'] === $password) {
                $valid = true;
                $_SESSION['role'] = 'parent';
            }

            // 🔥 3. УЧЕНИК
            elseif ($isStudent && $user['student_password'] === $password) {
                $valid = true;
                $_SESSION['role'] = 'student';
            }

            if ($valid) {
                $_SESSION['student_name'] =
                    $user['student_lastname'] . ' ' . $user['student_firstname'];

                $_SESSION['student_id'] = $user['id'];

                header("Location: account.php");
                exit();
            } else {
                $error = "Неверный пароль";
            }

        } else {
            $error = "Пользователь не найден";
        }
    }
}

if (isset($_POST['register'])) {

    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $phone = isset($_POST['phone']) ? cleanPhone($_POST['phone']) : '';
    $password = $_POST['password'] ?? '';

    if (!$lastname || !$firstname || !$phone || !$password) {
        $error = "Заполните все поля";
    } else {

        // ищем запись по телефону
        $stmt = $conn->prepare("
            SELECT * FROM users_info 
            WHERE parent_phone = ? OR student_phone = ?
            LIMIT 1
        ");
        $stmt->bind_param("ss", $phone, $phone);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $error = "Этот номер не найден. Обратитесь к администратору.";
        } else {

            $isParent = ($user['parent_phone'] === $phone);
            $isStudent = ($user['student_phone'] === $phone);

            // 🔥 если родитель
            if ($isParent) {

                if (!empty($user['parent_password'])) {
                    $error = "Вы уже зарегистрированы";
                } else {

                    $stmt = $conn->prepare("
                        UPDATE users_info 
                        SET parent_lastname = ?, parent_firstname = ?, parent_middlename = ?, parent_password = ?
                        WHERE id = ?
                    ");

                    $stmt->bind_param(
                        "ssssi",
                        $lastname,
                        $firstname,
                        $middlename,
                        $password,
                        $user['id']
                    );

                    $stmt->execute();

                    $success = "Регистрация родителя завершена";
                }
            }
            

            // 🔥 если ученик
            if ($isStudent) {

                if (!empty($user['student_password'])) {
                    $error = "Вы уже зарегистрированы";
                } else {

                    // 👉 сохраняем СТАРЫЕ данные
                    $old_lastname = $user['student_lastname'];
                    $old_firstname = $user['student_firstname'];
                    $subject = $user['subject_1'];  

                    // ================================
                    // 1. Обновляем users_info
                    // ================================
                    $stmt = $conn->prepare("
                        UPDATE users_info 
                        SET student_lastname = ?, student_firstname = ?, student_middlename = ?, student_password = ?
                        WHERE id = ?
                    ");

                    $stmt->bind_param(
                        "ssssi",
                        $lastname,
                        $firstname,
                        $middlename,
                        $password,
                        $user['id']
                    );

                    $stmt->execute();


                    // ================================
                    // 2. Обновляем test_results
                    // ================================
                    $stmt2 = $conn->prepare("
                        UPDATE test_results
                        SET student_lastname = ?, student_firstname = ?
                        WHERE student_lastname = ?
                        AND student_firstname = ?
                        AND subject = ?
                    ");

                    $stmt2->bind_param(
                        "sssss",
                        $lastname,
                        $firstname,
                        $old_lastname,
                        $old_firstname,
                        $subject
                    );

                    $stmt2->execute();

                    // ================================
                    // 🔄 ОБНОВЛЯЕМ student_name В ПРОГРЕССЕ
                    // ================================

                    $old_fullname = trim($old_lastname . ' ' . $old_firstname);
                    $new_fullname = trim($lastname . ' ' . $firstname);

                    // 👉 определяем класс
                    $class = (int)($user['student_class'] ?? 0);

                    // 👉 тип экзамена
                    $examType = ($class >= 10) ? 'ege' : 'oge';

                    // 👉 предмет → таблица
                    $subjectTable = ($subject == 'Математика') ? 'math' : 'physics';

                    // 👉 итоговая таблица
                    $table = $examType . '_' . $subjectTable;

                    // 👉 защита (чтобы не было SQL-инъекции)
                    $allowedTables = ['ege_math', 'ege_physics', 'oge_math', 'oge_physics'];

                    if (in_array($table, $allowedTables)) {

                        $stmt3 = $conn->prepare("
                            UPDATE $table
                            SET student_name = ?
                            WHERE student_name = ?
                        ");

                        $stmt3->bind_param("ss", $new_fullname, $old_fullname);
                        $stmt3->execute();
                        $stmt3->close();
                    }


                    $success = "Регистрация ученика завершена";
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/sections.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

<section class="login">

    <div class="login__container">

        <div class="login__logo">
            <a href="index.html"><img src="image/logo-desktop.webp" onclick=""></a>
        </div>

        <div class="card login__card">

            <div class="Title">
                <h1 class="lg" style="margin-left: var(--space-2xs);">Вход</h1>
                <a href="index.html" class="btn-light" style="text-decoration: none;">Назад</a>
            </div>

            <form method="POST" class="card s">
                
                <div class="input-group">
                    <label class="md">Телефон</label>
                    <input type="tel" name="phone" id="phone" value="+7" maxlength="18">
                </div>

                <div class="input-group password-group">
                    <div class="md">Пароль</div>

                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="Введите пароль">
                        <img class="toggle-password" onclick="togglePassword()" src="image/glass2.png">
                    </div>
                </div>

                <div class="line__horizontal"></div>

                <!-- ошибки -->
                <?php if ($error): ?>
                    <p style="color:red; font-size:14px;"><?= $error ?></p>
                <?php endif; ?>

                <?php if ($success): ?>
                    <p style="color:green; font-size:14px;"><?= $success ?></p>
                <?php endif; ?>

                <div class="login__actions">
                    <button class="btn-dark" type="submit" name="login">Войти</button>
                    <button type="button" class="btn-dark" onclick="openModal()">Регистрация</button>
                </div>

            </form>
        </div>
    </div>

    <!-- МОДАЛКА -->
    <div class="modal" id="modal">

        <div class="modal__content card">

            <div class="Title">
                <h1 class="lg" style="margin-left: var(--space-2xs);">Регистрация</h1>
            </div>

            <form method="POST" class="card s">

                <div class="input-group">
                    <input type="text" name="lastname" placeholder="Фамилия">
                </div>

                <div class="line__horizontal"></div>

                <div class="input-group">
                    <input type="text" name="firstname" placeholder="Имя">
                </div>

                <div class="line__horizontal"></div>

                <div class="input-group">
                    <input type="text" name="middlename" placeholder="Отчество">
                </div>

                <div class="line__horizontal"></div>

                <div class="input-group">
                    <input type="tel" name="phone" id="regPhone" value="+7">
                </div>

                <div class="line__horizontal"></div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Пароль">
                </div>

                <div class="login__actions">
                    <button class="btn-dark" type="submit" name="register">Создать аккаунт</button>
                    <button type="button" class="btn-dark" onclick="closeModal()">Отмена</button>
                </div>

            </form>

        </div>

    </div>

</section>
<script src="js/main.js"></script>
</body>
</html>