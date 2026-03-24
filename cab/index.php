<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Вход в личный кабинет</h1>
  <form action="auth.php" method="POST">
    <input type="text" name="phone" placeholder="Введите номер">
    <button type="submit">Войти</button>
  </form>
  <?php
   if($_SESSION['id'])
    {
      echo $_SESSION['id'] . "<br>" . $_SESSION['name'] .'<br>' . $_SESSION['phone'];
    }
  ?>
</body>
</html>