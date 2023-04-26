<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'shop';

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Sanitize user input
$name = mysqli_real_escape_string($conn, $_POST['name']);
$mail = mysqli_real_escape_string($conn, $_POST['mail']);
$feed = mysqli_real_escape_string($conn, $_POST['feed']);

$sql = mysqli_prepare($conn, "INSERT INTO feeback (name, mail, feed) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($sql, 'sss', $name, $mail, $feed);

if (mysqli_stmt_execute($sql)) {
    mysqli_stmt_close($sql);
    mysqli_close($conn);
    echo '<script>alert("Информация добавлена успешно."); window.location.href="./feedback.html";</script>';
    exit;
} else {
    $error_message = "Ошибка: " . mysqli_error($conn);
    mysqli_stmt_close($sql);
    mysqli_close($conn);
    echo '<script>alert("' . $error_message . '"); window.location.href="./feedback.html";</script>';
    exit;
}

?>