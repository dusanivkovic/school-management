
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

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title"><?= $testes ? 'odjeljenje ' . $tM->printClass($testes)  : '' ?></h4>
                    <p class="card-description">
                        <form action="<?= $testes ? 'd-none' : 'dashboard.php?addClassTeacher'?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group row">
                                <label class="<?= $testes ? 'd-none' : ''?>">Razred</label>
                                <div class="col-md-4">
                                    <select name="class" class="form-control form-control-lg <?= $testes ? 'd-none' : ''?>" id="schoolclass">
                                        <?php foreach ($classes as $item) : ?>
                                                <option value="<?= $item != 'Разред' ? $item : '' ?>">
                                                    <?php echo $item ?>
                                                </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-8 row">
                                    <label class="<?= $testes ? 'd-none' : ''?>">Odjeljenje</label>
                                    <?php while ($i <= 5) : ?>
                                        <div class="col-2">
                                            <input name="department[]" type="checkbox" class="form-check-input mx-1 <?= $testes ? 'd-none' : ''?>" value ="<?php echo  $i ?>" >
                                            <?php 
                                                echo $testes ? '' : $i; 
                                                $i++; 
                                            ?>
                                        </div> 
                                    <?php endwhile ?>
                                </div>
                            </div>
                            <button type="submit" name="update-class-teacher" class="btn btn-primary me-2 <?= $testes ? 'd-none' : ''?>">Update</button>
                            <a href="./dashboard.php?main" class="btn btn-light <?= $testes ? 'd-none' : ''?>">Cancel</a>
                        </form>
                    </p>
                    <?php Session::flash(); ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Predmet</th>
                                    <th>Nastavnik</th>
                                    <th>Termin</th>
                                    <th>Tip testa</th>
                                    <th>Status</th>
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
                                    <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
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