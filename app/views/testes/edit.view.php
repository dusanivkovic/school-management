<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$subjects = require_once __DIR__ . '/../../../subjects.php';
use app\helpers\Session;
use app\models\RegisterModel;
use app\controllers\testes\Edit;
use app\controllers\testes\Testes;

$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
$rm = new RegisterModel();
$user = $rm->findUserByUserId(Session::get('userId'));

$i = 1;
$testModel = new Edit;
if(isset($_POST['testId']))
{
    $testId = $_POST['testId'];
    $test = $testModel->populateTest($testId);
    $currentSubject = $test['subject'];
    $arr = str_split($test['class']);
    $department = array_pop($arr);
    $class = implode('', $arr);
}
?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0"></h4>
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
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo isset($user) ? $user['full_name'] : 'Your name here'; ?></h4>
                            <p class="card-description">Uredi provjeru</p>
                            <p class="text-danger">U polju za unos sedmice označi prvi dan sedmice u kojoj imaš provjeru.</p>
                            <form class="forms-sample" method="POST" action="dashboard.php?updateTest">
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="testId" value="<?php echo $testId; ?>">
                                <div class="form-group">
                                    <label for="exampleInputName1">Predmet</label>
                                    <select name="subject" class="form-control form-control-sm" id="schoolsubject">
                                        <?php foreach ($subjects as $subject) :?>
                                        <option value="<?php echo $subject != 'Izaberi predmet' ? $subject : '' ?>"
                                            <?= $currentSubject == $subject ? 'selected' : '';?>
                                        >
                                            <?= $subject ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label>Razred</label>
                                    <div class="col-md-4">
                                        <select name="class" class="form-control form-control-lg" id="schoolclass">
                                            <?php foreach ($classes as $item) : ?>
                                                    <option value="<?php echo $item != 'Разред' ? $item : '' ?>" <?php echo $item == $class ? 'selected' : '' ?>>
                                                        <?php echo $item ?>
                                                    </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-8 row">
                                        <label>Odjeljenje</label>
                                        <?php while ($i <= 5) : ?>
                                            <div class="col-2">
                                                <input name="department[]" type="checkbox" class="form-check-input mx-1" value ="<?php echo  $i ?>" <?php echo $i == $department ? 'checked="checked"' : '' ?>>
                                                <?php 
                                                    echo $i; 
                                                    $i++; 
                                                ?>
                                            </div> 
                                        <?php endwhile ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label>Vrsta provjere</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input name="testtype[]" type="radio" class="form-check-input mx-1" value="kontrolni" 
                                            <?php echo $test['testType'] == 'контролни' ? 'checked' : ''?>> kontrolni
                                        </div>
                                        <div class="col-6">
                                            <input name="testtype[]" type="radio" class="form-check-input mx-1" value="pismeni"
                                            <?php echo $test['testType'] == 'писмени' ? 'checked' : ''?>> pismeni
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label>Sedmica</label>
                                    <div class="col-md-4">
                                        <input name="termin" type="date" class="form-control" id="testtermin" value="<?= $test['termin']?>" min="2024-W34" max="2025-W28">
                                    </div>
                                </div>
                                <button type="submit" name="update-test" class="btn btn-primary me-2">Update</button>
                                <a href="./dashboard.php?controlsView" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->