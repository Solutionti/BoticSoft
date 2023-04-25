<?php
ob_start();
session_start();
include('menu.php');
include 'ajax/barcode.php';
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
date_default_timezone_set('America/Lima');
$fecha  = date("Y-m-d H:i:s");
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$cat_pro=$_POST['cat_pro'];
$estado=$_POST['estado'];
$pre_pro=$_POST['precio'];
$precio1=$_POST['precio1'];
$precio2=$_POST['precio2'];
$cos_pro=$_POST['costo'];
$multiplicando=$_POST['multiplicando'];
$cos_pro1=$cos_pro*$multiplicando;
$mon_costo=$multiplicando;
$mon_venta=1;
$cantidad_blister=$_POST['cantidad_blister'];
$pro_contiene=$_POST['contiene'];
$und_pro=$_POST['und_pro'];
$pts=$_POST['cantidad_puntos'];
$inventario=$_POST['inventario'];



$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$suc=$rs1['sucursal'];

$sql3="select * from sucursal where id_sucursal='".$suc."'";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$sucursal_actual=$rs3['tienda'];


$tienda=$sucursal_actual;
$barras=$_POST['barras'];
$min=$_POST['min'];
$precio_may=$_POST['precio_mayor'];
$descuento=$_POST['descuento'];
$f_caducidad=$_POST['caducidad'];
$precio_total=$_POST['costo_total'];
$laboratorio=$_POST['cat_labo'];
$mensaje="";
$prod = array();
    for($i=1 ;$i<=6;$i++){
        if($i==$tienda){
          $prod[$i]=$inventario;

        }else{
           $prod[$i]=0;
        }

    }
$aa=0;
$id_producto=0;
$consulta2 = "SELECT * FROM products ";
$result2 = mysqli_query($con, $consulta2);
 while ($valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    if($valor2['nombre_producto']==$nombre){
    $aa=1;
    }
    $id_producto=$valor2['id_producto']+1;
    if($valor2['codigo_producto']==$codigo or $valor2['nombre_producto']==$nombre){
        $mensaje="Codigo o nombre del producto duplicado ";
    }
}
if(trim($nombre)=="" or trim($codigo)==""){
    $mensaje="Codigo o nombre del producto vacio";
}
 if($mensaje <> '') {
  header("location:ingresoproductos.php?mensaje=$mensaje");
}else{

if($aa==1){
   ?>
<script language="JavaScript" type="text/javascript">
alert("este texto es el que modificas");
</script>
<?php
    header("location:ingresoproductos.php");

}else{

    $namefinal="nuevo.jpg";
    if(is_uploaded_file($_FILES['files']['tmp_name'])) {
    $ruta_destino = "fotos/";
        $namefinal="producto".$id_producto.".jpg"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
    if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
        if($barras*1>0 and strlen($barras)>=2){
            barcode('ajax/codigos/'.$barras.'.png', $barras, 30, 'horizontal', 'code128', true);

        }else{
            $barras="";
        }
        $consulta = "INSERT INTO products values (NULL, '$codigo', '$nombre', '$estado','$fecha','$pre_pro','$cos_pro1','$mon_costo','$mon_venta','$cantidad_blister','$pro_contiene','$pts','$prod[1]','$prod[2]','$prod[3]','$prod[4]','$prod[5]','$prod[6]','$cat_pro','1','$namefinal','nuevo.jpg','nuevo.jpg','nuevo.jpg','0','$pre_pro','','','0','0','$precio1','$precio2','$und_pro','$barras','$descuento','$min','$precio_may','$f_caducidad','$precio_total','$laboratorio')";
        if (mysqli_query($con, $consulta)) {
            header("location:productos.php");
        } else {
              die("No se pudo insertar..");
        }
      }
      }else{
        if($barras*1>0 and strlen($barras)>=2){
            barcode('ajax/codigos/'.$barras.'.png', $barras, 30, 'horizontal', 'code128', true);

        }else{
            $barras="";
        }
        $consulta = "INSERT INTO products values (NULL, '$codigo', '$nombre', '$estado','$fecha','$pre_pro','$cos_pro1','$mon_costo','$mon_venta','$cantidad_blister','$pro_contiene','$pts','$prod[1]','$prod[2]','$prod[3]','$prod[4]','$prod[5]','$prod[6]','$cat_pro','1','$namefinal','nuevo.jpg','nuevo.jpg','nuevo.jpg','0','$pre_pro','','','0','0','$precio1','$precio2','$und_pro','$barras','$descuento','$min','$precio_may','$f_caducidad','$precio_total','$laboratorio')";
        if (mysqli_query($con, $consulta)) {
            header("location:productos.php");
        } else {
              die("No se pudo insertar..");
        }

      }

        if($multiplicando>1){
            $consulta1 = "UPDATE datosempresa SET dolar=".$multiplicando;

            if (mysqli_query($con, $consulta1)) {
                header("location:productos.php");
            } else {
              die("No se pudo insertar..");
            }
       }

}
}
ob_end_flush();

?>
