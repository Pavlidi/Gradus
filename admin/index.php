<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// СОХРАНЕНИЕ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare("
        UPDATE users_info 
        SET lessons_total = ?, attendance = ?, homeworks_total = ?, homeworks_done = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "iiiii",
        $_POST['lessons_total'],
        $_POST['attendance'],
        $_POST['homeworks_total'],
        $_POST['homeworks_done'],
        $_POST['student_id']
    );

    $stmt->execute();
}

// ПОЛУЧЕНИЕ
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
    <title>Ученики</title>
</head>

<body>

    <header class="main-header">
        <div class="header-content-wrapper">
            <a href="/" class="header-logo">
                <img src="image/logo-tablet.webp">
            </a>

            <nav class="main-nav">
                <ul class="nav-list">
                    <li><a href="#" class="nav-link active lg">Ученики</a></li>
                    <li><a href="check-works.php" class="nav-link lg">Проверить</a></li>
                    <li><a href="add-task.php" class="nav-link lg">Добавить</a></li>
                </ul>
            </nav>

            <a href="add-student.php" class="nav-link lg">Новый ученик</a>
        </div>
    </header>

    <!-- ================= ГРУППЫ ================= -->

    <?php foreach ($groups as $groupNumber => $students): ?>
        <section class="container">

            <div class="card">
                <div class="line">
                    <h1 class="lg">Группа <?= $groupNumber ?></h1>
                </div>

                <div class="card s">
                    <div class="line">

                        <div class="column">
                            <h2 class="md">№</h2>
                            <?php $i = 1; ?>
                            <?php foreach ($students as $student): ?>
                                <p>
                                    <?= $i++ ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>
                        <!-- ФИО -->
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

                        <!-- Класс -->
                        <div class="column">
                            <h2 class="md">Класс</h2>
                            <?php foreach ($students as $student): ?>
                                <p><?= $student['student_class'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <!-- Предмет -->
                        <div class="column">
                            <h2 class="md">Предмет</h2>
                            <?php foreach ($students as $student): ?>
                                <p><?= $student['subject_1'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <!-- СТАТИСТИКА -->
                        <div class="column">
                            <h2 class="md">Статистика (Зан, Пос, ДЗ, Сд) </h2>

                            <?php foreach ($students as $student): ?>
                                <form method="POST" style="margin-bottom: var(--space-3xs);">

                                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">

                                    <input type="number" name="lessons_total" value="<?= $student['lessons_total'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="attendance" value="<?= $student['attendance'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="homeworks_total" value="<?= $student['homeworks_total'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="homeworks_done" value="<?= $student['homeworks_done'] ?>"
                                        style="width:50px;">

                                    <button type="submit">✔</button>

                                </form>
                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>

            </div>
        </section>
    <?php endforeach; ?>

    <!-- ================= ИНДИВИДУАЛЬНЫЕ ================= -->

    <section class="container">
        <?php if (!empty($individuals)): ?>

            <div class="card">
                <div class="line">
                    <h1 class="lg">Индивидуально</h1>
                </div>

                <div class="card s">
                    <div class="line">

                        <div class="column">
                            <h2 class="md">№</h2>
                            <?php $i = 1; ?>
                            <?php foreach ($individuals as $student): ?>
                                <p>
                                    <?= $i++ ?>
                                </p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>
                        <!-- ФИО -->
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

                        <!-- Класс -->
                        <div class="column">
                            <h2 class="md">Класс</h2>
                            <?php foreach ($individuals as $student): ?>
                                <p><?= $student['student_class'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <!-- Предмет -->
                        <div class="column">
                            <h2 class="md">Предмет</h2>
                            <?php foreach ($individuals as $student): ?>
                                <p><?= $student['subject_1'] ?: '-' ?></p>
                            <?php endforeach; ?>
                        </div>

                        <div class="vert-line"></div>

                        <!-- СТАТИСТИКА -->
                        <div class="column">
                            <h2 class="md">Статистика (Зан, Пос, ДЗ, Сд)</h2>

                            <?php foreach ($individuals as $student): ?>
                                <form method="POST" style="margin-bottom:var(--space-3xs);">

                                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">

                                    <input type="number" name="lessons_total" value="<?= $student['lessons_total'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="attendance" value="<?= $student['attendance'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="homeworks_total" value="<?= $student['homeworks_total'] ?>"
                                        style="width:50px;">
                                    <input type="number" name="homeworks_done" value="<?= $student['homeworks_done'] ?>"
                                        style="width:50px;">

                                    <button type="submit">✔</button>

                                </form>
                            <?php endforeach; ?>

                        </div>

                    </div>
                </div>

            </div>

        <?php endif; ?>
    </section>

</body>

</html>