<?php

session_start();
include('menu.php');
//include('funciones.php');
include('conexion.php');

$tipo_doc=0;

$db = conectar1();

$tienda1=$_SESSION['tienda'];
$consulta1 = "SELECT * FROM $db_clientes ";
$result1 = mysqli_query($db, $consulta1);
$producto = array();
$i=0;


while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    
    $producto[$i]=$valor1['nombre_cliente'];
    $i=$i+1;
    
}

  
   $sql1="select * from $db_users where user_id=$_SESSION[user_id]";
    $rw1=mysqli_query($db,$sql1);//recuperando el registro
    $rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo


$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

         if($a[28]==0){
        header("location:error.php");    
        }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> 
  
  Venta Servicio Tecnico
  </title>

 <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
 <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  
  
  
 <script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
  }
  var mostrarValor = function(x){
            document.getElementById('precio').value=x;
            
           
            }
 
 
 
    var mostrarValor2 = function(x){
            
        
        
        document.getElementById('precio').value=x;
        
        
        
            }
  
</script>
<SCRIPT LANGUAGE="JavaScript" SRC="calendar.js"></SCRIPT>
<style type="text/css"> 
    .fijo {
	background: #333;
	color: white;
	height: 10px;
	
	width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
	left: 0; /* Posicionamos la cabecera al lado izquierdo */
	top: 0; /* Posicionamos la cabecera pegada arriba */
	position: fixed; /* Hacemos que la cabecera tenga una posición fija */
} 
.Fields {
	background-color: white;
	border: 1px solid #2E9AFE;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
        text-align:center;
}


</style>
  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <?php
          menu2();
          
          ?>
          <!-- /menu prile quick info -->

          

          <!-- sidebar menu -->
          <?php
          menu1();
          
          ?>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
         
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
        
          <!-- /menu footer buttons -->
        </div>
      </div>

        
        <?php
          menu3();
          
          ?>
      <!-- top navigation -->
     

        <?php
        
         
        
        
        ?>

      
      <!-- /top navigation -->


      <!-- page content -->
      <div class="right_col" role="main">
        
          <div class="btn-group">
          
          <button type="button" class="btn btn-danger">Nuevo Documento</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                     
                    </button>
                    <ul class="dropdown-menu" role="menu">
                         <li><a href="tipo.php?accion=0">Nuevo Documento</a>
                      </li>
                       
                     
                    </ul>
          
          </div>
          <?php
          
          $ab="";
          $ab1="";
            if($_SESSION['tipo']==1){
               $ab="Laptop"; 
            }
            if($_SESSION['tipo']==2){
               $ab="Computadora"; 
            }
            if($_SESSION['tipo']==3){
               $ab="Impresora"; 
            }
            if($_SESSION['tipo']==4){
               $ab="Monitor"; 
            }
            if($_SESSION['tipo']==5){
               $ab1="Productos"; 
            }
            
          $read="";
          $cliente="";
          $ruc="";
          $dni="";
          $fecha="";
          $servicio="";
          $doc="";
          $telefono="";
          $adelanto="";
          $correo="";
          $i=0;
          $doc1="";
          $aceptar=0;
          $numero1=0;
            if (isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0") {
                $sql1="SELECT * FROM $db_servicio, $db_clientes WHERE servicio.id_cliente=clientes.id_cliente and servicio.guia=$_SESSION[servicio1]";
                $rw1=mysqli_query($db,$sql1);//recuperando el registro
                
                $read="readonly";
                ?>
              
          <?php
          
                while ($valor1 = mysqli_fetch_array($rw1)) {
    $aceptar=$valor1['activo']+1;
    $id_cliente=$valor1['id_cliente'];
    $cliente=$valor1['nombre_cliente'];
    $fecha=$valor1['fecha'];
    $servicio=$valor1['nom_ser'];
    $tipo_doc=$valor1['tip_doc'];
    
    $ruc=$valor1['doc'];
    $dni=$valor1['dni'];
    $correo=$valor1['email_cliente'];
    
    $doc=$valor1['guia'];
    $numero1=$valor1['aceptar_guia'];
    $doc1=$valor1['doc_servicio'];
    $telefono=$valor1['telefono1'];
    $adelanto=$valor1['ade_ser'];
    $i=$i+1;
    
}
$hora1="";
$hora="00";  
if($i==0){
     $sql1="SELECT * FROM $db_facturas, $db_clientes WHERE facturas.id_cliente=clientes.id_cliente and facturas.estado_factura=3 and facturas.numero_factura=$_SESSION[servicio1]";
                $rw1=mysqli_query($db,$sql1);//recuperando el registro
                
                //$read="readonly";
                ?>
              
          <?php
          
                while ($valor1 = mysqli_fetch_array($rw1)) {
    $id_cliente=$valor1['id_cliente'];
    
    
    $cliente=$valor1['nombre_cliente'];
    $fecha1=$valor1['fecha_factura'];
    
    $d3 = explode("-",$fecha1);
    $dia=date("d",strtotime($fecha1)); 
    $mes=date("m",strtotime($fecha1));
    $hora=date("H",strtotime($fecha1));
    $ano=$d3[0];
    $fecha=$ano."-".$mes."-".$dia;
    
    $tipo_doc=3;
    $doc=$valor1['numero_factura'];
    $doc1=$valor1['numero_factura'];
    $telefono=$valor1['telefono_cliente'];
    $ruc=$valor1['doc'];
    $dni=$valor1['dni'];
    $correo=$valor1['email_cliente'];
    $i=$i+1;
    
}
}



                
            }
            
            
            $sql1="SELECT * FROM $db_facturas, $db_clientes WHERE facturas.id_cliente=clientes.id_cliente and facturas.estado_factura=3 and facturas.numero_factura=$_SESSION[servicio1]";
                $rw1=mysqli_query($db,$sql1);
            While ($valor1 = mysqli_fetch_array($rw1)) {
                $fecha1=$valor1['fecha_factura'];
                $hora1=date("H",strtotime($fecha1)); 
            }
          ?>
          <div style="background:#81F79F;">   
