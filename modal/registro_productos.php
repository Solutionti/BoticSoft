	<!DOCTYPE html>
<head>

<script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
  }
</script>
</head>
<?php
        function generar_numero_aleatorio($longitud) {
            $key = '';
            $pattern = '1234567890';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }
?>
    <body>
        <div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> <font color="white">Agregar nuevo producto en la Tienda<?php echo $_SESSION['tienda']; ?></font></h4>
		  </div>
                    <div id="resultados_ajax_productos"></div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">

				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>

				</div>
			</div>
                        <div class="form-group">
				<label for="cat_pro" class="col-sm-3 control-label">Categoria</label>
				<div class="col-sm-8">
				 <select class="form-control" id="cat_pro" name="cat_pro" required>
					<option value="">-- Selecciona Categoria --</option>

                        <?php
                        $nom = array();
                        $sql2="select * from categorias ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["nom_cat"];
                            $id_categoria=$row3["id_categoria"];
                            ?>
                            <option value="<?php  echo $id_categoria;?>"><?php  echo $nom_cat;?></option>
                            <?php
                            $i=$i+1;
                        }

                        ?>
                         </select>
				</div>
                        </div>
                         <div class="form-group">
				<label for="und_pro" class="col-sm-3 control-label">Und/Medida</label>
				<div class="col-sm-8">
				 <select class="form-control" id="und_pro" name="und_pro" required>
					<option value="">-- Selecciona und/medida de producto --</option>

                        <?php

                                        $sql3="select * from und ";
                                        $rs3=mysqli_query($con,$sql3);
                                        while($row4=mysqli_fetch_array($rs3)){
                                            $nom_und=$row4["nom_und"];
                                            $id_und=$row4["id_und"];
                                        ?>

                                        <option value="<?php echo $id_und;?>"><?php  echo $nom_und;?></option>

                                        <?php
                                        }
                                        ?>
                         </select>
				</div>
                        </div>
                        <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo de Producto</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona tipo --</option>
					<option value="1">Nuevo</option>
					<option value="0">De segunda</option>
                                        <option value="2">Repuesto</option>
				  </select>
				</div>
			</div>
                        <div class="form-group">
				<label for="marca" class="col-sm-3 control-label"><?php echo des3;?></label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="marca" name="marca" placeholder="marca" >
				</div>
			</div>
                        <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label"><?php echo des1;?></label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="modelo" name="modelo" placeholder="modelo" >
				</div>
			</div>
                        <div class="form-group">
				<label for="color" class="col-sm-3 control-label"><?php echo des2;?></label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="color" name="color" placeholder="color" >
				</div>
			</div>
                        <?php
                        $barras=generar_numero_aleatorio(12);
                        ?>
                        <div class="form-group">
				<label for="mod_color" class="col-sm-3 control-label">Barras</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" id="barras" name="barras" placeholder="Barras" value="<?php echo $barras;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Costo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" onChange="multiplicar();" id="costo" name="costo" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			</div>


                        <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
                                    <input type="text"  class="form-control" id="precio" name="precio" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Stock minimo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="min" name="min" placeholder="Stock minimo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>

                         <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Inventario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precio" name="inventario" placeholder="Inventario inicial del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
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
