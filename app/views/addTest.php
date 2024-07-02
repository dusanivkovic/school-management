<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$subjects = require_once __DIR__ . '/../../subjects.php';
use app\helpers\Session;
use app\models\RegisterModel;

$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
$rm = new RegisterModel();
$user = $rm->findUserByUserId(Session::get('userId'));
$arr = str_split($user['class_teacher']);
$department = array_pop($arr);
$class = implode('', $arr);
$i = 1;
?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo isset($user) ? $user['full_name'] : 'Your name here'; ?></h4>
                        <p class="card-description">Uredi provjeru</p>
                        <form class="forms-sample" method="POST" action="dashboard.php?addTest">
                            <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
                            <div class="form-group">
                                <label for="exampleInputName1">Predmet</label>
                                <select name="class" class="form-control form-control-sm" id="schoolsubject">
                                    <?php foreach ($subjects as $subject) :?>
                                    <option value="<?php echo $subject?>">
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
                                                <option value="<?php echo $item ?>" <?php echo $item == $class ? 'selected' : '' ?>>
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
                                        <input name="testtype[]" type="radio" class="form-check-input mx-1" value="kontrolni" checked> kontrolni
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
                            <button type="submit" name="addTest" class="btn btn-primary me-2">Save</button>
                            <a href="./dashboard.php?main" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->