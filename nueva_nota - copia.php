<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
//include('conexion.php');
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$dolar=$rs2["dolar"];
$count=0;
$tienda=$_SESSION['tienda'];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
   header("location: login.php");
    exit;
}
        $tienda1=$_SESSION['tienda'];
        $sql3="select * from sucursal where tienda=$tienda1";
        $rw3=mysqli_query($con,$sql3);//recuperando el registro
        $rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
        $caja=$rs3["caja"];
        if($caja==0){
            header("location:error1.php");    
        }
        if (isset($_GET['id_factura']))
	{
		$id_factura=intval($_GET['id_factura']);
		$campos="clientes.direccion_cliente,clientes.id_cliente, clientes.nombre_cliente, clientes.doc, clientes.telefono_cliente, clientes.email_cliente, facturas.id_vendedor, facturas.fecha_factura, facturas.folio, facturas.condiciones, facturas.estado_factura, facturas.numero_factura";
		$sql_factura=mysqli_query($con,"select $campos from facturas, clientes where facturas.estado_factura=1 and facturas.id_cliente=clientes.id_cliente and id_factura='".$id_factura."'");
		$count=mysqli_num_rows($sql_factura);
		if ($count==1)
		{
				
                                $rw_factura=mysqli_fetch_array($sql_factura);
				$id_cliente=$rw_factura['id_cliente'];
				$nombre_cliente=$rw_factura['nombre_cliente'];
				$telefono_cliente=$rw_factura['telefono_cliente'];
                                $direccion_cliente=$rw_factura['direccion_cliente'];
                                $folio=$rw_factura['folio'];
                                $doc1=$rw_factura['doc'];
                                $numero_factura=$rw_factura['numero_factura'];
				$email_cliente=$rw_factura['email_cliente'];
				$id_vendedor_db=$rw_factura['id_vendedor'];
				$estado_factura=$rw_factura['estado_factura'];
                                $session_id=session_id();
                                $delete2=mysqli_query($con, "delete from tmp where session_id='".$session_id."'");
				$sql2=mysqli_query($con, "select * from  detalle_factura where numero_factura='".$numero_factura."' and folio='".$folio."' and tienda=$tienda and tipo_doc=1");
                                //$sql4="select * from  detalle_factura where numero_factura='".$numero_factura."' and folio='".$folio."' and tienda=$tienda and tipo_doc=1";
                                while ($row2=mysqli_fetch_array($sql2))
                                {
                                    $precio_venta=$row2['precio_venta'];
                                    $cantidad=$row2['cantidad'];
                                    $id=$row2['id_producto'];
                                    $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','1000')");
                                }
				$_SESSION['id_factura']=$id_factura;
				$_SESSION['numero_factura']=$numero_factura;
                                
                                
                                
                                if($a[28]==0){
                                    header("location:error.php");    
   
                                }
                                
		}	
		else
		{
			header("location: facturas.php");
			exit;	
		}
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

  <title>Nueva Nota </title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>

 

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

      
          <div class="clearfix"></div>

         
         <?php
          menu2();
      
          menu1();
          
          ?>
        
        </div>
      </div>
            <?php
          menu3();
          ?>
      <div class="right_col" role="main">
        <div class="">
          
          <div class="clearfix"></div>

      
          
        <div class="container" >
            
                    <?php
                    $read="";  
                    $required="";
                    $color="";
                    $form="facturas.php";
                    $select1="";
                    $select2="";
                    $doc="Nota";
                    if ($_SESSION['doc_ventas']==5) {
                        $doc="Nota de Debito";
                        $form="credito-debito.php";
                        $select1="selected";
                    }
                    if ($_SESSION['doc_ventas']==6) {
                        $doc="Nota de Credito";
                        $form="credito-debito.php";
                        $select2="selected";
                    }
                    //print"$sql4";

                    ?>
   		
		</div>
		<div class="panel-body" style="background:<?php echo COLOR;?>;color:black;">
                    <div class="panel-body" style="background:#F5F6CE;">
                    <form class="form-horizontal" role="form" action="nueva_nota1.php" method="get">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        Tipo de Nota:
                        <select class="textfield11" style="background-color: #F5D0A9;" class='form-control input-sm' id="nota" name="nota" required>
                            <option value="6" <?php echo $select2;?>>Nota de Credito</option>
                            <option value="5"  <?php echo $select1;?>>Nota de Debito</option>
                        </select>
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-12">
                    N° Doc. Modificado:<select class="textfield11" style="background-color: #F5D0A9;" class="select2_single form-control" tabindex="-1" id="doc_mod" name="doc_mod" required>
                    <?php
                                                                $consulta4 = "SELECT * FROM facturas WHERE estado_factura<=2 and ven_com=1 and activo=1 and tienda=$tienda";
                                                                $result4 = mysqli_query($con, $consulta4);
                                                                while ($valor4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                                                    if($valor4["id_factura"]==$_GET['id_factura']){
                                                                    ?>     
                                                     
                                                                    <option  value="<?php print"$valor4[id_factura]";?>" selected><?php print"$valor4[folio]-$valor4[numero_factura]";?></option>      
                                                                    <?php      
                                                                    }else{
                                                                    ?>     
                                                      
                                                                    <option  value="<?php print"$valor4[id_factura]";?>"><?php print"$valor4[folio]-$valor4[numero_factura]";?></option>      
                                                                    <?php 
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                             
                     </div>
                     <div class="col-md-2 col-sm-2 col-xs-12">   
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search"></span> Buscar
			</button>
                         
                    </div>  
                        <div class="col-md-6 col-sm-2 col-xs-12">
                        <?php 
                                $video=videos;
                    
                                if($video==1){
                                    $v="V49tchOMI4U";
                                    include("modal/registro_video.php");
                                    ?>
                                    <div class="btn-group pull-right">
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                                    </div>
                                    <?php
                    
                                }
                                ?>
                        </div>
                    </form>
		<?php 
			include("modal/buscar_productos.php");
                        include("modal/buscar_servicio.php");
			//include("modal/registro_clientes.php");
			if ($count==1)
		{
                            
                       
		?>
                     </div>   
                    <form class="form-horizontal" role="form" id="datos_factura" action="credito-debito.php" method="get">
			 <font color="black">LLenar los campos</font> <font style="background-color:#F5D0A9;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>
                        	
                        <div class="form-group row" >
				  
				  <div class="col-md-8 col-sm-8 col-xs-12">
                                      Cliente
                                      <input class="textfield10" type="search" class="form-control input-sm"  id="nombre_cliente" value="<?php echo $nombre_cliente;?>" placeholder="Buscar un cliente o ingresar cliente nuevo" readonly>
					  <input id="id_cliente" name="id_cliente" type='hidden' value="<?php echo $id_cliente;?>">	
				  </div>
                            
                                  <div class="col-md-2 col-sm-2 col-xs-12">
                                                            Documento del cliente
                                     							                       
								<input class="textfield10" type="text" autocomplete="off" class="form-control input-sm"  name="doc1" id="doc1" value="<?php echo $doc1;?>" placeholder="RUC/DNI" readonly>
							</div>
                            
                                    <div  class="col-md-2 col-sm-2 col-xs-12">
                                                           Tipo Doc
								<select  class="textfield10" class='form-control input-sm' id="tip_doc" name="tip_doc">
                                                                   <?php         
                                                                   if ($_SESSION['doc_ventas']==1 or $_SESSION['doc_ventas']>=3) {
                                                                     ?>
                                                                    
                                                                    <option value="2" selected>RUC</option>
                                                                     <?php
                                                                   }         
                                                                   if ($_SESSION['doc_ventas']==2 or $_SESSION['doc_ventas']==3) {
                                                                     ?>
                                                                    <option value="1" selected>DNI</option>
                                                                    <?php
                                                                   }         
                                                                            
                                                                    ?>
									
									
								</select>
							</div>                     
                            
                                  <div class="col-md-2 col-sm-2 col-xs-12">
                                      
                            </div>
                                  <?php
                             

$consulta3 = "SELECT * FROM documento ";
$result3 = mysqli_query($con, $consulta3);
while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    if($valor3['id_documento']==$_SESSION['doc_ventas']){
        
       
            $doc=$valor3["tienda$tienda1"]+1;
            $doc11=$valor3["folio$tienda1"];
            
    
    }
}
                                  ?>
                                     </div>
                                     <div class="form-group row" >
                                          <div class="col-md-8 col-sm-8 col-xs-12">
                                                            Dirección del cliente:
								<input class="textfield10" type="text" autocomplete="off" style="background-color: <?php echo $color;?>;" value="<?php echo $direccion_cliente;?>" class="form-control input-sm" id="direccion_cliente" placeholder="Dirección del cliente" readonly>
							</div>
                                         <div class="col-md-2 col-sm-2 col-xs-12">
                                                            Teléfono
								<input class="textfield10" type="text" autocomplete="off" class="form-control input-sm" id="tel1" value="<?php echo $telefono_cliente;?>" placeholder="Teléfono" readonly>
							</div>
                                                        <input id="id_cliente" name="id_cliente" type='hidden' value="<?php echo $id_cliente;?>">
							<div class="col-md-2 col-sm-2 col-xs-12">
                                                            Email
								<input class="textfield10" type="text" autocomplete="off" class="form-control input-sm" id="mail" placeholder="Email" value="<?php echo $email_cliente;?>" readonly>
							</div>
                                     </div>
                         
                         
						<div class="form-group row">
  						<div class="col-md-2 col-sm-2 col-xs-12">
                                                            
								Folio<input class="textfield10" type="text" value="<?php echo $doc11;?>" class="form-control input-sm" id="folio" placeholder="Folio" readonly required>
							</div>
                                                        
                                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                                            
								Nro Doc<input class="textfield10" type="text" value="<?php echo $doc;?>" class="form-control input-sm" id="factura" placeholder="Número de doc" readonly required>
							</div>
                                  
                                                         <div class="col-md-2 col-sm-2 col-xs-12">
                                                             N° Doc. Modificado:<input class="textfield10" type="text" value="<?php print"$folio-$numero_factura";?>" class="form-control input-sm" id="nro_doc" placeholder="Número de doc" readonly required>
                                                           
                                                                
                                                         </div>
                                                    
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <?php
                                                            if ($_SESSION['doc_ventas']<>5 and $_SESSION['doc_ventas']<>6 ) {
                                                                
                                                            ?>
                                                            Motivo (Nota de crédito y débito):<input autocomplete="off" type="text"  class="form-control input-sm" id="motivo" placeholder="Motivo" <?php echo $read;?>>
                                                            <?php
                                                            }
                                                            if ($_SESSION['doc_ventas']==6) {
                                                            ?>
                                                             Motivo:
                                                            <select class="textfield11" style="background-color: #F5D0A9;" class='form-control input-sm' id="motivo" required>
			                                        <option value="">SELECCIONA MOTIVO</option>        
                                                                <option value="01">ANULACION DE LA OPERACION</option>
                                                                <option value="02">ANULACION POR ERROR EN EL RUC</option>
						                <option value="03">CORRECION POR ERROR EN LA DESCRIPCION</option>
						                <option value="04">DESCUENTO GLOBAL</option>
						                <option value="05">DESCUENTO POR ITEM</option>
						                <option value="06">DEVOLUCION TOTAL</option>
						                <option value="07">DEVOLUCION POR ITEM</option>
						                <option value="08">BONIFICACION</option>
						                <option value="09">DISMINUCION EN EL VALOR</option>
			                                    </select>
                                                            
                                                            <?php
                                                            }
                                                            
                                                            ?>
                                                             
                                                            <?php
                                                            if ($_SESSION['doc_ventas']==5) {
                                                            ?>
                                                             Motivo:
                                                            <select class="textfield11" style="background-color: #F5D0A9;" class='form-control input-sm' id="motivo" required>
			                                        
                                                                <option value="">SELECCIONA MOTIVO</option>
						                <option value="01">INTERES POR MORA</option>
			                                        <option value="02">AUMENTO EN EL VALOR</option>
			                                        <option value="03">PENALIDADES</option>
			                                    </select>
                                                            
                                                            <?php
                                                            }
                                                            
                                                            ?> 
								
							</div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                                         Stock de productos:
                                                        <select class="textfield11" style="background-color: #F5D0A9;" class='form-control input-sm' id="des" required>
			                                        
                                                                
                                                                <?php
                                                            if($_SESSION['doc_ventas']>=5) {
                                                                print"<option value=0>NO MOVER STOCK</option>";
                                                            }    
                                                            if($_SESSION['doc_ventas']<=3 or $_SESSION['doc_ventas']==6) {
                                                                print"<option value=1>DESCONTAR STOCK(-)</option>";
                                                            }    
                                                            if($_SESSION['doc_ventas']==6) {
                                                                print"<option value=2>REPONER STOCK(+)</option>";
                                                            }
                                                            
                                                            ?>
						                
			                                        
			                                    </select>
                                                    </div>
                                                    
                              </div>
						<div class="form-group row">
							
							<?php date_default_timezone_set('America/Lima');?>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
                                                            Fecha:
								<input class="textfield10" style="background-color: #F5D0A9;" type="date" class="form-control input-sm" id="fecha" value="<?php echo date("Y-m-d");?>" required>
							</div>
							
                                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                                            Hora:
								<input class="textfield10" style="background-color: #F5D0A9;" type="time" class="form-control input-sm" id="hora" value="<?php echo date("H:i:s");?>" required>
							</div>
                                                    
                                                   <input type="hidden" class="form-control input-sm" value="<?php echo $_SESSION['doc_ventas'];?>" name="tipo_doc1" id="tipo_doc1"  required>
                                                    <input type="hidden" class="form-control input-sm" value="1" name="moneda" id="moneda"  required>
						
                                                    <input type="hidden" class="form-control input-sm" value="<?php echo $dolar;?>" name="tcp" id="tcp"  required>
							
                                                    <div  class="col-md-3 col-sm-3 col-xs-12">
                                                            Pago
								<select class="textfield11" style="background-color: #F5D0A9;" class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									 <?php
                                                                        if ($_SESSION['doc_ventas']<5) {
                                                                        ?>
                                                                            <option value="4">Crédito</option>
                                                                        <?php            
                                                                        }
                                                                        ?>
                                                                        
                                                                        
								</select>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
                                                            Nro Dias
								<input class="textfield10" style="background-color: #F5D0A9;" autocomplete="off" type="text" value="0" class="form-control input-sm" id="dias" name="dias" placeholder="Número de días de crédito">
							</div>
                                                        
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						
						
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
                                            
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">
						 <span class="glyphicon glyphicon-search"></span> Agregar servicio o descripcion
						</button>
                                            
						<button type="submit" class="btn btn-primary">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			
                    
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                <?php
                         }
                         ?>
			
		  <div class="row-fluid">
			<div class="col-md-12">
			
			</div>	
		 </div>
	</div>
         
          </div>
        </div>

     

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
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>

  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="js/editar_factura.js"></script>
	
  <script>
        $(function() {
						$("#doc1").autocomplete({
							source: "./ajax/autocomplete/notas.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);
								$('#doc1').val(ui.item.doc1);
                                                                $('#direccion_cliente').val(ui.item.direccion_cliente);
								
							 }
						});
						 
						
					});
					
	$("#doc1" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
                                                        $("#nombre_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
                                                        $("#doc1" ).val("");
							$("#direccion_cliente" ).val("");				
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
                                                        $("#doc1" ).val("");
                                                        $("#direccion_cliente" ).val("");
						}
			});
     </script>                   
</body>

</html>















