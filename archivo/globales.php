<?php
session_start();

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
include('menu.php');
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[21]==0){
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
  
  Variables Globales
  </title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
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
  
<?php
$sql1="SELECT * FROM globales";
$rw1=mysqli_query($con,$sql1);
while ($valor1 = mysqli_fetch_array($rw1)) {
                if($valor1['id_global']==5){
                    $iva=$valor1['med'];
                } 
                
                if($valor1['id_global']==6){
                    $nom_iva=$valor1['med'];
                }
                if($valor1['id_global']==7){
                     $doc=$valor1['med'];
                }
                if($valor1['id_global']==8){
                     $moneda=$valor1['med'];
                }
                if($valor1['id_global']==9){
                     $videos=$valor1['med'];
                }
                if($valor1['id_global']==10){
                     $des1=$valor1['med'];
                }
                if($valor1['id_global']==11){
                    $des2=$valor1['med'];
                }
                if($valor1['id_global']==12){
                    $des3=$valor1['med'];
                }
                if($valor1['id_global']==13){
                    $PN=$valor1['nombre'];
                    $PN1=$valor1['med'];
                }
                if($valor1['id_global']==14){
                   $PJ=$valor1['nombre'];
                    $PJ1=$valor1['med'];
                }
}
?>
          
          <div style="background:<?php echo COLOR;?>;color:black;">
<?php
print"<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\"  action=\"globales1.php\" method=\"POST\">";

?>
                            <div class="panel panel-info">
                            <div class="panel-heading">
                                
                                <h2>Variables Globales:</h2>
                                
                                
                                
                            </div>        
                            </div>
                        <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Impuesto a las ventas</label>
				<div class="col-md-9 col-sm-9 col-xs-12" >
                                    <input type="text"  class="textfield10" class="form-control" id="nom_iva" name="nom_iva" placeholder="Nombre del Impuesto " required value="<?php echo $nom_iva;?>">
				</div>
                        </div>
                                
                        <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Impuesto</label>
				<div class="col-md-9 col-sm-9 col-xs-12" >
                                    <input type="text"  class="textfield10" class="form-control" id="iva" name="iva" placeholder="Impuesto " required value="<?php echo $iva;?>">
				</div>
			</div>     
                                
                             
                    
                        <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Documento sin impuestos</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  class="textfield10" class="form-control" id="doc" name="doc" placeholder="Documento sin impuestos" value="<?php echo $doc;?>">
				</div>
			</div> 
                  
                        
                         <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Moneda</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  class="textfield10" class="form-control" id="Moneda" name="moneda" placeholder="Nombre de la moneda" value="<?php echo $moneda;?>">
				</div>
			</div> 
          
          
                        <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Videos</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" min="0" max="1" class="textfield10" class="form-control" id="videos" name="videos" placeholder="Videos" value="<?php echo $videos;?>">
				</div>
			  </div> 
          
                        <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion 1</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="des1" name="des1" placeholder="Descripcion 1" value="<?php echo $des1;?>">
				</div>
			  </div> 
   
          
                        <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion 2</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="des2" name="des2" placeholder="Descripcion 2" value="<?php echo $des2;?>">
				</div>
			  </div> 
                          <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion 3</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="des3" name="des3" placeholder="Descripcion 3" value="<?php echo $des3;?>">
				</div>
			  </div>  
                          
                           <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Doc Persona Natural</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="PN" name="PN" placeholder="DOcumento persona natural" value="<?php echo $PN;?>">
				</div>
                                <label  class="control-label col-md-2 col-sm-2 col-xs-12">Medida</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="PN1" name="PN1" placeholder="Medida" value="<?php echo $PN1;?>">
				</div>
			  </div>
              
                          <div class="form-group">
				<label  class="control-label col-md-3 col-sm-3 col-xs-12">Doc Persona Juridica</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="PJ" name="PJ" placeholder="DOcumento persona natural" value="<?php echo $PJ;?>">
				</div>
                                <label  class="control-label col-md-2 col-sm-2 col-xs-12">Medida</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="PJ1" name="PJ1" placeholder="Medida" value="<?php echo $PJ1;?>">
				</div>
			  </div>
                 
                        
                    <div class="modal-footer">
                    
			<button type="submit" class="btn btn-primary" id="guardar_datos" disabled>Guardar datos</button> 
                        <br>Boton se habilita al comprar para poder editar variables globales según país.
		  
                    </div>
            </div>
    
		  </form>
          
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
  </script>
  
  
  
</body>

</html>




