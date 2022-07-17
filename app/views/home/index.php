<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/links.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
  <title>Главная</title>
</head>
<body>
  <?php require_once 'public/blocks/header.php' ?>

  <!-- if Cookie is set - show link shortener-->
  <?php if(isset($_COOKIE['login'])): ?>
    <div class="main">
        <h1>Сокра.тим</h1>
        <p>Вам нужно сократить ссылку? Сейчас мы это сделаем!</p>
        <form action="/home" method="post">
          <input type="text" name="link" placeholder="Ссылка" value="<?=$_POST['link'] ?>"> <br>
          <input type="text" name="shortLink" placeholder="Короткое название" value="<?=$_POST['shortLink'] ?>">
          <br>
            <div class="error">
              <?=$data['error'] ?>
              <?=$data['info'] ?>
            </div>
          <br>
          <button name="button" style="width:150px" >Уменьшить</button>
        </form>
    </div>

    <div class="links">
      <?php if(($data['showLinks']) == true): ?>
        <h2>Сокращённые ссылки</h2>
      <?php endif; ?>
      <?php for($i=0;$i<count($data['showLinks']);$i++): ?>
        <div class="link">
          <div>
            <p>Длинная ссылка:
              <a href="<?= $data['showLinks'][$i]['link']?>">
                <b><?= $data['showLinks'][$i]['link']?></b>
              </a>
            </p>
            <p>Сокращённая ссылка:
              <a href="<?= $data['showLinks'][$i]['link']?>">
                <b><?= $data['showLinks'][$i]['shortLink']?></b>
              </a>
            </p>
          </div>

          <div>
            <form action="/home" method="post">
                <input type="hidden" value="<?=$data['showLinks'][$i]['id'] ?>" name="deleteLink">
                <button>
                  <?=$data['delete'] ?> Удалить <i class="fas fa-trash"></i>
                </button>
            </form>
          </div>

        </div>
      <?php endfor; ?>
    </div>

  <!-- registration form - if cookie is not set -->
  <?php else: ?>
    <div class="main">
        <h1>Сокра.тим</h1>
        <p>Вам нужно сократить ссылку?<br> Прежде чем это сделать зарегистрируйтесь на сайте</p>
        <form action="/home/reg" method="post">
          <input type="email" name="email" placeholder="Введите email" value =<?=$_POST['email'] ?>> <br>
          <input type="text" name="login" placeholder="Введите логин" value =<?=$_POST['login'] ?>>
          <br>
          <input type="password" name="password" placeholder="Введите пароль" value =<?=$_POST['password'] ?>>
          <br>
          <div class="error">
            <?=$data['error']?>
          </div>
          <button name="button">Зарегистрироваться</button>
        </form>
        <p>Есть аккаунт? Тогда вы можете
          <a href="/user/auth">авторизоваться</a>
        </p>
    </div>

  <?php endif; ?>

  <?php require_once 'public/blocks/footer.php' ?>
</body>
</html>
