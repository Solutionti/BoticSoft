<?php

session_start();
include('menu.php');
//include('funciones.php');
include('conexion.php');
require_once ("config/db.php");
require_once ("config/conexion.php");

$db = conectar1();

date_default_timezone_set('America/Lima');
$fecha1  = date("Y-m-d H:i:s");
$fecha2  = date("Y-m-d H:i:s");


    $cliente=$_POST['cliente'];
    
    $db_products = $db_db.'.products';
    $db_clientes = $db_db.'.clientes';
$consulta1 = "SELECT * FROM $db_clientes ";
$result1 = mysqli_query($db, $consulta1);

$aa=0;
$b=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if($valor1['nombre_cliente']==$cliente){
    
    $aa=$valor1['id_cliente'];
    $b=1;
    }
}

$t=recoge1("num");
$f = array();
$g = array();
$h = array();
$subtotal2=0;
for($i =1; $i<=$t; $i++){
    $f[$i]=recoge1("cant$i");
    $g[$i]=recoge1("id$i");
    $h[$i]=recoge1("det$i");
    $subtotal2=$subtotal2+$f[$i];
}

for ($i =1; $i <=$t; $i++ ){
	        $dml = "UPDATE $db_servicio SET pre_ser=$f[$i] WHERE id_servicio=$g[$i]";
if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar11..");
        }else{
            header("location:ingresoservicios.php");
        }
}

for ($i =1; $i <=$t; $i++ ){
	        $dml = "UPDATE $db_detalle_factura SET precio_venta=$f[$i] WHERE id_detalle=$h[$i]";
if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar12..");
        }else{
            header("location:ingresoservicios.php");
        }
}



    $doc1=$_POST['doc1'];
    $servicio=$_POST['servicio'];
    $tipo=$_SESSION['tipo'];
    $total=$_POST['total'];
    $precio=$_POST['precio'];
    
    $subtotal1=$_POST['subtotal1'];
    
    $subtotal3=$subtotal1+$subtotal2;
    
    $doc_servicio=$_POST['doc_servicio'];
    $tienda=$_SESSION['tienda'];
    
    $tien="tienda".$tienda;
    $fol="folio".$tienda;
    
    $tip_doc=$_POST['tip_doc'];
    
    $total1=$total+$precio;
    $adelanto=$_POST['adelanto'];
    $fecha=$_POST['fecha'];
    $descripcion=$_POST['descripcion'];
    $car1=$_POST['car1'];
    $car2=$_POST['car2'];
    $car3=$_POST['car3'];
    $car4=$_POST['car4'];
    $car5=$_POST['car5'];
    $car6=$_POST['car6'];
    $aceptar=recoge1('aceptar');
    $guia=recoge1('guia');
    
    $eliminar=recoge1('eliminar');
    
    $tel=recoge1('tel');
    $correo=recoge1('correo');
    $ruc=recoge1('ruc');
    $dni=recoge1('dni');
    
    $cantidad=$_POST['cantidad'];
    
    $id=recoge1('id_producto');
    $nombre1=$_POST['nombre_producto'];
    
    if($id==0){
        $id=$nombre1;
    }
 
    if($adelanto>=$total1){
        $cc=1;
    }else{
        $cc=4;
    }
    
    
$consulta1 = "SELECT * FROM $db_products";
$result1 = mysqli_query($db, $consulta1);

$ini=5000;
$ini1=0;
$costo=$precio;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    if($valor1['id_producto']==$id){
    
    $costo=$valor1['costo_producto'];
    
        $ini=$valor1["b$tienda"];
        $ini1=$valor1["b$tienda"];
   
  
    
    }
}
    
    
    
    $doc=$_POST['doc'];
    
    if ($doc1<>""){
        $doc_servicio1=$doc_servicio;
    }else{
        $doc_servicio1=$doc;
    }
    
    
   
    $consulta5 = "SELECT * FROM $db_documento ";
$result5 = mysqli_query($db, $consulta5);


while ($valor5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
    if($valor5['id_documento']==1){
    
    $fact=$valor5["$tien"];
    $folio2=$valor5["$fol"];
    
    }
    if($valor5['id_documento']==2){
    
    $bol=$valor5["$tien"];
    $folio3=$valor5["$fol"];
    
    }
}
    
    
   if($tip_doc==3) {
       $doc_servicio=$doc_servicio;
       $folio1="";
   }else{
      if($tip_doc==1) {
         $doc_servicio=$fact+1;
         $folio1=$folio2;
      }
      if($tip_doc==2) {
         $doc_servicio=$bol+1; 
         $folio1=$folio3;
      }
       
   }
    
    
    $user_id=$_SESSION['user_id'];
    
 if($b==0){
   $consulta1 = "INSERT INTO $db_clientes
            values (NULL, '$cliente','$tel','$correo','','1','$fecha1','$ruc','$dni','','','','','','','1','0','0','0','0')";
        if (mysqli_query($db, $consulta1)) {
            header("location:ingresoservicios.php");
        } else {
              die("No se pudo insertar3..");
        }  
     
 }
 
 if($b>0){
 $dml="update $db_clientes
                  set doc='$ruc',dni='$dni',telefono_cliente='$tel',email_cliente='$correo'
               where id_cliente=$aa";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar4..$dml");
        }else{
            header("location:ingresoservicios.php");
        }
 }
    
 $consulta2 = "SELECT * FROM $db_clientes ";
