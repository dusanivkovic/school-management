<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

class SignUpControler
{
  protected const FULL_NAME = 'Name is required';
  protected const PASSWORD_REQUIRED = 'Password is required';
  protected const PASSWORD_MIN = 'Password must be at least 8 characters long';
  protected const EMAIL_REQUIRED = 'Email is required';
  protected const PASSWORD_MATCH = 'Password does not match';
  protected const EMAIL_FORMAT = 'Invalid email format';
  protected const USER_EXISTS = 'Username or email already taken';
  const SUCCESS_REGISTRATION = 'Registration success!';
  public RegisterModel $rm;

  public function __construct()
  {
    $this->rm = new RegisterModel();
  }

  public function validationData($postData)
  {
    $data = trim($postData);
    $data = stripcslashes($postData);
    $data = htmlspecialchars($postData);
    return $data;
  }

  protected function validateFullname($data) : void
  {
    $fullName = $this->validationData($data['fullname']);
    empty($fullName) ? $this->rm->addError('fullname', self::FULL_NAME) : '';
    if (empty($fullName))
    {
      Session::flash('name-empty', self::FULL_NAME, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validateEmail($data) : void
  {
    $email = $this->validationData($data['email']);
    if (empty($email)) 
    {
      $this->rm->addError('email-empty', self::EMAIL_REQUIRED);
      Session::flash('email-empty', self::EMAIL_REQUIRED, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $this->rm->addError('email-format', self::EMAIL_FORMAT);
      Session::flash('email-format', self::EMAIL_FORMAT, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validatePassword($data) : void
  {
    $password = $this->validationData($data['password']);

    if (empty($password)) 
    {
      $this->rm->addError('password', self::PASSWORD_REQUIRED);
      Session::flash('password-empty', self::PASSWORD_REQUIRED, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    } elseif (strlen($password) < 8) {
      $this->rm->addError('password-min', self::PASSWORD_MIN);
      Session::flash('password-min', self::PASSWORD_MIN, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validatePasswordMatch ($data): void
  {
    $password = $this->validationData($data['password']);
    $confirmPassword = $this->validationData($data['passwordConfirm']);
    $password !== $confirmPassword ? $this->rm->addError('confirm', self::PASSWORD_MATCH) : '';
    if ($password !== $confirmPassword)
    {
      Session::flash('password-match', self::PASSWORD_MATCH, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validation ($data): void
  {
    $this->validateFullname($data);
    $this->validateEmail($data);
    $this->validatePassword($data);
    $this->validatePasswordMatch($data);
  }

  protected function chackIfUserExists ()
  {
    if ($this->rm->findUserByEmail($this->rm->data));
    {
      Session::flash('register', self::USER_EXISTS, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
      exit;
    }
  }


  public function signUpUser(): void
  {
    $this->validation($this->rm->data);
    if (empty($this->rm->errors))
    {
      if ($this->rm->findUserByEmail($this->rm->data));
      {
        Session::flash('register', self::USER_EXISTS, FLASH_ERROR);
        // Session::redirect('../../httpdocs/index.php?page=register');
        exit;
      }
      if ($this->rm->registerUser($this->rm->data))
      {
        Session::flash('successRegistration', self::SUCCESS_REGISTRATION, FLASH_SUCCESS);
        Session::set('user', $this->rm->data['fullname']);
        // Session::redirect('../../httpdocs/index.php?page=register');
        Session::redirect('../../httpdocs/index.php');
      }else
      {
        Session::flash('register', 'Something went wrong!', FLASH_WARNING);
      }
    }
	}
}

if (isset($_POST['submit']))
{
  Session::init();

  //Instantiate SignUpController class
  $signup = new SignUpControler();
  //Grabbing the data
  $signup->rm->loadData($_POST);
  //Running error handlers and user signup
  $signup->signUpUser();
  //Session::prntR($signup->rm->findUserByEmail($_POST['email']));
  //going back to front page
}