	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" >
		  <div class="modal-header" style="background: #001394;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 style="color:white;" class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Datos para cierre de caja</h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="editar_caja" name="editar_caja">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_cat" class="col-sm-3 control-label">Cierre de Caja</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <select class="form-control" id="cierre" name="cierre"  required>
                                      <option value="1">Cerrar Caja</option>
                                  </select>

				</div>
			  </div>
			   <input type="hidden" name="mod_id" id="mod_id">
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Inicio <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="mod_inicio" name="mod_inicio" placeholder="Solo número de dos decimales" required readonly>

				</div>
			  </div>
			  <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Entradas <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="entrada" name="entrada" placeholder="Solo número de dos decimales" required readonly>

				</div>
			  </div>
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Salidas <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="salida" name="salida" placeholder="Solo número de dos decimales" required readonly>

				</div>
			  </div>
                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Cierre Optimo <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="faltante" name="faltante" placeholder="Solo número de dos decimales" required readonly>

				</div>
			  </div>

                           <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Cierre Real <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="cierre1" name="cierre1" placeholder="Solo número de dos decimales" required>

				</div>
			  </div>



		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Cerrar caja</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