$result2 = mysqli_query($db, $consulta2);
 while ($valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    if($valor2['nombre_cliente']==$cliente){
    
    $aa=$valor2['id_cliente'];
   
    }
}
    
    
    if($total1==$adelanto){
        $cancelado=1;
    }else{
        $cancelado=0;
    }
 
    
    if($doc_servicio==""){
        $tipo2=3;
    }else{
       $tipo2=$tip_doc; 
    }
  
   if($servicio<>""){
  $consulta2 = "INSERT INTO $db_detalle_factura
            values (NULL,'$aa','$user_id', '$doc_servicio1','$doc','$descripcion','1','$precio','$tienda','0','1','$fecha1','0','$tipo2','0','0','$folio1')";
        if (mysqli_query($db, $consulta2)) {
            header("location:ingresoservicios.php");
        } else {
              die("No se pudo insertar5..");
        }           
 }   
    
   $servicio1=0;
 $consulta3 = "SELECT * FROM $db_detalle_factura ORDER BY  `detalle_factura`.`id_detalle` ASC ";
$result3 = mysqli_query($db, $consulta3);
 while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
   
    $servicio1=$valor3['id_detalle'];
    
}
 
 
    
    if($servicio<>""){
$consulta = "INSERT INTO $db_servicio
            values (NULL, '$aa','$user_id','$doc_servicio1','$tienda','$servicio','$tipo','$precio','$adelanto','$fecha','$descripcion','$car1','$car2','$car3','$car4','$car5','$car6','','0','0','$tel','$doc','$tipo2','0','$servicio1','$fecha2','','','','0','0','0','0','0')";
        if (mysqli_query($db, $consulta)) {
            header("location:ingresoservicios.php");
        } else {
              die("No se pudo insertar6..");
        }
    }
   
$deuda=$total1-$adelanto;

$fecha4=date("Y-m-d H:i:s"); 
$fecha1=date("Y-m-d",strtotime($fecha)); 

  if($_SESSION['servicio1']=="0"){     
$consulta1 = "INSERT INTO $db_facturas
            values (NULL, '$doc','$fecha1','0','$doc','$aa','0','$user_id','1','$total1','$deuda','3','$tienda','1','0','1','1','','1','0','0','0','$folio1')";
        if (mysqli_query($db, $consulta1)) {
            header("location:ingresoservicios.php");
        } else {
              die("No se pudo insertar7..");
        }     
  }  else{
      
      $dml="update $db_facturas
                  set numero_factura='".$doc_servicio."',
                     
                         total_venta='".$total1."',
                         estado_factura='".$tip_doc."',
                             folio='".$folio1."'
               where servicio=1 and numero_factura=".$doc1;
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar8..");
        }else{
            header("location:ingresoservicios.php");
        }
        
       $dml="update $db_servicio
                  set doc_servicio='".$doc_servicio."',
                     ade_ser='".$adelanto."',
                       tip_doc='".$tip_doc."',
                           telefono1='".$tel."'
               where guia=".$doc;
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar9..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        $dml="update $db_detalle_factura
                  set numero_factura='".$doc_servicio."',tipo_doc='".$tip_doc."',folio='".$folio1."'
                     
                         
               where numero_factura=".$doc1;
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar10..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        
 
  }
  $_SESSION['servicio1']=$doc;
$_SESSION['tipo']=0;
  

