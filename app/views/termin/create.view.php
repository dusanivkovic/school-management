<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$subjects = require_once __DIR__ . '/../../../subjects.php';
use app\helpers\Session;
use app\models\RegisterModel;
$rm = new RegisterModel();
$user = $rm->findUserByUserId(Session::get('userId'));
$days = ['понедјељак', 'уторак', 'сриједа', 'четвртак', 'петак'];
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
                            <h5 class="card-description">Dodaj termin</h5>
                            <form class="forms-sample" method="POST" action="dashboard.php?editTermin">
                                <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputName1">Dan</label>
                                    <select name="day" class="form-control form-control-sm" id="schoolsubject">
                                        <?php foreach ($days as $day) :?>
                                            <option value="<?= $day?>"><?= $day?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Sati</label>
                                    <input name="hours" type="number" min="00" max="23" placeholder="23" class="form-control form-control-sm">
                                    <label>Minuti</label>
                                    <input  name="minutes" type="number" min="00" max="59" placeholder="00" class="form-control form-control-sm">
                                </div>

                                <button type="submit" name="saveTermin" class="btn btn-primary me-2">Save</button>
                                <a href="./dashboard.php?main" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->