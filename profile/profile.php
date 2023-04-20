<?php
include ('./php/setting.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location: ./authorization.html");
    exit();
}

if (isset($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
}
$email = $_SESSION['email'];
$sql = "SELECT email, name, secondname, date, about FROM reg WHERE email='$email'";
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
<title>профиль</title>
<link rel="stylesheet" href="https://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="https://bootstraptema.ru/plugins/2015/b-v3-3-6/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/pstyle.css" />
<script src="../script.js"></script>
</head>
<body>
    <div class="menu2">
        <nav>
        <ul>
            <li> <button class="back" onclick="goBack()">Назад</button> <button class="back"onclick="window.location.href='../home.html'">Главная</button></li>
        </ul>
        </nav>
        </div>
<div class="wrapper">
<div class="text-center">
</header>
</div>
<img src="https://avatars.mds.yandex.net/i?id=3b42883ebede69f7cba84695be433e669a7e5088-8710632-images-thumbs&n=13" >
<a href="./redact.php" class="redact">Редактировать профиль</a>
<table class="table table-th-block">
<tbody>
<tr><td class="active">Имя</td><td><?php echo $row['name'] ; ?></td></tr>
<tr><td class="active">Фамилия</td><td><?php echo $row['secondname']; ?></td></tr>
<tr><td class="active">Дата рождения</td><td><?php echo $row['date']; ?></td></tr>
<tr><td class="active">mail</td><td><?php echo $_SESSION['email'] ;?></td></tr>
<tr><td class="active">Обо мне</td><td><?php echo $row['about']; ?></td></tr>
</tbody>
</table>
</div>
</body>
</html>
