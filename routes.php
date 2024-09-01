<?php

$router->get('login', '/../app/views/users/login.php');
$router->get('', '/../app/views/users/login.php');
$router->get('register', '/../app/views/users/create.view.php');
// $router->get('/register', 'controllers/users/Index.php');
$router->get('main', '/../app/views/main.php');
$router->get('addTest', '/../app/views/testes/create.view.php');
$router->get('editUser', '/../app/views/users/edit.view.php');
$router->get('logout', 'controllers/users/Login.php');
$router->get('classesView', '/../app/views/testes/index.classes.php');
$router->get('controlsView', '/../app/views/testes/index.php');
$router->get('writeningView', '/../app/views/testes/index.php');


$router->post('loginUser', 'controllers/users/Login.php');
$router->post('signUpUser', 'controllers/users/Create.php');
$router->put('saveUser', 'controllers/users/Store.php');
$router->put('addClassTeacher', 'controllers/users/Store.php');
$router->post('saveTest', 'controllers/testes/Store.php');
$router->delete('deleteTest', 'controllers/testes/Destroy.php');
$router->patch('editTest', '/../app/views/testes/edit.view.php');
$router->patch('updateTest', 'controllers/testes/Edit.php');


