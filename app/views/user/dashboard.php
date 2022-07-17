<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/user.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
  <title>Кабинет пользователя</title>
</head>
<body>
  <?php require_once 'public/blocks/header.php' ?>

  <!-- personal account -->
  <?php if(isset($_COOKIE['login'])): ?>
    <div class="dashboard">
      <h2>Кабинет пользователя</h2>

      <form action="/user" method="post">
        <p>Добро пожаловать, <b><?=$data['user']['login'] ?></b></p>
      </form>

      <form action="/user" method="post">
        <input type="hidden" name="exit">
        <button name="button">Выйти</button>
      </form>
    </div>

  <?php else: ?>
    <?php header('Location: /user/auth') ?>
  <?php endif; ?>

  <?php require_once 'public/blocks/footer.php' ?>
</body>
</html>
