<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "test");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['lastname'];

    $stmt = $conn->prepare("
        SELECT * FROM users_info 
        WHERE student_lastname = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $lastname);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['student_name'] = $user['student_lastname'] . ' ' . $user['student_firstname'];
        $_SESSION['student_id'] = $user['id'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Ученик не найден";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Вход</h2>

<form method="POST">
    <input type="text" name="lastname" placeholder="Фамилия" required>
    <button type="submit">Войти</button>
</form>

<p style="color:red;"><?= $error ?></p>

</body>
</html>