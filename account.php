<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "root", "test");

$student_id = $_SESSION['student_id'];

// 👉 текущий выбранный предмет (по умолчанию математика)
$subject = $_GET['subject'] ?? 'Математика';


// 👉 сначала получаем телефон пользователя
$stmt = $conn->prepare("
    SELECT student_phone, parent_phone 
    FROM users_info 
    WHERE id = ?
    LIMIT 1
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();

$phone = $userData['student_phone'] ?: $userData['parent_phone'];


// 👉 теперь получаем нужную запись по предмету
$stmt = $conn->prepare("
    SELECT * FROM users_info 
    WHERE (student_phone = ? OR parent_phone = ?)
    AND subject_1 = ?
    LIMIT 1
");
$stmt->bind_param("sss", $phone, $phone, $subject);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();


// 👉 основные данные
$fullName = $student['student_lastname'] . ' ' . $student['student_firstname'];
$group = $student['group_number'];


// ====== ДАННЫЕ ДЛЯ ГРАФИКА ======
$stmt = $conn->prepare("
    SELECT lines_count, step 
    FROM test_results
    WHERE student_lastname = ? 
    AND student_firstname = ?
    AND subject = ?
    LIMIT 1
");

$lastname = $student['student_lastname'];
$firstname = $student['student_firstname'];

$stmt->bind_param("sss", $lastname, $firstname, $subject);
$stmt->execute();

$resultChart = $stmt->get_result()->fetch_assoc();

$linesCount = $resultChart['lines_count'] ?? 10;
$step = $resultChart['step'] ?? 10;

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

$testData = $stmt->get_result()->fetch_assoc();


// 👉 проверяем, есть ли у ученика математика и физика
$hasMath = false;
$hasPhysics = false;

$stmt = $conn->prepare("
    SELECT subject_1 FROM users_info 
    WHERE student_phone = ? OR parent_phone = ?
");
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


// 👉 функция форматирования даты
function formatDateRu($date) {
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

    return $day . ' ' . $months[$month];
}
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
            <div class="card s" style="padding-bottom: var(--space-lg);">
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
                        <div class="chart">

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
            <div class="grades">
                <div>
                    <p>«2»</p>
                    <p>0 - 26</p>
                </div>
                <div class="line__vertical"></div>

                <div>
                    <p>«3»</p>
                    <p>27 - 49</p>
                </div>
                <div class="line__vertical"></div>

                <div>
                    <p>«4»</p>
                    <p>50 - 67</p>
                </div>
                <div class="line__vertical"></div>

                <div>
                    <p>«5»</p>
                    <p>68 - 100</p>
                </div>
            </div>
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
                    <p class="xs">7/13</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="54%">
                            <div class="progress__line-background" style="width: 185%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold">54%</p>
                </div>

                <div class="line__horizontal"></div>

                <div class="hwc__line-first">
                    <p class="md">Среднее качество домашних работ</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="70%">
                            <div class="progress__line-background" style="width: 143%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold">70%</p>
                </div>

                <div class="line__horizontal"></div>

                <div class="hwc__line-first">
                    <p class="md">Посещаемость</p>
                    <p class="xs">11/12</p>
                </div>
                <div class="hw__line-progress">
                    <div class="progress__line">
                        <div class="progress__line-active" data-width="92%">
                            <div class="progress__line-background" style="width: 109%;"></div>
                        </div>
                    </div>
                    <p class="xs-bold">92%</p>
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
    <!--    Statisticsooks - End   -->














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