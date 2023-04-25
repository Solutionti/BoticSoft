<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

   $sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo


$modulo=$rs1["accesos"];
$a = explode(".", $modulo);

	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

        if($a[32]==0){
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
<title>Caja </title>
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
				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nueva Caja</button>
			</div>
                         <?php
                        $video=videos;

                        if($video==1){
                        $v="rpA5jGMpyBM";
                        include("modal/registro_video.php");
                        ?>
                        <?php

                        }
                        ?>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar día para caja</h4>
		</div>
		<div class="panel-body">

			<?php

			include("modal/registro_caja.php");
			include("modal/editar_caja.php");


			?>
			<form style="color:black;" class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row">
							<div class="col-md-4 col-sm-4 col-xs-12" style="width:50%;">Fecha inicio:
							<input type="date" class="form-control" id="q" placeholder="Fecha1" onchange='load(1);'>
							</div>

              <div class="col-md-4 col-sm-4 col-xs-12" style="width:50%;">  Fecha final:
							<input type="date" class="form-control" id="q1" placeholder="Fecha2" onchange='load(1);'>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-12" style="width:30%;">
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
      </div>
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
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>




<script>
        $(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
                        var q1= $("#q1").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_caja.php?action=ajax&page='+page+'&q='+q+'&q1='+q1,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');

				}
			})
		}



			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar la caja")){
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_caja.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}



$( "#guardar_caja" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_caja.php",
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

$( "#editar_caja" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_caja.php",
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
			var salida = $("#salida"+id).val();
                        var entrada = $("#entrada"+id).val();
                        var faltante = $("#faltante"+id).val();
                         var inicio = $("#inicio"+id).val();
                        $("#salida").val(salida);
                        $("#entrada").val(entrada);
                        $("#faltante").val(faltante);
                        $("#mod_inicio").val(inicio);
                        $("#mod_id").val(id);

		}

         function abrir (id)
		{
			var q= $("#q").val();

		$.ajax({
        type: "GET",
        url: "abrir.php",
        data: "caja="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});

		}
        function caja(fecha,tienda){
			VentanaCentrada('caja1.php?f='+fecha+'&tienda='+tienda,'Factura','','1024','768','true');
		}

        </script>



</body>

</html>
<?php
ob_end_flush();
?>
