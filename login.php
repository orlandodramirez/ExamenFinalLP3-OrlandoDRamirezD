<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}
ob_end_flush();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>
<?php include 'header.php' ?>
<style>
  body {
    background: url('fondo.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .login-box {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  }

  .btn-primary {
    background-color: #6c757d;
    border-color: #6c757d;
  }

  .btn-primary:hover {
    background-color: #5a6268;
    border-color: #545b62;
  }

  a {
    position: absolute;
    bottom: 10px;
    left: 10px;
    color: white;
    text-decoration: none;
    font-size: 16px;
  }

  a:hover {
    text-decoration: underline;
  }
</style>
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="login-form" class="d-flex flex-column align-items-center">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row w-100">
          <div class="col-8 d-flex align-items-end">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">Recuérdame</label>
            </div>
          </div>
        </div>
        <div class="row w-100 mt-3">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
      e.preventDefault();
      start_load();
      if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
      $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
          console.log(err);
          end_load();
        },
        success:function(resp){
          if(resp == 1){
            location.href ='index.php?page=home';
          }else{
            $('#login-form').prepend('<div class="alert alert-danger">El nombre de usuario o la contraseña son incorrectos.</div>')
            end_load();
          }
        }
      })
    });
  });
</script>
<?php include 'footer.php' ?>
</body>
</html>
