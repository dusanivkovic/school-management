
<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use app\helpers\Session;
use app\models\TestModel;

$uri = parse_url($_SERVER['REQUEST_URI'])['query'] ?? '';
$tM = new TestModel;
$testType = $uri == 'controlsView' ? 'kontrolni' : 'pismeni' ;
$testes = $tM->findAllTestesForUser(Session::get('userId'), $testType);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $testType . ' radovi'?></h4>
                        <p class="card-description">
                            Uredi ili obriši
                        </p>
                        <?php Session::flash(); ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Predmet<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                        <th>Razred<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                        <th>Termin<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                        <th>Tip testa<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                        <th>Status<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                        <th>Uredi ili obrisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($testes as $test) : ?>
                                    <tr>
                                        <td><?= $tM->getSubject($test) ?></td>
                                        <td><?= $tM->getClass($test) ?></td>
                                        <td><?= $tM->getTermin($test) ?></td>
                                        <td><?= $tM->getTestType($test) ?></td>
                                        <td class="<?= date('Y-m-d') < $tM->getTermin($test) ? 'text-danger' : 'text-success' ?>"> 
                                            <?= date('Y-m-d') < $tM->getTermin($test) ? 'Čekanje' : 'Održan' ?> 
                                            <i class="ti-arrow-<?= date('Y-m-d') < $tM->getTermin($test) ? 'down' : 'up text-success' ?>"></i>
                                        </td>
                                        <td class="row justify-content-around">
                                            <form action="./dashboard.php?deleteTest" method="POST" class="col-4">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input name="testId" type="hidden" value="<?=$test['id'] ?>">
                                                <button type="submit" name="delete-test" class="btn bttn btn-inverse-danger btn-rounded btn-icon btn-sm"><i class="ti-trash"></i></button>
                                            </form>
                                            <form action="./dashboard.php?editTest" method="POST" class="col-4">
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input name="testId" type="hidden" value="<?= $test['id'] ?>">
                                                <button type="submit" name="edit-test" class="btn bttn btn-inverse-success btn-rounded btn-icon btn-sm"><i class="ti-settings"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content wrapper ends -->