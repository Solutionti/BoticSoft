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
if($a[16]==0){
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

  Consulta Precios
  </title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
  <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
 <link href="css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>

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

</style>

  <script>
  function limpiarFormulario() {
    document.getElementById("consultaprecios").reset();
  }
</script>
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
        <?php
$foto=recoge1('foto');
$producto1=recoge1('producto');
$inv_producto=recoge1('inv_producto');
$precio=recoge1('precio');
$tipo=recoge1('tipo');
$marca=recoge1('marca');
$modelo=recoge1('modelo');
$color=recoge1('color');
print"<form name=\"myForm\" name=\"consultaprecios\" class=\"form-horizontal form-label-left\" id=\"consultaprecios\" enctype=\"multipart/form-data\" action=\"consultaprecios.php\" method=\"POST\">
";

?> <div class="x_panel" style="background:#F2F5A9;color:black;">
       <div class="panel panel-info">
     
        </div>

          <div class="form-group">
				<label for="producto" class="col-sm-3 control-label" style="width:40%;">Nombre del Producto:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">
                                    <input type="search" style="background-color:#9FF781;color:black;font-size:15pt; font-family:Verdana;" class="form-control input-sm" id="nombre_producto" name="producto" value="<?php echo $producto1;?>" placeholder="Nombre del producto" >
					  <input id="id_producto" name="id_producto" type='hidden'>

                                </div>
			  </div>

                        <div class="form-group">
				<label for="inventario" class="col-sm-3 control-label" style="width:40%;">Inventario:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">
				 <input type="text" style="background-color:#F5D0A9;color:black;font-size:15pt; font-family:Verdana;" class="form-control input-sm" readonly id="inv_producto" value="<?php echo $inv_producto;?>" name="inv_producto" >
				</div>
			  </div>

			<div class="form-group">
				<label for="precio" class="col-sm-3 control-label" style="width:40%;">Precio <?php echo moneda;?>:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">

				  <input type="text" style="background-color:#A9F5D0;color:black;font-size:15pt; font-family:Verdana;" readonly class="form-control input-sm" id="precio_producto" name="precio" value="<?php echo $precio;?>" placeholder="precio producto">
				</div>
			  </div>


                        <div class="form-group">
				<label for="tipo" class="col-sm-3 control-label" style="width:40%;">Tipo de Producto:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">

				  <input type="text" style="background-color:#A9F5D0;color:black;font-size:15pt; font-family:Verdana;" readonly class="form-control input-sm" id="tipo" name="tipo" value="<?php echo $tipo;?>" placeholder="tipo">
				</div>
			  </div>



                        <div class="form-group">
				<label for="marca" class="col-sm-3 control-label" style="width:40%;"><?php echo des3;?>:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">

				  <input type="text" style="background-color:#A9F5D0;color:black;font-size:15pt; font-family:Verdana;" readonly class="form-control input-sm" id="marca" name="marca" value="<?php echo $marca;?>" placeholder="<?php echo des3;?>">
				</div>
			  </div>

                        <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label" style="width:40%;"><?php echo des1;?>:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">

				  <input type="text" style="background-color:#A9F5D0;color:black;font-size:15pt; font-family:Verdana;"  readonly class="form-control input-sm" id="modelo" name="modelo" value="<?php echo $modelo;?>" placeholder="<?php echo des1;?>">
				</div>
			</div>
                        <div class="form-group">
				<label for="color" class="col-sm-3 control-label" style="width:40%;"><?php echo des2;?>:</label>
				<div class="col-md-8 col-sm-8 col-xs-12" style="width:60%;">

				  <input type="text" style="background-color:#A9F5D0;color:black;font-size:15pt; font-family:Verdana;" readonly class="form-control input-sm" id="color" name="color" value="<?php echo $color;?>" placeholder="<?php echo des2;?>">
				</div>
			</div>


                 <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>

           </form>

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
  </script>

	<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>

        <script>
		$(function() {
						$("#nombre_producto").autocomplete({
							source: "./ajax/autocomplete/productos1.php",
							minLength: 1,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_producto').val(ui.item.id_producto);
								$('#nombre_producto').val(ui.item.nombre_producto);
								$('#precio_producto').val(ui.item.precio_producto);
                                                                $('#precio_producto2').val(ui.item.precio_producto2);
                                                                $('#precio_producto3').val(ui.item.precio_producto3);
								$('#inv_producto').val(ui.item.inv_producto);
								$('#marca').val(ui.item.marca);
                                                                $('#modelo').val(ui.item.modelo);
                                                                $('#color').val(ui.item.color);
                                                                $('#tipo').val(ui.item.tipo);
								$('#foto').val(ui.item.foto);


							 }
						});


					});

	$("#nombre_producto" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
                                                        $("#precio_producto2" ).val("");
                                                        $("#precio_producto3" ).val("");
                                                        $('#inv_producto').val("");
                                                        $('#marca').val("");
                                                        $('#modelo').val("");
                                                        $('#color').val("");
                                                        $('#tipo').val("");
							$('#foto').val("");

						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_producto" ).val("");
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
                                                        $("#precio_producto2" ).val("");
                                                        $("#precio_producto3" ).val("");
                                                        $('#inv_producto').val("");
                                                        $('#marca').val("");
                                                        $('#modelo').val("");
                                                        $('#color').val("");
                                                        $('#tipo').val("");
                                                        $('#foto').val("");

						}
			});

  </script>

</body>

</html>
<?php
ob_end_flush();
?>
