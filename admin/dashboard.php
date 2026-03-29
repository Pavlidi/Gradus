<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "test");

$student_id = $_SESSION['student_id'];

// получаем ученика
$stmt = $conn->prepare("SELECT * FROM users_info WHERE id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

$fullName = $student['student_lastname'] . ' ' . $student['student_firstname'];
$group = $student['group_number'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>

<body>

    <h2>Привет, <?= $fullName ?></h2>

    <form action="logout.php" method="POST">
        <button>Выйти</button>
    </form>

    <hr>

    <!-- ================= АКТИВНЫЕ ================= -->

    <h3>Активные задания</h3>

    <?php
    $active = $conn->prepare("
    SELECT * FROM homeworks h
    WHERE 
        (
            (h.target_type = 'student' AND h.target_value = ?)
            OR
            (h.target_type = 'group' AND h.target_value = ?)
        )
        AND NOT EXISTS (
            SELECT 1 FROM homework_submissions hs
            WHERE hs.homework_id = h.id
            AND hs.student_name = ?
        )
    ORDER BY h.homework_date ASC
");

    $active->bind_param("sss", $fullName, $group, $fullName);
    $active->execute();
    $activeResult = $active->get_result();
    ?>

    <?php if ($activeResult->num_rows > 0): ?>
        <?php while ($hw = $activeResult->fetch_assoc()): ?>

            <div style="border:1px solid #ccc; padding:15px; margin-bottom:10px;">

                <p><strong><?= $hw['title'] ?></strong></p>
                <p>Сдать до: <?= $hw['homework_date'] ?></p>

                <!-- ✅ СКАЧАТЬ ЗАДАНИЕ -->
                <?php if (!empty($hw['file_path'])): ?>
                    <div style="margin-bottom:10px;">
                        <a href="<?= $hw['file_path'] ?>" download>
                            <button>Скачать задание</button>
                        </a>
                    </div>
                <?php endif; ?>

                <form action="php/upload-solution.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="homework_id" value="<?= $hw['id'] ?>">
                    <input type="hidden" name="student_name" value="<?= $fullName ?>">

                    <input type="file" name="photos[]" multiple required>
                    <button type="submit">Отправить</button>
                </form>

            </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p>Нет активных заданий</p>
    <?php endif; ?>

    <hr>

    <!-- ================= АРХИВ ================= -->

    <h3>История задач</h3>

    <?php
    $archive = $conn->prepare("
    SELECT hs.*, h.title, h.homework_date
    FROM homework_submissions hs
    JOIN homeworks h ON hs.homework_id = h.id
    WHERE hs.student_name = ?
    ORDER BY hs.id DESC
    LIMIT 3
");

    $archive->bind_param("s", $fullName);
    $archive->execute();
    $archiveResult = $archive->get_result();
    ?>

    <?php if ($archiveResult->num_rows > 0): ?>
        <?php while ($item = $archiveResult->fetch_assoc()): ?>

            <div style="border:1px solid #ddd; padding:15px; margin-bottom:10px; border-radius:10px;">

                <p><strong><?= $item['title'] ?></strong></p>
                <p><?= $item['homework_date'] ?></p>

                <?php
                $status = $item['status'];

                if ($status == 'не проверено') {
                    echo "<p style='color:orange;'>На проверке</p>";
                } elseif ($status == 'проверено') {

                    $percent = $item['completed_tasks'];

                    if ($percent >= 50) {
                        echo "<p style='color:green;'>Выполнено</p>";
                    } else {
                        echo "<p style='color:red;'>Не выполнено</p>";
                    }

                    echo "<p>Выполнено: {$percent}%</p>";
                }
                ?>

                <!-- КНОПКА СКАЧИВАНИЯ -->
                <?php if ($status == 'проверено'): ?>
                    <div style="margin-top:10px;">
                        <a href="php/download-checked.php?submission_id=<?= $item['id'] ?>">
                            <button>Скачать проверенные файлы</button>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p>История пустая</p>
    <?php endif; ?>

</body>

</html>