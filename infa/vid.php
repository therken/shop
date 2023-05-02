<?php
include ('../profile/php/setting.php');
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT name, message FROM reviews";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Reviews</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="../script/script.js"></script>
<link rel="stylesheet" href="../css/infa.css">
<title>feedback</title>
</head>
<body>
<div class="menu2">
<nav>
<ul>
<li> <button class="back" onclick="goBack()">Назад</button></li>
</ul>
</nav>
</div>
<div class="reviews">
<div class="header">
    <h3>Отзывы</h3>
    </div>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <h3>Имя</h3>
<p><?php echo $row['name'] ; ?></p>
<h3>Отзыв</h3>
<span><?php echo $row['feed'] ; ?></span><hr>
<?php } ?>
<button class="send"><a href="reviews.html" class="dost">Добавить отзыв</a></button>
</div>
</body>
