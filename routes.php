<?php
// return [
//     '/route=login' => 'controllers/SignUpControler.php',
//     '/route=signUp' => 'app/controllers/SignUpControler.php',
//     '/logout' => 'app/controllers/SignUpControler.php',
//     '/editUser' => 'app/controllers/SignUpControler.php',
//     '/login' => 'app/controllers/SignUpControler.php',
// ];


$router->get('login', '/../app/views/login.php');
$router->get('', '/../app/views/login.php');
$router->get('register', '/../app/views/register.php');
$router->get('main', '/../app/views/main.php');
$router->get('editUser', '/../app/views/editUser.php');
$router->get('logout', 'controllers/SignUpControler.php');

$router->post('loginUser', 'controllers/SignUpControler.php');
$router->post('signUpUser', 'controllers/SignUpControler.php');
$router->put('saveUser', 'controllers/SignUpControler.php');