<div class="panel panel-info">
		<div class="panel-heading">
		   
                    <h2>Datos del Documento:</h2>
		</div>        
        </div>  
           
          
         <?php //echo $hora1;

         
print"<form name=\"myForm\" class=\"form-horizontal form-label-left\" id=\"guardar_producto\" enctype=\"multipart/form-data\" action=\"ingresoservicios1.php\" method=\"POST\">
";

    

?>
           <div class="form-group">
				<label for="cliente" class="col-sm-3 control-label">Nombre del Cliente:</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
                                    
				  <input type="text" <?php echo $read;?> value="<?php echo $cliente;?>" class="form-control input-sm"  name="cliente" id="cliente" placeholder="Nombre del Cliente" required>
				 
                                </div>
                                
                                <label for="cliente" class="col-sm-1 control-label">Ruc:</label>
				<div class="col-md-5 col-sm-5 col-xs-12">
                                    
                                    <input type="text"  value="<?php echo $ruc;?>" autocomplete="off" class="form-control input-sm"  name="ruc" id="ruc" placeholder="Ruc del Cliente" required>
				 
                                </div>
                                
			  </div>
              
              <div class="form-group">
				<label for="cliente" class="col-sm-3 control-label">DNI del Cliente:</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
                                    
				  <input type="text"  value="<?php echo $dni;?>" autocomplete="off" class="form-control input-sm"  name="dni" id="dni" placeholder="Dni del Cliente" required>
				 
                                </div>
                                
                                <label for="cliente" class="col-sm-1 control-label">Correo:</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
                                    
				  <input type="text" value="<?php echo $correo;?>" autocomplete="off" class="form-control input-sm"  name="correo" id="correo" placeholder="Correo del Cliente" required>
				 
                                </div>
                                
                                <label for="doc" class="col-sm-1 control-label">Teléfono:</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
                                     <input type="text"  <?php echo $read;?> autocomplete="off" value="<?php echo $telefono;?>" class="form-control" id="tel" name="tel" placeholder="Teléfono del cliente" required>
				  
				</div>
                                
			  </div>
              
              
           
          
          <?php
          $consulta3 = "SELECT * FROM $db_documento ";
$result3 = mysqli_query($db, $consulta3);

