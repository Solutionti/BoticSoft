<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$iva=$_POST['iva'];
$nom_iva=$_POST['nom_iva'];
$doc=$_POST['doc'];
$moneda=$_POST['moneda'];
$videos=$_POST['videos'];
$des1=$_POST['des1'];
$des2=$_POST['des2'];
$des3=$_POST['des3'];
$PN=$_POST['PN'];
$PN1=$_POST['PN1'];
$PJ=$_POST['PJ'];
$PJ1=$_POST['PJ1'];

$d1=mysqli_query($con, "UPDATE globales SET med=$iva WHERE id_global=5");
$d2=mysqli_query($con, "UPDATE globales SET med='$nom_iva' WHERE id_global=6");
$d3=mysqli_query($con, "UPDATE globales SET med='$doc' WHERE id_global=7");
$d4=mysqli_query($con, "UPDATE globales SET med='$moneda' WHERE id_global=8");
$d5=mysqli_query($con, "UPDATE globales SET med='$videos' WHERE id_global=9");
$d6=mysqli_query($con, "UPDATE globales SET med='$des1' WHERE id_global=10");
$d7=mysqli_query($con, "UPDATE globales SET med='$des2' WHERE id_global=11");
$d8=mysqli_query($con, "UPDATE globales SET med='$des3' WHERE id_global=12");
$d9=mysqli_query($con, "UPDATE globales SET nombre='$PN',med='$PN1' WHERE id_global=13");
$d10=mysqli_query($con, "UPDATE globales SET nombre='$PJ',med='$PJ1' WHERE id_global=14");
header("location:globales.php");
ob_end_flush();
?>



