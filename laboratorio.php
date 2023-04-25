<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$alerta=$rs2["alerta"];
$precio2=$rs2["precio2"];
$precio3=$rs2["precio3"];

$modulo=$rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[11]==0){
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
<title>Lista de laboratorio </title>
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
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoLaboratorio"><span class="glyphicon glyphicon-plus" ></span> Nuevo Laboratorio</button>
        </div>
			<h6><i class='glyphicon glyphicon-search'></i> Buscar Laboratorio</h6>
    </div>
		<div class="panel-body">
                    <?php
      include("modal/registro_laboratorio.php");
			include("modal/editar_laboratorio.php");

			?>

				<form style="color:black;" class="form-horizontal" role="form" id="datos_cotizacion">

						<div class="form-group row">

							<div class="col-md-4 col-sm-4 col-xs-12" style="width:50%;">
							<input type="text" class="form-control" id="q" placeholder="Código o nombre del laboratorio" onkeyup='load(1);'>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12" style="width:20%;">
							<button type="button" class="btn btn-default" onclick='load(1);'><span class="glyphicon glyphicon-search" ></span> Buscar</button><span id="loader"></span>
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
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
<script>
$( "#guardar_laboratorio" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_laboratorio.php",
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

$( "#editar_laboratorio" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_laboratorio.php",
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
			var cod_laboratorio = $("#id_laboratorio"+id).val();
			var nom_laboratorio = $("#nom_laboratorio"+id).val();
			$("#mod_id_laboratorio").val(cod_laboratorio);
			$("#mod_nom_laboratorio").val(nom_laboratorio);
		}
  function imprimirproducto(id_producto){
    window.open('pack1.php?id_producto='+id_producto, "Serie", "width=900, height=1000")
}
</script>
<script type="text/javascript" src="js/laboratorio.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>
