<?php
ob_start();
session_start();
include('menu.php');
include 'ajax/barcode.php';
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$_SESSION["cliente"]=recoge1('id');
$enviar=recoge1('enviar');
//$cliente=$_SESSION["cliente"];
$cliente=279;

$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$alerta=$rs2["alerta"];
$precio2=$rs2["precio2"];
$precio3=$rs2["precio3"];
$tienda=$rs2["tienda"];
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[11]==0){
    header("location:error.php");    
 
}


if($enviar=="enviar"){
    //$sql=$_SESSION['where'];
    //$sql1="SELECT * FROM products $sql";
    //$query = mysqli_query($con, $sql1);
    
    //while ($row=mysqli_fetch_array($query)){
    for($i=1;$i<=100;$i++){    
        $a2 =recoge1("a$i");
        $b2 =recoge1("b$i");
        $delete1=mysqli_query($con,"DELETE FROM permiso WHERE id_producto=$b2 and id_cliente=$cliente");
        if($a2>0){
            $sql3="INSERT INTO permiso (id_producto,id_cliente,activo) VALUES ('$a2','$cliente','1')";
            $rs3=mysqli_query($con,$sql3);
        }
    //}
    }    
}
//for($i=1;$i<=100;$i++){
     
    //print"<br>$a2 11";
  //      if($a2>0){    
  //          $sql3="INSERT INTO permiso (id_producto,id_cliente,activo) VALUES ('$a2','$cliente','1')";
  //          $rs3=mysqli_query($con,$sql3);
            //$row3=mysqli_fetch_array($rs3);
            //$usuariocarga=$row3["usuariocarga"];
              
            //$sql="UPDATE permiso SET activo=1 WHERE id='".$a2."' ";
            //$query_update = mysqli_query($con,$sql);
            
                
    //    }
//}   


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Lista de Productos </title>

   <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>



<style type="text/css"> 
    
.Fields {
	background-color: #A9F5E1;
	border: 2px solid #2E9AFE;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
        text-align:center;
}


</style>
  
  
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

          <div class="row">

           <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
                        <?php 
                        $video=videos;
                    
                        if($video==1){
                        $v="nveP-cCKCtc";
                        include("modal/registro_video.php");
                        ?>
                        <div class="btn-group pull-right">
                                    <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                        </div>
                        <?php
                    
                        }
                        $cargar=recoge1('cargar');
                        ?>
			<h4><i class='glyphicon glyphicon-search'></i>Productos</h4>
                        
                </div>
		<div class="panel-body">
                       
				<form style="color:black;" class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							
							<div class="col-md-4 col-sm-4 col-xs-12" style="width:40%;">
								<input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
							</div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12" style="width:30%;">
                                                                
								<select class="form-control input-sm" id="q1"  onchange='load(1);'>
                                                                    <option value="">Ordenar por</option>
                                                                    <optgroup label = "Stock">
                                                                    <option value="order by b<?php echo $tienda;?> asc">Stock asc</option>
                                                                    <option value="order by b<?php echo $tienda;?> desc">Stock desc</option>
                                                                    <optgroup label = "Nombre">
                                                                    <option value="order by nombre_producto asc">Nombre asc</option>
                                                                    <option value="order by nombre_producto desc">nombre  desc</option>
                                                                </select>
							</div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12" style="width:30%;">
								<select class="form-control input-sm" id="q2" style="color:black;" onchange='load(1);'>
                                                                    <option value="">Elegir Categoria</option>
                                                                   <?php
    
  
                                                                    $sql3="select*from categorias ORDER BY  `categorias`.`nom_cat` ASC ";
                                                                    
                                                                    $rs2=mysqli_query($con,$sql3);
                                                                    while($row4=mysqli_fetch_array($rs2)){
                                                                        $id_categoria=$row4["id_categoria"];
                                                                        $categoria=$row4["nom_cat"];
                                                                        ?>
                                                                        <option value="<?php echo $id_categoria;?>"><?php echo $categoria;?></option>
                                                                        <?php
                                                                        
                                                                    }
                                                                    ?>
                                                                    
                                                                </select>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12" style="width:100%;">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
                                </form>
                    
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
		
                </div>
            </div>
		 
	</div>
    </div>
</div>

        <?php
          footer();
          
          ?>
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
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript" src="js/VentanaCentrada.js"></script>
  <script src="js/pace/pace.min.js"></script>
<script>
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

$( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_producto.php",
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
			var codigo_producto = $("#codigo_producto"+id).val();
			var nombre_producto = $("#nombre_producto"+id).val();
			
			var precio_producto = $("#precio_producto"+id).val();
                        var costo_producto = $("#costo_producto"+id).val();
                        var status = $("#status"+id).val();
                         var monventa = $("#mon_venta"+id).val();   
                        var moncosto = $("#mon_costo"+id).val();
                        var cat_pro = $("#cat"+id).val();
                        var inv = $("#inv"+id).val();
                        var marca = $("#marca"+id).val();
                       var modelo = $("#modelo"+id).val(); 
                        var color = $("#color"+id).val();
                        var dolar = $("#dolar"+id).val();
                        var costo = $("#costo"+id).val();
                        var utilidad = $("#utilidad"+id).val();
                        var precio2 = $("#precio2"+id).val();
                        var precio3 = $("#precio3"+id).val();
                        var und_pro = $("#und_pro"+id).val();
                        var barras = $("#barras"+id).val();
                        var min = $("#min"+id).val();
			$("#mod_id").val(id);
			$("#mod_codigo").val(codigo_producto);
			$("#mod_nombre").val(nombre_producto);
			$("#mod_precio").val(precio_producto);
                        $("#mod_costo").val(costo_producto);
                        $("#mod_status").val(status);
                        $("#mod_monventa").val(monventa);
                        $("#mod_moncosto").val(moncosto);
                        $("#mod_cat").val(cat_pro);
                        $("#mod_inv").val(inv);
                        $("#mod_marca").val(marca);
                        $("#mod_modelo").val(modelo);
                        $("#mod_color").val(color);
                        $("#multiplicando1").val(dolar);
                        $("#soles").val(costo);
                        $("#utilidad").val(utilidad);
                        $("#mod_precio2").val(precio2);
                        $("#mod_precio3").val(precio3);
                        $("#mod_und_pro").val(und_pro);
                        $("#mod_barras").val(barras);
                        $("#mod_min").val(min);
		}
</script>
<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
<script>
		$(function() {
						$("#q").autocomplete({
							source: "./ajax/autocomplete/productos.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_producto').val(ui.item.id_producto);
								$('#q').val(ui.item.nombre_producto);
								$('#precio_producto').val(ui.item.precio_producto);
								$('#inv_producto').val(ui.item.inv_producto);
																
								
							 }
						});
						 
						
					});
					
	$("#q" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#q" ).val("");
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
						}
			});	
function imprimir_barra(id_producto){
			VentanaCentrada('./pdf/documentos/ver_producto.php?id_producto='+id_producto,'Factura','','1024','768','true');
		}
function imprimirproducto(id_producto){
    window.open('pack.php?id_producto='+id_producto, "Serie", "width=900, height=1000,toolbar=no,scrollbars=no,resize=no")
}

</script>
<script type="text/javascript" src="js/productos1.js"></script>

</body>

</html>
<?php
ob_end_flush();
?>






