<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "test";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

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

usort($individuals, function($a, $b) {
    return strcmp($a['student_lastname'], $b['student_lastname']);
});
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить ДЗ</title>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/section.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/components.css">

    <style>
        /* ===== GRID ТАБЛИЦА ===== */
        .individ-table {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .individ-row {
            display: grid;
            grid-template-columns: 2fr 1fr 2fr 1.5fr 2fr auto;
            gap: 10px;
            align-items: center;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 10px;
        }

        .individ-header {
            font-weight: bold;
            background: #fafafa;
        }

        .individ-row input {
            width: 100%;
        }

        .individ-row button {
            white-space: nowrap;
        }
    </style>
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
                <li><a href="check-works.php" class="nav-link lg">Проверить</a></li>
                <li><a href="#" class="nav-link active lg">Добавить</a></li>
            </ul>
        </nav>

        <a href="add-student.php" class="nav-link lg">Новый ученик</a>
    </div>
</header>

<!-- ================= ГРУППЫ ================= -->

<?php foreach ($groups as $groupNumber => $students): ?>
<section class="container">

    <div class="card">
        <form action="php/add-homework.php" method="POST" enctype="multipart/form-data">

            <div class="line">
                <h1 class="lg">Группа <?= $groupNumber ?></h1>

                <input type="hidden" name="target_type" value="group">
                <input type="hidden" name="target_value" value="<?= $groupNumber ?>">

                <input type="text" name="title" placeholder="Тема" required>
                <input type="date" name="homework_date" required>
                <input type="file" name="file">
            </div>

            <div class="card s">
                <div class="line">

                    <div class="column">
                        <h2 class="md">Ф.И.О.</h2>
                        <?php foreach ($students as $student): ?>
                            <p><?= $student['student_lastname'] ?> <?= $student['student_firstname'] ?></p>
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

            <button type="submit">Создать</button>

        </form>
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

        <div class="individ-table">

            <!-- заголовок -->
            <div class="individ-row individ-header">
                <div>ФИО</div>
                <div>Предмет</div>
                <div>Тема</div>
                <div>Дата</div>
                <div>Файл</div>
                <div></div>
            </div>

            <?php foreach ($individuals as $student): ?>

                <form action="php/add-homework.php" method="POST" enctype="multipart/form-data">

                    <div class="individ-row">

                        <div>
                            <?= $student['student_lastname'] ?>
                            <?= $student['student_firstname'] ?>
                        </div>

                        <div><?= $student['subject_1'] ?></div>

                        <div>
                            <input type="text" name="title" placeholder="Тема">
                        </div>

                        <div>
                            <input type="date" name="homework_date">
                        </div>

                        <div>
                            <input type="file" name="file">
                        </div>

                        <div>
                            <button type="submit">Создать</button>
                        </div>

                        <!-- скрытые -->
                        <input type="hidden" name="target_type" value="student">
                        <input type="hidden" name="target_value"
                            value="<?= $student['student_lastname'] . ' ' . $student['student_firstname'] ?>">

                    </div>

                </form>

            <?php endforeach; ?>

        </div>

    </div>

<?php endif; ?>
</section>

</body>
</html>