<?php

$router->get('login', '/../app/views/users/login.php');
$router->get('', '/../app/views/users/login.php');
$router->get('register', '/../app/views/users/create.view.php');
// $router->get('/register', 'controllers/users/Index.php');
$router->get('main', '/../app/views/main.php');
$router->get('addTest', '/../app/views/testes/create.view.php');
$router->get('editUser', '/../app/views/users/edit.view.php');
$router->get('logout', 'controllers/users/Login.php');


$router->post('loginUser', 'controllers/users/Login.php');
$router->post('signUpUser', 'controllers/users/Create.php');
$router->put('saveUser', 'controllers/users/Store.php');
$router->post('addTest', 'controllers/testes/Create.php');


