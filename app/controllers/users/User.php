<?php
namespace app\controllers\users;
require_once __DIR__ . '/../../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

class User
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
  public const SUCCESS_REGISTRATION = 'Registration success!';
  public const SUCCESS_UPDATED = 'User successfully updated!';
  public const UNSUCCESS_UPDATED = 'User unsuccessfully updated!';
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
    }
  }

  protected function validateEmail(): void
  {
    $email = $this->validationData($this->rm->data['email']);
    if (empty($email)) 
    {
      $this->rm->addError('email-empty', self::EMAIL_REQUIRED);
      Session::flash('email-empty', self::EMAIL_REQUIRED, FLASH_ERROR);
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $this->rm->addError('email-format', self::EMAIL_FORMAT);
      Session::flash('email-format', self::EMAIL_FORMAT, FLASH_ERROR);
    }
  }

  protected function validatePassword(): void
  {
    $password = $this->validationData($this->rm->data['password']);

    if (empty($password)) 
    {
      $this->rm->addError('password', self::PASSWORD_REQUIRED);
      Session::flash('password-empty', self::PASSWORD_REQUIRED, FLASH_ERROR);
    } elseif (strlen($password) < 8) {
      $this->rm->addError('password-min', self::PASSWORD_MIN);
      Session::flash('password-min', self::PASSWORD_MIN, FLASH_ERROR);
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

  public function getValueByKey($array, $key) {
    if (array_key_exists($key, $array)) {
      return $array[$key];
    } else {
      return "Key not found.";
    }
  }
}