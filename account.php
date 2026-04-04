<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "test");

$student_id = $_SESSION['student_id'];

// 1. Сначала получаем ЛЮБУЮ запись пользователя (чтобы взять телефон)
$stmt = $conn->prepare("
    SELECT student_phone, parent_phone 
    FROM users_info 
    WHERE id = ?
    LIMIT 1
");
$stmt->bind_param("i", $student_id);
$stmt->execute();

$temp = $stmt->get_result()->fetch_assoc();

if (!$temp) {
    echo "Ошибка: пользователь не найден";
    exit();
}

// 2. Определяем телефон (ключ пользователя)
$phone = $temp['student_phone'] ?: $temp['parent_phone'];

// 3. Определяем предмет (из URL или по умолчанию)
$subject = $_GET['subject'] ?? 'Математика';

// 4. Получаем НУЖНУЮ запись по предмету
$stmt = $conn->prepare("
    SELECT * FROM users_info 
    WHERE (student_phone = ? OR parent_phone = ?)
    AND subject_1 = ?
    LIMIT 1
");

$stmt->bind_param("sss", $phone, $phone, $subject);
$stmt->execute();

$student = $stmt->get_result()->fetch_assoc();

// ❗ защита
if (!$student) {
    echo "Ошибка: данные по предмету не найдены";
    exit();
}

// ❗ защита
if (!$student) {
    echo "Ошибка: пользователь не найден";
    exit();
}

// 👉 базовые данные
$fullName = ($student['student_lastname'] ?? '') . ' ' . ($student['student_firstname'] ?? '');
$group = $student['group_number'] ?? 0;

// 👉 subject: либо из URL, либо из БД
$subject = $_GET['subject'] ?? $student['subject_1'] ?? 'Математика';

// ====== ДАННЫЕ ДЛЯ ГРАФИКА ======

$lastname = $student['student_lastname'];
$firstname = $student['student_firstname'];

// 👉 получаем настройки графика
$stmt = $conn->prepare("
    SELECT lines_count, step 
    FROM test_results
    WHERE student_lastname = ? 
    AND student_firstname = ?
    AND subject = ?
    LIMIT 1
");

$stmt->bind_param("sss", $lastname, $firstname, $subject);
$stmt->execute();

$resultChart = $stmt->get_result()->fetch_assoc();

if (!$resultChart) {
    $linesCount = 10;
    $step = 10;
} else {
    $linesCount = $resultChart['lines_count'];
    $step = $resultChart['step'];
}

// 👉 получаем результаты тестов
$stmt = $conn->prepare("
    SELECT * 
    FROM test_results
    WHERE student_lastname = ? 
    AND student_firstname = ?
    AND subject = ?
    LIMIT 1
");

$stmt->bind_param("sss", $lastname, $firstname, $subject);
$stmt->execute();

$testData = $stmt->get_result()->fetch_assoc() ?? [];

// 👉 проверяем предметы
$hasMath = false;
$hasPhysics = false;

$stmt = $conn->prepare("
    SELECT subject_1 FROM users_info 
    WHERE student_phone = ? OR parent_phone = ?
");

$phone = $student['student_phone'] ?: $student['parent_phone'];

$stmt->bind_param("ss", $phone, $phone);
$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['subject_1'] === "Математика") {
        $hasMath = true;
    }
    if ($row['subject_1'] === "Физика") {
        $hasPhysics = true;
    }
}

// 👉 функция даты
function formatDateRu($date) {
    if (!$date) return '';

    $months = [
        '01' => 'января',
        '02' => 'февраля',
        '03' => 'марта',
        '04' => 'апреля',
        '05' => 'мая',
        '06' => 'июня',
        '07' => 'июля',
        '08' => 'августа',
        '09' => 'сентября',
        '10' => 'октября',
        '11' => 'ноября',
        '12' => 'декабря'
    ];

    $day = date('j', strtotime($date));
    $month = date('m', strtotime($date));

    return $day . ' ' . ($months[$month] ?? '');
}

$grades = [];
$showGrades = true;

// 👉 определяем класс (например 9, 10, 11)
$class = (int)$group;

if ($class == 9) {

    if ($subject == 'Математика') {
        $grades = [
            ['2', '0 - 7'],
            ['3', '8 - 14'],
            ['4', '15 - 21'],
            ['5', '22 - 31'],
        ];
    }

    if ($subject == 'Физика') {
        $grades = [
            ['2', '0 - 9'],
            ['3', '10 - 19'],
            ['4', '20 - 29'],
            ['5', '30 - 39'],
        ];
    }

} elseif ($class != 9) {
    $showGrades = false;
}


// Успеваемость - Начало
$hwTotal = (int)($student['homeworks_total'] ?? 0);
$hwDone  = (int)($student['homeworks_done'] ?? 0);

$lessonTotal = (int)($student['lessons_total'] ?? 0);
$lessonDone = (int)($student['attendance'] ?? 0);


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/sections.css">
    <link rel="stylesheet" href="css/components.css">
    <title>Личный кабинет</title>
</head>

<body>

    <header class="header">
        <div class="header__container">

            <!-- Логотип -->
            <div class="header__logo">
                <a href="/" class="logo">
                    <img src="image/logo-mobile.webp" alt="Логотип Градус">
                </a>
            </div>

            <!-- Центральное меню -->
            <nav class="menu">

                <div class="menu__inside-first">
                    <div class="menu-item active" data-tab="tasks" onclick="window.location.hash='tasks'; openTasks()">
                        <img class="icon-default" src="image/tasks_logo_mobile.png">
                        <img class="icon-active" src="image/tasks_logo_mobile-active.png">
                        <span class="sm">Задания</span>
                    </div>

                    <div class="menu-item" data-tab="statistics"
                        onclick="window.location.hash='statistics'; openStatistics()">
                        <img class="icon-default" src="image/statistics_logo_mobile.png">
                        <img class="icon-active" src="image/statistics_logo_mobile-active.png">
                        <span class="sm">Статистика</span>
                    </div>

                    <div class="menu-item" data-tab="materials" onclick="openMaterials()">
                        <img class="icon-default" src="image/materials_logo_mobile.png">
                        <img class="icon-active" src="image/materials_logo_mobile-active.png">
                        <span class="sm">Материалы</span>
                    </div>
                </div>

                <div class="menu__inside-second" onclick="openProfile()">
                    <div class="menu-item profile__logo" data-tab="profile">
                        <img class="icon-default" src="image/profile_logo_mobile.png" alt="Профиль">
                        <img class="icon-active" src="image/profile_logo_mobile-active.png" alt="Профиль">
                    </div>
                </div>

            </nav>

        </div>
    </header>

    <!--    Subject-Swiper - Begin   -->
    <?php if ($hasMath && $hasPhysics): ?>
    <section class="subject__swiper">
        <div class="subjects">

            <div class="subject <?= $subject == 'Математика' ? 'active' : '' ?>" onclick="changeSubject('Математика')">
                Математика
            </div>

            <div class="subject <?= $subject == 'Физика' ? 'active' : '' ?>" onclick="changeSubject('Физика')">
                Физика
            </div>

        </div>
    </section>
    <?php endif; ?>
    <!--    Subject-Swiper - End   -->


    <!--    Home-Work-current - Begin   -->
    <section class="container section-task current-task">
        <div class="card">
            <div class="Title">
                <h1 class="lg">Домашняя работа</h1>
            </div>
            <?php
                    $active = $conn->prepare("
                    SELECT * FROM homeworks h
                    WHERE 
                        (
                            (h.target_type = 'student' AND h.target_value = ?)
                            OR
                            (h.target_type = 'group' AND h.target_value = ?)
                        )
                        AND h.subject = ?
                        AND NOT EXISTS (
                            SELECT 1 FROM homework_submissions hs
                            WHERE hs.homework_id = h.id
                            AND hs.student_name = ?
                        )
                    ORDER BY h.homework_date ASC
                ");

                    $active->bind_param("ssss", $fullName, $group, $subject, $fullName);
                    $active->execute();
                    $activeResult = $active->get_result();
                ?>

            <?php if ($activeResult->num_rows > 0): ?>
            <?php while ($hw = $activeResult->fetch_assoc()): ?>
            <div class="card s">
                <div class="hwc__line-first">
                    <p class="md">
                        <?= $hw['title'] ?>
                    </p>
                    <!-- <div class="hwc-status">
                                <p class="xs">Новое</p>
                            </div> -->
                </div>

                <div class="hwc__line-second">
                    <div class="hwc-date">
                        <img class="hw-date-icon" src="image/hw_date.png">
                        <p class="xs">До
                            <?= formatDateRu($hw['homework_date']) ?>
                        </p>
                    </div>
                </div>

                <div class="line__horizontal"></div>

                <div class="hwc__line-third">
                    <?php if (!empty($hw['file_path'])): ?>

                    <a href="<?= $hw['file_path'] ?>" download class="btn-dark download" style="text-decoration: none;"
                        id="DOWN">
                        <img class="hw-date-icon" src="image/download.png">
                        Скачать
                    </a>

                    <?php endif; ?>

                    <form action="php/upload-solution.php" method="POST" enctype="multipart/form-data" class="upload"
                        id="UPL">

                        <input type="hidden" name="homework_id" value="<?= $hw['id'] ?>">
                        <input type="hidden" name="student_name" value="<?= $fullName ?>">

                        <!-- скрытый input -->
                        <input type="file" name="photos[]" id="fileInput<?= $hw['id'] ?>" multiple hidden
                            onchange="this.form.submit()">

                        <!-- твоя кнопка -->
                        <button type="button" class="btn-dark"
                            onclick="document.getElementById('fileInput<?= $hw['id'] ?>').click()">

                            <img class="hw-date-icon" src="image/upload.png">
                            Загрузить
                        </button>
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <!-- <script>
                var sectionCurrentTask = document.getElementsByClassName('current-task');
                for (let i = 0; i < sectionCurrentTask.length; i++) {
                    sectionCurrentTask[i].style.display = "none";
                }
            </script> -->
            <p class="md" style="margin-left: var(--space-xs);">Текущих заданий нет.</p>
            <?php endif; ?>
        </div>
    </section>
    <!--    Home-Work-current - End   -->
    <!--    Home-Work-history - Begin   -->
    <section class="container  section-task">
        <div class="card">
            <div class="Title">
                <h1 class="lg">Прошлые задания</h1>
            </div>
            <?php
                $archive = $conn->prepare("
                    SELECT hs.*, h.title, h.homework_date
                    FROM homework_submissions hs
                    JOIN homeworks h ON hs.homework_id = h.id
                    WHERE hs.student_name = ?
                    AND h.subject = ?
                    ORDER BY hs.id DESC
                    LIMIT 3
                ");

                $archive->bind_param("ss", $fullName, $subject);
                $archive->execute();
                $archiveResult = $archive->get_result();
                ?>
            <!-- Крайняя домашка -->

            <?php if ($archiveResult->num_rows > 0): ?>
            <?php while ($item = $archiveResult->fetch_assoc()): ?>

            <div class="card s">
                <div class="hwc__line-first">
                    <p class="md">
                        <?= $item['title'] ?>
                    </p>
                    <p class="xs">
                        <?= formatDateRu($item['homework_date']) ?>
                    </p>
                </div>
                <?php
                $status = $item['status'];

                if ($status == 'не проверено') {
                    echo "<div class=\"hw__line-third\">
                            <div class=\"hw__result-status\">
                                <div class=\"hw__result-status-indicator\" style=\"background-color: #FFE400;\"></div>
                                <p class=\"xs\">На проверке</p>
                            </div>
                           </div>";
                } elseif ($status == 'проверено') {

                    $percent = $item['completed_tasks'];
                    $widthBG = 10000 / $percent;

                    echo "<div class=\"hw__line-progress\">
                            <div class=\"progress__line\">
                                <div class=\"progress__line-active\" data-width=\"" . $percent . "%\">
                                    <div class=\"progress__line-background\" style=\"width: " . $widthBG . "%;\"></div>
                                </div>
                            </div>
                            <p class=\"xs-bold\">" . $percent . "%</p>
                           </div>";

                    echo "<div class=\"hw__line-third\">
                            <div class=\"hw__result-status\">";
                    if ($percent >= 50) {
                        echo "<div class=\"hw__result-status-indicator complete\"></div>
                                <p class=\"xs\">Выполнено</p>";
                    } else {
                        echo "<div class=\"hw__result-status-indicator fail\"></div>
                                <p class=\"xs\">Не выполнено</p>";
                    }
                    // echo "</div>
                    //         <button class=\"btn-light\">
                    //             Посмотреть
                    //         </button>
                    //     </div>";
                    
                     echo "</div>
                            <a href=\"php/download-checked.php?submission_id=" . $item['id'] . "\" 
   class=\"btn-light\" 
   style=\"text-decoration: none;\">
    
    Посмотреть

            </a>
                        </div>";
                }
                ?>

            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <p class="md" style="margin-left: var(--space-xs);">История пустая</p>
            <?php endif; ?>






        </div>
    </section>
    <!--    Home-Work-history - End   -->



    <!--    Statistics - Begin   -->
    <section class="container section-demotest">
        <div class="card">
            <div class="Title">
                <h1 class="lg">Пробные экзамены</h1>
            </div>
            <div class="card s hight-result" style="padding-bottom: var(--space-lg);" id="hight-result">
                <?php
                    $maxValue = $step * ($linesCount - 1);

                    for ($i = $maxValue; $i >= 0; $i -= $step):
                    ?>
                <div class="chart-grades">
                    <p class="md">
                        <?= $i ?>
                    </p>
                    <div class="line__horizontal"></div>
                </div>
                <?php endfor; ?>

                <div class="chart-overlay">

                    <div class="chart-container" id="chart">
                        <div class="chart" data-max="<?= $maxValue ?>">

                            <?php
                                $months = [
                                    'september' => 'Сентябрь',
                                    'october' => 'Октябрь',
                                    'november' => 'Ноябрь',
                                    'december' => 'Декабрь',
                                    'january' => 'Январь',
                                    'february' => 'Февраль',
                                    'march' => 'Март',
                                    'april' => 'Апрель',
                                    'may' => 'Май'
                                ];

                                foreach ($months as $key => $label):

                                    $value = $testData[$key] ?? 0;
                                ?>
                            <div class="bar" data-value="<?= $value ?>">
                                <div class="bar-fill">
                                    <span>
                                        <?= $value ?>
                                    </span>
                                </div>
                                <p>
                                    <?= $label ?>
                                </p>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                </div>
            </div>
            <?php if ($showGrades): ?>
    <div class="grades">
        <?php foreach ($grades as $index => $grade): ?>
            <div>
                <p>«<?= $grade[0] ?>»</p>
                <p><?= $grade[1] ?></p>
            </div>

            <?php if ($index < count($grades) - 1): ?>
                <div class="line__vertical"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
        </div>
    </section>





    <section class="container section-performance">
        <div class="card">
            <div class="Title">
                <h1 class="lg">Успеваемость</h1>
            </div>
            <div class="card s">
                <div class="hwc__line-first">
                    <p class="md">Выполнение домашних работ</p>
                    <p class="xs"><?= $hwDone ?>/<?= $hwTotal ?></p>
                </div>
                <div class="hw__line-progress">
                    <?php
                        $percent = 0;

                        if ($hwTotal > 0) {
                            $percent = round(($hwDone / $hwTotal) * 100);
                        }

                        $widthBG = $percent > 0 ? round(10000 / $percent) : 0;
                    ?>
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="<?= $percent ?>%">
                            <div class="progress__line-background" style="width: <?= $widthBG ?>%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold"><?= $percent ?>%</p>
                </div>

                <div class="line__horizontal"></div>
                <?php
                    $stmt = $conn->prepare("
                        SELECT AVG(completed_tasks) as avg_value
                        FROM homework_submissions
                        WHERE student_name = ?
                        AND subject = ?
                        AND status = 'проверено'
                    ");

                    $stmt->bind_param("ss", $fullName, $subject);
                    $stmt->execute();

                    $result = $stmt->get_result()->fetch_assoc();

                    $avgQuality = round($result['avg_value'] ?? 0);

                    $widthBG = $percent > 0 ? round(10000 / $avgQuality) : 0;
                    $stmt->close();
                ?>
                <div class="hwc__line-first">
                    <p class="md">Среднее качество домашних работ</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="<?= $avgQuality ?>%">
                            <div class="progress__line-background" style="width: <?= $widthBG ?>%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold"><?= $avgQuality ?>%</p>
                </div>

                <div class="line__horizontal"></div>

                <div class="hwc__line-first">
                    <p class="md">Посещаемость</p>
                    <p class="xs"><?= $lessonDone ?>/<?= $lessonTotal ?></p>
                </div>
                <div class="hw__line-progress">
                    <?php
                        $percent = 0;

                        if ($lessonTotal > 0) {
                            $percent = round(($lessonDone / $lessonTotal) * 100);
                        }

                        $widthBG = $percent > 0 ? round(10000 / $percent) : 0;
                    ?>
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="<?= $percent ?>%">
                            <div class="progress__line-background" style="width: <?= $widthBG ?>%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold"><?= $percent ?>%</p>
                </div>
            </div>
        </div>
    </section>
    <section class="container section-progress">
        <div class="card">
            <div class="Title">
                <h1 class="lg">Прогресс</h1>
            </div>
            <div class="card s">
                <div class="hwc__line-first">
                    <p class="md">Общий прогресс</p>
                    <p class="xs">10/19</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="53%">
                            <div class="progress__line-background" style="width: 189%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold">53%</p>
                </div>
            </div>
            <div class="card s">
                <div class="hwc__line-first">
                    <p class="md">Первая часть</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__tasks">
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task done"></div>
                        <div class="progress__task now"></div>
                        <div class="progress__task"></div>
                    </div>
                    <p class="xs-bold">83%</p>
                </div>

                <div class="line__horizontal"></div>

                <div class="hwc__line-first">
                    <p class="md">Вторая часть</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__tasks">
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                        <div class="progress__task"></div>
                    </div>
                    <p class="xs-bold">0%</p>
                </div>
            </div>
        </div>
    </section>
    <!--    Statistics - End   -->


















    <!-- Футер -->
    <footer class="footer">
        <div class="footer-container">

            <!-- Верхняя часть -->
            <div class="footer-top">

                <!-- Лого + описание -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="image/logo-black.webp" class="footer-logo__img" alt="">
                    </div>
                    <p class="footer-description">
                        Центр подготовки к ОГЭ и ЕГЭ по физике и математике
                    </p>
                </div>

                <!-- Навигация -->
                <div class="footer-nav">

                    <!-- Курсы -->
                    <div class="footer-column">
                        <h3 class="H3">Курсы</h3>
                        <ul>
                            <li><a href="#">ЕГЭ по математике</a></li>
                            <li><a href="#">ЕГЭ по физике</a></li>
                            <li><a href="#">ОГЭ по математике</a></li>
                            <li><a href="#">ОГЭ по физике</a></li>
                        </ul>
                    </div>

                    <!-- О центре -->
                    <div class="footer-column">
                        <h3 class="H3">О центре</h3>
                        <ul>
                            <li><a href="#">Сведения об организации</a></li>
                            <li><a href="#">Акции</a></li>
                            <li><a href="#">Telegram</a></li>
                            <li><a href="#">WhatsApp</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Разделительная линия -->
            <div class="footer-divider"></div>

            <!-- Нижняя часть -->
            <div class="footer-bottom">
                <div class="footer-links">
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Пользовательское соглашение</a>
                </div>

                <div class="footer-copy">
                    ©2026 Образовательный центр «Градус».<br>
                    Все права защищены.
                </div>
            </div>

        </div>
        <div class="footer-container-tablet">

            <!-- Верхняя часть -->
            <div class="footer-top">

                <!-- Лого + описание -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="image/logo-black.webp" class="footer-logo__img" alt="">
                    </div>
                    <p class="footer-description">
                        Центр подготовки к ОГЭ и ЕГЭ по физике и математике
                    </p>
                </div>


                <!-- Курсы -->
                <div class="footer-column">
                    <h3 class="H3">Курсы</h3>
                    <ul>
                        <li><a href="#">ЕГЭ по математике</a></li>
                        <li><a href="#">ЕГЭ по физике</a></li>
                        <li><a href="#">ОГЭ по математике</a></li>
                        <li><a href="#">ОГЭ по физике</a></li>
                    </ul>
                </div>

                <!-- О центре -->
                <div class="footer-column">
                    <h3 class="H3">О центре</h3>
                    <ul>
                        <li><a href="#">Сведения об организации</a></li>
                        <li><a href="#">Акции</a></li>
                        <li><a href="#">Telegram</a></li>
                        <li><a href="#">WhatsApp</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>

            <!-- Разделительная линия -->
            <div class="footer-divider"></div>

            <!-- Нижняя часть -->
            <div class="footer-bottom">
                <div class="footer-links">
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Пользовательское соглашение</a>
                </div>

                <div class="footer-copy">
                    ©2026 Образовательный центр «Градус».<br>
                    Все права защищены.
                </div>
            </div>

        </div>
    </footer>


    <form action="logout.php" method="POST">
        <button>Выйти</button>
    </form>

    <hr>

    <script src="js/main.js"></script>
</body>

</html>