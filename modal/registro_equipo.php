<?php
		if (isset($con))
		{
	?>
	<div class="modal fade in" id="nuevoproforma" tabindex="-1"  aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Agregar nuevo equipo</font></h4>
		  </div>
      <div id="resultados_ajax"></div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_equipo" name="guardar_cliente">

      <div class="form-group row">
			<label for="distrito" class="col-sm-2 col-form-label">Equipo</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="equipo" name="equipo" placeholder="nuevo equipo">
			</div>
			</div>
		  </div>
		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" onclick="nif()" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
