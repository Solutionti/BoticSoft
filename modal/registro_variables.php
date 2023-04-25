	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_variables").reset();
  }
</script>
</head>
<?php
if (isset($con))
{
    ?>

        <body>
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fffs;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white" >Agregar nueva variable laboral</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_variables" name="guardar_variables">
			<div id="resultados_ajax"></div>
                        <div class="form-group">
				<label for="variables" class="col-sm-3 control-label">Codigo:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="cod_var" name="cod_var" placeholder="Codigo de la variable" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="variables" class="col-sm-3 control-label">Nombre:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="variables" name="variables" placeholder="Nombre de la variable" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="des_var" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="des_var" name="des_var" placeholder="Descripcion de la variable" required>

				</div>
			  </div>
                          <div class="form-group">
				<label for="color" class="col-sm-3 control-label">Color:</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="color" id="color" name="col_var" placeholder="col_var" placeholder="Color de la variable" required>

				</div>
			  </div>
		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
                       <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
</body>
</html>
