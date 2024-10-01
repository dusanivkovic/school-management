<?php 
    require_once __DIR__ . '/../../vendor/autoload.php';

    use app\controllers\users\User;
    use app\helpers\Session;
    use app\models\TestModel;

    $tM = new TestModel();
    $userModel = new User();
    $userId = Session::get('userId');
    $numberControlTestes = count($tM->findAllTestesForUser($userId, 'контролни'));
    $numberWriteningTestes = count($tM->findAllTestesForUser($userId, 'писмени'));
    $testes = $tM->findThreSoonerTestesForUser($userId);
    $user = $userModel->rm->findUserByUserId($userId);
    $isAdmin = $userModel->getValueByKey($user, 'email') === 'dusan.ivkovic@skolers.org' ? true : false;
    $visitTermins = explode(',', $user['visit_termin']);
?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-4"><?php Session::flash(); ?></div>
                <div class="col-md-8 grid-margin">
                    <?php $isAdmin ? require_once __DIR__ . './../views/users/admin.php' : '' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title text-md-center text-xl-left">Kontrolni</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">Dodaj</h3>
                                <a href="./dashboard.php?addTest" type="button" class="btn btn-inverse-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                    <i class="ti-plus"></i>
                                </a>
                            </div>  
                            <p class="mb-0 mt-2 text-danger">
                                <span class="text-black ms-1"><small>Ukupno </small></span><?= $numberControlTestes ?><span class="text-black ms-1"><small>provjera</small></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title text-md-center text-xl-left">Pismeni</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">Dodaj</h3>
                                    <a href="./dashboard.php?addTest" type="button" class="btn btn-inverse-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                        <i class="ti-plus"></i>
                                    </a>
                            </div>  
                                <p class="mb-0 mt-2 text-danger">
                                    <span class="text-black ms-1"><small>Ukupno </small></span><?= $numberWriteningTestes ?><span class="text-black ms-1"><small>provjera</small></span>
                                </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title text-md-center text-xl-left">Predstoji</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <ul class="list-ticked">
                                    <?php foreach ($testes as $test) : ?>
                                    <li><?= $test['subject'] . ' ' . $test['termin'] ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Termin posjeta</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">Dodaj</h3>
                            <a href="./dashboard.php?addVisitTermin" type="button" class="btn btn-inverse-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                    <i class="ti-plus"></i>
                                </a>
                        </div>  
                        <p class="mb-0 mt-2"><strong>Moji termini: </strong></p>
                            <?php foreach($visitTermins as $termin) : ?>
                                <span class="text-black ms-1"><small><?= !$termin ? 'Nema dodatih termina' : $termin ?></small><br></span>
                            <?php endforeach ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->