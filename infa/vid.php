<?php
include ('../profile/php/setting.php');
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT name, feed FROM reviews";
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
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="review">
    <h3>Имя</h3>
<span><?php echo $row['name'] ; ?></span><br>
</h3>Отзыв</h3><br>
<span><?php echo $row['feed'] ; ?></span>   
</div>
<?php } ?>
</body>
