<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'shop';

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$name = $_POST['name'];
$review = $_POST['message'];

$sql = mysqli_prepare($conn, "INSERT INTO reviews (name, feed) VALUES (?, ?)");
mysqli_stmt_bind_param($sql, 'ss', $name, $review);

if (mysqli_stmt_execute($sql)) {
    mysqli_stmt_close($sql);
    mysqli_close($conn);
    echo '<script>alert("Отзыв добавлен успешно."); window.location.href="vid.php";</script>';
    exit;
} else {
    echo "Ошибка: " . mysqli_error($conn);
    mysqli_stmt_close($sql);
    mysqli_close($conn);
}
?>
