
<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$subjects = require_once __DIR__ . '/../../../subjects.php';
use app\helpers\Session;
use app\models\RegisterModel;
use app\models\TestModel;
$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
$i = 1;
$tM = new TestModel;
$rm = new RegisterModel;
$testes = $tM->findTestByClass(Session::get('userId')) ?? [];

$userClass = $rm->findUserByUserId(Session::get('userId'))['class_teacher'];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title"><?= empty($userClass) ? 'Izaberi razred i odjeljenje' : 'Odjeljenje ' . $userClass?></h4>
                    <p class="card-description "><?= (!$testes and !empty($userClass)) ? 'Nema provjera za odjeljenje' : '' ?></p>
                    <p class="card-description">
                        <form action="<?= $userClass ? 'd-none' : 'dashboard.php?addClassTeacher'?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group row">
                                <label class="<?= $userClass ? 'd-none' : ''?>">Razred</label>
                                <div class="col-md-4">
                                    <select name="class" class="form-control form-control-lg <?= $userClass ? 'd-none' : ''?>" id="schoolclass">
                                        <?php foreach ($classes as $item) : ?>
                                                <option value="<?= $item != 'Разред' ? $item : '' ?>">
                                                    <?php echo $item ?>
                                                </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-8 row">
                                    <label class="<?= $userClass ? 'd-none' : ''?>">Odjeljenje</label>
                                    <?php while ($i <= 5) : ?>
                                        <div class="col-2">
                                            <input name="department[]" type="checkbox" class="form-check-input mx-1 <?= $userClass ? 'd-none' : ''?>" value ="<?php echo  $i ?>" >
                                            <?php 
                                                echo $userClass ? '' : $i; 
                                                $i++; 
                                            ?>
                                        </div> 
                                    <?php endwhile ?>
                                </div>
                            </div>
                            <button type="submit" name="update-class-teacher" class="btn btn-primary me-2 <?= $userClass ? 'd-none' : ''?>">Update</button>
                            <a href="./dashboard.php?main" class="btn btn-light <?= $userClass ? 'd-none' : ''?>">Cancel</a>
                        </form>
                    </p>
                    <?php Session::flash(); ?>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Predmet<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                    <th>Nastavnik<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                    <th>Termin<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                    <th>Tip testa<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                    <th>Status<i class="ti-exchange-vertical text-primary" style="float: right"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($testes as $test) : ?>
                                <tr>
                                    <td><?= $test['subject'] ?></td>
                                    <td>
                                        <?php 
                                            $user = $rm->findUserByUserId($test['user_id']);
                                            echo $user['full_name'];
                                        ?>
                                    </td>
                                    <td><?=$test['termin'] ?></td>
                                    <td><?=$test['test_type'] ?></td>
                                    <td class="<?= date('Y-m-d') < $tM->getTermin($test) ? 'text-danger' : 'text-success' ?>"> 
                                            <?= date('Y-m-d') < $tM->getTermin($test) ? 'Čekanje' : 'Održan' ?> 
                                            <i role="button" class="ti-arrow-<?= date('Y-m-d') < $tM->getTermin($test) ? 'down' : 'up text-success' ?>"></i>
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