	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document" >
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> <font color="white">Editar usuario</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
                      <font color="black">LLenar los campos obligatorios</font> <font style="background-color:#A9F5BC;color:white; "> &nbsp;&nbsp;&nbsp;&nbsp;</font>

			<form style="color:black;" class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombres y Apellidos</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" style="background-color:#A9F5BC;" id="firstname2" name="firstname2" placeholder="Nombres" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>

			  <div class="form-group">
				<label for="user_name2" class="col-sm-3 control-label">Usuario</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" style="background-color:#A9F5BC;" id="user_name2" name="user_name2" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="user_email2" class="col-sm-3 control-label">Email</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="email" class="form-control" id="user_email2" name="user_email2" placeholder="Correo electrónico">
				</div>
			  </div>
			  <div class="form-group">
				<label for="dom" class="col-sm-3 control-label">Domicilio</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<input type="text" class="form-control" id="dom" name="dom" placeholder="Domicilio">
				</div>
			  </div>

				<div class="form-group">
				<label for="dni" class="col-sm-3 control-label">DNI</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" class="form-control" id="mod_dni" name="mod_dni" placeholder="DNI">
				</div>
				</div>

        <div class="form-group">
				<label for="tel" class="col-sm-3 control-label">Telefono</label>
				<div class="col-md-4 col-sm-4 col-xs-12">
				 <input type="text" class="form-control" id="tel" name="tel" placeholder="telefono">
				</div>
			  </div>

				<div class="form-group">
				<label for="hora_entrada" class="col-sm-3 control-label">Hora de Entrada</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="time" class="form-control" id="hora" name="hora" placeholder="Hora de Entrada">
				</div>
			  </div>

				<div class="form-group">
				<label for="hora_entrada" class="col-sm-3 control-label">Hora de Entrada</label>
				<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="time" class="form-control" id="hora" name="hora" placeholder="Hora de Entrada">
				</div>
			  </div>

				<div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Sucursal</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<select class="form-control" id="mod_sucursal" name="mod_sucursal" required>
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
                        <script>
                        function capturar()
                        {

                         document.getElementById("valor").checked = true;
                        }
                        </script>
		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" onclick="capturar()" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
