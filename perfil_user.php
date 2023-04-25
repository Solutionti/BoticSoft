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


$user_dni=$rs1["dni"];
$user_name=$rs1["nombres"];
$user_phone=$rs1["telefono"];
$user_mail=$rs1["user_email"];
$user_dir=$rs1["domicilio"];

$user_login=$rs1["user_name"];



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

<title>perfil de Usuario</title>
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
<form   method="post" id="editar_datos_basicos" name="editar_datos_basicos">

<div class="x_panel" style="color:black;background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">

<div class="col-md-6">
  <fieldset class="scheduler-border">
  <legend class="scheduler-border"><h4> <small>Informacion Basica</small></h4></legend>

<div id="resultados_actualizar_datos"></div>
<div class="form-horizontal">
  <div class="form-group">
    <label for="user_dni" class="col-md-4 control-label">Dni :</label>
    <div class="col-sm-8">
      <input type="text" name="user_dni" class="form-control input-sm " id="user_dni"  value="<?php echo $user_dni; ?>" required>
      <input type="pass" name="id_user_mod" value="<?php echo $_SESSION['user_id']; ?>" hidden>
    </div>
  </div>
  <div class="form-group">
    <label for="user_names" class="col-sm-4 control-label">Nombres y apellidos :</label>
    <div class="col-sm-8">
      <input type="text" name="user_names" class="form-control input-sm " id="user_names"  value="<?php echo $user_name; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="user_phone" class="col-md-4 control-label">Telefono :</label>
    <div class="col-sm-8">
    <input type="text" name="user_phone" class="form-control input-sm" id="user_phone"  value="<?php echo $user_phone; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="user_mail" class="col-md-4 control-label">E-mail :</label>
    <div class="col-sm-8">
    <input type="text" name="user_mail" class="form-control input-sm" id="user_mail" value="<?php echo $user_mail; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="user_dir" class="col-md-4 control-label">Direccion :</label>
    <div class="col-sm-8">
    <input type="text" name="user_dir" class="form-control input-sm" id="user_dir"  value="<?php echo $user_dir; ?>" required>
    </div>
  </div>
</div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary input-sm" name="aceptar" id="actualizar_datos_basicos">Guardar</button>
      </div>
  </fieldset>
</div>
</form>

<form class="" method="post">

<div class="col-md-6">
  <fieldset class="scheduler-border">
  <legend class="scheduler-border"><h4> <small>Avatar</small></h4></legend>

  <div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
				</div>
				<h5 class="user-name">Yuki Hayashi</h5>
				<h6 class="user-email">yuki@Maxwell.com</h6>
			</div>
			<div class="about">
				<h5>About</h5>
				<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
			</div>
		</div>
  </div>



  </fieldset>
</div>
</form>

<form   method="post" id="editar_password" name="editar_password">
<div class="col-md-6">
  <fieldset class="scheduler-border">
  <legend class="scheduler-border"><h4> <small>Cambiar contraseña</small></h4></legend>

<div id="resultados_cambio_pass"></div>
<div class="form-horizontal">
  <div class="form-group">
    <label for="user_login" class="col-sm-4 control-label">Usuario :</label>
    <div class="col-sm-8">
      <input type="pass" name="id_user_mod" value="<?php echo $_SESSION['user_id']; ?>" hidden>
      <input type="text" name="user_login" class="form-control input-sm " id="user_login"  value="<?php echo $user_login; ?>" disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="user_pass_ant" class="col-md-4 control-label">Contraseña actual :</label>
    <div class="col-sm-8">
    <input type="password" name="user_pass_ant" class="form-control input-sm" id="user_pass_ant" required>
    </div>
  </div>
  <div class="form-group">
    <label for="user_pass_new" class="col-md-4 control-label">Nueva contraseña :</label>
    <div class="col-sm-8">
    <input type="password" name="user_pass_new" class="form-control input-sm" id="user_pass_new" required>
    </div>
  </div>
  <div class="form-group">
    <label for="user_pass_new_confirmar" class="col-md-4 control-label">Confirmar contraseña :</label>
    <div class="col-sm-8">
    <input type="password" name="user_pass_new_confirmar" class="form-control input-sm" id="user_pass_new_confirmar" required>
    </div>
  </div>
</div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary input-sm" id="actualizar_password" name="aceptar" >Confirmar cambio</button>
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

<script type="text/javascript">

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_password').attr("disabled", true);

 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_contraseña.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_cambio_pass").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_cambio_pass").html(datos);
      $('#actualizar_password').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

$( "#editar_datos_basicos" ).submit(function( event ) {
  $('#actualizar_datos_basicos').attr("disabled", true);

 var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/editar_datos_basicos.php",
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados_actualizar_datos").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados_actualizar_datos").html(datos);
      $('#actualizar_datos_basicos').attr("disabled", false);
      load(1);
      }
  });
  event.preventDefault();
})

</script>
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
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>