$tien="tienda".$_SESSION['tienda'];
$fol="folio".$_SESSION['tienda'];
while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    if($valor3['id_documento']==3){
    $guia=$valor3["$tien"];
    
    }
}
$guia1=$guia+1;
  if($doc=="")  {
      $doc=$guia1;
  }      
          ?>
          
          
          
           <div class="form-group">
				<label for="doc" class="col-sm-3 control-label">Número de Guía:</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" readonly="" value="<?php echo $doc;?>" class="form-control" id="doc" name="doc" required>
				  
				</div>
                                <label for="fecha" class="col-sm-1 control-label">Fecha:</label>
				
                                <div class="col-md-5 col-sm-5 col-xs-12">
				  <input type="date" <?php echo $read;?> value="<?php echo $fecha;?>" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy"  required>
				
                            
                                
                                </div>
			  </div>
          
            
           
         
         
          <?php
          
				
				include("modal/editar_servicios2.php");
			
          
          if (isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0") {
          ?>
         
          
          <div class="form-group">
				<label for="tip_doc" class="col-sm-3 control-label">Documento Asociado a Guia:</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				 <select class="form-control" id="tip_doc" name="tip_doc" required>
					<?php
                                        if($tipo_doc==1){
                                         ?>
                                      <option value="1" selected>Factura</option>
                                     <?php
                                        }else{
                                          ?>
                                      <option value="1">Factura</option>
                                     <?php  
                                        }
                                        
                                        if($tipo_doc==2){
                                         ?>
                                      <option value="2" selected>Boleta</option>
                                     <?php
                                        }else{
                                          ?>
                                      <option value="2" >Boleta</option>
                                     <?php  
                                        }
                                        
                                        
                                        if($tipo_doc==3){
                                         ?>
                                      <option value="3" selected>Guia</option>
                                     <?php
                                        }else{
                                          ?>
                                      <option value="3">Guia</option>
                                     <?php  
                                        }
                                        
                                        ?>
				      
				  </select>
				</div>
			 
          <?php
          
          $consulta3 = "SELECT * FROM $db_documento ";
$result3 = mysqli_query($db, $consulta3);



while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    if($valor3['id_documento']==$tipo_doc){
    $doc2=$valor3["$tien"];
    $folio=$valor3["$tien"];
    }
}

