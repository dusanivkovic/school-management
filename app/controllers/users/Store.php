<?php
namespace app\controllers\users;
require_once __DIR__ . '/../../../vendor/autoload.php';

use app\helpers\Session;


use const app\helpers\FLASH_ERROR;
use const app\helpers\FLASH_INFO;
use const app\helpers\FLASH_SUCCESS;
use const app\helpers\FLASH_WARNING;

class StoreUser extends User 
{
    public function saveUser ()
    {
        $this->rm->loadData($_POST);
        $userId = $this->rm->getUserId();
        $fullName = $this->rm->getName();
        $email = $this->rm->getMail();
        $password = $this->rm->getPassword();
        $classTeacher = $this->rm->data['class'] == 'Разред' ? '' : $this->rm->getClass() . $this->rm->getDepartment();
        if ($this->rm->editUser($userId, $fullName, $email, $password, $classTeacher)) 
        {
        $user = $this->rm->findUserByEmail();
        $this->rm->db->conn->close();
        Session::set('password', $_POST['password']);
        Session::set('user', $user['full_name']);
        Session::flash('updateUser', self::SUCCESS_UPDATED, FLASH_SUCCESS);
        Session::redirect('./dashboard.php?main');
        exit;
        }
    }
    public function saveClassTeacher ()
    {
        $this->rm->loadData($_POST);
        $class = $this->rm->getClass() . $this->rm->getDepartment();
        $user = Session::get('userId');
        if ($this->rm->editClassTeacher($class, $user))
        {
            Session::flash('updateClassTeacher', self::SUCCESS_UPDATED, FLASH_SUCCESS);
            Session::redirect('./dashboard.php?classesView');
            exit;
        }
    }

}

$user = new StoreUser();
if (isset($_POST['saveUser']))
{
    Session::init();
    $user->saveUser();
    exit;
}
if (isset($_POST['update-class-teacher']))
{
    $user->saveClassTeacher();
}
