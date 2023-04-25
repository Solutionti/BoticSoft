<?php
ob_start();
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
if($a[0]==0){
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

  Datos de la Empresa
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
	background: black;
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
$sql1="SELECT * FROM datosempresa WHERE id_emp=1";
$rw1=mysqli_query($con,$sql1);
while ($valor1 = mysqli_fetch_array($rw1)) {

    $nom_emp=$valor1['nom_emp'];
    $des_emp=$valor1['des_emp'];
    $mis_emp=$valor1['mis_emp'];
    $vis_emp=$valor1['vis_emp'];
    $dir_emp=$valor1['dir_emp'];
    $tel_emp=$valor1['tel_emp'];
    $email_emp=$valor1['email_emp'];
    $face_emp=$valor1['face_emp'];
    $tiwter_emp=$valor1['tiwter_emp'];
    $youtube_emp=$valor1['youtube_emp'];
    $linkedin_emp=$valor1['linkedin_emp'];
    $wasap_emp=$valor1['wasap_emp'];
    $google=$valor1['google_maps'];
    $color=$valor1['color'];

    $comentario1=$valor1['comentario1'];
    $comentario2=$valor1['comentario2'];
    $comentario3=$valor1['comentario3'];
    $comentario4=$valor1['comentario4'];
    $comentario5=$valor1['comentario5'];
    $fac_ele=$valor1['fac_ele'];
    $usuariosol=$valor1['usuariosol'];
    $clavesol=$valor1['clavesol'];
    $clave=$valor1['clave'];
}
?>

          <div style="text-color:black;background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
<?php
print"<form class=\"form-horizontal form-label-left\" id=\"guardar_producto\"  action=\"empresa1.php\" method=\"POST\">";

?>
                            <div class="panel panel-info">
                            <div class="panel-heading">

                                <h6>Datos generales de la empresa:</h6>

                                 <?php
                    $video=videos;

                    if($video==1){
                    $v="Oocazta9OmM";
                    include("modal/registro_video.php");
                    ?>
                    <?php

                    }
                    ?>


                            </div>
                            </div>


                           <div class="form-group">
				<label for="nom_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de la empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12" >
        <input type="text"  class="textfield10" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre de la empresa" required value="<?php echo $nom_emp;?>">
				</div>
			  </div>

                              <div class="form-group">
				<label for="des_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion de la empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea  class="textfield10" class="form-control" id="des_emp" name="des_emp" placeholder="Descripcion de la empresa"><?php echo $des_emp;?></textarea>
				</div>
			  </div>

                         <div class="form-group">
				<label for="mis_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Mision de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  class="textfield10" class="form-control" id="mis_emp" name="mis_emp" placeholder="Mision de la Empresa" value="<?php echo $mis_emp;?>">
				</div>
			  </div>


                       <div class="form-group">
				<label for="vis_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Visión de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="vis_emp" name="vis_emp" placeholder="Visión de la Empresa" value="<?php echo $vis_emp;?>">
				</div>
			  </div>


                        <div class="form-group">
				<label for="dir_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="dir_emp" name="dir_emp" placeholder="Dirección de la Empresa" value="<?php echo $dir_emp;?>">
				</div>
			  </div>

                        <div class="form-group">
				<label for="tel_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Telefonos de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="tel_emp" name="tel_emp" placeholder="Dirección de la Empresa" value="<?php echo $tel_emp;?>">
				</div>
			  </div>


                        <div class="form-group">
				<label for="email_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Email de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="email_emp" name="email_emp" placeholder="Email de la Empresa" value="<?php echo $email_emp;?>">
				</div>
			  </div>
                           <div class="form-group">
				<label for="email_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Google maps</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="google" name="google" placeholder="Google maps" value="<?php echo $google;?>">
				</div>
			  </div>
                            <div class="form-group">
				<label for="email_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Color tema tienda 3</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="textfield10" class="form-control" id="color" name="color">
                                        <?php
                                        $s1="";
                                        $s2="";
                                        $s3="";
                                        $s4="";
                                        $s5="";
                                        $s6="";
                                        $s7="";
                                        $s8="";
                                        $s9="";
                                        $s10="";

                                        if($color=="bridge-theme"){
                                            $s1="selected";
                                        }
                                        if($color=="dark-red-theme"){
                                            $s2="selected";
                                        }
                                        if($color=="default-theme"){
                                            $s3="selected";
                                        }
                                        if($color=="green-theme"){
                                            $s4="selected";
                                        }
                                        if($color=="lite-blue-theme"){
                                            $s5="selected";
                                        }
                                        if($color=="orange-theme"){
                                            $s6="selected";
                                        }
                                        if($color=="pink-theme"){
                                            $s7="selected";
                                        }
                                        if($color=="purple-theme"){
                                            $s8="selected";
                                        }
                                        if($color=="red-theme"){
                                            $s9="selected";
                                        }
                                        if($color=="yellow-theme"){
                                            $s10="selected";
                                        }

                                        ?>
                                        <option value="bridge-theme" <?php echo $s1;?>>Verde claro</option>
                                        <option value="dark-red-theme" <?php echo $s2;?>>Negro -rojo</option>
                                        <option value="default-theme" <?php echo $s3;?>>Por default</option>
                                        <option value="green-theme" <?php echo $s4;?>>Verde</option>
                                        <option value="lite-blue-theme" <?php echo $s5;?>>Celeste</option>
                                        <option value="orange-theme" <?php echo $s6;?>>Naranja</option>
                                        <option value="pink-theme" <?php echo $s7;?>>Rosado</option>
                                        <option value="purple-theme" <?php echo $s8;?>>Purpura</option>
                                        <option value="red-theme" <?php echo $s9;?>>Rojo</option>
                                        <option value="yellow-theme" <?php echo $s10;?>>Amarillo</option>

                                    </select>
				</div>
			  </div>

                           <div class="panel panel-info">
                            <div class="panel-heading">

                            <h2>Redes Sociales</h2>
                            </div>
                            </div>

                          <div class="form-group">
				<label for="face_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="face_emp" name="face_emp" placeholder="Facebook de la Empresa" value="<?php echo $face_emp;?>">
				</div>
			  </div>

                            <div class="form-group">
				<label for="tiwter_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="tiwter_emp" name="tiwter_emp" placeholder="Twitter de la Empresa" value="<?php echo $tiwter_emp;?>">
				</div>
			  </div>
                          <div class="form-group">
				<label for="youtube_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Youtube de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="youtube_emp" name="youtube_emp" placeholder="Youtube de la Empresa" value="<?php echo $youtube_emp;?>">
				</div>
			  </div>

                            <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Linkedin de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="linkedin_emp" name="linkedin_emp" placeholder="Linkedin de la Empresa" value="<?php echo $linkedin_emp;?>">
				</div>
			  </div>
                          <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Wasap de la Empresa</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="textfield10" class="form-control" id="wasap_emp" name="wasap_emp" placeholder="Wasap de la Empresa" value="<?php echo $wasap_emp;?>">
				</div>
			  </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">

                            <h2>Otros datos de la web:</h2>
                            </div>
                        </div>

                        <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Slider1</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="textfield10" class="form-control" id="comentario1" name="comentario1" placeholder="Comentario Slider1"><?php echo $comentario1;?></textarea>
				</div>
			  </div>
                        <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Slider2</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="textfield10" class="form-control" id="comentario2" name="comentario2" placeholder="Comentario Slider2"><?php echo $comentario2;?></textarea>
				</div>
			  </div>

                         <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Slider3</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="textfield10" class="form-control" id="comentario3" name="comentario3" placeholder="Comentario Slider3"><?php echo $comentario3;?></textarea>
				</div>
			  </div>

                         <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Slider4</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="textfield10" class="form-control" id="comentario4" name="comentario4" placeholder="Comentario Slider4"><?php echo $comentario4;?></textarea>
				</div>
			</div>
                        <div class="form-group">
				<label for="linkedin_emp" class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Slider5</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="textfield10" class="form-control" id="comentario5" name="comentario5" placeholder="Comentario Slider5"><?php echo $comentario5;?></textarea>
				</div>
			</div>
                    <div class="modal-footer">

			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>

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
<?php
ob_end_flush();
?>
