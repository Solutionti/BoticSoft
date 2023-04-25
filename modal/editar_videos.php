	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Editar video</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="editar_video" name="editar_video">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Menu</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="mod_menu" name="mod_menu" required>
					<option value="">-- Selecciona estado --</option>
					<option value="Empresa">Empresa</option>
					<option value="Usuarios">Usuarios</option>
                                        <option value="Productos y Servicios">Productos y Servicios</option>
                                        <option value="Proveedores">Proveedores</option>
                                        <option value="Clientes">Clientes</option>
                                        <option value="Ventas de productos">Ventas de productos</option>
                                        <option value="Facturación Electrónica">Facturación Electrónica</option>
                                        <option value="Compras">Compras</option>
                                        <option value="Ent/Sal Mercaderia">Ent/Sal Mercaderia</option>
                                        <option value="Pagos/Cobros-Reportes">Pagos/Cobros-Reportes</option>
                                        <option value="Reporte de Ventas">Reporte de Ventas</option>
                                        <option value="Reporte de Compras">Reporte de Compras</option>
                                        <option value="Contabilidad">Contabilidad</option>
				  </select>
				</div>
			</div>
                        <div class="form-group">
				<label  class="col-sm-3 control-label">SubMenu</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control" id="mod_submenu" name="mod_submenu" placeholder="Sub Menu" required>
                                    <input type="hidden" name="mod_id" id="mod_id">
                                </div>
			</div>
                        <div class="form-group">
				<label  class="col-sm-3 control-label">Descripcion</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea class="form-control"  id="mod_descripcion" name="mod_descripcion" placeholder="Descripcion"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-sm-3 control-label">Video</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" class="form-control"  id="mod_video" name="mod_video" placeholder="Video">
				</div>
			</div>

		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
