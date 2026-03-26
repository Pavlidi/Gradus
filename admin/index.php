<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Сортируем сразу в SQL
$sql = "SELECT * FROM users_info 
        ORDER BY study_format, group_number, student_lastname";

$result = $conn->query($sql);

$groups = [];
$individuals = [];

while ($row = $result->fetch_assoc()) {

    if ($row['study_format'] === 'Группа') {
        $groupNumber = $row['group_number'] ?? 0;
        $groups[$groupNumber][] = $row;
    } else {
        $individuals[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/section.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/components.css">
    <title>Document</title>
</head>

<body>
    <header class="main-header">
        <div class="header-content-wrapper">
            <!-- Левая часть: Логотип -->
            <a href="/" class="header-logo">
                <img src="image/logo-tablet.webp" alt="Логотип Градус">
            </a>

            <!-- Центральная часть: Навигация -->
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="#" class="nav-link active lg">Ученики</a>
                    </li>
                    <li class="nav-item">
                        <a href="check-works.php" class="nav-link lg">Проверить</a>
                    </li>
                    <li class="nav-item">
                        <a href="add-task.php" class="nav-link lg">Добавить</a>
                    </li>
                </ul>
            </nav>

            <!-- Правая часть: Кнопка "Новый ученик" -->
            <a href="add-student.php" class="nav-link lg">Новый ученик</a>
        </div>
    </header>

    <!-- Таблицы с учениками из групп -->
    <?php foreach ($groups as $groupNumber => $students): ?>
        <section class="container">
            </div>
            <div class="card">
                <div class="line">
                    <h1 class="lg">Группа <?= $groupNumber ?></h1>
                </div>

                <!-- ОДНА карточка на всю группу -->
                <div class="card s">

                    <!-- Заголовки (один раз!) -->
                    <div class="line">
                        <div class="column">
                            <h2 class="md">Ф.И.О.</h2>
                            <?php foreach ($students as $student): ?>
                                <p>
                                    <?= htmlspecialchars($student['student_lastname']) ?>
                                    <?= htmlspecialchars($student['student_firstname']) ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <div class="column">
                            <h2 class="md">Класс</h2>
                            <?php foreach ($students as $student): ?>
                                <p><?= $student['student_class'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <div class="column">
                            <h2 class="md">Предмет</h2>
                            <?php foreach ($students as $student): ?>
                                <p><?= $student['subject_1'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    <?php endforeach; ?>


    <section class="container">
        <?php if (!empty($individuals)): ?>

            <div class="card">
                <div class="line">
                    <h1 class="lg">Индивидуально</h1>
                </div>

                <div class="card s">
                    <div class="line">

                        <div class="column">
                            <h2 class="md">Ф.И.О.</h2>
                            <?php foreach ($individuals as $student): ?>
                                <p>
                                    <?= $student['student_lastname'] ?>
                                    <?= $student['student_firstname'] ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <div class="column">
                            <h2 class="md">Класс</h2>
                            <?php foreach ($individuals as $student): ?>
                                <p><?= $student['student_class'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <div class="column">
                            <h2 class="md">Предмет</h2>
                            <?php foreach ($individuals as $student): ?>
                                <p><?= $student['subject_1'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

            </div>

        <?php endif; ?>

    </section>
</body>

</html>