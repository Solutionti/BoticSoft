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

if($contaseña_anterior1 == $_POST['user_pass_ant']) {
$sql="update users set nombres='$User_nombres',user_email='$User_correo',dni='$User_dni',domicilio='$User_direccion',telefono='$User_telefono'  where user_id='".$user_id."' ";
$query_update = mysqli_query($con,$sql);
if ($query_update){$messages[] = "Actualizacion satisfactoria..!!!!!";}
} else{$errors []= "No actualizado...!!!";}
ob_end_flush();
?>
