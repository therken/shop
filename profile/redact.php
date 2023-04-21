<?php 
include ('./php/setting.php');
session_start();

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
  header("Location: ./authorization.html");
  exit();
}
if (isset($_POST['email'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $secondname = mysqli_real_escape_string($conn, $_POST['secondname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $about = mysqli_real_escape_string($conn, $_POST['about']);

  $date_unix = strtotime($date);
  if ($date_unix === false) {
    echo "Некорректная дата";
    exit();
  }

  $sql = "UPDATE reg SET name='$name', secondname='$secondname', date='$date',about='$about' WHERE email='$email'";
  if (mysqli_query($conn, $sql)) {
    header("Location: ./profile.php");
  } else {
    echo "Ошибка при обновлении данных: " . mysqli_error($conn);
  }
}
$email = $_SESSION['email'];
$sql = "SELECT email FROM reg WHERE email='$email'";
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
<label for="name" class="form-label">Имя</label>
<input type="text" class="col-xs-2" id="text" required name="name"value="<?php echo $row['name']; ?>">
</div>

<div class="mb-3">
<label for="secondname" class="form-label">Фамилия</label>
<input type="text" class="col-xs-2" required name="secondname" value="<?php echo $row['secondname']; ?>">
</div>
<div class="mb-3">
<label for="date">Дата рождения:</label>
<input type="date" class="col-xs-2" id="date" required name="date" value="<?php echo $row['date']; ?>">
</div>
<div class="mb-3">
<label for="about" class="form-label">Расскажите о себе</label>
<input type="text" maxlength="100" required class="col-xs-2" name="about" value="<?php echo $row['about']; ?>">
</div>
<div class="mb-3">
<label for="email">Email:</label>
<input type="email" id="email" required name="email" value="<?php echo $row['email']; ?>" readonly>
</div>
<input type="submit" value="Обновить данные">
</form>
</div>
</body>
</html>
<!-- Форма редактирования профиля -->
