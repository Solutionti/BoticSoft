	<!DOCTYPE html>
<head>


<script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
  }
</script>
</head>

    <body>
        <div class="modal fade" id="nuevoServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 style="color:black;" class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> <font color="white">Agregar nuevo servicio en la Sucursal<?php echo $_SESSION['tienda']; ?></font></h4>
		  </div>
                    <div id="resultados_ajax_productos"></div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_servicio" name="guardar_servicio">
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">

				  <input type="text" class="form-control" id="cod_servicio" name="cod_servicio" placeholder="Código del servicio" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
			<input type="text" class="form-control" id="nom_servicio" name="nom_servicio" placeholder="Nombre del servicio" required>
			</div>
			</div>
      <div class="form-group">
			<label for="precio" class="col-sm-3 control-label">Precio</label>
			<div class="col-sm-8">
      <input type="text"  class="form-control" id="pre_servicio" name="pre_servicio" placeholder="Precio del servicio" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
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
	//	}
	?>
</body>

</html>
