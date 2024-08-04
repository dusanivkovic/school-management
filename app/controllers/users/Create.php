<?php
namespace app\controllers\users;
require_once __DIR__ . '/../../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

class CreateUsers extends User
{
    public function signUpUser(): void
    {
        $this->validation();
        if ($this->rm->errors)
        {
            Session::redirect('./?register');
            exit;
        }
        if (!$this->rm->errors)
        {
            if ($this->rm->findUserByEmail($this->rm->data))
            {
                Session::flash('register', self::USER_EXISTS, FLASH_ERROR);
                Session::redirect('./?register');
                exit;
            }
            if ($this->rm->registerUser($this->rm->data))
            {
                Session::flash('successRegistration', self::SUCCESS_REGISTRATION, FLASH_SUCCESS);
                Session::redirect('./');
                exit;
            }
            if (!$this->rm->registerUser($this->rm->data))
            {
                Session::flash('register', 'Something went wrong!', FLASH_WARNING);
                Session::redirect('./?register');
                exit;
            }
            $this->rm->db->conn->close();
        }
    }
}

//Instantiate CreateUser class
$user = new CreateUsers();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (isset($_POST['submit']))
  {
    Session::init();
    $user->signUpUser();
    exit;
  }
}