<?php
namespace app\controllers\users;
require_once __DIR__ . '/../../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

class LoginUser extends User
{
    public function loginUser ()
    {
      $this->loginValidation();
      if ($this->rm->errors)
      {
        Session::redirect('index.php?login');
        exit;
      }
      if (!$this->rm->errors)
      {
        if ($this->rm->validateUserData())
        {
          $user = $this->rm->findUserByEmail();
          Session::set('user', $user['full_name']);
          Session::set('userId', $user['user_id']);
          Session::set('password', $_POST['password']);
          Session::redirect('dashboard.php?main');
          exit;
        }
        if (!$this->rm->findUserByEmail())
        {
          Session::flash('user', self::USER_UNKNOWN, FLASH_WARNING);
          Session::redirect('index.php?login');
          exit;
        }else
        {
          Session::flash('user', self::PASSWORD_WRONG, FLASH_WARNING);
          Session::redirect('index.php?login');
          exit;
        }
        $this->rm->db->conn->close();
      }
    }

    public function logout ()
    {
      Session::destroy();
      Session::redirect('index.php');
    }
}
//Instantiate LoginUser class
$user = new LoginUser();
if (isset($_POST['login']))
{
  Session::init();
  $user->loginUser();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
  if (isset($_GET['logout']))
  {
    Session::init();
    $user->logout();
    exit;
  }
}