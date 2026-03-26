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
                        <a href="index.php" class="nav-link lg">Ученики</a>
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
            <a href="#" class="nav-link active lg">Новый ученик</a>
        </div>
    </header>

    <!-- Add-student - Bgin -->
    <section class="container" id="add-student">
        <form action="php/add-students.php" method="POST">
            <div class="card">
                <h2 class="lg">Родитель</h2>
                <div class="card s  ">
                    <div class="line">
                        <h2 class="md">Фамилия</h2>
                        <input type="text" name="parent_lastname" id="parent_lastname" placeholder="Введите фамилию">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Имя</h2>
                        <input type="text" name="parent_firstname" id="parent_firstname" placeholder="Введите имя">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Отчество</h2>
                        <input type="text" name="parent_middlename" id="parent_middlename" placeholder="Введите отчество">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Номер телефона</h2>
                        <input type="text" name="parent_phone" id="parent_phone" placeholder="Введите телефон">
                    </div>
                </div>
                <h2 class="lg">Ученик</h2>
                <div class="card s">
                    <div class="line">
                        <h2 class="md">Фамилия</h2>
                        <input type="text" name="student_lastname" id="student_lastname" placeholder="Введите фамилию">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Имя</h2>
                        <input type="text" name="student_firstname" id="student_firstname" placeholder="Введите имя">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Отчество</h2>
                        <input type="text" name="student_middlename" id="student_middlename" placeholder="Введите отчество">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Номер телефона</h2>
                        <input type="text" name="student_phone" id="student_phone" placeholder="Введите телефон">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Класс</h2>
                        <input type="text" name="student_class" id="student_class" placeholder="Введите класс">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Формат</h2>
                        <input type="text" name="study_format" id="study_format" placeholder="Групповой или индивидуальный">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Номер группы</h2>
                        <input type="text" name="group_number" id="group_number" placeholder="Введите номер группы">
                    </div>
                    <div class="under-line"></div>
                    <div class="line">
                        <h2 class="md">Предмет</h2>
                        <input type="text" name="subject_1" id="subject_1" placeholder="Введите предмет">
                    </div>
                </div>
                <button type="submit" name="submit">Создать</button>
            </div>
        </form>
    </section>
</body>
</html>