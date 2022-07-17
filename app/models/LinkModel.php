<?php

  require_once 'DB.php';

  // making user link
  class LinkModel {
    private $url;
    private $shortUrl;
    private $_db = null;

    public function __construct() {
      $this->_db = DB::getInstence();
    }

    public function setData($url, $shortUrl) {
      $this->url = $url;
      $this->shortUrl = $shortUrl;
    }

    public function validation() {
      if((filter_var($this->url,FILTER_VALIDATE_URL)) == '')
        return 'Укажите верный Url';
      else if(strlen($this->shortUrl) < 2)
        return 'Название должно содержать не менее 2 символов';
      else
        return 'Url указан верно';
    }

    public function addShortLink($url,$shortUrl) {

      $newUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $shortUrl;
      $email = $_COOKIE['login'];

      $sql = $this->_db->query("SELECT * FROM links WHERE shortLink = '$newUrl'");
      $link = $sql->fetch(PDO::FETCH_ASSOC);

      if($link == true)
        return 'Данное сокращение уже используется';

      else {
        $sql = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        $sql = 'INSERT INTO links(user_id, link, shortLink) VALUES(:user_id, :link, :shortLink)';
        $query = $this->_db->prepare($sql);
        $query->execute(['user_id'=>$user['id'],'link'=>$url,'shortLink'=>$newUrl]);
      }
    }

    public function getShortLink() {
      $email = $_COOKIE['login'];

      $sql = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
      $user = $sql->fetch(PDO::FETCH_ASSOC);

      $sql = $this->_db->query("SELECT * FROM users WHERE email = '$email'");
      $user = $sql->fetch(PDO::FETCH_ASSOC);
      $userId = $user['id'];

      $sql = $this->_db->query("SELECT * FROM links WHERE user_id = '$userId'");
      $link = $sql->fetchAll(PDO::FETCH_ASSOC);
      
      return $link; 
    }

    public function delLink($id) {
      $sql = $this->_db->query("DELETE FROM links WHERE id = '$id'");
    }
  }
