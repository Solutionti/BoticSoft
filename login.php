<?php
ob_start();
require_once ("config/db.php");
require_once ("config/conexion.php");

require_once("classes/Login.php");

$login = new Login();

if ($login->isUserLoggedIn() == true) {
   include('menu.php');

   $sql1="select * from users where user_id=$_SESSION[user_id]";
    $rw1= mysqli_query($con, $sql1);//recuperando el registro
    $rs1= mysqli_fetch_array($rw1);
    $modulo=$rs1["accesos"];
    $b = explode(".", $modulo);
   $c=0;
  if($b[47]==1){
        $_SESSION['tienda']=5;
        $c=1;
        }
  if($b[46]==1){
        $_SESSION['tienda']=4;
        $c=1;
        }

  if($b[45]==1){
        $_SESSION['tienda']=3;
        $c=1;
        }
  if($b[44]==1){
        $_SESSION['tienda']=2;
        $c=1;
        }
   if($b[43]==1){
        $_SESSION['tienda']=1;
        $c=1;
        }
   if($c>0){
   $_SESSION['doc_ventas']=1;
   $_SESSION['tipo']=0;
   $_SESSION['tabla']=1;
   $_SESSION['servicio1']="0";
       header("location: resumen2.php");
   }else{
     header("location: login.php");
   }
} else {
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Sistema de Facturación Online, Tienda Online y Facturación Electrónica.</title>
  <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>



<body>

    <div class="animated bounceInDown">
      <div class="container">
        <span class="error animated tada" id="msg"></span>

        <form    method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="box" onsubmit="return checkStuff()">
          <br>
          <img src="img/logo_login.png" alt="">
          <h4>CLINICA ENFOQUE SALUD</span></h4>
          <h5>Iniciar sesión en su cuenta</h5>
            <input  name="user_name" type="text"  required autocomplete="off" placeholder="Usuario" >
            <i class="typcn typcn-eye" id="eye"></i>
            <input  name="user_password" type="password"  placeholder="******" id="pwd" autocomplete="off" required>
            <?php
              if (isset($login)) {
                if ($login->errors) {
                  ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error!</strong><br>
                  <?php
                  foreach ($login->errors as $error) {
                    echo $error;
                  }
                  ?>
                  </div>
                  <?php
                }
                if ($login->messages) {
                  ?>
                  <div role="alert">
                      <strong >Aviso!</strong><br>
                  <?php
                  foreach ($login->messages as $message) {
                    echo $message;
                  }
                  ?>
                  </div>
                  <?php
                }
              }
              ?>
            <p>Al Utilizar Nuestros Servicios Aceptas Nuestros Términos y <br>Condiciones y Política de Tratamiento de Datos.</p>


            <button type="submit" class="btn1" name="login" id="submit">ACCEDER AL SISTEMA</button><br>
          </form>
          <a href="#" class="dnthave">¿Has olvidado tu contraseña?</a><br>
          <img src="img/verificacion.png"  width="130px" alt="">
      </div>
    </div>
</body>
<script type="text/javascript" src="js/js_login.js"></script>
</html>
	<?php
}
ob_end_flush();
?>