if($tipo_doc==3 and $numero1==1){
$doc2=$doc;     
}else{
if($doc1<>""){
       $doc2=$doc1;
 }else{
    $doc2=$doc2+1;
   }
}
    
          ?>
          
           
				<label for="doc" class="col-sm-3 control-label">Número de Documento Asociado:</label>
				<div class="col-md-1 col-sm-1 col2-xs-12">
                                    <input type="text"  readonly value="<?php echo $doc2;?>" class="form-control" id="doc_servicio" name="doc_servicio" placeholder="Número de Documento" required>
				  
				</div>
			  
          
          
          
          <?php
          }
          ?>
          
          
           
          <?php
          if(isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0"){
              
          ?>
          
				<label for="adelanto" class="col-sm-1 control-label">Adelanto Total:</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input type="text" value="<?php echo $adelanto;?>" class="form-control" id="adelanto" name="adelanto" placeholder="Adelanto"  pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
          
          
           
          
          
          <?php
          }
          ?>
         
          <?php
         // print"$_SESSION[servicio1]";
          $total=0;
          $sub_total1=0;
          $aceptar=0;
          $cancelado=0;
          $cancelado1=0;
          $aceptar_guia=0;
          $num=0;
          
          
          if (isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0") {
                $sql2="SELECT*FROM $db_servicio WHERE guia=$_SESSION[servicio1] and doc_servicio=$doc1 and tip_doc=$tipo_doc and tienda=$tienda1";
                $rw2=mysqli_query($db,$sql2);//recuperando el registro
                
                $read="readonly";
                ?>
        
          <input type="hidden" value="<?php echo $doc1;?>" name="doc1">
                <div class="table-responsive">
                    <table class="table" >
				<tr  style="background-color:#2E9AFE;color:white;" >
					
                                        <th>Borrar</th>
                                        <th>Foto</th>
					<th>Cantidad</th>
					
                                        <th>Descripcion</th>
                                       
					<th>Detalle</th>
                                        
                                        <th>Precio Unitario</th>
                                        <th>Precio Total</th>
                                        
				</tr>
          <?php
          $r=0;
          $i=0;
          $aceptar=0;
          
          
                while($valor2=mysqli_fetch_array($rw2)) {
    
  $accion=$valor2['id_servicio'];
  $accion1=$valor2['detalle'];
  //$accion1=$valor2['id_servicio'];
    $precio=$valor2['pre_ser'];
    $total=$total+$precio;
    $car2=$valor2['car2'];
    $com_ser=$valor2['com_ser'];
    $aceptar_guia=$valor2['aceptar_guia'];
    
    $cancelado=$cancelado+$valor2['ter_ser']; 
    
    $tipo=$valor2['tipo']; 
    
    if($tipo==1){
                                                    $tipo1="Laptop";
                                                }
                                                if($tipo==2){
                                                    $tipo1="Computadora";
                                                }
                                                if($tipo==3){
                                                   $tipo1="Impresora"; 
                                                }
                                                if($tipo==4){
                                                   $tipo1="Monitor"; 
                                                }
    $des_ser=$valor2['des_ser'];        
    $car3=$valor2['car3'];
    $car4=$valor2['car4'];
    $car5=$valor2['car5'];
    $car1=$valor2['car1'];
    $car6=$valor2['car6'];
    $tipo=$valor2['tipo'];
    $nom_ser=$valor2['des_ser'];
    $activo1=$valor2['activo'];
    $sql3="select * from $db_sub_tipo where id_tipo=$tipo";
                $rw3=mysqli_query($db,$sql3);
       $r=0;         
    $car = array();            
    while ($valor3 = mysqli_fetch_array($rw3)) {
        $car[$r]=$valor3['sub_tipo'];
        $tipo1=$valor3['nombre'];
        $r=$r+1;
    }
    if($r==4){
        $car[4]="";
        $car[5]="";
    }
    if($r==5){
        $car[5]="";
    }
    
    
    $cancelado1=$cancelado1+1;
    $i=$i+1;
    $descripcion="$car[0]:$car1 $car[1]:$car2 $car[2]:$car3 $car[3]:$car4 $car[4]:$car5 $car[5]:$car6";
    
    $c="ingresar1.php?id=$accion";
    ?>
                                
                                 <script> 
function abrir<?php echo $accion;?>() { 
open('<?php echo $c;?>','','top=300,left=300,width=300,height=400') ; 
} 

 

</script>      
    
    
    <?php
    if($aceptar_guia<>2){
    print"<tr style=\"background-color:#ECF8E0;color:black;\"><td><a class=\"btn btn-danger btn-xs\" href=\"eliminarservicios.php?accion=$accion&accion1=$accion1\"><i class=\"fa fa-trash-o\"></i> Borrar</a></td><td><img src=images/$tipo1.jpg width=30 height=30>$tipo1</td><td>1</td>";
            ?>
                                <td>
                                    
                       <?php echo $nom_ser;?>
                     
                    
                            
                                
                                    
                                    
                                    
                                    
                                </td>
                                <td>  
                          
       
          <?php
                                  include("registro_productos.php");
                                  
                                  
                                  ?>
                                    
                      <a onclick="abrir<?php echo $accion;?>()" class='btn btn-success btn-xs'>Editar</a>              
                                     <input type="hidden" value="<?php echo $com_ser;?>" id="com_ser<?php echo $accion;?>">
                                     <input type="hidden" value="<?php echo $des_ser;?>" id="des_ser<?php echo $accion;?>">
                                    <input type="hidden" value="<?php echo $tipo1;?>" id="equipo<?php echo $accion;?>">
                                    <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $accion;?>">
                                    <a href="#" class='btn btn-primary btn-xs' title='Editar servicio' onclick="obtener_datos('<?php echo $accion;?>');" data-toggle="modal" data-target="#nuevoProducto1"><i class="fa fa-folder"></i> Ver</a>                          
                                
                                   
                                  
                                    
                 </td>           
                                
                                
                                
    <?php
    $num=$num+1;          
    $valor="cant".$num;
    $valor1="id".$num;
    $valor2="det".$num;
    print"<td><input type=\"text\" size=5 class=Fields name=\"$valor\" value=\"$precio\"></td><td>$precio </td></tr>";
    
    print"<input type=\"hidden\" name=\"$valor1\" value=\"$accion\">";
    print"<input type=\"hidden\" name=\"$valor2\" value=\"$accion1\">";
    
    }else{
    print"<tr style=\"background-color:#ECF8E0;color:black;\"><td>No se puede eliminar</td><td><img src=images/$tipo1.jpg width=30 height=30>$tipo1</td><td>1</td><td>$nom_ser</td><td>";
            
    ?>
       
          <?php
                                  include("registro_productos.php");
                                  
                                  
                                  ?>
          
                
                 
<a onclick="abrir<?php echo $accion;?>()" class='btn btn-success btn-xs'>Editar</a>
                                     <input type="hidden" value="<?php echo $com_ser;?>" id="com_ser<?php echo $accion;?>">
                                     <input type="hidden" value="<?php echo $des_ser;?>" id="des_ser<?php echo $accion;?>">
                                    <input type="hidden" value="<?php echo $tipo1;?>" id="equipo<?php echo $accion;?>">
                                    <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $accion;?>">
                                    <a href="#" class='btn btn-primary btn-xs' title='Editar servicio' onclick="obtener_datos('<?php echo $accion;?>');" data-toggle="modal" data-target="#nuevoProducto1"><i class="fa fa-folder"></i> Ver</a>                          
                                
                                <?php
    print"</td><td>$precio</td><td>$precio</td></tr>";    
    }
    
}


               ?>
   
 
          
         
          <input type="hidden" name="num" value="<?php echo $num;?>">
          
               
          <?php
          
          
          
          $sql2="SELECT*FROM $db_detalle_factura WHERE numero_factura=$doc1 and tipo_doc=$tipo_doc and ven_com=1 and tienda=$tienda1 and id_cliente=$id_cliente";
                $rw2=mysqli_query($db,$sql2);//re
          
         
                while($valor2=mysqli_fetch_array($rw2)) {
    $ini=$valor2['precio_compra'];
    if($hora<>"00"){
              $aceptar_guia=$valor2['activo']+1;
          }
    
        $cantidad=$valor2['cantidad'];
        $aceptar=$valor2['activo']+1;
        $accion1=$valor2['id_detalle'];
        $producto1=$valor2['id_producto'];
        $foto1="nuevo.jpg";
        $activo1=$valor2['activo'];
    $precio=$valor2['precio_venta'];
    $id_detalle=$valor2['id_detalle'];
    $id_producto=$valor2['id_producto'];
             $consulta1 = "SELECT * FROM $db_products ";
$result1 = mysqli_query($db, $consulta1);

$producto2=0;
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    
    if($valor1['id_producto']==$id_producto){
    $producto1=$valor1['nombre_producto'];
    $producto2=$valor1['id_producto'];
    }
}       
                    
  if($producto1<>"" && $ini>0){
    $sub_total=$cantidad*$precio;
    $valor1="";
    $color="#ECF8E0";
    if($_SESSION['user_id']==1 && $producto2==0){
        $valor1="&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\"abri$id_detalle()\"><font color=red><strong>Costo</strong></font></a>";
        $color="#F5D0A9";
        
    }
    
    
    $sub_total1=$sub_total1+$cantidad*$precio;
    if($aceptar_guia<>2){
    
    print"<tr style=\"background-color:$color;color:black;\"><td><a class=\"btn btn-danger btn-xs\" href=\"eliminarservicios.php?accion1=$accion1\"><i class=\"fa fa-trash-o\"></i> Borrar  </a></td><td><img src=fotos/$foto1 width=30 height=30></td><td>$cantidad </td><td>$producto1</td><td></td><td>$precio $valor1</td><td>$sub_total</td></tr>";
    
    }else{
        
    print"<tr style=\"background-color:$color;color:black;\"><td>No se puede eliminar</td><td><img src=fotos/$foto1 width=30 height=30></td><td>$cantidad</td><td>$producto1</td><td></td><td>$precio $valor1</td><td>$sub_total </td></tr>";
       
    }
    $a="ingresar.php?id=$id_detalle";
    ?>
          
          
       <script> 
function abri<?php echo $id_detalle;?>() { 
open('<?php echo $a;?>','','top=300,left=300,width=300,height=300') ; 
} 

 

</script>
          
          
          
          <?php
          
    $total=$total+$sub_total;
}
                }

               ?>
                                <tr style="background-color:#CEF6EC;color:black;"><td><i style="background-color:#F5D0A9;color:black;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> Productos externos</td><td colspan="4"></td><td>Total:</td><td><?php echo number_format($total,2);?></td></tr>
 </table>       
               
                    
              </div>                  
              
          
          
          
          
          
          
          
          
