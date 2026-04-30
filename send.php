<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$role = $_POST['role'];

// --- БАЗА ---
$conn = new mysqli("localhost", "u3414210_default", "77tiLOpwb6aF5koW", "u3414210_default");

if (!$conn->connect_error) {
    $stmt = $conn->prepare("INSERT INTO leads (name, phone, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $role);
    $stmt->execute();
    $stmt->close();
}

// --- TELEGRAM ---
$token = "8642722442:AAHIXOBL87e0MWpTeuEJjNwg0BTjsAH3CQs";
$chat_id = "257819245";

$text = "📩 Новая заявка:\n\n👤 Имя: $name\n📞 Телефон: $phone\n🎓 Роль: $role";

$url = "https://api.telegram.org/bot$token/sendMessage";

$params = [
  'chat_id' => $chat_id,
  'text' => $text
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_exec($ch);
curl_close($ch);

header("Location: index.html");
exit;

?>