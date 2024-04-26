<?php
require_once __DIR__ . './inc/header.php';
if (isset($_GET['page']))
{
    $page = $_GET['page'];
}

?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="d-flex col-12 flex-column">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                            <img src="images/logo.svg" alt="logo">
                        </div>
                        <h4>Welcome back!</h4>
                        <h6 class="font-weight-light">Happy to see you again!</h6>
                        <?php 
                            $page == 'register' ? require_once __DIR__. '/../app/views/register.php' : require_once __DIR__. '/../app/views/login.php';
                        ?>
                    </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2021  All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
<?php
require_once __DIR__ . './inc/footer.php';


