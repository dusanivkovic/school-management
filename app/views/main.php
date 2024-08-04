<?php 
    require_once __DIR__ . '/../../vendor/autoload.php';
    use app\helpers\Session;
    use app\models\TestModel;

    $tM = new TestModel();
    $numberTestes = count($tM->findAllTestesForUser(Session::get('userId')));
?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">RoyalUI Dashboard</h4>
                        </div>
                        <?php Session::flash(); ?>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                                <i class="ti-clipboard btn-icon-prepend"></i>Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title text-md-center text-xl-left">Provjere</p>
                            <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">Dodaj</h3>
                                <a href="./dashboard.php?addTest" type="button" class="btn btn-inverse-primary btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                    <i class="ti-plus"></i>
                                </a>
                            </div>  
                            <p class="mb-0 mt-2 text-danger"><span class="text-black ms-1"><small>Ukupno </small></span><?= $numberTestes ?><span class="text-black ms-1"><small>provjera</small></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Revenue</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">47033</h3>
                        <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        <p class="mb-0 mt-2 text-danger">0.47% <span class="text-black ms-1"><small>(30 days)</small></span></p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Downloads</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">40016</h3>
                        <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ms-1"><small>(30 days)</small></span></p>
                    </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title text-md-center text-xl-left">Returns</p>
                        <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">61344</h3>
                        <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                        </div>  
                        <p class="mb-0 mt-2 text-success">23.00%<span class="text-black ms-1"><small>(30 days)</small></span></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->