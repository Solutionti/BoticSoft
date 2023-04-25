<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos


$tipo_moneda=$_POST['tipo_moneda'];
$nom_impuesto=$_POST['nombre_impuesto'];
$porcentaje_impuesto=$_POST['porcentaje_impuesto'];



$dml="update globales set med='$porcentaje_impuesto' where id_global=5 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar.$dml");
}else{
    header("location:config_moneda_iva.php");
}

$dml="update globales set med='$nom_impuesto' where id_global=6 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar.");
}else{
    header("location:config_moneda_iva.php");
}
$dml="update globales set med='$tipo_moneda' where id_global=8 ";
if(!mysqli_query($con,$dml)){
    die("No se pudo actualizar.");
}else{

    header("location:config_moneda_iva.php");
}
ob_end_flush();
?>
