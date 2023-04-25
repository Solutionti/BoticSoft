	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_categoria").reset();
  }
</script>
</head>
<?php
if (isset($con))
{
?>
	<!-- Modal -->
<body>
	<div class="modal fade" id="nuevoTransferencia3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 style="color:black;" class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white" >Agregar nueva tranferencia</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_transferencia3" name="guardar_transferencia3">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="und_pro" class="col-sm-3 control-label">Producto Pack</label>
				<div class="col-sm-8">
				 <select class="form-control" id="id_producto" name="id_producto" required>
					<option value="">-- Selecciona Pack --</option>

                                        <?php

                                        $sql3="select distinct id_producto from pack";
                                        $rs3=mysqli_query($con,$sql3);
                                        while($row4=mysqli_fetch_array($rs3)){

                                            $id_producto=$row4["id_producto"];
                                            $sql4="select*from products where id_producto=$id_producto";
                                            $rs4=mysqli_query($con,$sql4);
                                            $row5=mysqli_fetch_array($rs4);
                                            $nombre_producto=$row5["nombre_producto"];
                                        ?>

                                        <option value="<?php echo $id_producto;?>"><?php  echo $nombre_producto;?></option>

                                        <?php
                                        }
                                        ?>
                         </select>
				</div>
                        </div>
			  <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad a transferir" required>

				</div>
			  </div>

                         <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Tipo</label>
				<div class="col-sm-8">
					 <select  class="form-control" id="tipo" name="tipo" required>
					<option value="">-- Selecciona tipo --</option>
					<option value="1">Abrir Pack</option>
					<option value="2">Convertir</option>

				  </select>
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
