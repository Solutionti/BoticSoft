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

$tienda1=$_SESSION['tienda'];
$sql3="select * from sucursal where tienda=$tienda1";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$caja=$rs3["caja"];
$online=recoge1('online');
$session_id=session_id();
$delete2=mysqli_query($con, "delete from tmp where session_id='".$session_id."'");
$nombre="CLIENTES VARIOS";
$documento="11111111";
$telefono="";
$email="";
$s1="";
$s2="";
if($online<>""){
$sql2=mysqli_query($con, "select * from carrito where clave='$online'");
                                //$sql4="select * from  detalle_factura where numero_factura='".$numero_factura."' and folio='".$folio."' and tienda=$tienda and tipo_doc=1";
while ($row2=mysqli_fetch_array($sql2))
{
    $precio_venta=$row2['precio'];
    $cantidad=$row2['cantidad'];
    $id=$row2['id_producto'];
    $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','1000')");
}
$sql3=mysqli_query($con, "select * from factura_carrito where codigo='$online'");
$row3=mysqli_fetch_array($sql3);
$nombre=$row3['nombre'];
$documento=$row3['documento'];
$telefono=$row3['telefono'];
$email=$row3['email'];
if($documento>=11111111111){
    $s2="selected";
}else{
    $s1="selected";
}

}else{
    $_SESSION['online']="";
}






$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
   header("location: login.php");
    exit;
}

