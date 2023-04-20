<?php 
include ('./php/setting.php');
session_start();

// Проверка авторизации пользователя
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location: ./authorization.html");
    exit();
}

// Если форма отправлена
if (isset($_POST['email'])) {
    // Получаем новые значения данных из формы редактирования профиля
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $secondname = mysqli_real_escape_string($conn, $_POST['secondname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Обновляем данные в базе данных
    $sql = "UPDATE reg SET name='$name', secondname='$secondname' WHERE email='$email'";
}

// Получаем данные пользователя из базы данных для отображения в форме редактирования
$email = $_SESSION['email'];
$sql = "SELECT email, name, secondname FROM reg WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>
    <link rel="stylesheet" href="./css/redstyle.css">
    <script src="../script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="menu2">
        <nav>
        <ul>
            <li> <button class="back" onclick="goBack()">Назад</button></li>
        </ul>
        </nav>
        </div>
    <div class="wrapper">
<form method="post">
<div class="mb-3">
    <label for="text" class="form-label">Name</label>
    <input type="text" class="col-xs-2" id="text" name="name"value="<?php echo $row['name']; ?>">
  </div>

  <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Имя</label>
    <input type="text" class="col-xs-2" id="exampleInputEmail1" aria-describedby="emailHelp"name="secondname" value="<?php echo $row['secondname']; ?>">
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
</div>
    <input type="submit" value="Обновить данные">
</form>
</div>
</body>
</html>
<!-- Форма редактирования профиля -->
