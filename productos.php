<?php
ob_start();
session_start();
include('menu.php');
include 'ajax/barcode.php';
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$suc=$rs1['sucursal'];

$sql2="select * from datosempresa where id_emp=1";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$alerta=$rs2["alerta"];
$precio2=$rs2["precio2"];
$precio3=$rs2["precio3"];

$sql3="select * from sucursal where id_sucursal='".$suc."'";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$sucursal_actual=$rs3['tienda'];

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

.altura_i{
  height:30px; font-size: 11px;
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

                        <?php

                        }
                        $cargar=recoge1('cargar');
                        ?>
			<h6>Productos en Sucursal<?php echo $_SESSION['tienda']; ?> (Subir masivamente los productos:    <a href="excel/productos.xlsx" target="_blanck"><font color="blue">Descargar formato de subida</font></a>)</h6>
                        <form enctype="multipart/form-data" action="productos.php" method="POST">
                               <input   type="file" id="files" name="files" class="form-control"/>
                                <input type="submit" class='btn btn-success btn-xs' value="cargar" name="cargar">
                            </form>
                </div>
		<div class="panel-body">
                        <?php


                          if($cargar=="cargar"){


                 //$insert=mysqli_query($con,"delete from planificacion");

   //$namefinal="nuevo.jpg";
    if(is_uploaded_file($_FILES['files']['tmp_name'])) {

        $ruta_destino = "archivo/";
        $namefinal="productos.xlsx"; //linea nueva devuelve la cadena sin espacios al principio o al final
        $uploadfile=$ruta_destino.$namefinal;
    if(move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {

  set_time_limit(3000);
	include 'simplexlsx.class.php';
$xlsx = new SimpleXLSX( 'archivo/productos.xlsx' );//Instancio la clase y le paso como parametro el archivo a leer
$fp = fopen( 'archivo/productos.csv', 'w');//Abrire un archivo "datos.csv", sino existe se creara
 foreach( $xlsx->rows() as $fields ) {//Itero la hoja de calculo
        fputcsv( $fp, $fields);//Doy formato CSV a una línea y le escribo los datos
}
fclose($fp);

//$con=@mysqli_connect("localhost", "oferth84_optica", "empresa2018", "oferth84_optica");


	$productos = fopen ("archivo/productos.csv" , "r" );//leo el archivo que contiene los datos del producto
while (($datos =fgetcsv($productos,1000,",")) !== FALSE )//Leo linea por linea del archivo hasta un maximo de 1000 caracteres por linea leida usando coma(,) como delimitador
{

    //$linea[]=array('codigo'=>$datos[0],'nombre'=>$datos[1],'lote'=>$datos[2],'presentacion'=>$datos[3],'medida'=>$datos[4],'contenido'=>$datos[5],'peso'=>$datos[6],'stock1'=>$datos[7],'stock2'=>$datos[8],'marca'=>$datos[9]);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo
    $linea[]=array('codigo_producto'=>$datos[0],'nombre_producto'=>$datos[1],'costo_producto'=>$datos[2],'precio_producto'=>$datos[3],'marca'=>$datos[4],'modelo'=>$datos[5],'pro_puntos'=>$datos[6],'b1'=>$datos[7],'b2'=>$datos[8],'b3'=>$datos[9],'b4'=>$datos[10],'b5'=>$datos[11],'b6'=>$datos[12],'min'=>$datos[13],'barras'=>$datos[14]);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo


}
fclose ($productos);//Cierra el archivo

	$ingresado=0;//Variable que almacenara los insert exitosos
	$error=0;//Variable que almacenara los errores en almacenamiento
	$duplicado=0;//Variable que almacenara los registros duplicados
        $r=1;
        foreach($linea as $indice=>$value) //Iteracion el array para extraer cada uno de los valores almacenados en cada items
	{
	$codigo_producto=str_replace("'", "''",$value["codigo_producto"]);//Codigo del producto
	$nombre_producto=str_replace("'", "''",$value["nombre_producto"]);//descripcion del producto

        $nombre_producto=trim($nombre_producto);
        $codigo_producto=trim($codigo_producto);

	$costo_producto=$value["costo_producto"];//fabricante del producto
	$precio_producto=$value["precio_producto"];//precio del producto
	$marca=$value["marca"];//precio del producto
	$modelo=$value["modelo"];
        $barras=$value["barras"];
        $puntos_pro=$value["pro_puntos"];
        $b1=$value["b1"];
        $b2=$value["b2"];
        $b3=$value["b3"];
        $b4=$value["b4"];
        $b5=$value["b5"];
        $b6=$value["b6"];
        $min=$value["min"];

        $foto="nuevo.jpg";
        $und="1";
        date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");

	$sql=mysqli_query($con,"select * from products where codigo_producto='$codigo_producto' or nombre_producto='$nombre_producto'");//Consulta a la tabla productos
	$num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
        if($codigo_producto<>"" and $nombre_producto<>"")
	{
            if ($num==0)//Si es == 0 inserto
	{
	//if ($insert=mysqli_query($con,"insert into products (codigo_producto,nombre_producto, lote,peso_bruto,presentacion,med,contenido,peso,pro_ser) values('$codigo','$nombre','$lote','$peso_bruto','$presentacion','$medida','$contenido','$peso','1')"))
        if ($insert=mysqli_query($con,"insert into products (codigo_producto, nombre_producto, status_producto, date_added, precio_producto,costo_producto,mon_costo,mon_venta,marca,modelo,color,b1,b2,b3,b4,b5,b6,cat_pro,pro_ser,foto1,foto2,foto3,foto4,web,pre_web,descripcion,descripcion1,megusta,nomegusta,precio2,precio3,und_pro,barras,dcto,min) VALUES ('$codigo_producto','$nombre_producto','1','$date_added','$precio_producto','$costo_producto','1','1','$marca','$modelo','$color','$b1','$b2','$b3','$b4','$b5','$b6','0','1','nuevo.jpg','nuevo.jpg','nuevo.jpg','nuevo.jpg','1','$precio_producto','','','0','0','0','0','$und','$barras','0','$min')"))

        {
	//echo $msj='<font color=green>Colegio <b>'.$destino.'</b> Guardado</font><br/>';
	if($barras>0 and strlen($barras)>=10){
            barcode('ajax/codigos/'.$barras.'.png', $barras, 30, 'horizontal', 'code128', true);

        }

            $ingresado+=1;
        $r=$r+1;
	}//fin del if que comprueba que se guarden los datos
	else//sino ingresa el producto
	{
	//print"insert into products (codigo_producto, nombre_producto, status_producto, date_added, precio_producto,costo_producto,mon_costo,mon_venta,marca,modelo,color,b1,b2,b3,b4,b5,b6,cat_pro,pro_ser,foto1,foto2,foto3,foto4,web,pre_web,descripcion,descripcion1,megusta,nomegusta,precio2,precio3,und_pro,barras,dcto,min) VALUES ('$codigo_producto','$nombre_producto','1','$date_added','$precio_producto','$costo_producto','1','1','$marca','$modelo','$color','$b1','$b2','$b3','$b4','$b5','$b6','0','1','nuevo.jpg','nuevo.jpg','nuevo.jpg','nuevo.jpg','1','$precio_producto','','','0','0','0','0','$und','','0','$min')";
            echo $msj='<div><font color=red>Producto de código<b>'.$codigo_producto.' </b> NO Guardado '.mysqli_error().'</font><br/></div>';
	$error+=1;
	}
	}//fin de if que comprueba que no haya en registro duplicado
	else
	{
	$duplicado+=1;
	echo $duplicate='<div><font color=red>El producto de codigo <b>'.$codigo_producto.'</b> Esta duplicado<br></font></div>';
	}

	}

        }

   }
  }
  }
      if(isset($ingresado) and isset($ingresado) and isset($error)){
         echo "<div><font color=green>".number_format($ingresado,2)." Productos Almacenados con exito</font><br/>";
	echo "<font color=red>".number_format($duplicado,2)." Productos Duplicados</font><br/>";
	echo "<font color=red>".number_format($error,2)." Errores de almacenamiento</font><br/></div>";

      }

  include("modal/registro_productos.php");
			include("modal/editar_productos.php");
  ?>







				<form style="color:black;" class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row">
							<div class="col-md-2 col-sm-2 col-xs-12" style="width:30%;">
								<input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
							</div>
              <div class="col-md-2 col-sm-2 col-xs-12" style="width:20%;">
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

          <div class="col-md-2 col-sm-2 col-xs-12" style="width:25%;">
								<select class="form-control input-sm" id="q2" style="color:black;" onchange='load(1);'>
                                                                    <option value="">CATEGORIAS</option>
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


              <div class="col-md-2 col-sm-2 col-xs-12" style="width:25%;">
                    <select class="form-control input-sm" id="q3" name="q3" style="color:black;" onchange='load(1);'>
                                                                        <option value="">LABORATORIO</option>
                                                                       <?php


                                                                        $sql4="select*from laboratorio ORDER BY  `laboratorio`.`nom_laboratorio` ASC ";

                                                                        $rs3=mysqli_query($con,$sql4);
                                                                        while($row5=mysqli_fetch_array($rs3)){
                                                                            $id_lab=$row5["id_laboratorio"];
                                                                            $laboratorio=$row5["nom_laboratorio"];
                                                                            ?>
                                                                            <option value="<?php echo $id_lab;?>"><?php echo $laboratorio;?></option>
                                                                            <?php

                                                                        }
                                                                        ?>

                  </select>
                  </div>

							<div class="col-md-2 col-sm-2 col-xs-12" style="width:100%;">
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
                        var contiene = $("#modelo"+id).val();
                        var puntos = $("#puntos"+id).val();
                        var dolar = $("#dolar"+id).val();
                        var costo = $("#costo"+id).val();
                        var utilidad = $("#utilidad"+id).val();
                        var precio2 = $("#precio2"+id).val();
                        var precio3 = $("#precio3"+id).val();
                        var und_pro = $("#und_pro"+id).val();
                        var barras = $("#barras"+id).val();
                        var min = $("#min"+id).val();
                        var pre_mayor = $("#precio_mayor"+id).val();
                        var f_caducidad = $("#caducidad"+id).val();
                        var descuento = $("#descuento"+id).val();
                        var precios_total = $("#costototal"+id).val();
                        var cantidad_blister = $("#cantidad_blister"+id).val();
                        var laboratorio=$("#labor"+id).val();


			                  $("#mod_id").val(id);
			                  $("#mod_codigo").val(codigo_producto);
			                  $("#mod_nombre").val(nombre_producto);
			                  $("#mod_precio").val(precio_producto);
                        $("#mod_costo").val(costo_producto);
                        $("#mod_status").val(status);
                        $("#mod_monventa").val(monventa);
                        $("#mod_moncosto").val(moncosto);
                        $("#mod_cat").val(cat_pro);
                        $("#mod_lab").val(laboratorio);
                        $("#mod_inv").val(inv);
                        $("#mod_marca").val(marca);
                        $("#mod_contiene").val(contiene);
                        $("#mod_puntos").val(puntos);
                        $("#multiplicando1").val(dolar);
                        $("#soles").val(costo);
                        $("#utilidad").val(utilidad);
                        $("#mod_precio2").val(precio2);
                        $("#mod_precio3").val(precio3);
                        $("#mod_und_pro").val(und_pro);
                        $("#mod_barras").val(barras);
                        $("#mod_min").val(min);
                        $("#mod_precio_mayor").val(pre_mayor);
                        $("#mod_caducidad").val(f_caducidad);
                        $("#mod_descuento").val(descuento);
                        $("#mod_compra_total").val(precios_total);
                        $("#mod_cantidad_blister").val(cantidad_blister);
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
<script type="text/javascript" src="js/productos.js"></script>

</body>

</html>
<?php
ob_end_flush();
?>
