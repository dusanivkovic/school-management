<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;

class SignUpControler
{
  const FULL_NAME = 'Name is required';
  const PASSWORD_REQUIRED = 'Password is required';
  const PASSWORD_MIN = 'Password must be at least 8 characters long';
  const EMAIL_REQUIRED = 'Email is required';
  const PASSWORD_MATCH = 'Password does not match';
  const EMAIL_FORMAT = 'Invalid email format';
  public RegisterModel $rm;

  public function __construct()
  {
    $this->rm = new RegisterModel();
  }

  public function validation($postData)
  {
    $data = trim($postData);
    $data = stripcslashes($postData);
    $data = htmlspecialchars($postData);
    return $data;
  }

  protected function validateFullname() 
  {
    $fullName = $this->validation($this->rm->data['fullname']);
    empty($fullName) ? $this->rm->addError('fullname', self::FULL_NAME) : '';
    if (empty($fullName))
    {
      Session::flash('register', self::FULL_NAME, FLASH_INFO);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validateEmail() 
  {
    $email = $this->validation($this->rm->data['email']);
    if (empty($email)) 
    {
      $this->rm->addError('email-empty', self::EMAIL_REQUIRED);
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $this->rm->addError('email-format', self::EMAIL_FORMAT);
    }
  }

  protected function validatePassword() 
  {
    $password = $this->rm->data['password'];

    if (empty($password)) 
    {
      $this->rm->addError('password', self::PASSWORD_REQUIRED);
    } elseif (strlen($password) < 8) {
      $this->rm->addError('password-min', self::PASSWORD_MIN);
    }
  }

  protected function validatePasswordMatch ()
  {
    $password = $this->rm->data['password'];
    $confirmPassword = $this->rm->data['passwordConfirm'];
    $password !== $confirmPassword ? $this->rm->addError('confirm', self::PASSWORD_MATCH) : '';
  }

  public function signUpUser()
  {
    $this->validateFullname();
    $this->validateEmail();
    $this->validatePassword();
    $this->validatePasswordMatch();
    return $this->rm->errors;
	}
}

if (isset($_POST['submit']))
{
  // $fullName = $_POST['fullname'];
  // $password = $_POST['password'];
  // $email = $_POST['email'];
  // $subject = $_POST['subject'];
  // $classTeacher = $_POST['classteacher'];
  Session::init();

  //Instantiate SignUpController class
  $signup = new SignUpControler();
  //Grabbing the data
  $signup->rm->loadData($_POST);
  $signup->signUpUser();

  //Running error handlers and user signup
  // if ($signup->rm->hasError('fullname'))
  // {
  //   Session::set('fullname', $signup::FULL_NAME);
  //   Session::redirect('../../httpdocs/index.php?page=register');
  // }else
  // {
  //   Session::unset('fullname');
  // }

  if ($signup->rm->hasError('email-empty'))
  {
    Session::set('email-empty', $signup::EMAIL_REQUIRED);
    Session::redirect('../../httpdocs/index.php?page=register');
  }else
  {
    Session::unset('email-empty');
  }

  if ($signup->rm->hasError('email-format'))
  {
    Session::set('email-format', $signup::EMAIL_FORMAT);
    Session::redirect('../../httpdocs/index.php?page=register');
  }else
  {
    Session::unset('email-format');
  }

  if ($signup->rm->hasError('password'))
  {
    Session::set('password', $signup::PASSWORD_REQUIRED);
    Session::redirect('../../httpdocs/index.php?page=register');
  }else
  {
    Session::unset('password');
  }

  if ($signup->rm->hasError('confirm'))
  {
    Session::set('password-confirm', $signup::PASSWORD_MATCH);
    Session::redirect('../../httpdocs/index.php?page=register');
  }else
  {
    Session::unset('password-confirm');
  }

  if ($signup->rm->hasError('password-min'))
  {
    Session::set('password-min', $signup::PASSWORD_MIN);
    Session::redirect('../../httpdocs/index.php?page=register');
  }else
  {
    Session::unset('password-min');
  }

  if (empty($signup->rm->errors))
  {
    $signup->rm->registerUser();
    Session::prntR($signup);
    exit;
    header('location: ../../httpdocs/dashboard.php');
  }
  //going back to front page
}