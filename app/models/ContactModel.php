<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require_once 'vendor/autoload.php';

  // sending mail
  class ContactModel {
    private $name;
    private $email;
    private $age;
    private $message;

    public function setData($name,$email,$age,$message) {
      $this->name = $name;
      $this->email = $email;
      $this->age = $age;
      $this->message = $message;
    }

    public function validation() {
      if(strlen($this->name) < 3)
        return 'Имя слишком короткое';
      else if ($_COOKIE['login'] != $this->email)
        return 'Пользователь с указанной почтой не найден';
      else if (strlen($this->email) < 5)
        return 'Email слишком короткий';
      else if (!is_numeric($this->age) || $this->age <= 0)
        return 'Введите возраст';
      else if (strlen($this->message) < 10)
        return 'Сообщение слишком короткое';
      else
        return 'Всё введено верно';
    }

    public function mail($email,$message) {
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'example@mail.ru';
        $mail->Password   = 'examplePassword';
        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
        $mail->Port       = 587;

        $mail->setFrom($email);
        $mail->addAddress('admin@mail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Вопрос от ' . $email;
        $mail->Body='Пользователь: '.$email.' отправил вопрос: '.$message;
        $mail->AltBody = '';

        $mail->send();
          return 'Сообщение было отправлено';
      } catch (Exception $e) {
          return "Сообщение не может быть отправлено. Ошибка: {$mail->ErrorInfo}";
      }
    }
  }