<?php
                
            }
          
            ?>
          <?php
                      if($cliente<>""){
                          
                          
                      if($aceptar_guia<>2){
                          
                     
                         
                          ?>
                          
                          
                          
          <div class="btn-group">
                    <button type="button" class="btn btn-danger">Agregar Equipo</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                     
                    </button>
                    <ul class="dropdown-menu" role="menu">
                         <li><a href="tipo.php?accion=1">Laptops</a>
                      </li>
                        <li><a href="tipo.php?accion=2">Computadoras</a>
                      </li>
                      <li><a href="tipo.php?accion=3">Impresoras</a>
                      </li>
                     <li><a href="tipo.php?accion=4">Monitores</a>
                      </li>
                     
                    </ul>
                    
                    
                    
                  </div>  
          
          <?php
          
          if (isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0") {
         ?>
          <div class="btn-group">
                    <button type="button" class="btn btn-danger">Agregar Productos</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                     
                    </button>
                    <ul class="dropdown-menu" role="menu">
                         <li><a href="tipo.php?accion=5">Nuevo producto</a>
                      </li>
                       
                     
                    </ul>
                    
                    
                    
                  </div>
                          <?php
                           }  
                           ?>
          <div class="btn-group">
           <a class="btn btn-danger" href="tipo.php?accion=6">Actualizar</a>
         </div>
          <?php
           }
           ?>
          
           
            
         
           <?php
           
         
          if($ab<>""){
              
          ?>
          
          
          <div class="panel panel-info">
		<div class="panel-heading">
		   
                    <h2>Datos del Equipo ( <?php echo"$ab";?>)</h2>
		</div>        
        </div> 
           <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Nombre del Servicio:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    
				  <input type="text"  class="form-control" id="servicio" name="servicio" placeholder="Servicio a realizar al equipo" required>
				</div>
			  </div>
			                   
            
		 <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Diagnóstico del Equipo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" name="descripcion" placeholder="Diagnóstico del Equipo"></textarea>
				  
				</div>
			  </div>		
			<div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio del Servicio de Equipo:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio del Servicio" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>	
          
          
          
          
          
           <?php
                        
          }
          
          
          
          
           ?> 
             	
	
          
        <?php 
          if($ab1<>""){
              
          ?>
          
          
          <div class="panel panel-info">
		<div class="panel-heading">
		   
                    <h2>Datos del Producto</h2>
		</div>        
        </div> 
          <div class="form-group">
				<label for="producto" class="col-sm-3 control-label">Nombre del Producto:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="text" class="form-control input-sm" name="nombre_producto" id="nombre_producto" placeholder="Selecciona un producto">
					  <input id="id_producto" name="id_producto" type='hidden'>
                                
                                </div>
			  </div>
			                   
            <div class="form-group">
				<label for="inventario" class="col-sm-3 control-label">Inventario:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				 <input type="text" readonly="" class="form-control input-sm" id="inv_producto" name="inv_producto" >
				</div>
			  </div>
				
			<div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio del Producto S/:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    
				  <input type="text" class="form-control input-sm" id="precio_producto" name="precio" placeholder="precio_producto">
				</div>
			  </div>	
          
          <div class="form-group">
				<label for="cantidad" class="col-sm-3 control-label">Cantidad del Producto:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad del Producto" >
				</div>
			  </div>
				  
	
          
           <?php
                        
          }
          
           ?> 
             
          <input type="hidden" value="<?php echo $hora1;?>" name="hora">
          
          <input type="hidden" value="<?php echo $sub_total1;?>" name="subtotal1">
				 
      
        <input type="hidden" value="<?php echo $total;?>" name="total">
                        <?php
                        
                        
                        
                        $nom = array();
    $sql2="select * from $db_sub_tipo ";
    $i=0;
$rs1=mysqli_query($db,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    if($_SESSION['tipo']==$row3["id_tipo"]){
    ?>
    <div class="form-group">
				<label for="car" class="col-sm-3 control-label"><?php echo "$row3[sub_tipo]";?></label>
				<div class="col-md-9 col-sm-9 col-xs-12">
    
    <?php
$i=$i+1;
?>
<input type="text" class="form-control" id="car<?php echo "$i";?>" name="car<?php echo "$i";?>" placeholder="<?php echo "$row3[sub_tipo]";?>" value="----" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '----';}" required>

</div>
			  </div>
<?php


}
}                      
                        ?>
                     
 
          
    <?php
                      
    $nom = array();
    $sql2="select * from $db_clientes ";
    $i=0;
