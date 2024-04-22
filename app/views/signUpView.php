<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\models\{Db, RegisterModel};
use app\controllers\SignUpControler;

if (isset($_POST['submit']))
{
    $fullName = $_POST['fullname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $classTeacher = $_POST['classteacher'];
}

//Grabbing the data
$signup = new SignUpControler($_POST);
RegisterModel::prntR($signup);
//$signup->loadData($_POST);

//Instantiate SignUpController class

//Running error handlers and user signup

//going back to front page