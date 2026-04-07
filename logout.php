<?php
session_start();
session_destroy();

// 🔥 удаляем cookie (чтобы не было автологина)
setcookie("student_id", "", time() - 3600, "/");

header("Location: login.php");
exit();