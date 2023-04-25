<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$consulta1 = "SELECT * FROM clientes ";
$result1 = mysqli_query($con, $consulta1);
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[19]==0){
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

<title>Conf Moneda / IGV</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
  }
  var mostrarValor = function(x){
            document.getElementById('precio').value=x;
            }
    var mostrarValor2 = function(x){
        document.getElementById('precio').value=x;    }
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
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}
</style>
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

          <br />
        </div>
      </div>
      <?php
          menu3();
     ?>

      <div class="right_col" role="main">
        <?php


print"<form name=\"myForm\" class=\"form-horizontal form-label-left\"  enctype=\"multipart/form-data\" action=\"config_moneda_iva1.php\" method=\"POST\">
";

$consulta3 = "SELECT * FROM globales ";
$result3 = mysqli_query($con, $consulta3);
while ($valor3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    if($valor3['id_global']==5){
    $porcentaje=$valor3['med'];
    }
    if($valor3['id_global']==6){
    $siglas=$valor3['med'];
    }
    if($valor3['id_global']==8){
    $monedas=$valor3['med'];
    }
    if($valor3['id_global']==1){
    $color1=$valor3['med'];
    }
    if($valor3['id_global']==2){
    $color2=$valor3['med'];
    }
    if($valor3['id_global']==3){
    $color3=$valor3['med'];
    }
    if($valor3['id_global']==4){
    $color4=$valor3['med'];
    }
}

?>
<div class="x_panel" style="color:black;background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">

<div class="col-md-6">
  <fieldset class="scheduler-border">
  <legend class="scheduler-border"><h4> <small>Configurar tipo de moneda / impuesto</small></h4></legend>


<div class="form-horizontal">
  <div class="form-group">
    <label for="tipo_moneda" class="col-sm-4 control-label">Simbolo de moneda:</label>
    <div class="col-sm-8">
      <input type="text" name="tipo_moneda" class="form-control input-sm " id="tipo_moneda" placeholder="Ejm: S/." value="<?php echo $monedas; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="nombre_impuesto" class="col-md-4 control-label">Siglas de impuesto</label>
    <div class="col-sm-8">
    <input type="text" name="nombre_impuesto" class="form-control input-sm" id="nombre_impuesto" placeholder="Ejm: IGV" value="<?php echo $siglas; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="porcentaje_impuesto" class="col-md-4 control-label">Porcentaje de impuesto</label>
    <div class="col-sm-8">
      <input type="text" name="porcentaje_impuesto" class="form-control input-sm " id="porcentaje_impuesto" placeholder="Ejm: 0.18" value="<?php echo $porcentaje; ?>" required>
    </div>
  </div>
</div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary input-sm" name="aceptar" >Guardar</button>
      </div>
  </fieldset>
</div>
</form>

<form class="" method="post">

<div class="col-md-6">
  <fieldset class="scheduler-border">
  <legend class="scheduler-border"><h4> <small>Configurar colores</small></h4></legend>


<div class="form-horizontal">
  <div class="form-group">
    <label for="color1" class="col-sm-4 control-label">Color cabecera:</label>
    <div class="col-sm-8">
      <input type="text" name="color1" class="form-control input-sm " id="color1" placeholder="Ejm: S/." value="<?php echo $color1; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="color2" class="col-md-4 control-label">color de menus</label>
    <div class="col-sm-8">
    <input type="text" name="color2" class="form-control input-sm" id="color2" placeholder="Ejm: IGV" value="<?php echo $color2; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="color3" class="col-md-4 control-label">color de tablas</label>
    <div class="col-sm-8">
      <input type="text" name="color3" class="form-control input-sm " id="color3" placeholder="Ejm: 0.18" value="<?php echo $color3; ?>" required>
    </div>
  </div>
</div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary input-sm" name="aceptar" >Guardar</button>
      </div>
  </fieldset>
</div>
</form>
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
  <script type="text/javascript">
    $(function() {
      'use strict';

      var data =[
      <?php
                    for($i = 0;$i<count($producto);$i++){
                ?>
                '<?php echo $producto[$i];?>',
                <?php } ?>];



      var countriesArray = $.map(data, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>

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


	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



        <script>
		$(function() {
						$("#nombre_producto").autocomplete({
							source: "./ajax/autocomplete/productos.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_producto').val(ui.item.id_producto);
								$('#nombre_producto').val(ui.item.nombre_producto);
								$('#precio_producto').val(ui.item.precio_producto);
								$('#inv_producto').val(ui.item.inv_producto);


							 }
						});


					});

	$("#nombre_producto" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");

						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_producto" ).val("");
							$("#id_producto" ).val("");
							$("#inv_producto" ).val("");
							$("#precio_producto" ).val("");
						}
			});








  </script>




</body>

</html>
<?php
ob_end_flush();
?>
