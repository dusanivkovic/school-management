<?php

$router->get('login', '/../app/views/login.php');
$router->get('', '/../app/views/login.php');
$router->get('register', '/../app/views/register.php');
$router->get('main', '/../app/views/main.php');
$router->get('editUser', '/../app/views/editUser.php');
$router->get('logout', 'controllers/Users/Login.php');
$router->get('addTest', '/../app/views/addTest.php');

$router->post('loginUser', 'controllers/users/Login.php');
$router->post('signUpUser', 'controllers/users/Create.php');
$router->put('saveUser', 'controllers/users/Store.php');
$router->post('addTest', 'controllers/testes/create.php');


