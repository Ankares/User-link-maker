<?php

  class Contact extends Controller {
    // send mail
    public function index() {

      $data = [];

      if(isset($_POST['name'])) {
        $mail = $this->model('ContactModel');
        $mail->setData(
          $_POST['name'],
          $_POST['email'],
          $_POST['age'],
          $_POST['message']
        );

        $isValid = $mail->validation();
        if($isValid == 'Всё введено верно')
            $data['message'] = $mail->mail($_POST['email'],$_POST['message']);
        else
            $data['message'] = $isValid;
      }
      $this->view('contact/index',$data);
    }
    public function about(){
      $this->view('contact/about');
    }
  }
