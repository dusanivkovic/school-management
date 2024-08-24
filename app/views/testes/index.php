
<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use app\helpers\Session;
use app\models\TestModel;
$tM = new TestModel;
$testes = $tM->findAllTestesForUser(Session::get('userId'));
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Kontrolni radovi</h4>
                    <p class="card-description">
                        Uredi ili obriši
                    </p>
                    <?php Session::flash(); ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Predmet</th>
                                    <th>Razred</th>
                                    <th>Termin</th>
                                    <th>Tip testa</th>
                                    <th>Status</th>
                                    <th>Uredi ili obrisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($testes as $test) : ?>
                                <tr>
                                    <td><?=$test['subject'] ?></td>
                                    <td><?=$test['class'] ?></td>
                                    <td><?=$test['termin'] ?></td>
                                    <td><?=$test['test_type'] ?></td>
                                    <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
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