<?php
include ('./profile/php/setting.php');
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email= $_POST['email'];
$country= $_POST['country'];
$city = $_POST['country'];
$address= $_POST['address'];
$size= $_POST['size'];
$stmt = mysqli_prepare($conn, "INSERT INTO reg (name,lastname,email,country,city,address,size) VALUES (?, ?, ?, ?,?,?)");
mysqli_stmt_bind_param($stmt, 'sssssss', $name,$lastname,$email, $country,$city,$address,$size);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo '<script>alert("Информация добавлена успешно."); window.location.href="../authorization.html";</script>';
    exit;
} else {
    echo "Ошибка: " . mysqli_error($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);}
?>