if($a[20]==0){
   header("location:error.php");    
   
}
if($caja==0){
    header("location:error1.php");    
}
$oc="";
$folio=recoge1('folio');
$numero_factura=recoge1('numero_factura');
if($folio<>"" and $numero_factura>0){
$sql2=mysqli_query($con, "select * from detalle_factura where folio='$folio' and numero_factura=$numero_factura and tienda=$tienda1 and tipo_doc=8 and ven_com=1");
                                //$sql4="select * from  detalle_factura where numero_factura='".$numero_factura."' and folio='".$folio."' and tienda=$tienda and tipo_doc=1";
while ($row2=mysqli_fetch_array($sql2))
{
    $precio_venta=$row2['precio_venta'];
    $cantidad=$row2['cantidad'];
    $id=$row2['id_producto'];
    $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','1000')");
}
$sql3=mysqli_query($con, "select * from clientes,facturas where facturas.id_cliente=clientes.id_cliente and facturas.folio='$folio' and facturas.numero_factura=$numero_factura and facturas.tienda=$tienda1 and facturas.estado_factura=8 and facturas.ven_com=1");
$row3=mysqli_fetch_array($sql3);
$nombre=$row3['nombre_cliente'];
$documento=$row3['documento'];
$direccion=$row3['direccion_cliente'];
$telefono=$row3['telefono_cliente'];
$email=$row3['email_cliente'];
if($documento>=11111111111){
    $s2="selected";
}else{
    $s1="selected";
}

$oc="$folio-$numero_factura";
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

  <title>Nuevo Documento </title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>

 <style type="text/css">
#caja_busqueda /*estilos para la caja principal de busqueda*/
{
width:100%;
height:25px;
border:solid 1px #088A08;
font-size:11px;

}

.busca /*estilos para la caja principal de busqueda*/
{
width:100%;
height:25px;
border:solid 1px #088A08;
font-size:11px;

}

#display /*estilos para la caja principal en donde se puestran los resultados de la busqueda en forma de lista*/
{
width:100%;
background: white;
overflow:hidden;
z-index:10;

position:absolute;

}
.display_box /*estilos para cada caja unitaria de cada usuario que se muestra*/
{
padding:2px;
padding-left:6px; 
font-size:11px;

text-decoration:none;
color:#3b5999; 
}

.display_box:hover /*estilos para cada caja unitaria de cada usuario que se muestra. cuando el mause se pocisiona sobre el area*/
{
background: #F5F6CE;
color: black;
}
.desc
{
color:#666;
font-size:11;
}
.desc:hover
{
color:#FFF;
}

/* Easy Tooltip */
</style>     
         <script type="text/javascript">
$(document).ready(function(){

$(".busca").keyup(function() //se crea la funcioin keyup
{
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion
{
    $("#display").hide();
                        return false;
}
else
{
$.ajax({//metodo ajax
type: "POST",//aqui puede  ser get o post
url: "search.php",//la url adonde se va a mandar la cadena a buscar
data: dataString,
cache: false,
success: function(html)//funcion que se activa al recibir un dato
{
$("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
	}
});
}return false;    
});
});
jQuery(function($){//funcion jquery que muestra el mensaje "Buscar amigos..." en la caja de texto
   $("#caja_busqueda").Watermark("Buscar producto...");
   });
</script> 
<?php
//if(!isset($_GET['Ancho']) && !isset($_GET['Alto'])){
 //   echo "<script language=\"JavaScript\">
//    <!-- 
//    document.location=\"$PHP_SELF?Ancho=\"+screen.width+\"&Alto=\"+screen.height;
 //   //-->
 //   </script>";
//} 
$r="nav-sm";
//if($_GET['Ancho']<=400){
//    $r="nav-md";
    
//}else{
//    $r="nav-sm";
    
//}
//print"$r";
?>

</head>


<body class="<?php echo $r;?>">

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
          <div class="page-title">
            <div class="title_left">
              
            </div>

            
          </div>
          <div class="clearfix"></div>
            <?php
                    $read="";  
                    $required="";
                    $color="";
                    $form="facturas.php";
                    $dd1="";
                    $dd2="";
                    if ($_SESSION['doc_ventas']>=5 and $_SESSION['doc_ventas']<8) {
                        $_SESSION['doc_ventas']=1;
                    }
                    if ($_SESSION['doc_ventas']==1) {
                        $doc="Factura";
                        $read="readonly";
                        $required="required";
                        $color="#F5D0A9";
                        $dato="INGRESAR RUC";
                        
                    }
                    if ($_SESSION['doc_ventas']==2) {
                        $doc="Boleta";
                        $read="readonly";
                        $dato="INGRESAR DNI";
                         //$dd1="11111111";
                    //$dd2="CLIENTES VARIOS";
                        
                    }
                    if ($_SESSION['doc_ventas']==3) {
                        $doc=doc;
                        $read="readonly";
                        $dato="INGRESAR RUC/DNI";
                    }
                    if ($_SESSION['doc_ventas']==8) {
                        $doc="Cotizacion";
                        $read="readonly";
                        $dato="INGRESAR RUC/DNI";
                    }
                    


                    ?>
          
          
     
          
        <div class="container" >
            <div class="panel panel-info" >
		
		<div class="panel-body" style="background:white;color:black;">
		<?php 
			include("modal/buscar_productos.php");
                        include("modal/buscar_servicio.php");
			//include("modal/registro_clientes.php");
			
		?>  <div class="row">
                    
                    <div class="col-md-7 col-sm-7 col-xs-12" style=" background: white; ">
                            <table class="table">
                                <tr style="background:#A9D0F5;color:black;">
                                    <td style="width:70%;">    
                                        <input type="search" class="busca" id="caja_busqueda" name="clave" placeholder="Buscar nombre producto o por codigo producto"/><br />
                                        <div id="display" style="position: absolute;"></div>
                                    </td>
                                    <td style="width:30%;">
                                <input type="text" class="busca"  autocomplete="off" id="q5" placeholder="Codigo de barras" onkeyup="Lector(this.value);">
                               
                                </td></tr>
                            </table>

	
                            <div id="resultados" style="margin-top:10px;width:100%;"></div>
                    </div><!-- Carga los datos ajax -->
                    
                    <div class="col-md-5 col-sm-5 col-xs-12" style="background: <?php echo COLOR;?>;">
                        
                        <div style="background:#01A9DB;padding:5px;margin:5px;border-radius: 7px;">
                            <?php 
                                $video=videos;
                    
                                if($video==1){
                                    $v="7eghFzpiy9I";
                                    include("modal/registro_video.php");
                                    ?>
                                    
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                                    
                                    <?php
                    
                                }
                                ?>
                            <font color="white" size="3"><strong>VENTAS:</strong></font><font color="black">LLenar campos obligatorios</font> <font style="background-color:<?php echo COLOR1;?>;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>                          
                        </div> 
                       
                    <form class="form-horizontal" role="form" id="datos_factura" action="facturas.php" method="get">
                       
                         <div class="col-md-12">
					<div class="pull-right">
						
						
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Productos
						</button>
                                            
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">
						 <span class="glyphicon glyphicon-search"></span> Descripcion
						</button>
                                            
						<button type="submit" class="btn btn-primary">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>	
                        <div class="form-group row" >
			  
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                Doc cliente
                                     							                       
                                            <input class="textfield10" type="text" autocomplete="off" class="form-control input-sm" style="background-color: <?php echo COLOR1;?>;" name="doc1" id="doc1"  placeholder="<?php echo $dato;?>"  value="<?php echo $documento;?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '11111111';}" required>
                            </div>
                                                        
                            
                            <div  class="col-md-4 col-sm-24 col-xs-12">
                                                        Tipo Documento
								<select  class="textfield11" class='form-control input-sm' id="tip_doc" name="tip_doc">
                                                                   
                                                                    <option value="1" <?php echo $s1;?>><?php echo PN;?></option>
                                                                    <option value="2" <?php echo $s2;?>><?php echo PJ;?></option>
                                                                 	
								</select>
							</div>                     
                            
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                      <input  type="button" class="btn btn-success" style=" margin-top: 15px;" id="btn-ingresar" value="Buscar Ruc/Dni" />
                            </div>
                                  
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                Cliente
                                <input class="textfield10"  type="text" minlength="10"  class="form-control input-sm" style="background-color: <?php echo COLOR1;?>;" name="nombre_cliente" id="nombre_cliente" placeholder="Nombre del cliente"  value="<?php echo $nombre;?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'CLIENTES VARIOS';}"  required>
					 
                                <input id="id_cliente" type='hidden'>	
                            </div>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                            Dirección del cliente:
								<input class="textfield10" type="text" autocomplete="off"  class="form-control input-sm" id="direccion_cliente" placeholder="Dirección del cliente" >
                            </div>
                         </div>
                        <div class="form-group row" >    
                            <div class="col-md-6 col-sm6 col-xs-12">
                                                            Teléfono
								<input class="textfield10" type="text" autocomplete="off" class="form-control input-sm" id="tel1" value="<?php echo $telefono;?>" placeholder="Teléfono" >
                            </div>
					
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                            Email
								<input class="textfield10" type="text" autocomplete="off" class="form-control input-sm" id="mail" value="<?php echo $email;?>" placeholder="Email" >
                            </div>
                        </div>
                         
                         
			<div class="form-group row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                         Tip doc:
                                                        <select class="textfield11" style="background-color: <?php echo COLOR1;?>;" class='form-control input-sm' id="tipo_doc1" required>
			                                        
                                                            <?php
                                                                $doc1=doc;
                                                                if($s2<>""){
                                                                    print"<option value=1>Factura</option>";
                                                                }else{
                                                                    print"<option value=2>Boleta</option>";
                                                                }
                                                                //print"<option value=1>Factura</option>";
                                                                print"<option value=3>$doc1</option>";
                                                                print"<option value=8>Cotización</option>";
                                                            ?>  
                                                               
						                
			                                        
			                                    </select>
                            </div>
                                  
                                                    <input type="hidden" id="des" value="1">   
                                                    
                                                    
                                                    
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                         Tipo:
                                                        <select class="textfield11" style="background-color: <?php echo COLOR1;?>;" class='form-control input-sm' id="tip" required>
			                                      
                                                                <?php
                                                                print"<option value=0>IGV</option>";
                                                                print"<option value=1>EXONERADA</option>";
                                                                                                                      
                                                            ?>
						             
                                                            
			                                        
			                                    </select>
                            </div>
                                                    
                                                    
                             
							
							<?php date_default_timezone_set('America/Lima');?>
							
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                Fecha:
                                <input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="date" class="form-control input-sm" id="fecha" value="<?php echo date("Y-m-d");?>" required readonly>
                            </div>
							
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                Hora:
                                <input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="time" class="form-control input-sm" id="hora" value="<?php echo date("H:i:s");?>" required readonly>
                            </div>
                                                    
                                                   <input type="hidden" class="form-control input-sm" value="<?php echo $online;?>" name="online" id="online"  required>
                                                    <input type="hidden" class="form-control input-sm" value="1" name="moneda" id="moneda"  required>
						
                                                    <input type="hidden" class="form-control input-sm" value="<?php echo $dolar;?>" name="tcp" id="tcp"  required>
			 </div>
                         
                         
			<div class="form-group row">				
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            Cotizacion:
                            <input class="textfield10"   autocomplete="off" type="text" value="<?php echo $oc;?>" class="form-control input-sm" id="motivo" name="motivo" placeholder="Doc Cotización">
                            </div>
                            <div  class="col-md-4 col-sm-4 col-xs-12">
                            Pago:
                            <select class="textfield11" style="background-color: <?php echo COLOR1;?>;" class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
                                                                        <option value="5">Tarjeta</option>
									 <?php
                                                                        if ($_SESSION['doc_ventas']<5) {
                                                                        ?>
                                                                            <option value="4">Crédito</option>
                                                                        <?php            
                                                                        }
                                                                        ?>
                                                                        
                                                                        
                            </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            Nro Dias Crédito
                            <input class="textfield10"  style="background-color: <?php echo COLOR1;?>;" autocomplete="off" type="text" value="0" class="form-control input-sm" id="dias" name="dias" placeholder="Número de días de crédito">
                            </div>
                                                        
                        </div>
                        
                        
                        <div class="form-group row">				
                            <div class="col-md-6 col-sm-6 col-xs-12">
                             Valor de pago efectivo:  
                             <input  style="background-color: red;color:white;text-align:center;height:50px;font-size: 18pt;" autocomplete="off" type="search" onchange="sumar1();" class="form-control input-sm" id="pagado"  placeholder="Paga con:">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                Vuelto
                                <div  id="vuelto" style="background:green;color:white;text-align:center;height:50px;padding:8px;font-size:18pt;"></div>
                                
                            </div>
                           
			</div>	
				
				
			</form>	
                        </div>
                       
                    </div>
                </div>
            </div>		
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
	<script>
        $(function() {
						$("#doc1").autocomplete({
							source: "./ajax/autocomplete/clientes1.php",
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
                        
       $(function() {
						$("#nombre_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
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
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
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
                        
                        
                        
	   $(document).ready(function(){
			load(1);
                        $( "#resultados" ).load( "ajax/agregar_facturacion.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_factura.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
                        var stock=document.getElementById('stock_'+id).value;
			//Inicia validacion
			
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&stock="+stock,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
                       document.getElementById("caja_busqueda").value = "";
                        $("#caja_busqueda").focus();
                       $("#display").hide();
                        return false;
                        
                        
		}
                
                function agregar2 (id)
		{
			var precio_venta=document.getElementById('precio_'+id).value;
			var cantidad=document.getElementById('cant_'+id).value;
                        var stock=document.getElementById('stoc_'+id).value;
			//Inicia validacion
			
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&stock="+stock,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
                        document.getElementById("caja_busqueda").value = "";
                        $("#caja_busqueda").focus();
                       $("#display").hide();
                        return false;
                        
		}
		
                
                
               function agregar1 (id1)
		{
			var precio_venta=document.getElementById('precio_ventaa_'+id1).value;
			var cantidad=document.getElementById('cantidada_'+id1).value;
                        var id=document.getElementById('descripcion_'+id1).value;
                        var stock=document.getElementById('stocka_'+id1).value;
			//Inicia validacion
                        if (!isNaN(id))
			{
			alert('Esto no es un texto');
			document.getElementById('descripcion_'+id1).focus();
			return false;
			}
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidada_'+id1).focus();
			return false;
			}                     
                	if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_ventaa'+id1).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&stock="+stock,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		} 
                
                function Lector(n){
			
			$.ajax({
                type: "POST",
                url: "./ajax/productos_factura1.php",
                    data: "barra="+n,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
                    success: function(datos){
		$( "#resultados" ).load( "ajax/agregar_facturacion.php" );
		}
			});
                        
                        if(n.length >=12) {
                        blanco();
                        }
		}
                
                function blanco() {
                    
                    
                document.getElementById("q5").value = "";
        
    
                }
             
             
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_factura").submit(function(){
		  var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
                 
                  var factura = $("#factura").val();
		   var fecha = $("#fecha").val();
                    var hora = $("#hora").val();
                     var moneda = $("#moneda").val();
                     var dias = $("#dias").val();
                      var tcp = $("#tcp").val();
                    var folio = $("#folio").val();
                    var nro_doc = $("#nro_doc").val();
                    var motivo = $("#motivo").val();
                    var nombre_cliente = $("#nombre_cliente").val();
                    var doc1 = $("#doc1").val();
                    var tip_doc = $("#tip_doc").val();
                    var tel1 = $("#tel1").val();
                    var mail = $("#mail").val();
                    var direccion = $("#direccion_cliente").val();
                    var des = $("#des").val();
                    var tip = $("#tip").val();
                    var tipo_doc1 = $("#tipo_doc1").val();
                    var online = $("#online").val();
                         var n = doc1.length;
                    
                        if ((n == <?php echo PJ1;?> && tip_doc==2) |  (n == <?php echo PN1;?> && tip_doc==1) ) {
                            VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&factura='+factura+'&dias='+dias+'&condiciones='+condiciones+'&fecha='+fecha+'&hora='+hora+'&moneda='+moneda+'&tcp='+tcp+'&folio='+folio+'&nro_doc='+nro_doc+'&motivo='+motivo+'&nombre_cliente='+nombre_cliente+'&doc1='+doc1+'&tip_doc='+tip_doc+'&tel1='+tel1+'&mail='+mail+'&direccion='+direccion+'&des='+des+'&tip='+tip+'&online='+online+'&tipo_doc1='+tipo_doc1,'Factura','','1024','768','true');
                  
                        }else{
                           
                            alert('El dni o ruc es erroneo');
                            event.preventDefault();
                        }
                    
	 	});
		
		$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})

    $(document).on('ready',function(){

      $('#btn-ingresar').click(function(){
        var url = "busqueda.php";                                      
        
        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#datos_factura").serialize(),
           success: function(data)            
           {
             $('#doc1').html(data);
             
             porciones = data.split('|');


             document.getElementById("nombre_cliente").value = porciones[0];
             document.getElementById("direccion_cliente").value = porciones[1];
             document.getElementById("tel1").value = porciones[2];
             document.getElementById("mail").value = porciones[3];
           }
         });
         
      });
    });
    
        
        
        </script>
 
<script language="javascript">
$(document).ready(function(){
    $("#tip_doc").on('change', function () {
        $("#tip_doc option:selected").each(function () {
            elegido=$(this).val();
            $.post("modelo.php", { elegido: elegido }, function(data){
                $("#tipo_doc1").html(data);
            });			
        });
   });
});
$(document).ready(function(){
    $("#tipo_doc1").on('change', function () {
        $("#tipo_doc1 option:selected").each(function () {
            elegido=$(this).val();
            $.post("modelo1.php", { elegido: elegido }, function(data){
                $("#tip").html(data);
            });			
        });
   });
});

function sumar1 () {
    var total = 0;	
    var total1 = 0;
	
    total = document.getElementById("total").value;
    total1 = document.getElementById("pagado").value;
    r1=1*total1-1*total;
    
    document.getElementById('vuelto').innerHTML = r1;
}

$( function() {
    $("#condiciones").change( function() {
        
        
        if ($(this).val() === "1") {
            $("#pagado").prop("disabled", false);
            
        } else {
            $("#pagado").prop("disabled", true);
        }
        
    });
});


</script>
 
</body>

</html>















