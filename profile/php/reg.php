<?php
include ('setting.php');

// Использование подготовленных выражений
$stmt = mysqli_prepare($conn, "INSERT INTO reg (name,secondname,email, password) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    die("ERROR: Could not prepare statement. " . mysqli_error($conn));
}
$name = $_POST['name'];
$secondname = $_POST['secondname'];
$mail = $_POST['mail'];
$password = $_POST['psw'];

// Использование md5 для хеширования пароля
$hashed_password = md5($password);

// Проверка наличия email в базе данных
$check_email_query = mysqli_prepare($conn, "SELECT email FROM reg WHERE email = ?");
mysqli_stmt_bind_param($check_email_query, 's', $mail);
mysqli_stmt_execute($check_email_query);
mysqli_stmt_store_result($check_email_query);

if (mysqli_stmt_num_rows($check_email_query) > 0) {
    // Почта уже существует, необходимо обработать ошибку
    echo '<script>alert("Данный email уже зарегистрирован."); window.location.href="../reg.html";</script>';
    exit;
}

mysqli_stmt_bind_param($stmt, 'ssss', $name,$secondname,$mail, $hashed_password);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo '<script>alert("Информация добавлена успешно."); window.location.href="../authorization.html";</script>';
    exit;
} else {
    echo "Ошибка: " . mysqli_error($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
