<?php

  class Home extends Controller {
    // cut user link
    public function index() {     

      $data = [];
      $link = $this->model('LinkModel');

      if(isset($_POST['link'])) {

        $link->setData($_POST['link'], $_POST['shortLink']);
        $isValid = $link->validation();

        if($isValid == 'Url указан верно')
          //data['info'] - error if shortLink already exists in DB
          $data['info'] = $link->addShortLink($_POST['link'],  $_POST['shortLink']);
        else
          //data['error'] - error in form
          $data['error'] = $isValid;
      }
      $data['delete'] = $link->delLink($_POST['deleteLink']);
      $data['showLinks'] = $link->getShortLink();
      $this->view('home/index',$data);
    }

    // registration
    public function reg() {         

      $data = [];

      if(isset($_POST['email'])) {
        $user = $this->model('UserModel');
        $user->setData(
          $_POST['email'],
          $_POST['login'],
          $_POST['password']
        );

        $isValid = $user->validation();

        if($isValid == 'Всё верно')
          $user->addUser();
        else
          $data['error'] = $isValid;
      }
      $this->view('home/index', $data);
    }
  }
