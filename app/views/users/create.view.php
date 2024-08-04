<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use app\models\{Db, RegisterModel};
use app\controllers\SignUpControler;
use app\helpers\Session;
$classes = ['Разред', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];

Session::flash();
?>
<form class="pt-3" method="post" action="index.php?signUpUser">
  <div class="form-group">
    <label>Ime i prezime</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-user text-primary"></i>
        </span>
      </div>
      <input name="fullname" type="text" class="form-control form-control-lg border-left-0" placeholder="Ime i prezime" value="">
    </div>
  </div>
  <div class="form-group">
    <label>Email</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-email text-primary"></i>
        </span>
      </div>
      <input name="email" type="email" class="form-control form-control-lg border-left-0" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label>Lozinka</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-lock text-primary"></i>
        </span>
      </div>
      <input name="password" type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Lozinka">                        
    </div>
  </div>
  <div class="form-group">
    <label>Ponovi lozinku</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-lock text-primary"></i>
        </span>
      </div>
      <input name="passwordConfirm" type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Lozinka">                        
    </div>
  </div>
  <div class="form-group row">
    <label>Razrednik</label>
    <div class="col-md-4">
      <select name="class" class="form-control form-control-lg" id="exampleFormControlSelect2">
        <?php foreach ($classes as $class) { echo '<option value=' ."$class". ">{$class}<" .'/option>';} ?>
      </select>
    </div>
    <div class="col-md-8 row">
    <label>Odjeljenje</label>
      <?php 
        $i = 1;
        while ($i <= 5)
        {
          echo '<div class="col-2"><input name="department[]" type="checkbox" class="form-check-input" value = ' . $i . '>' .$i . '</input></div>';
          $i++;
        }  
      ?>
    </div>

  </div>
  <div class="mt-3">
    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
  </div>
  <div class="text-center mt-4 font-weight-light">
    Already have an account? <a href="./?login" class="text-primary">Login</a>
  </div>
</form>

