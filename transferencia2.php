<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$usuario=$_SESSION['user_id'];
$consulta1 = "SELECT * FROM products ";
$result1 = mysqli_query($con, $consulta1);
$id=$_POST['id_producto'];
$tienda2=$_POST['tienda2'];
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if($valor1['id_producto']==$id){
        $c=$valor1["b$tienda2"];
        
    }
}
date_default_timezone_set('America/Lima');
$fecha1  = date("Y-m-d H:i:s");
$tienda=$_SESSION['tienda'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$inv_producto=$_POST['inv_producto'];

$b1="b".$tienda;
$b2="b".$tienda2;
$user_id=$_SESSION['user_id'];
if($id>0 && $cantidad<=$inv_producto && $inv_producto>0 ){
    $consulta2 = "INSERT INTO detalle_factura
            values (NULL, '0','$usuario','0','1','$id','$cantidad','$precio','$tienda','1','1','$fecha1','$user_id','0','$inv_producto','0','0')";
        if (mysqli_query($con, $consulta2)) {
            header("location:transferencia.php");
        } else {
              die("No se pudo insertar3..");
        }          
    $consulta3 = "INSERT INTO detalle_factura
            values (NULL, '0','$usuario','0','2','$id','$cantidad','$precio','$tienda2','1','2','$fecha1','$user_id','0','$c','0','0')";
        if (mysqli_query($con, $consulta3)) {
            header("location:transferencia.php");
        } else {
              die("No se pudo insertar4..");
        }          
        $dml="update products set $b1=$b1-$cantidad,$b2=$b2+$cantidad where id_producto=".$id;
        if(!mysqli_query($con,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:transferencia1.php");
        }   
}else{
    header("location:transferencia.php?mensaje=Error en el inventario");
}
ob_end_flush();
?>



