	<!doctype html>
<html lang="en">
<head>
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_serie").reset();
  }
</script>






</head>
<?php
if (isset($con))
{
?>
	<!-- Modal -->
<body>
	<div class="modal fade" id="nuevoPack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white" >Agregar nueva producto al Servicio</font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_pack1" name="guardar_pack">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nom_cat" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required>
				</div>
			  </div>
                         <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Producto</label>
				<div class="col-sm-8">
				<select style="width:100%;" class="select2_single form-control" tabindex="-1" id="id_producto1" name="id_producto1" required>

                                     <option value="">-- Selecciona Producto --</option>

                        <?php


                        $sql2="select * from products,und where products.und_pro=und.id_und ORDER BY  `products`.`nombre_producto` ASC ";

                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nombre_producto=$row3["nombre_producto"];
                            $id_producto=$row3["id_producto"];
                            $nom_und=$row3["nom_und"];
                            ?>
                            <option value="<?php  echo $id_producto;?>"><?php  print"$nombre_producto ($nom_und)" ;?></option>
                            <?php

                        }

                        ?>
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

<script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Seleccionar",
        dropdownParent: $('#nuevoPack'),
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "Con Max Selección límite de 4",
        allowClear: true
      });
    });



  </script>
