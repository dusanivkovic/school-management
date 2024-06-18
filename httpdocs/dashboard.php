<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\helpers\Session;
use app\core\Router;


// require_once __DIR__ . '/../app/helpers/Session.php';
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';

Session::requireLogin();

$router = new Router();
$routes = require __DIR__ . '../../routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'])['query'] ?? '';
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

var_dump($method);
Session::prntR($uri);
?>    
<div class="container-fluid page-body-wrapper">
    <?php

    ob_start();
    require_once __DIR__ . '/inc/sidebar.php';
    $router->route($uri, $method);
    ob_end_flush();

    require_once __DIR__ . '/inc/footer.php';