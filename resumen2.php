<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$tienda1=$_SESSION['tienda'];
$sql2=" select * from caja where tienda=$tienda1 ORDER BY  `caja`.`id_caja` DESC ";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$fecha1=$rs2["fecha"];
$usuario_cierre=$rs2["usuario_cierre"];
//$inicio=$rs2["inicio"];
$id_caja=$rs2["id_caja"];
date_default_timezone_set('America/Lima');
$fecha2=date("Y-m-d");
$fecha4=date("d-m-Y");
$entrada1=0;
$salida1=0;
//if($fecha1==$fecha2){
$suma1= mysqli_query($con, "SELECT SUM(total_venta) AS total1 FROM facturas  where condiciones=1 and (estado_factura<=3 or estado_factura=5) and activo=1 and ven_com=1 and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )");
$row1= mysqli_fetch_array($suma1);
$total1 = $row1['total1'];
if($total1==""){
    $total1=0;
}
//print"SELECT SUM(total_venta) AS total1 FROM facturas  where condiciones=1 and (estado_factura<=3 or estado_factura=5) and activo=1 and ven_com=1 and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )";

$suma4= mysqli_query($con, "SELECT SUM(total_venta) AS total4 FROM facturas  where  condiciones=1 and activo=1 and (ven_com=5 or ven_com=3) and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )");
$row4= mysqli_fetch_array($suma4);
$total4 = $row4['total4'];
if($total4==""){
    $total4=0;
}
$suma2= mysqli_query($con, "SELECT SUM(total_venta) AS total2 FROM facturas  where condiciones=1 and estado_factura=6 and activo=1 and ven_com=1 and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )");
$row2= mysqli_fetch_array($suma2);
$total2 = $row2['total2'];
if($total2==""){
    $total2=0;
}
$suma3= mysqli_query($con, "SELECT SUM(total_venta) AS total3 FROM facturas  where condiciones=1 and activo=1 and (ven_com=2 or ven_com=4) and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )");
$row3= mysqli_fetch_array($suma3);
$total3 = $row3['total3'];
if($total3==""){
    $total3=0;
}
$suma5= mysqli_query($con, "SELECT SUM(total_venta) AS total5 FROM facturas  where condiciones=1 and activo=1 and ven_com=6 and tienda=$tienda1 and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fecha2' )");
$row5= mysqli_fetch_array($suma5);
$total5 = $row5['total5'];
if($total5==""){
    $total5=0;
}
$entrada1=$total1+$total4;
$salida1=$total2+$total3+$total5;
//}




$modulo=$rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[1]==0){
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

<title>Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body class="nav-md">


<?php  menu0();?>

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
          <!-- /menu prile quick info -->
          <br />
        </div>
      </div>
        <?php
          menu3();
        ?>
      <div class="right_col" role="main">
        <br />
        <div class="">
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align: center;">
                <div id="dato" >
                <div class="tile-stats" >
                <div ><i style="color: green; font-size: 30px;" class="fa fa-building"></i>
                </div>
                    <div><font ><?php echo moneda;echo $total1;?></font></div>
                    <p><font ><strong>Total ventas</strong></font> <strong> : <?php echo date("d-m-Y");?></strong></p>
              </div>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align: center;">
              <div class="tile-stats" >
                <div ><i style="color: orange; font-size: 30px;" class="fa fa-shopping-cart"></i></div>
                <div><font ><?php echo moneda; echo $total3;?></font></div>
                <p><font ><strong>Total compras</strong></font><strong>  : <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align: center;">
              <div class="tile-stats">
                <div class="row justify-content-center">
                  <div ><i style="color: blue; font-size: 30px;" class="fa fa-money"></i></div>
                  <div ><font><?php echo moneda; echo $total2;?></font></div>
                </div>
                <p><font ><strong>Total entradas</strong></font> <strong> : <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align: center;">
              <div class="tile-stats">
                <div><i style="color: red; font-size: 30px;" class="fa fa-toggle-up"></i>
                </div>
                <div><font><?php echo moneda; echo $total4;?></font></div>
                <p><font ><strong>Total salidas</strong></font><strong> : <?php echo date("d-m-Y");?></strong></p>
              </div>
            </div>
          </div>
  <div class="col-md-12 col-sm-12 col-xs-12"></div>
  </div>

  <div class="container">
	<div class="panel panel-info">

                    <?php
                                $video=videos;

                                if($video==0){
                                    $v="CSrb6nzgnag";
                                    include("modal/registro_video.php");
                                    ?>
                                    <div class="btn-group pull-right">
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                                    </div>
                                    <?php

                                }
                    date_default_timezone_set('America/Lima');
                    //$date_added=date("Y-m-d H:i:s");
                    $fecha2=date("Y-m-d");
                    $fecha1=date("Y-m-d",strtotime($fecha2."- 6 days"));
                    ?>


<div class="panel-body">
<div style="color:  #060606;"><font  size="4"><strong> Registro de Ventas</strong></font></DIV>
<form class="form-horizontal" style="color:black;" role="form" id="datos_cotizacion">
<div class="form-group row">
<div class="col-md-2 col-sm-2 col-xs-12">
                                                                Sucursal
								<select class="form-control input-sm" id="q4"  onchange='load(1);'>
                                                                    <?php

                                                                    $sql2="select * from sucursal ";
                                                                    $rs1=mysqli_query($con,$sql2);
                                                                    while($row3=mysqli_fetch_array($rs1)){
                                                                        $nombre=$row3["nombre"];
                                                                        $tienda=$row3["tienda"];
                                                                        ?>

                                                                        <option value="<?php echo $tienda;?>"><?php  print"$tienda: $nombre";?></option>

                                                                        <?php
                                                                        }
                                                                    ?>
                                                                        <option value=">=1">Todas las Sucursales</option>
                                                                </select>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">Fecha inicio<input type="date"  class="form-control input-sm" id="q2" value="<?php echo $fecha1;?>" onchange='load(1);'></div>
              <div class="col-md-2 col-sm-2 col-xs-12">Fecha final
							<input type="date"  class="form-control input-sm" id="q3" value="<?php echo $fecha2;?>" onchange='load(1);'>
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
  <!-- echart -->
  <script src="js/echart/echarts-all.js"></script>
  <script src="js/echart/green.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script>

      $(document).ready(function(){
			load(1);

		});

		function load(page){
			var q= $("#q").val();
                         var q1= $("#q1").val();
                        var q2= $("#q2").val();
                        var q3= $("#q3").val();
                        var q4= $("#q4").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_resumen2.php?action=ajax&page='+page+'&q='+q+'&q1='+q1+'&q2='+q2+'&q3='+q3+'&q4='+q4,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({html:true});

				}
			})
		}

</script>
<script src="js/moris/raphael-min.js"></script>
<script src="js/moris/morris.min.js"></script>
</body>
</html>
<?php
ob_end_flush();
?>