$rs1=mysqli_query($db,$sql2);
while($row3=mysqli_fetch_array($rs1)){
    
    
$nom[$i]=$row3["nombre_cliente"];

$i=$i+1;
}
  

$car1 = array();
$sql3="select distinct car1 from $db_servicio where tipo=$_SESSION[tipo]";
    $j=0;
$rs3=mysqli_query($db,$sql3);
while($row4=mysqli_fetch_array($rs3)){
    
    

$car1[$j]=$row4["car1"];

$j=$j+1;

}


$car2 = array();
$sql4="select distinct car2 from $db_servicio where tipo=$_SESSION[tipo]";
    $i=0;
$rs4=mysqli_query($db,$sql4);
while($row5=mysqli_fetch_array($rs4)){
    
    

$car2[$i]=$row5["car2"];

$i=$i+1;

}

$car3 = array();
$sql5="select distinct car3 from $db_servicio where tipo=$_SESSION[tipo]";
    $i=0;
$rs5=mysqli_query($db,$sql5);
while($row6=mysqli_fetch_array($rs5)){
    
    

$car3[$i]=$row6["car3"];

$i=$i+1;

}


$car4 = array();
$sql6="select distinct car4 from $db_servicio where tipo=$_SESSION[tipo] ";
    $i=0;
