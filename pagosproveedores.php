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

$tienda1=$_SESSION['tienda'];
$sql3="select * from sucursal where tienda=$tienda1";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$caja=$rs3["caja"];

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
//echo $a[21];
if($a[38]==0){
   header("location:error.php");
}

$_SESSION['cliente']="";
$a=recoge1('a');
$clientes="";
if($a>0){
$sql2="select * from clientes where id_cliente=$a";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$clientes=$rs2["nombre_cliente"];
$_SESSION['cliente']=$a;
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

  <title>Lista de pagos por Proveedores </title>
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
                                    $v="W0DyBLPoge4";
                                    include("modal/registro_video.php");
                                    ?>

                                    <?php

                                }
                        ?>
			<h4>Lista de pagos por Proveedor</h4>
		</div>
			<div class="panel-body">

                            <form style="color:black;" class="form-horizontal" role="form" id="datos_cotizacion">

						<div class="form-group row">

							<div class="col-md-6 col-sm-6 col-xs-12">
                                                                Buscar Cliente o doc cliente
								<input style="font-weight: bold;" type="text" class="form-control" id="q" placeholder="Nombre, documento o telefono" value="<?php echo $clientes;?>" onkeyup='load(1);'>
							</div>
                                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                                                Buscar Doc
								<input type="text" autocomplete="off" class="form-control input-sm" id="q1" placeholder="Nro doc " onkeyup='load(1);'>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
                                                                Fecha Inicial
								<input type="date"  class="form-control input-sm" id="q2"  onkeyup='load(1);'>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
                                                                Fecha Final
								<input type="date"  class="form-control input-sm" id="q3"  onkeyup='load(1);'>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
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

        <!-- footer content -->
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





  </body>
</html>

<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/pagos1.js"></script>

        <script>

         function imprimir_cobros(id_factura){
            window.open('pagos1.php?a='+id_factura, "Pagos", "width=900, height=1000")
	}


        </script>
<?php
ob_end_flush();
?>
