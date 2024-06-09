<?php
require_once __DIR__ . './../../vendor/autoload.php';
use app\helpers\Session;
use app\controllers\SignUpControler;
use app\models\RegisterModel;

require_once __DIR__ . './../helpers/Session.php';
$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
$rm = new RegisterModel();
$user = $rm->findUserByUserId(Session::get('userId'));
$arr = str_split($user['class_teacher']);
$department = array_pop($arr);
$class = implode('', $arr);
$password = password_verify(Session::get('password'), $user['password']) ? Session::get('password') : 'Something went wrong!';
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo isset($user) ? $user['full_name'] : 'Your name here' ?></h4>
                    <p class="card-description">Uredi podatke</p>
                    <form class="forms-sample" method="POST" action="../app/controllers/SignUpControler.php">
                        <input type="hidden" name="userId" value="<?php echo $user['user_id']?>">
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input name="fullname" type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?php echo $user['full_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?php echo $user['email']?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" value="<?php echo Session::get('password') ?>">
                        </div>
                        <div class="form-group row">
                            <label>Razrednik</label>
                            <div class="col-md-4">
                                <select name="class" class="form-control form-control-lg" id="exampleFormControlSelect2">
                                    <?php foreach ($classes as $item) : ?>
                                            <option value="<?php echo $item ?>" <?php echo $item == $class ? 'selected' : ''?>>
                                                <?php echo $item ?>
                                            </option>
                                    <?php endforeach?>
                                </select>
                            </div>
                            <div class="col-md-8 row">
                                <label>Odjeljenje</label>
                                <?php 
                                    $i = 1;
                                    while ($i <= 5) : ?>
                                    <div class="col-2">
                                        <input name="department[]" type="checkbox" class="form-check-input mx-1" value ="<?php echo  $i ?>" <?php echo $i == $department ? 'checked="checked"' : ''?>>
                                        <?php echo $i; $i++;?>
                                    </div> 
                                <?php endwhile ?>
                            </div>
                        </div>
                        <button type="submit" name="saveUser" class="btn btn-primary me-2">Save</button>
                        <a href="./dashboard.php" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>