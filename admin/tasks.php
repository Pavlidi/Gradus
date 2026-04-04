<?php
$conn = new mysqli("localhost", "root", "root", "test");

$students = $conn->query("SELECT * FROM users_info ORDER BY student_lastname");

// СОХРАНЕНИЕ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_id = $_POST['student_id'];
    $table = $_POST['table'];

    // собираем задания
    $updates = [];
    for ($i = 1; $i <= $_POST['total_tasks']; $i++) {
        $value = isset($_POST["task_$i"]) ? 1 : 0;
        $updates[] = "task_$i = $value";
    }

    $sql = "UPDATE $table SET " . implode(",", $updates) . " WHERE student_id = $student_id";
    $conn->query($sql);
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
    <title>Проверка</title>
</head>

<body>

<header class="main-header">
    <div class="header-content-wrapper">
        <a href="/" class="header-logo">
            <img src="image/logo-tablet.webp">
        </a>

        <nav class="main-nav">
            <ul class="nav-list">
                <li><a href="index.php" class="nav-link lg">Ученики</a></li>
                <li><a href="#" class="nav-link active lg">Проверить</a></li>
                <li><a href="add-task.php" class="nav-link lg">Добавить</a></li>
            </ul>
        </nav>

        <a href="add-student.php" class="nav-link lg">Новый ученик</a>
    </div>
</header>

<section class="container">

<div class="card">
    <div class="line">
        <h1 class="lg">Прогресс заданий</h1>
    </div>

    <div class="card s">
    <div class="line">

        <!-- ФИО -->
        <div class="column">
            <h2 class="md">ФИО</h2>
            <?php foreach ($students as $student): ?>
                <p>
                    <?= $student['student_lastname'] ?>
                    <?= $student['student_firstname'] ?>
                </p>
            <?php endforeach; ?>
        </div>

        <div class="vert-line"></div>

        <!-- Экзамен -->
        <div class="column">
            <h2 class="md">Экзамен</h2>
            <?php foreach ($students as $student): ?>
                <p>
                    <?= $student['student_class'] > 9 ? 'ЕГЭ' : 'ОГЭ' ?>
                </p>
            <?php endforeach; ?>
        </div>

        <div class="vert-line"></div>

        <!-- Предмет -->
        <div class="column">
            <h2 class="md">Предмет</h2>
            <?php foreach ($students as $student): ?>
                <p><?= $student['subject_1'] ?></p>
            <?php endforeach; ?>
        </div>

        <div class="vert-line"></div>

        <!-- ЗАДАНИЯ -->
        <div class="column">

            <!-- номера -->
            <div style="display:flex; gap:4px; hight: 15px; margin-top: 30px;">
                <?php for ($i = 1; $i <= 26; $i++): ?>
                    <div style="width:18px; text-align:center; font-size:10px; color:#999;">
                        <?= $i ?>
                    </div>
                <?php endfor; ?>
            </div>

            <?php foreach ($students as $student): ?>

                <?php
                    $isEge = $student['student_class'] > 9;
                    $subject = $student['subject_1'];

                    if ($isEge && $subject == 'Математика') $table = 'ege_math';
                    elseif ($isEge) $table = 'ege_physics';
                    elseif ($subject == 'Математика') $table = 'oge_math';
                    else $table = 'oge_physics';

                    $total = ($table == 'ege_math') ? 19 :
                             ($table == 'oge_math' ? 25 :
                             ($table == 'oge_physics' ? 22 : 26));

                    $res = $conn->query("SELECT * FROM $table WHERE student_id = {$student['id']}");
                    $tasks = $res->fetch_assoc();
                ?>

                <form method="POST" >

                    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                    <input type="hidden" name="table" value="<?= $table ?>">
                    <input type="hidden" name="total_tasks" value="<?= $total ?>">

                    <div style="display:flex; gap:4px; align-items:center;">

                        <?php for ($i = 1; $i <= $total; $i++): ?>
                            <input 
                                type="checkbox" 
                                name="task_<?= $i ?>"
                                <?= ($tasks && $tasks["task_$i"]) ? 'checked' : '' ?>
                            >
                        <?php endfor; ?>

                        <button type="submit">✔</button>

                    </div>

                </form>

            <?php endforeach; ?>

        </div>

    </div>
</div>

    </div>
</div>

</section>

</body>
</html>