<?php

  require_once 'DB.php';

  // user model
  class UserModel {
    private $email;
    private $login;
    private $password;

    private $_db = null;

    public function __construct() {
      $this->_db = DB::getInstence();
    }

    public function setData($email,$login,$password) {
      $this->email = $email;
      $this->login = $login;
      $this->password = $password;
    }

    public function validation() {

      $sql = $this->_db->query("SELECT * FROM users WHERE login = '$this->login'");
      $thisUser = $sql->fetch(PDO::FETCH_ASSOC);

      if(strlen($this->email) < 5)
        return 'Почта слишком короткая';
      else if(strlen($this->login) < 3)
        return 'Слишком короткий логин';
      else if($thisUser['login'] == $this->login)
        return 'Пользователь с таким логином уже существует';
      else if(strlen($this->password) < 5)
        return 'Пароль слишком короткий';
      else
        return 'Всё верно';
    }

    public function addUser() {
      $sql = 'INSERT INTO users(email,login,password) VALUES(:email,:login,:password)';
      $query = $this->_db->prepare($sql);
      $passHash = password_hash($this->password, PASSWORD_DEFAULT);
      $query->execute(['email'=>$this->email,'login'=>$this->login,'password'=>$passHash]);
      $this->setCookie($this->email);
    }

    public function getUser() {
      $email = $_COOKIE['login'];
      $sql = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
      return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function logOut() {
      setcookie('login', $this->email, time() - 3600 * 24, '/');
      unset($_COOKIE['login']);
      header('Location: /user/auth');
    }

    public function auth($email,$pass) {
      $sql = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      if($user['email'] == '')
        return 'Пользователь не найден';
      else if(password_verify($pass, $user['password']))
        $this->setCookie($email);
      else
        return 'Пароли не совпадают';
    }

    public function setCookie($email) {
      setcookie('login', $email, time() + 3600 * 24, '/');
      header('Location: /user');
    }
  }
