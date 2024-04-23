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


    //Instantiate SignUpController class
    $signup = new SignUpControler($_POST);
        //Grabbing the data
    $signup->rm->loadData($_POST);
    $signup->signUpUser();


    //Running error handlers and user signup
    if ($signup->rm->hasError('fullname'))
    {
        RegisterModel::prntR($signup);
        // header('location: ../../httpdocs/index.php?error=fullname');
    }

    //going back to front page
}