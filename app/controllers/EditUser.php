<?php
namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\helpers\Session;
use app\models\RegisterModel;

class EditUser 
{
    public RegisterModel $rm;
    public int $userId;
    public string $fullName;
    public string $email;
    public string $password;
    public string $classTeacher;

    public function __construct()
    {
      $this->rm = new RegisterModel();
    }

    
}
