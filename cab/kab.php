<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['name'] ?></title>
</head>
<body>
    <h1>Привет <?= $_SESSION['name'] ?>!</h1>
    <p>Твой номер телефона: <?= $_SESSION['phone'] ?></p>
    <p>Твой ID: <?= $_SESSION['id'] ?></p>
    <form action="index.php">
        <button>Вернуться назад</button>
    </form>
</body>
</html>