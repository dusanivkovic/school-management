
<form class="pt-3" method="post" action="../app/controllers/loginControler.php">
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-email text-primary"></i>
        </span>
      </div>
      <input name="email" type="email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword">Lozinka</label>
    <div class="input-group">
      <div class="input-group-prepend bg-transparent">
        <span class="input-group-text bg-transparent border-right-0">
          <i class="ti-lock text-primary"></i>
        </span>
      </div>
      <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">                        
    </div>
  </div>
  <div class="mt-3">
    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
  </div>
  <div class="text-center mt-4 font-weight-light">
    Don't have an account? <a href="index.php?page=register" class="text-primary">Create</a>
  </div>
</form>
