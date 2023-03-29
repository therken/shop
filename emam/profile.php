<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Редактирование профиля</title>
<link rel="stylesheet" href="https://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="./redactstyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<script src="redscript.js"></script>
</head>
<body>
<div class="wrapper">
<nav>
<ul>
<li><a href="../home.html">Главная</a></li>
<li><a href="../profile.html">Назад</a></li>
</ul>
</nav>
<div class="container">
<div class="row mt-5">
<div class="col-md-4 left-part">
<form id="form" action="profile.php" method="POST" enctype="multipart/form-data">
<div class="form-group text-center">
<label type="file" for="profile-photo">
<img src="https://preview.redd.it/imrpoved-steam-default-avatar-v0-ffxjnceu7vf81.png?width=640&crop=smart&auto=webp&s=0f8cbc4130a94fc83f19418f1a734209108c2a4b" class="rounded-circle" alt="Фото профиля">
</label>
<input name="image" type="file" class="form-control-file" id="profile-photo" style="display: none">
<label for="image">Выберите фотографию</label>
</div>
</div>
<div class="col-md-8 right-part">
<div class="form-group">
<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Укажите ваш никнейм" required>
</div>
<div class="form-group">
<input type="text" name="mail" type="email" class="form-control" id="mail" placeholder="Укажите ваш email" required>
</div>
<div class="form-group">
<textarea required type="text" maxlength="1000" class="form-control" id="about" rows="3" name="about" placeholder="Немного о себе"></textarea>
</div>
<input type="submit" placeholder="Отправить" value="Сохранить">
</div>
</form>
</div>
</div>
</div>
</body>
</html>
