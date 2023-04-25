<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$mensaje=recoge1('mensaje');


$consulta2 = "SELECT * FROM datosempresa ";
$result2 = mysqli_query($con, $consulta2);
$valor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$dolar=$valor2['dolar'];
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo);
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[10]==0){
    header("location:error.php");
}
function generar_numero_aleatorio($longitud){
	$key = '';
	$pattern = '1234567890';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	return $key;
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

  <title>Ingreso de productos</title>

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
</script>
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
table tr:nth-child(odd) {background-color: #FBF8EF;}
table tr:nth-child(even) {background-color: #EFFBF5;}
 .valor1 {
border-bottom: 2px solid #F5ECCE;
}
-valor1:hover {
background-color: white;
border-bottom: 2px solid #A9E2F3;
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
</div>
</div>
        <?php
          menu3();
        ?>
<div class="right_col" role="main">
<div style="background:<?php echo COLOR;?>;color:black;">
<div class="panel panel-info">
<div class="panel-heading">
                    <h6>Ingresar datos del producto:</h6>
		</div>
            </div>
           <?php
          if($mensaje<>"")
              {
              ?>
               <div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error! <?php echo $mensaje;?></strong>
			</div>
             <?php
          }
            print"<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\" enctype=\"multipart/form-data\" action=\"ingresoproductos1.php\" method=\"POST\">";
            ?>
        <div class="form-group">
				<label for="codigo"  class="col-sm-3 control-label">Código del producto </label>
				<div class="col-md-3 col-sm-3 col-xs-5">
				<input type="text" style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" autocomplete="off" class="form-control" id="codigo" name="codigo" placeholder="El código debe ser corto" required>
        </div>
        <button type="button" onclick="generarcodigo()" class="btn btn-info"name="button"><i class="fa fa-undo"></i></button>
			  </div>

        <div class="form-group">
        <label for="nombre"  class="col-sm-3 control-label">Nombre del producto <font color="Red"><strong>(Sin repetir):</strong></font></label>
				<div class="col-md-9 col-sm-9 col-xs-12">
        <input style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" type="search" style="color:black;font-size:10pt; font-family:Verdana;" class="form-control input-sm" id="nombre_producto" name="nombre"  placeholder="Nombre del producto" >
			  </div>
        </div>

        <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Ingresar foto:</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<input class="textfield10" id="valor1" accept="image/jpeg" type="file" id="files" name="files" class="form-control"/>
				</div>

        <label for="cat_pro" class="col-sm-2 control-label">Und/Medida</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <select style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" class="form-control" id="und_pro" name="und_pro" required>
                                <?php
                                $sql3="select * from und ";
                                $rs3=mysqli_query($con,$sql3);
                                while($row3=mysqli_fetch_array($rs3)){
                                    $nom_und=$row3["nom_und"];
                                    $id_und=$row3["id_und"];
                                    ?>
                                    <option value="<?php  echo $id_und;?>"><?php  echo $nom_und;?></option>
                                    <?php
                                }

                                ?>
        </select>
        </div>
			  </div>

        <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Categoria</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<select style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" class="form-control" id="cat_pro" name="cat_pro" required>
				<option value="">-- Selecciona Categoria --</option>
                        <?php
                        $nom = array();
                        $sql2="select * from categorias ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option value="<?php  echo $id_categoria;?>"><?php  echo $nom_cat;?></option>
                            <?php
                            $i=$i+1;
                        }
                        ?>
                         </select>
				</div>


        <label for="cat_pro" class="col-sm-2 control-label">Laboratorio</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				<select style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" class="form-control" id="cat_labo" name="cat_labo" required>
				<option value="">-- Selecciona laboratorio --</option>
                        <?php
                        $nomb = array();
                        $sql3="select * from laboratorio ";
                        $j=0;
                        $rs2=mysqli_query($con,$sql3);
                        while($row4=mysqli_fetch_array($rs2)){
                            $nom_labor=$row4["nom_laboratorio"];
                            $id_labor=$row4["id_laboratorio"];
                            ?>
                            <option value="<?php  echo $id_labor;?>"><?php  echo $nom_labor;?></option>
                            <?php
                            $j=$j+1;
                        }
                        ?>
                         </select>
				</div>

</div>

<div class="form-group" style="display: none">
<label for="estado" class="col-sm-3 control-label">Tipo de Producto</label>
<div class="col-md-3 col-sm-3 col-xs-12">
<select style="background-color:<?php echo COLOR1;?>;color:black; "  class="textfield10" class="form-control" id="estado" name="estado" required>
<option value="">-- Selecciona tipo --</option>
<option value="1" selected>Nuevo</option>
<option value="0">De segunda</option>
<option value="2">Repuesto</option>
</select>
</div>
                                <?php
                                $barras=generar_numero_aleatorio(12);
                                ?>
<label for="barras" class="col-sm-2 control-label">Barras</label>
<div class="col-md-4 col-sm-4 col-xs-12">
<input class="textfield10" type="text" autocomplete="off" class="form-control" value="<?php echo $barras;?>" id="barras" name="barras" placeholder="barras" required>
</div>
</div>

<div class="form-group">
<label for="precio" class="col-sm-3 control-label">Stock minimo</label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input type="text" style="background-color:<?php echo COLOR1;?>;color:black;" autocomplete="off" class="textfield10" class="form-control" id="min" name="min"   placeholder="Stock minimo">
</div>
<input type="hidden"  class="form-control" id="precio1" name="precio1"  value="0">
<input type="hidden"  class="form-control" id="precio2" name="precio2"  value="0">

<label for="precio" class="col-sm-2 control-label">Inventario (Stock)</label>
<div class="col-md-4 col-sm-4 col-xs-12">
<input style="background-color:<?php echo COLOR1;?>;color:black;"  type="text" autocomplete="off" class="form-control" id="precio" name="inventario" placeholder="Stock inicial del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
</div>
</div>

<div class="form-group">
<label for="precio" class="col-sm-3 control-label">Costo total</label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" type="text" autocomplete="off" class="form-control" id="costo" name="costo_total" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
</div>

<label for="precio" class="col-sm-2 control-label">Costo unitaria</label>
<div class="col-md-4 col-sm-4 col-xs-12">
<input style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" type="text" autocomplete="off" class="form-control" onChange="multiplicar();" id="costo" name="costo" placeholder="Costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
</div>

</div>

<div class="form-group">
<input type="hidden" name="multiplicando"   value="1" >
<label for="precio" class="col-sm-3 control-label">Precio venta</label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input style="background-color:<?php echo COLOR1;?>;color:black; " class="textfield10" type="text"  autocomplete="off" class="form-control" id="precio" name="precio"  placeholder="Precio">
</div>

<label for="descuento" class="col-sm-2 control-label">Descuento</label>
<div class="col-md-4 col-sm-4 col-xs-12">
<input class="textfield10" type="text" autocomplete="off" class="form-control" id="descuento" name="descuento" placeholder="descuento"  value="0" required>
</div>
</div>


<div class="form-group">
<label for="cantidad_blister" class="col-sm-3 control-label">Cantidad Blister</label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input class="textfield10" type="text" autocomplete="off" class="form-control" id="cantidad_blister" name="cantidad_blister" placeholder="Cantidad blister"  value="0" required>
</div>

<label for="precio_mayor" class="col-sm-2 control-label">Precio blister</label>
<div class="col-md-4 col-sm-4 col-xs-12">
<input class="textfield10" type="text"  class="form-control" id="precio_mayor" name="precio_mayor" placeholder="Precio por mayor" value="0" required>
</div>
</div>

<div class="form-group">
<label for="subscribe" class="col-sm-3 control-label"></label>
<div class="col-md-3 col-sm-3 col-xs-12">
<input type="checkbox" name="subscribe" id="subscribe"> Mas opciones
</div>
</div>

  <div class="form-group" id="mas_detalle1" style="display: none;">
	<label for="contiene" class="col-sm-3 control-label">Cantidad que contiene la caja</label>
	<div class="col-md-3 col-sm-3 col-xs-12">
	<input class="textfield10" type="text"  class="form-control" id="contiene" name="contiene" placeholder="Contenido" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales">
	</div>

	<input class="textfield10" type="text" autocomplete="off" class="form-control" id="color" name="color" placeholder="color" hidden>
	<input class="textfield10" type="text"  class="form-control" id="marca" name="marca" placeholder="marca" hidden>

  <label for="color" class="col-sm-2 control-label">Caducidad</label>
	<div class="col-md-4 col-sm-4 col-xs-12">
	<input class="textfield10" type="date" autocomplete="off" class="form-control" id="caducidad" name="caducidad" value="<?php  echo date("Y-m-d"); ?>">
	</div>


  <div class="form-group">
  <label for="cantidad_puntos" class="col-sm-3 control-label">Puntos del producto</label>
  <div class="col-md-3 col-sm-3 col-xs-12">
  <input class="textfield10" type="text" autocomplete="off" class="form-control" id="cantidad_puntos" name="cantidad_puntos" placeholder="0"  value="0">
  </div>
  </div>

	</div>
 </td></tr>
 <script type="text/javascript">
 $(document).ready(function(){
$('#subscribe').on('change',function(){
  if (this.checked) {
   $("#mas_detalle1").show();
   $("#mas_detalles").show();
  } else {
   $("#mas_detalle1").hide();
   $("#mas_detalles").hide();
  }
})
});
 </script>

    <script>
    var tags1 = [];
                <?php
                    for($i = 0 ;$i<count($marca);$i++){
                ?>
                tags1.push("<?php echo $marca[$i];?>");
                <?php } ?>
    $("#marca" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags1, function( item ){
              return matcher.test( item );
          }) );
      }
});
    </script>
    <script>
    var tags2 = [];
                <?php
                    for($i = 0 ;$i<count($modelo);$i++){
                ?>
                tags2.push("<?php echo $modelo[$i];?>");
                <?php } ?>
    $("#modelo" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags2, function( item ){
              return matcher.test( item );
          }) );
      }
});

    </script>
     <script>
    var tags3 = [];
                <?php
                    for($i = 0 ;$i<count($color);$i++){
                ?>
                tags3.push("<?php echo $color[$i];?>");
                <?php } ?>
    $("#color" ).autocomplete({
  source: function( request, response ) {
          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
          response( $.grep( tags3, function( item ){
              return matcher.test( item );
          }) );
      }
});

    </script>
  <div class="modal-footer">
  <button type="button" class="btn btn-success" onclick="limpiarFormulario()">Limpiar</button>
  <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
  </div>
	</form>
  </div>
  </div>
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
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
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
  <script type="text/javascript">
  function generarcodigo(length) {
    var caracteres = "1234567890ABCDEFGHJKMNPQRTUVWXYZ";
    var codigobarra = "";
    for (i=0; i<13; i++) codigobarra +=caracteres.charAt(Math.floor(Math.random()*caracteres.length));
     document.getElementById("codigo").value = codigobarra;
  }
  </script>

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
		}
	});
});
$("#nombre_producto" ).on( "keydown", function( event ) {
	if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
	{
		$("#id_producto" ).val("");
	}
	if (event.keyCode==$.ui.keyCode.DELETE){
		$("#nombre_producto" ).val("");
		$("#id_producto" ).val("");
	}
});
</script>
</body>
</html>
<?php
ob_end_flush();
?>
