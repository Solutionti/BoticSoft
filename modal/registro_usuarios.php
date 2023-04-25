	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
        <script>
  function limpiarFormulario() {
    document.getElementById("guardar_usuario").reset();
  }
</script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;" >
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Agregar nuevo usuario</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<font color="black">LLenar los campos obligatorios</font> <font style="background-color:#001394;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>
                        <div id="resultados_ajax"></div>
			<div class="form-group">
			<label for="firstname" class="col-sm-3 control-label">Nombres y Apellidos</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nombres" required>
			</div>
			</div>

			<div class="form-group">
			<label for="user_name" class="col-sm-3 control-label">Usuario</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
		  <input type="text" class="form-control" style="background-color: #A9F5BC;" id="user_name" name="user_name" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
			</div>
			</div>

			<div class="form-group">
			<label for="user_email" class="col-sm-3 control-label">Email</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<input type="email" class="form-control" id="user_email" name="user_email" placeholder="Correo electrónico">
			</div>
			</div>

      <div class="form-group">
			<label for="telefono" class="col-sm-3 control-label">Telefonos</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
		  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefonos" >
			</div>
			</div>

        <div class="form-group">
				<label for="domicilio" class="col-sm-3 control-label">Domicilio</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domiclio" >
				</div>
			  </div>

				<div class="form-group">
				<label for="dni" class="col-sm-3 control-label">DNI</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" >
				</div>
			  </div>


			  <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="password" style="background-color: #A9F5BC;" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>

				<div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Repetir</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="password" style="background-color: #A9F5BC;" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
				</div>

				<div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Sucursal</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control" id="sucursal_us" name="sucursal_us" required>
					 <option value="">-- Selecciona el Sucursal --</option>

																					<?php
																				 $nomb = array();
																				 $sql3="select * from sucursal ";
																				 $rs2=mysqli_query($con,$sql3);
																				 while($row4=mysqli_fetch_array($rs2)){
																						 $id_suc=$row4["id_sucursal"];
																						 $nombre_suc=$row4["nombre"];
																				 ?>

																				 <option value="<?php echo $id_suc;?>"><?php  echo $nombre_suc;?></option>

																				 <?php
																				 }
																				 ?>
					 </select>
					 </div>
				</div>


		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
                      <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
