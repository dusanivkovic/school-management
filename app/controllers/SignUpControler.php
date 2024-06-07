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
  protected const FULL_NAME = 'Name is required!';
  protected const PASSWORD_REQUIRED = 'Password is required!';
  protected const PASSWORD_MIN = 'Password must be at least 8 characters long!';
  protected const EMAIL_REQUIRED = 'Email is required!';
  protected const PASSWORD_MATCH = 'Password does not match!';
  protected const EMAIL_FORMAT = 'Invalid email format!';
  protected const USER_EXISTS = 'Username or email already taken!';
  protected const USER_UNKNOWN = 'Username with that email does not exists!';
  protected const PASSWORD_WRONG = 'Incorrect password!';
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

  protected function validateFullname(): void
  {
    $fullName = $this->validationData($this->rm->data['fullname']);
    empty($fullName) ? $this->rm->addError('fullname', self::FULL_NAME) : '';
    if (empty($fullName))
    {
      Session::flash('name-empty', self::FULL_NAME, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validateEmail(): void
  {
    $email = $this->validationData($this->rm->data['email']);
    if (empty($email)) 
    {
      $this->rm->addError('email-empty', self::EMAIL_REQUIRED);
      Session::flash('email-empty', self::EMAIL_REQUIRED, FLASH_ERROR);
      // Session::redirect('../../httpdocs/index.php?page=register');
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $this->rm->addError('email-format', self::EMAIL_FORMAT);
      Session::flash('email-format', self::EMAIL_FORMAT, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validatePassword(): void
  {
    $password = $this->validationData($this->rm->data['password']);

    if (empty($password)) 
    {
      $this->rm->addError('password', self::PASSWORD_REQUIRED);
      Session::flash('password-empty', self::PASSWORD_REQUIRED, FLASH_ERROR);
      // Session::redirect('../../httpdocs/index.php?page=register');
    } elseif (strlen($password) < 8) {
      $this->rm->addError('password-min', self::PASSWORD_MIN);
      Session::flash('password-min', self::PASSWORD_MIN, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  protected function validatePasswordMatch (): void
  {
    $password = $this->validationData($this->rm->data['password']);
    $confirmPassword = $this->validationData($this->rm->data['passwordConfirm']);
    $password !== $confirmPassword ? $this->rm->addError('confirm', self::PASSWORD_MATCH) : '';
    if ($password !== $confirmPassword)
    {
      Session::flash('password-match', self::PASSWORD_MATCH, FLASH_ERROR);
      Session::redirect('../../httpdocs/index.php?page=register');
    }
  }

  public function validation (): void
  {
    //Grabbing the data
    $this->rm->loadData($_POST);
    //Running error handlers and user signup
    $this->validateFullname();
    $this->validateEmail();
    $this->validatePassword();
    $this->validatePasswordMatch();
  }

  public function loginValidation (): void
  {
    //Grabbing the data
    $this->rm->loadData($_POST);
    //Running error handlers and user signup
    $this->validateEmail();
    $this->validatePassword();
  }


  public function signUpUser(): void
  {
    $this->validation();
    if ($this->rm->errors)
    {
      Session::redirect('../../httpdocs/index.php?page=register');
      exit;
    }
    if (!$this->rm->errors)
    {
      if ($this->rm->findUserByEmail($this->rm->data))
      {
        Session::flash('register', self::USER_EXISTS, FLASH_ERROR);
        Session::redirect('../../httpdocs/index.php?page=register');
        exit;
      }
      if ($this->rm->registerUser($this->rm->data))
      {
        // $this->rm->conn->close();
        Session::flash('successRegistration', self::SUCCESS_REGISTRATION, FLASH_SUCCESS);
        Session::redirect('../../httpdocs/index.php');
        exit;
      }
      if (!$this->rm->registerUser($this->rm->data))
      {
        Session::flash('register', 'Something went wrong!', FLASH_WARNING);
        Session::redirect('../../httpdocs/index.php?page=register');
        exit;
      }
    }
	}

  public function loginUser ()
  {
    $this->loginValidation();
    if ($this->rm->errors)
    {
      Session::redirect('../../httpdocs/index.php');
      exit;
    }
    if (!$this->rm->errors)
    {
      if ($this->rm->validateUserData())
      {
        $user = $this->rm->findUserByEmail();
        Session::set('user', $user['full_name']);
        Session::set('userId', $user['user_id']);
        Session::redirect('../../httpdocs/dashboard.php');
        exit;
      }
      if (!$this->rm->findUserByEmail())
      {
        Session::flash('user', self::USER_UNKNOWN, FLASH_WARNING);
        Session::redirect('../../httpdocs/index.php');
        exit;
      }else
      {
        Session::flash('user', self::PASSWORD_WRONG, FLASH_WARNING);
        Session::redirect('../../httpdocs/index.php');
        exit;
      }
    }
  }

  public function logout ()
  {
    Session::destroy();
    Session::redirect('../../httpdocs/index.php');
  }

  public function saveUser ()
  {
    $this->rm->loadData($_POST);
  }


}

//Instantiate SignUpController class
$signup = new SignUpControler();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (isset($_POST['submit']))
  {
    Session::init();
    $signup->signUpUser();
    exit;
  }
  if (isset($_POST['login']))
  {
    Session::init();
      //Instantiate SignUpController class
    // $login = new SignUpControler();
    $signup->loginUser();
    exit;
  }
  if (isset($_POST['saveUser']))
  {
    //$edit = new SignUpControler();
    $signup->rm->editUser();
    Session::prntR($signup->rm);
    exit;
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if (isset($_GET['logout']))
  {
    Session::init();
    $signup->logout();
    exit;
  }

  // if (isset($_GET['saveUser']))
  // {
  //   $signup->editUser();
  //   Session::prntR($signup->rm);
  // }
}