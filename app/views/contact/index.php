<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
  <title>Обратная связь</title>
</head>
<body>
  <?php require_once 'public/blocks/header.php' ?>

  <?php if(isset($_COOKIE['login'])): ?>
    <div class="main">
        <h2>Обратная связь</h2>
        <p>Напишите нам, если у вас есть вопросы</p>
        <form action="/contact" method="post">
          <input type="text" name="name" placeholder="Имя" value="<?=$_POST['name'] ?>"> <br>
          <input type="email" name="email" placeholder="Почта" value="<?=$_COOKIE['login'] ?>"> <br>
          <input type="number" name="age" placeholder="Ваш возраст" value="<?=$_POST['age'] ?>"> <br>
          <textarea name="message" placeholder="Сообщение" value="<?=$_POST['message'] ?>"></textarea><br>
          <div class="error">
            <?=$data['message'] ?>
          </div>
          <button name="button" style="width:150px">Отправить</button>
        </form>
    </div>

  <?php else: ?>
    <?php header('Location: /user/auth'); ?>
  <?php endif; ?>

  <?php require_once 'public/blocks/footer.php' ?>
</body>
</html>
