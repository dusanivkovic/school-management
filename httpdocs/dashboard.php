<?php

use app\helpers\Session;

require_once __DIR__ . '/../app/helpers/Session.php';
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
Session::requireLogin();
?>    
<div class="container-fluid page-body-wrapper">
    <?php
    require_once __DIR__ . '/inc/sidebar.php';

    if (isset($_GET['editUser']))
    {
        require_once __DIR__ . '/../app/views/editUser.php';
    }else
    {
        require_once __DIR__ . '/inc/main.php';
    }


require_once __DIR__ . '/inc/footer.php';