$rs6=mysqli_query($db,$sql6);
while($row7=mysqli_fetch_array($rs6)){
    
    

$car4[$i]=$row7["car4"];

$i=$i+1;

}


$car5 = array();
$sql7="select distinct car5 from $db_servicio where tipo=$_SESSION[tipo] ";
    $i=0;
$rs7=mysqli_query($db,$sql7);
while($row8=mysqli_fetch_array($rs7)){
    
    

$car5[$i]=$row8["car5"];

$i=$i+1;

}


$car6 = array();
$sql8="select distinct car6 from $db_servicio where tipo=$_SESSION[tipo]";
    $i=0;
$rs8=mysqli_query($db,$sql8);
while($row9=mysqli_fetch_array($rs8)){
    
    

$car6[$i]=$row9["car6"];

$i=$i+1;

}


    ?>       
    <script>
      
var tags = [];
                <?php
                    for($i = 0 ;$i<count($nom);$i++){
                ?>
                tags.push("<?php echo $nom[$i];?>");
                <?php } ?>
                
  

            
    $( "#cliente" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags, function( item ){
              return matcher.test( item );
          }) );
      }
});


</script>    
        
 
 </td></tr>
     
     <?php
 


?>
   

    <script>
    var tags1 = [];
                <?php
                    for($i = 0 ;$i<count($car1);$i++){
                ?>
                tags1.push("<?php echo $car1[$i];?>");
                <?php } ?>
                
  

            
    $("#car1" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags1, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    
    <script>
    var tags2 = [];
                <?php
                    for($i = 0 ;$i<count($car2);$i++){
                ?>
                tags2.push("<?php echo $car2[$i];?>");
                <?php } ?>
                
  

            
    $("#car2" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags2, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
   
    
     <script>
    var tags3 = [];
                <?php
                    for($i = 0 ;$i<count($car3);$i++){
                ?>
                tags3.push("<?php echo $car3[$i];?>");
                <?php } ?>
                
  

            
    $("#car3" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags3, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    
     <script>
    var tags4 = [];
                <?php
                    for($i = 0 ;$i<count($car4);$i++){
                ?>
                tags4.push("<?php echo $car4[$i];?>");
                <?php } ?>
                
  

            
    $("#car4" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags4, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    
     <script>
    var tags5 = [];
                <?php
                    for($i = 0 ;$i<count($car5);$i++){
                ?>
                tags5.push("<?php echo $car5[$i];?>");
                <?php } ?>
                
  

            
    $("#car5" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags5, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
     <script>
    var tags6 = [];
                <?php
                    for($i = 0 ;$i<count($car6);$i++){
                ?>
                tags6.push("<?php echo $car6[$i];?>");
                <?php } ?>
                
  

            
    $("#car6" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags6, function( item ){
              return matcher.test( item );
          }) );
      }
});
    
    </script>
    
    <?php
                      }
                     ?>
    
           <div>
                 <br>    
			
                      <?php
                      
                      
                      if($aceptar_guia<=1){
                          ?>
                      
                    
                      
			<button type="submit" class="btn btn-success" id="guardar_datos">Guardar datos</button>
                                       
                          <?php
                        }
                      ?>
                      
                      <?php
                     $rw2=""; 
                      $sql2="SELECT*FROM $db_facturas WHERE numero_factura=$doc1 and estado_factura=$tipo_doc and ven_com=1";
                $rw2=mysqli_query($db,$sql2);//re
          
         if($rw2<>""){
                while($valor2=mysqli_fetch_array($rw2)) {
                    $id_factura=$valor2["id_factura"];
                }
         }             
                      if($aceptar_guia==0 && $cliente<>""){
                          ?>
                      
                      
                      
			<button type="submit" class="btn btn-primary" name="guia" value="1" id="guia">Aceptar Guia</button>
                        
                      
                          <?php
                        }
                      ?>  
                        
                       <?php
                        
                       
                      if($aceptar_guia==1){
                          ?>
                      
                      
                      
			
                        <button type="submit" class="btn btn-primary" name="aceptar" value="1" id="aceptar">Aceptar venta</button>
                       <a href="#" class='btn btn-warning' title='Descargar Guia' onclick="imprimir_factura('<?php echo $id_factura;?>');">Imprimir Guia</a>  
                          <?php
                        }
                        
                      ?>  
                        
                        
                        
                      <?php
                      if($aceptar_guia==2){
                         
                          ?>
                      
                      
                      
                      
                      
                      <button type="submit" class="btn btn-primary" name="eliminar" value="1" id="eliminar">Eliminar venta</button>
			 <a href="#" class='btn btn-info' title='Descargar factura' onclick="imprimir_factura('<?php echo $id_factura;?>');">Descargar Documento</a>  
                         <a href="#" class='btn btn-warning' title='Descargar Guia' onclick="imprimir_factura('<?php echo $id_factura;?>');">Imprimir Guia</a>   
                          <?php
                        }
                      ?>
                      <?php
                      if($aceptar_guia==2){
                         
                          ?>
                  
                         <a target="_blanck" class="btn btn-primary"  href="pdf/documentos/02_generarFactura.php?id_factura=<?php echo $id_factura;?>">Fact Electrónica</a>  
                      
                      
                  
                    <?php
                        }
                      ?>
                      
                      
                      
                      
		  
                  </div>
		  </form>
                  
                 
          
          

          </div>
      </div>
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  
  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="js/facturas.js"></script>
  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });

    var asInitVals = new Array();
    $(document).ready(function() {
      var oTable = $('#example').dataTable({
        "oLanguage": {
          "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
          } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/datatables/tools/swf/copy_csv_xls_pdf.swf"
        }
      });
      $("tfoot input").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
      });
      $("tfoot input").each(function(i) {
        asInitVals[i] = this.value;
      });
      $("tfoot input").focus(function() {
        if (this.className == "search_init") {
          this.className = "";
          this.value = "";
        }
      });
      $("tfoot input").blur(function(i) {
        if (this.value == "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
        }
      });
    });
  </script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      
      var data =[
      <?php
                    for($i = 0;$i<count($producto);$i++){
                ?>
                '<?php echo $producto[$i];?>',
                <?php } ?>];
     
      
      
      var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->
  
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Seleccionar",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "Con Max Selección límite de 4",
        allowClear: true
      });
    });
    
    
    $( "#nuevoProducto1" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "registro_productos.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})


function obtener_datos(id){
			var descripcion = $("#descripcion"+id).val();
                        var equipo = $("#equipo"+id).val();
                        var com_ser = $("#com_ser"+id).val();
                        var des_ser = $("#des_ser"+id).val();
                        
                        
                        $("#mod_descripcion").val(descripcion);
                        $("#mod_equipo").val(equipo);
                        $("#mod_com_ser").val(com_ser);
                        $("#mod_des_ser").val(des_ser);
        $("#mod_id").val(id);
		
		}
     function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
                
       function imprimir_factura1(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura2.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}         
                
                
  </script>
  
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <?php
          
          //if (isset($_SESSION['servicio1']) and $_SESSION['servicio1'] != "0") {
         ?>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<?php
          //}
          ?>
        
        
        <script>
		$(function() {
						$("#nombre_producto").autocomplete({
							source: "./ajax/autocomplete/productos.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_producto').val(ui.item.id_producto);
								$('#nombre_producto').val(ui.item.nombre_producto);
								$('#precio_producto').val(ui.item.precio_producto);
								$('#inv_producto').val(ui.item.inv_producto);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_producto" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_producto" ).val("");
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
						}
			});	
	
        
        
        
        
        
      
 
  </script>
  
  <script>
		$(function() {
						$("#cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#cliente').val(ui.item.nombre_cliente);
								$('#tel').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel" ).val("");
							$("#mail" ).val("");
						}
			});
        
        
        
      
 
  </script>
  
  
</body>

</html>