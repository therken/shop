<?php
include ('./profile/php/setting.php');
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email= $_POST['email'];
$country= $_POST['country'];
$city = $_POST['city'];
$address= $_POST['address'];
$size= $_POST['size'];
$price =$_POST['price'];
$desc= $_POST['desc'];
$stmt = mysqli_prepare($conn, "INSERT INTO oplata (name,lastname,email,country,city,address,size,price,description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sssssssss', $name, $lastname, $email, $country, $city, $address, $size,$price,$desc);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo '<script>alert("Информация добавлена успешно.")</script>';
    exit;
} else {
    $error_msg = "Ошибка: " . mysqli_error($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo '<script>alert("'.$error_msg.'")</script>';
    exit;
}
?>

