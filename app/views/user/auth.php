<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
  <title>Авторизация</title>
</head>
<body>
  <?php require_once 'public/blocks/header.php' ?>

  <!-- authorization -->
  <?php if(!isset($_COOKIE['login'])): ?>
    <div class="main">
      <h2>Авторизация</h2>
      <p>Здесь вы можете авторизоваться на сайте</p>
      <form action="/user/auth" method="post">
        <input type="email" name="email" value="<?=$_POST['email']?>" placeholder="Введите вашу почту"> <br>
        <input type="password" name="password" placeholder="Введите ваш пароль">
        <div class="error">
          <?=$data['message'] ?>
        </div>
        <button name="button" style="width:150px">Войти</button>
      </form>
    </div>

  <?php else: ?>
    <div class="main">
      <h2>Вы уже авторизованы</h2>
    </div>
  <?php endif; ?>

  <?php require_once 'public/blocks/footer.php' ?>
</body>
</html>
