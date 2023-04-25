<?php
ob_start();
session_start();
include("menu.php");
 $accion=recoge1('accion');
 $online=recoge1('online');
 $d="";
 if($online<>""){
    $_SESSION['online']=$online;
    $d="?online=$_SESSION[online]";
 }
 if($_SESSION['online']<>""){

    $d="?online=$_SESSION[online]";
 }
 $tipo=recoge1('tipo');
if ($accion==1) {
 $_SESSION['doc_ventas']=1;
 $_SESSION['doc_ventas1']="RUC";
}
if ($accion==2) {
 $_SESSION['doc_ventas']=2;
 $_SESSION['doc_ventas1']="DNI";
}

if ($accion==3) {
 $_SESSION['doc_ventas']=3;
 $_SESSION['doc_ventas1']="RUC O DNI";
}
if ($accion==8) {
 $_SESSION['doc_ventas']=8;
 $_SESSION['doc_ventas1']="RUC O DNI";
}
if ($accion==5) {
 $_SESSION['doc_ventas']=5;
 $_SESSION['doc_ventas1']="RUC";
}

if ($accion==6) {
 $_SESSION['doc_ventas']=6;
 $_SESSION['doc_ventas1']="RUC";
}


if($tipo==1){
header("location:nueva_factura.php$d");
}else{
 header("location:nueva_compras.php");
}
ob_end_flush();
?>
