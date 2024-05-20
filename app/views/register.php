<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\models\{Db, RegisterModel};
use app\controllers\SignUpControler;
use app\helpers\Session;

Session::prntR(Session::get('fullname'));
Session::prntR(Session::get('email-empty'));
Session::prntR(Session::get('password'));
Session::prntR(Session::get('email-format'));
Session::prntR(Session::get('password-confirm'));
Session::prntR(Session::get('password-min'));
?>
<form class="pt-3" method="post" action="../app/controllers/SignUpControler.php">
  <div class="form-group">
    <label>Ime i prezime</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-user text-primary"></i>
        </span>
      </div>
      <input name="fullname" type="text" class="form-control form-control-lg border-left-0 <?php ##echo $hasErrorUserName ?? 'is-invalid'; ?>" placeholder="Ime i prezime" value="<?php ##echo $hasErrorUserName ?? 'Ime i prezime'?>">
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
  <div class="form-group">
    <label>Predmet</label>
    <select name="subject" class="form-control form-control-lg" id="exampleFormControlSelect2">
      <option>Izaberi predmet</option>
      <option>United States of America</option>
      <option>United Kingdom</option>
      <option>India</option>
      <option>Germany</option>
      <option>Argentina</option>
    </select>
  </div>
  <div class="form-group">
    <label>Razrednik</label>
    <select name="classteacher" class="form-control form-control-lg" id="exampleFormControlSelect2">
      <option>Izaberi razred</option>
      <option>United States of America</option>
      <option>United Kingdom</option>
      <option>India</option>
      <option>Germany</option>
      <option>Argentina</option>
    </select>
  </div>
  <div class="mt-3">
    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
  </div>
  <div class="text-center mt-4 font-weight-light">
    Already have an account? <a href="index.php?page=login" class="text-primary">Login</a>
  </div>
</form>

