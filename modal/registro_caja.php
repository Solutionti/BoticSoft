	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_caja").reset();
  }
</script>
</head>
<?php
      date_default_timezone_set('America/Lima');
      $fecha=date("Y-m-d");
      $tienda1=$_SESSION['tienda'];
      $user_id=$_SESSION['user_id'];
      $id_caja=0;
                $sql2="select * from caja where fecha='$fecha' and tienda=$tienda1 and usuario_inicio=$user_id";
                $rs1=mysqli_query($con,$sql2);
                $row3=mysqli_fetch_array($rs1);
                $id_caja=$row3["id_caja"];


		if (isset($con))
		{

        ?>

        <body>

	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
		<div class="modal-content">

		  <div class="modal-header" style="background: #001394;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 style="color:white;" class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar inicio de caja</h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_caja" name="guardar_caja">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Fecha</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" readonly required>
				</div>
			  </div>

                          <div class="form-group">
				<label for="des_cat" class="col-sm-3 control-label">Inicio de caja en <?php echo moneda;?></label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="inicio" name="inicio" placeholder="Solo número de dos decimales" required>

				</div>
			  </div>
                         <div class="form-group">
				<label for="mod_cat" class="col-sm-3 control-label">Vendedor</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="mod_usuario" name="mod_usuario" required>
					<option value="">-- Selecciona Vendedor --</option>

                                         <?php
                                        $nom = array();
                                        $sql2="select * from users";
                                        $rs1=mysqli_query($con,$sql2);
                                        while($row3=mysqli_fetch_array($rs1)){
                                            $nombres=$row3["nombres"];
                                            $user_id=$row3["user_id"];
                                        ?>

                                        <option value="<?php echo $user_id;?>"><?php  echo $nombres;?></option>

                                        <?php
                                        }
                                        ?>
				  </select>
				</div>
			  </div>



		  </div>

		  <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
                       <button type="button" class="btn btn-default" onclick="limpiarFormulario()">Limpiar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Abrir Caja</button>
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
