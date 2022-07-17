<header>
    <div class="container">
      <div class="logo">
        <a href="/"><img src="/public/img/logo.png" alt=""></a>
        <h3>Уберём всё лишнее из ссылки!</h3>
      </div>
      <?php if(!isset($_COOKIE['login'])): ?>
        <div class="menu">
          <a href="/">Главная</a>
          <a href="/contact/about">Про нас</a>
          <a href="/contact">Контакты</a>
          <a href="/user/auth">Войти</a>
        </div>
      <?php else: ?>
        <div class="menu">
          <a href="/">Главная</a>
          <a href="/contact/about">Про нас</a>
          <a href="/contact">Контакты</a>
          <a href="/user">Личный кабинет</a>
        </div>
      <?php endif; ?>
    </div>
</header>
