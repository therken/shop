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
$about = mysqli_real_escape_string($conn, $_POST['about']);
$edate = strtotime($_POST['date']); 
$edate = date("Y-m-d", $edate);
$startDate = date('Y-m-d', strtotime("01/01/1900"));
$endDate = date('Y-m-d', strtotime("01/10/2024"));

// проверка даты
if (($edate >= $startDate) && ($edate <= $endDate)) {
echo "";
} else {
    '<script>alert("Введите корректную дату"); window.location.href="./redact.php";</script>';
die();
}
$uploaddir = 'uploads/';
$tempFilePath = $_FILES['image']['tmp_name']; 
$fileName = $_FILES['image']['name']; 
$uploadFile = $uploaddir . uniqid() . '-' . basename($fileName); 

if(!is_uploaded_file($_FILES['image']['tmp_name'])) {
    '<script>alert("Загрузите фото"); window.location.href="./redact.php";</script>';
die();
} 

//Проверка что это картинка
if (!getimagesize($_FILES["image"]["tmp_name"])) {
    '<script>alert("Не картинка"); window.location.href="./redact.php";</script>';
die();
}

if (move_uploaded_file($tempFilePath, $uploadFile)) {
header("Location: ./profile.php");
} else {
$errorMessage = "Возможная атака с помощью файловой загрузки!";
echo "'$errorMessage";
}
$photo_link = $uploadFile; 
$sql = "UPDATE reg SET name='$name', secondname='$secondname', date='$edate',about='$about',photo_link='$photo_link' WHERE email='$email'";
if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Информация обновлена."); window.location.href="./profile.php";</script>';
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./css/redstyle.css">
<script src="./script.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link type="image/x-icon" href="./icon.png" rel="shortcut icon">
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
<form method="post" enctype="multipart/form-data">
<label type="file" for="profile-photo">
<img src="https://preview.redd.it/imrpoved-steam-default-avatar-v0-ffxjnceu7vf81.png?width=640&crop=smart&auto=webp&s=0f8cbc4130a94fc83f19418f1a734209108c2a4b" class="rounded-circle" alt="Фото профиля">
</label>
<input name="image" type="file" class="form-control-file" id="profile-photo" style="display: none">
<label for="image">Выберите фотографию</label>
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
<textarea type="text" maxlength="100" required name="about" value="<?php echo $row['about']; ?>"></textarea>
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
