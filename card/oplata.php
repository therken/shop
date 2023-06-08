<?php 
include ('../profile/php/setting.php'); 
$name = $_POST['name']; 
$surname = $_POST['surname']; 
$card = $_POST['card']; 
$email= $_POST['email']; 
$country= $_POST['country']; 
$city = $_POST['city']; 
$address= $_POST['address']; 
$stmt = mysqli_prepare($conn, "INSERT INTO card (name,surname,card,email,country,city,address) VALUES (?, ?, ?, ?, ?, ?, ?)"); 
mysqli_stmt_bind_param($stmt, 'sssssss', $name, $surname, $card, $email, $country, $city, $address); 
 
if (mysqli_stmt_execute($stmt)) { 
    echo '<script>alert("Заказ добавлен"); window.location.href="../home.html";</script>'; 
} else { 
    $error_msg = "Ошибка: " . mysqli_error($conn); 
    echo '<script>alert("'.$error_msg.'")</script>'; 
} 
mysqli_close($conn); 
?>
