<?php
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

// получаем всех учеников
$result = $conn->query("
    SELECT * FROM users_info 
    ORDER BY study_format, group_number, student_lastname
");

$groups = [];
$individuals = [];

// разбиваем на группы и индивидуальных
while ($row = $result->fetch_assoc()) {
    if ($row['study_format'] === 'Группа') {
        $groups[$row['group_number']][] = $row;
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

<h2>Проверка домашних заданий</h2>

<!-- ================= ГРУППЫ ================= -->

<?php foreach ($groups as $groupNumber => $students): ?>

    <h3>Группа <?= $groupNumber ?></h3>

    <?php foreach ($students as $student): 

        $fullName = $student['student_lastname'] . ' ' . $student['student_firstname'];
        $subject = $student['subject_1'];
    ?>

        <?php
        $stmt = $conn->prepare("
            SELECT hs.*, h.title, h.homework_date
            FROM homework_submissions hs
            JOIN homeworks h ON hs.homework_id = h.id
            WHERE hs.student_name = ?
            AND hs.status = 'не проверено'
            AND h.subject = ?
            ORDER BY h.homework_date DESC
        ");
        $stmt->bind_param("ss", $fullName, $subject);
        $stmt->execute();
        $submissions = $stmt->get_result();
        ?>

        <?php if ($submissions->num_rows > 0): ?>

            <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">

                <p><strong><?= $fullName ?> (<?= $subject ?>)</strong></p>

                <?php while ($submission = $submissions->fetch_assoc()): ?>

                    <div style="border-top:1px solid #ddd; margin-top:10px; padding-top:10px;">

                        <p>Тема: <?= $submission['title'] ?></p>
                        <p>Дата: <?= $submission['homework_date'] ?></p>

                        <!-- PDF кнопка -->
                        <form action="php/download-pdf.php" method="POST" style="margin-bottom:10px;">
                            <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">
                            <input type="hidden" name="student_name" value="<?= $fullName ?>">
                            <input type="hidden" name="subject" value="<?= $subject ?>">
                            <input type="hidden" name="title" value="<?= $submission['title'] ?>">
                            <button type="submit">📄 Скачать PDF</button>
                        </form>

                        <form action="php/check-homework.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">

                            <input type="number" name="completed_tasks" placeholder="Сколько выполнено" required>
                            <input type="file" name="checked_files[]" multiple>

                            <button type="submit">Проверить</button>

                        </form>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endforeach; ?>

<hr>

<!-- ================= ИНДИВИДУАЛЬНЫЕ ================= -->

<h3>Индивидуально</h3>

<?php foreach ($individuals as $student): 

    $fullName = $student['student_lastname'] . ' ' . $student['student_firstname'];
    $subject = $student['subject_1'];
?>

    <?php
    $stmt = $conn->prepare("
        SELECT hs.*, h.title, h.homework_date
        FROM homework_submissions hs
        JOIN homeworks h ON hs.homework_id = h.id
        WHERE hs.student_name = ?
        AND hs.status = 'не проверено'
        AND h.subject = ?
        ORDER BY h.homework_date DESC
    ");
    $stmt->bind_param("ss", $fullName, $subject);
    $stmt->execute();
    $submissions = $stmt->get_result();
    ?>

    <?php if ($submissions->num_rows > 0): ?>

        <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">

            <p><strong><?= $fullName ?> (<?= $subject ?>)</strong></p>

            <?php while ($submission = $submissions->fetch_assoc()): ?>

                <div style="border-top:1px solid #ddd; margin-top:10px; padding-top:10px;">

                    <p>Тема: <?= $submission['title'] ?></p>
                    <p>Дата: <?= $submission['homework_date'] ?></p>

                    <!-- PDF кнопка -->
                    <form action="php/download-pdf.php" method="POST" style="margin-bottom:10px;">
                        <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">
                        <input type="hidden" name="student_name" value="<?= $fullName ?>">
                        <input type="hidden" name="subject" value="<?= $subject ?>">
                        <input type="hidden" name="title" value="<?= $submission['title'] ?>">
                        <button type="submit">📄 Скачать PDF</button>
                    </form>

                    <form action="php/check-homework.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="submission_id" value="<?= $submission['id'] ?>">

                        <input type="number" name="completed_tasks" placeholder="Сколько выполнено" required>
                        <input type="file" name="checked_files[]" multiple>

                        <button type="submit">Проверить</button>

                    </form>

                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

<?php endforeach; ?>

</body>
</html>