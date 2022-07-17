<?php

  class User extends Controller {
    // personal account
    public function index() {          
      $user=$this->model('UserModel');
      $data['user'] = $user->getUser();

      if(isset($_POST['exit'])) {
        $user->logOut();
        exit();
      }
      $this->view('user/dashboard',$data);
    }

    // authorization
    public function auth() {
      $data = [];
      if(isset($_POST['email'])) {
        $user = $this->model('UserModel');
        $data['message'] = $user->auth($_POST['email'],$_POST['password']);
      }
      $this->view('user/auth',$data);
    }
  }