if($subtotal3>0){
  $dml="update $db_facturas
                  set total_venta=$subtotal3
                     
               where servicio=1 and numero_factura=$doc_servicio and estado_factura=$tipo2 and ven_com=1";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar11..");
        }else{
            header("location:ingresoservicios.php");
        }
  
  }
  
  
 
 if($cantidad<=$ini && $cantidad>0 ){
  $consulta2 = "INSERT INTO $db_detalle_factura
            values (NULL,'$aa','$user_id', '$doc_servicio1','0','$id','$cantidad','$precio','$tienda','0','1','$fecha1','$costo','$tipo2','$ini1','0','0')";
        if (mysqli_query($db, $consulta2)) {
            header("location:ingresoservicios.php");
        } else {
              die("No se pudo insertar12..");
        }           
 }  
 
 
 
 if($aceptar==1){
    $dml="update $db_detalle_factura
                  set activo=1,fecha='".$fecha4."'
                     
                         
               where numero_factura=$doc_servicio and tipo_doc=$tipo2 and ven_com=1 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar13..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        
        $consulta2 = "SELECT * FROM $db_servicio ";
$result2 = mysqli_query($db, $consulta2);
 while ($valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    if($valor2['doc_servicio']==$doc_servicio && $valor2['tip_doc']==$tipo2 && $valor2['tienda']==$tienda){
    
    $reparado=$valor2['reparado'];
    $id_servicio=$valor2['id_servicio'];
   if($reparado==0) {
       
       $dml="update $db_servicio
                  set reparado=1,fecha_reparado='".$fecha4."',id_reparado='".$user_id."'
               where id_servicio=$id_servicio";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar14..");
        }else{
            header("location:ingresoservicios.php");
        } 
   }
    
    }
}
        
   $dml="update $db_servicio
                  set activo=1,aceptar_guia=2,entregado=1,saliente='".$fecha4."',id_entregado='".$user_id."'
                     
                         
               where doc_servicio=$doc_servicio and tip_doc=$tipo2 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar15..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        
        
        if($tipo2<>3) 
        
        {
        $dml="update $db_documento
                  set $tien=$tien+1
                     
                         
               where id_documento=$tipo2";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar16..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        }
        
        
         $dml="update $db_facturas
                  set activo=1,condiciones=1,deuda_total=0
                     
               where servicio=1 and numero_factura=$doc_servicio and estado_factura=$tipo2 and ven_com=1 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar17..");
        }else{
            header("location:ingresoservicios.php");
        }
        
        $consulta5 = "SELECT * FROM $db_detalle_factura WHERE numero_factura=$doc_servicio and tipo_doc=$tipo2 and ven_com=1";
        $result5 = mysqli_query($db, $consulta5);
        
        while ($valor5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
            $id_producto=$valor5['id_producto'];
            $tienda=$valor5['tienda'];
            $cantidad=$valor5['cantidad'];
            $precio1=$valor5['precio_venta'];
            
            $b="b$tienda";
            $d=$valor5["b$tienda"];
            
           
            $dml="update $db_products
                 set $b=$b-$cantidad,precio_producto=$precio1
                     
               where id_producto=$id_producto and pro_ser=1";
           if(!mysqli_query($db,$dml)){
                die("No se pudo actualizar18..");
            }else{
                header("location:ingresoservicios.php");
           }
            
           if($d>0){
            $dml="update $db_detalle_factura
                 set inv_ini=$d
                     
               where id_producto=$id_producto and numero_factura=$doc_servicio and tipo_doc=$tipo2 and ven_com=1 and tienda=$tienda";
            if(!mysqli_query($db,$dml)){
                die("No se pudo actualizar..");
            }else{
                header("location:ingresoservicios.php");
            }
            
            }
 
        }       

        
}
 

if($guia==1){
    
        
        $dml="update $db_servicio
                  set activo=1,aceptar_guia=1,ter_ser=0                                  
               where doc_servicio=$doc1 and tip_doc=$tipo2 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
           die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        
        $dml="update $db_documento
                  set $tien=$tien+1
                     
                         
               where id_documento=3";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
        
         $dml="update $db_facturas
                  set condiciones=$cc,deuda_total=$deuda,activo=0,fecha_factura='".$fecha4."'
                     
               where servicio=1 and numero_factura=$doc1 and estado_factura=$tipo2 and ven_com=1 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        }
       
}

if($eliminar==1){
    $dml="update $db_detalle_factura
                  set activo=0
                     
                         
               where numero_factura=$doc_servicio and tipo_doc=$tipo2 and ven_com=1 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
    $dml="update $db_servicio
                  set activo=0,aceptar_guia=0,fecha_reparado='".$fecha5."',saliente='".$fecha5."',desechado='".$fecha5."',reparado=0,entregado=0,ter_ser=0
                     
                         
               where doc_servicio=$doc_servicio and tip_doc=$tipo2 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        } 
        
         $dml="update $db_facturas
                  set activo=0
                     
               where servicio=1 and numero_factura=$doc_servicio and estado_factura=$tipo2 and ven_com=1 and tienda=$tienda";
       if(!mysqli_query($db,$dml)){
            die("No se pudo actualizar..");
        }else{
            header("location:ingresoservicios.php");
        }
        
        
        $consulta5 = "SELECT * FROM $db_detalle_factura WHERE numero_factura=$doc_servicio and tipo_doc=$tipo2 and ven_com=1";
        $result5 = mysqli_query($db, $consulta5);
        while ($valor5 = mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
            $id_producto=$valor5['id_producto'];
            $tienda=$valor5['tienda'];
            $cantidad=$valor5['cantidad'];
            $precio1=$valor5['precio_venta'];
            
                $b="b$tienda";
                $d=$row5["b$tienda"];
            
            $dml="update $db_products
                  set $b=$b+$cantidad,precio_producto=$precio1
                     
               where id_producto=$id_producto and pro_ser=1";
            if(!mysqli_query($db,$dml)){
                die("No se pudo actualizar..");
            }else{
                header("location:ingresoservicios.php");
            }
           
        }       

        
}



 
?>



