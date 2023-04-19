<?php
$host= 'localhost';
$user = 'root';
$pass = '';
$db = 'form'; 
$conn = mysqli_connect($host , $user , $pass , $db);
// Check connection
if($conn === false){
  die("ERROR: Невозможно подключиться. "
      . mysqli_connect_error());
}
///переменные
$name = mysqli_real_escape_string($conn ,$_POST['firstname']);
$mail = mysqli_real_escape_string($conn,$_POST['mail']);
$about = mysqli_real_escape_string($conn,$_POST['about']);
$edate=strtotime($_POST['date']); 
$edate=date("Y-m-d",$edate);
$startDate = date('Y-m-d', strtotime("01/01/1900"));
$endDate = date('Y-m-d', strtotime("01/10/2024"));

///проверка существования email-адреса
$sql = "SELECT mail FROM user_form WHERE mail='$mail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$errorMessage = "Этот email уже используется";
echo "$errorMessage";
} else {
  ///проверка даты
if (($edate >= $startDate) && ($edate <= $endDate)) {
  echo "";
} else {
  $errorMessage = "некорректная дата";
  echo "$errorMessage"; 
die();
}
///загрузка файла 
$uploaddir = 'uploads/';
$tempFilePath = $_FILES['image']['tmp_name']; 
$fileName = $_FILES['image']['name']; 
$uploadFile = $uploaddir . uniqid() . '-' . basename($fileName); 

if(!is_uploaded_file($_FILES['image']['tmp_name'])) {
     $errorMessage = "Выберите изображение";
     echo "$errorMessage";
     die();
} 

//Проверка что это картинка
if (!getimagesize($_FILES["image"]["tmp_name"])) {
     $errorMessage = "Это не картинка...";
     echo "$errorMessage";
     die();
}

if (move_uploaded_file($tempFilePath, $uploadFile)) {
    $successMessage = "Файл корректен и был успешно загружен.";
    echo "$successMessage";
} else {
    $errorMessage = "Возможная атака с помощью файловой загрузки!";
    echo "'$errorMessage";
    die();
}
$photo_link = $uploadFile; 
///добавление значений в бд
  $sql = "INSERT INTO redactprofile (firstname, mail, about, date,img)
  VALUES ('$name', '$mail', '$about', '$edate','$photo_link')";
  ///вывод сообщения о том что данные добавлены
  if(mysqli_query($conn, $sql)){
    $successMessage= "Информация добавлена.";  
    echo "$successMessage";
  } else{
    $errorMessage= "Ошибка $sql. "
        . mysqli_error($conn);
        echo "$errormeMessage";
  }
}
mysqli_close($conn);
?>
