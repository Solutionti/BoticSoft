<?php
session_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos       
include('menu.php');
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$dolar=$rs2["dolar"];
$a = explode(".", $modulo); 
$session_id=session_id();
$delete2=mysqli_query($con, "delete from tmp where session_id='".$session_id."'");

$tienda1=$_SESSION['tienda'];
$sql3="select * from sucursal where tienda=$tienda1";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$caja=$rs3["caja"];

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[33]==0){
    header("location:error.php");    
}

if($caja==0){
    header("location:error1.php");    
}

$folio=recoge1('folio');
$numero_factura=recoge1('numero_factura');
$oc="";
$id_proveedores="";
$telefono="";
$email="";
$nombre="";

$read="";


if($folio<>"" and $numero_factura>0){
$sql2=mysqli_query($con, "select * from detalle_factura where folio='$folio' and numero_factura=$numero_factura and tienda=$tienda1  and ven_com=12");
                                //$sql4="select * from  detalle_factura where numero_factura='".$numero_factura."' and folio='".$folio."' and tienda=$tienda and tipo_doc=1";
while ($row2=mysqli_fetch_array($sql2))
{

    $precio_venta=$row2['precio_venta'];
    $cantidad=$row2['cantidad'];
    $id=$row2['id_producto'];
    $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','1000')");
}
$sql3=mysqli_query($con, "select * from clientes,facturas where facturas.id_cliente=clientes.id_cliente and facturas.folio='$folio' and facturas.numero_factura=$numero_factura and facturas.tienda=$tienda1  and facturas.ven_com=12");
$row3=mysqli_fetch_array($sql3);
$nombre=$row3['nombre_cliente'];

$id_proveedores=$row3['id_cliente'];



$direccion=$row3['direccion_cliente'];
$telefono=$row3['telefono_cliente'];
$email=$row3['email_cliente'];
$read="readonly";

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

  <title>Nueva compras </title>
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
url: "search1.php",//la url adonde se va a mandar la cadena a buscar
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
 //   <!-- 
 //   document.location=\"$PHP_SELF?Ancho=\"+screen.width+\"&Alto=\"+screen.height;
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

          <!-- menu prile quick info -->
         <?php
          menu2();
          
         
          menu1();
          
          ?>
         
        </div>
      </div>

      <!-- top navigation -->
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

      
              
              
              
 <div class="container">
	
            
		<?php 
			include("modal/buscar_productos.php");
                        include("modal/registro_productos.php");
			include("modal/registro_proveedores.php");
			
		?>
                <div class="row" style='color:black;'>
                    
                     <div class="col-md-7 col-sm-7 col-xs-12" style=" background: white; ">
                         
					<div class="pull-center">
						
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#nuevoProveedores">
						 <span class="glyphicon glyphicon-user"></span>+Proveedor
						</button>
                                               
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span>+Productos
						</button>
						
					</div>	
				
                         
                            <table class="table">
                                <tr style="background:#A9D0F5;color:black;">
                                    <td style="width:70%;">    
                                        <input type="search" class="busca" id="caja_busqueda" name="clave" placeholder="Buscar nombre o codigo producto"/><br />
                                        <div id="display" style="position: absolute;"></div>
                                    </td>
                                    <td style="width:30%;">
                                <input type="text" class="busca"  autocomplete="off" id="q5" placeholder="Codigo barras" onkeyup="Lector(this.value);">
                               
                                </td></tr>
                            </table> 

                            <div id="resultados" style="margin-top:10px"></div>     

                     </div>
                   
                    <div class="col-md-5 col-sm-5 col-xs-12" style="background: <?php echo COLOR;?>;">
               
		
			<form class="form-horizontal" role="form" id="datos_factura" action="compras.php">
				 <div style="background:#01A9DB;padding:5px;margin:5px;border-radius: 7px;">
                             <?php 
                                $video=videos;
                    
                                if($video==1){
                                    $v="P4-FpmvWs6c";
                                    include("modal/registro_video.php");
                                    ?>
                                    
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                                    
                                    <?php
                    
                                }
                                ?>            
                            <font color="white" size="3"><strong>COMPRAS:</strong></font><font color="black">LLenar campos obligatorios</font> <font style="background-color:#D8D8D8;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>                          
                        </div> 
                               
                               
                            <div class="form-group row">
				  
				  <div class="col-md-12 col-sm-12 col-xs-12">
                                      Proveedor
					  <input autocomplete="off" class="textfield10" type="text" style="background-color: <?php echo COLOR1;?>;" class="form-control input-sm" id="nombre_proveedores" placeholder="Selecciona un proveedor" value="<?php echo $nombre;?>" <?php echo $read;?> required>
					  <input id="id_proveedores" type='hidden' value="<?php echo $id_proveedores;?>">	
				  </div>
                                
                                </div>    
                                
                            <div class="form-group row">
					
							<div class="col-md-6 col-sm-6 col-xs-12">
                                                            Teléfono
								<input class="textfield10" type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" value="<?php echo $telefono;?>" readonly>
							</div>
					
							<div class="col-md-6 col-sm-6 col-xs-12">
                                                            Email
								<input class="textfield10" type="text" class="form-control input-sm" id="mail" placeholder="Email" value="<?php echo $email;?>" readonly>
							</div>
				
                                                </div>
                                 
                                                <div class="form-group row">
				
                                
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            
								Serie<input class="textfield10" style="background-color:<?php echo COLOR1;?>;" type="text" class="form-control input-sm" id="serie" placeholder="Serie" required>
							</div>
							
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            
								Nro Doc<input class="textfield10" style="background-color:<?php echo COLOR1;?>;" type="number" min="1" class="form-control input-sm" id="factura" placeholder="Número de doc" required>
							</div>
                                  
                                                        <input type="hidden" class="form-control input-sm" id="ot"  value="0" >
                                                </div>
						<div class="form-group row">
							
							
							<?php date_default_timezone_set('America/Lima');?>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            Tipo documento
								<select class="textfield11" style="background-color: <?php echo COLOR1;?>;" class='form-control input-sm' id="tipo_doc1">
									<option value="1">Factura</option>
									<option value="2">Boleta</option>
									<option value="3"><?php echo doc;?></option>
									
								</select>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
                                                            Fecha
								<input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="date" class="form-control input-sm" id="fecha" value="<?php echo date("Y-m-d");?>" required>
							</div>
							
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            Hora:
								<input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="time" class="form-control input-sm" id="hora" value="<?php echo date("H:i:s");?>" required>
							</div>
                                                  
                                                    <input type="hidden" class="form-control input-sm" value="<?php echo 1;?>" name="moneda" id="moneda"  required>
                                                    <input type="hidden" class="form-control input-sm" value="<?php echo $dolar;?>" name="tcp" id="tcp"  required>
							
                                                    </div>
                                 
                                                    <div class="form-group row">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            Requerimiento:
								<input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="text"  class="form-control input-sm" id="obs" name="obs" placeholder="Requerimiento" value="<?php echo $oc;?>" <?php echo $read;?>>
							</div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            Pago
								<select class="textfield11" style="background-color: <?php echo COLOR1;?>;" class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>
							</div>
                                                        
                                                        
                                                        
							<div class="col-md-4 col-sm-4 col-xs-12">
                                                            Día de Pago al Crédito
								<input class="textfield10" style="background-color: <?php echo COLOR1;?>;" type="text"  class="form-control input-sm" id="dias" name="dias" placeholder="Nro días de crédito">
							</div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <button type="submit" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-print"></span> Imprimir
                                                    </button>
                                                      </div>  
						</div>
				   
			</form>	
			
		<!-- Carga los datos ajax -->			
                    
                     </div>     
                </div>
			
         
	</div>
         
          </div>
        </div>

        <!-- footer content -->
       
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
						$("#nombre_proveedores").autocomplete({
							source: "./ajax/autocomplete/proveedores.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_proveedores').val(ui.item.id_proveedores);
								$('#nombre_proveedores').val(ui.item.nombre_proveedores);
								$('#tel1').val(ui.item.telefono_proveedores);
								$('#mail').val(ui.item.email_proveedores);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_proveedores" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_proveedores" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_proveedores" ).val("");
							$("#id_proveedores" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	
        
        
        
        
        
        $(document).ready(function(){
			load(1);
                         $( "#resultados" ).load( "ajax/agregar_compras.php" );
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_compras.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
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
        url: "./ajax/agregar_compras.php",
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
                
                
	function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
                        var stock=document.getElementById('stock_'+id).value;
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}                     
                       
                           
                        
                        
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_compras.php",
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
        url: "./ajax/productos_factura2.php",
        data: "barra="+n,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$( "#resultados" ).load( "ajax/agregar_compras.php" );
		}
			});
                        var x=13;
                        if(n.length >0) {
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
        url: "./ajax/agregar_compras.php",
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
		  var id_proveedores = $("#id_proveedores").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
                  var factura = $("#factura").val();
		  var moneda = $("#moneda").val();
                  var fecha = $("#fecha").val();
                    var hora = $("#hora").val();
                    var serie = $("#serie").val();
                    var tcp = $("#tcp").val();
                    var obs = $("#obs").val();
                     var dias = $("#dias").val();
                    var tipo_doc1 = $("#tipo_doc1").val();
		  if (id_proveedores==""){
			  alert("Debes seleccionar un proveedor");
			  $("#nombre_proveedores").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/factura1_pdf.php?id_proveedores='+id_proveedores+'&id_vendedor='+id_vendedor+'&factura='+factura+'&moneda='+moneda+'&condiciones='+condiciones+'&fecha='+fecha+'&hora='+hora+'&dias='+dias+'&tcp='+tcp+'&serie='+serie+'&tipo_doc1='+tipo_doc1+'&obs='+obs,'Factura','','1024','768','true');
	 	});
		
		$( "#guardar_proveedores" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_proveedores.php",
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

        </script>
  
</body>

</html>















