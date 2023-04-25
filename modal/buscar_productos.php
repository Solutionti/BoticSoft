	<?php
		if (isset($con))
		{
	?>
<script type="text/javascript">
$("#myModall").draggable({
	handle: ".modal-header"
});
</script>
	<div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
			</div>

			<div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form class="form-horizontal">
				<div class="form-group">
				<div class="col-sm-6">
				<input type="text" class="form-control" autocomplete="off" id="q" placeholder="Buscar productos" onkeyup="load(1)">
				</div>
				<div class="col-sm-2">
				<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
				</div>
			</div>
			</form>
			<div id="loader"></div><!-- Carga gif animado -->
			<div class="outer_div" ></div><!-- Datos ajax Final -->
			</div>

			<div class="modal-footer" >
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
    </div>
  </div>
</div>

	<?php
		}
	?>
