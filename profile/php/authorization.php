<?php
include ('setting.php');
$mail = $_POST['mail'];
$password = md5($_POST['psw']);

// Использование подготовленных выражений
$stmt = mysqli_prepare($conn, "SELECT * FROM reg WHERE email=? AND password=?");
mysqli_stmt_bind_param($stmt, 'ss', $mail, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['email'] = $row['email']; // обновляем email в сессии
    header("Location: ../profile.php");
} else {
    // Если пользователь с таким email не найден, выводится сообщение об ошибке
    echo '<script>alert("Неверный логин."); window.location.href="../authorization.html";</script>';
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
