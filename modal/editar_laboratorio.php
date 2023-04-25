<?php
if (isset($con))
{

?>
<head>


</head>
    <body>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 style="color:black;" class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Editar Laboratorio</font></h4>
		  </div>

      <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="editar_laboratorio" name="editar_laboratorio">


			  <div class="form-group">
        <input type="text"  id="mod_id_laboratorio" name="mod_id_laboratorio" hidden>
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre del laboratorio</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<textarea class="form-control" id="mod_nom_laboratorio" name="mod_nom_laboratorio" placeholder="Nombre del Laboratorio" required></textarea>
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
</body>
