<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$subjects = require_once __DIR__ . '/../../../subjects.php';
use app\helpers\Session;
use app\models\RegisterModel;

$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
$rm = new RegisterModel();
$user = $rm->findUserByUserId(Session::get('userId'));
$arr = str_split($user['class_teacher']);
$department = array_pop($arr);
$class = implode('', $arr);
// $testType
$i = 1;
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
                            <p class="card-description">Dodaj provjeru</p>
                            <form class="forms-sample" method="POST" action="dashboard.php?saveTest">
                                <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
                                <div class="form-group">
                                    <label for="exampleInputName1">Predmet</label>
                                    <select name="subject" class="form-control form-control-sm" id="schoolsubject">
                                        <?php foreach ($subjects as $subject) :?>
                                        <option value="<?php echo $subject != 'Izaberi predmet' ? $subject : '' ?>">
                                            <?php echo $subject ?>
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
                                            <input name="testtype[]" type="radio" class="form-check-input mx-1" value="kontrolni"> kontrolni
                                        </div>
                                        <div class="col-6">
                                            <input name="testtype[]" type="radio" class="form-check-input mx-1" value="pismeni"> pismeni
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label>Sedmica</label>
                                    <div class="col-md-4">
                                        <input name="termin" type="date" class="form-control" id="testtermin" value="" min="2024-W34" max="2025-W28">
                                    </div>
                                </div>
                                <button type="submit" name="saveTest" class="btn btn-primary me-2">Save</button>
                                <a href="./dashboard.php?main" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->