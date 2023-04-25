<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");

$User_dni=$_POST['user_dni'];
$User_nombres=$_POST['user_names'];
$User_telefono=$_POST['user_phone'];
$User_correo=$_POST['user_mail'];
$User_direccion=$_POST['user_dir'];
$user_id=$_POST['id_user_mod'];



if(!empty($user_id)) {
$sql="update users set nombres='$User_nombres',user_email='$User_correo',dni='$User_dni',domicilio='$User_direccion',telefono='$User_telefono'  where user_id='".$user_id."'";
$query_update = mysqli_query($con,$sql);
if ($query_update){$messages[] = "Actualizacion satisfactoria..!!!";}
} else{$errors []= "en la actualizaion...!!";}

if (isset($errors)){

  ?>
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>
    <?php foreach ($errors as $error) {echo $error;}?>
  </div>
  <?php } if (isset($messages)){ ?>
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Bien hecho!</strong>
    <?php foreach ($messages as $message) { echo $message; } ?>
    </div>
    <?php
  }
ob_end_flush();
?>
