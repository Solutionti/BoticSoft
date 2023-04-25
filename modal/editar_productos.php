<?php
if (isset($con))
{
$sql3="select * from datosempresa ";
$rs2=mysqli_query($con,$sql3);
while($row4=mysqli_fetch_array($rs2)){
    $dolar=$row4["dolar"];
}
?>
<head>
<script type="text/javascript">
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

var mostrarValor = function(x){
    if (x>0){
        x1=1;
                        }
    else{
        x1=<?php echo $dolar;?>;
    }



};
</script>
</head>
    <body>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content" style="background: #fff;">
		  <div class="modal-header" style="background: #001394;color:black;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Editar producto</font></h4>
		  </div>
                  <div id="resultados_ajax2"></div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="editar_producto" name="editar_producto">

			  <div class="form-group">
				<label for="mod_codigo" class="col-sm-3 control-label altura_i">Código</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
        <input type="text" class="form-control altura_i" readonly="" id="mod_codigo" name="mod_codigo" placeholder="Código del producto" required>
        <input type="hidden" name="mod_id" id="mod_id">

				</div>
			  </div>
			   <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label altura_i">Nombre</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <textarea class="form-control" id="mod_nombre"  name="mod_nombre" placeholder="Nombre del producto" required></textarea>
				</div>
			  </div>
			<div class="form-group">
				<label for="mod_cat" class="col-sm-3 control-label altura_i">Categoria</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control altura_i" id="mod_cat" name="mod_cat" required>
					<option value="">-- Selecciona categoria de producto --</option>

                                         <?php
                                        $nom = array();
                                        $sql2="select * from categorias ";
                                        $rs1=mysqli_query($con,$sql2);
                                        while($row3=mysqli_fetch_array($rs1)){
                                            $nom_cat=$row3["nom_cat"];
                                            $id_categoria=$row3["id_categoria"];
                                        ?>

                                        <option value="<?php echo $id_categoria;?>"><?php  echo $nom_cat;?></option>

                                        <?php
                                        }
                                        ?>
				  </select>
				</div>
			  </div>

        <div class="form-group">
          <label for="mod_lab" class="col-sm-3 control-label altura_i">Laboratorio</label>
          <div class="col-md-8 col-sm-8 col-xs-12">
           <select class="form-control altura_i" id="mod_lab" name="mod_lab" required>
            <option value="">-- Selecciona laboratorio --</option>

                                           <?php
                                          $nom2 = array();
                                          $sql3="select * from laboratorio ";
                                          $rs2=mysqli_query($con,$sql3);
                                          while($row4=mysqli_fetch_array($rs2)){
                                              $nom_lab=$row4["nom_laboratorio"];
                                              $id_lab=$row4["id_laboratorio"];
                                          ?>

                                          <option value="<?php echo $id_lab;?>"><?php  echo $nom_lab;?></option>

                                          <?php
                                          }
                                          ?>
            </select>
          </div>
          </div>
                          <div class="form-group">
				<label for="mod_und" class="col-sm-3 control-label altura_i">Und/Medida</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control altura_i" id="mod_und_pro" name="mod_und_pro" required>
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

      <div class="form-group" style="display: none;">
			<label for="mod_status" class="col-sm-3 control-label altura_i">Tipo de producto</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<select class="form-control altura_i" id="mod_status" name="mod_status" required>
					<option value="">-- Selecciona tipo de producto --</option>
					<option value="1" selected>Nuevo</option>
					<option value="0">De segunda</option>
          <option value="2">Repuesto</option>
			</select>
			</div>
			</div>




			<div class="form-group">
			<label for="mod_costo" class="col-sm-3 control-label altura_i">Compra total</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<input  ype="text" class="form-control altura_i"  id="mod_compra_total" name="mod_compra_total" placeholder="Precio de compra total" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
			</div>
			</div>

            <div class="form-group">
			<label for="mod_costo" class="col-sm-3 control-label altura_i">Compra unitaria</label>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<input type="text" class="form-control altura_i" onChange="multiplicar();" id="mod_costo" name="mod_costo" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
			</div>
			</div>


      <div class="form-group">
	  <label for="mod_precio" class="col-sm-3 control-label altura_i">Precio venta</label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
      <input type="text" class="form-control altura_i" id="mod_precio" name="mod_precio" placeholder="Precio 1" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" >
	  </div>
	  </div>

	    <div class="form-group">
      <label for="precio" class="col-sm-3 control-label altura_i">Precio blister</label>
      <div class="col-sm-8">
      <input type="text" class="form-control altura_i" id="mod_precio_mayor" name="mod_precio_mayor" placeholder="Precio por mayor" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
      </div>
      </div>

      <div class="form-group">
      <label for="precio" class="col-sm-3 control-label altura_i">Cantidad blister</label>
      <div class="col-sm-8">
      <input type="text" class="form-control altura_i" id="mod_cantidad_blister" name="mod_cantidad_blister" placeholder="Cantidad blister" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
      </div>
      </div>

      <div class="form-group">
      <label for="precio" class="col-sm-3 control-label altura_i">Descuento</label>
      <div class="col-sm-8">
      <input type="text" class="form-control altura_i" id="mod_descuento" name="mod_descuento" placeholder="descuento" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
      </div>
      </div>


      <div class="form-group">
      <label for="mod_puntos" class="col-sm-3 control-label altura_i">Puntos del producto</label>
      <div class="col-sm-8">
      <input type="text" class="form-control altura_i" id="mod_puntos" name="mod_puntos" placeholder="Puntos" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" value="0">
      </div>
      </div>



      <div class="form-group">
	  <input type="text" id="mod_marca" name="mod_marca" placeholder="Marca" hidden>
	  <input type="text"  id="mod_barras" name="mod_barras" placeholder="Barras" hidden>

    <label for="mod_contiene" class="col-sm-3 control-label altura_i">Cantidad que contiene caja</label>
		<div class="col-md-8 col-sm-8 col-xs-12">
		<input type="text" class="form-control altura_i" id="mod_contiene" name="mod_contiene" placeholder="Contiene">
		</div>
	  </div>

                        <?php
                        $aa="";
                        $sql1="select * from users where user_id=$_SESSION[user_id]";
                        $rw1=mysqli_query($con,$sql1);//recuperando el registro
                        $rs1=mysqli_fetch_array($rw1);
                        $modulo=$rs1["accesos"];
                        $a = explode(".", $modulo);
                        //if($a[3]==0){
                            $aa="readonly";
                        //}
                        ?>
        <div class="form-group">
				<label for="precio" class="col-sm-3 control-label altura_i">Stock minimo</label>
				<div class="col-sm-8">
				<input type="text" class="form-control altura_i" id="mod_min" name="mod_min" placeholder="Stock minimo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>

        <div class="form-group">
				<label for="mod_inv" class="col-sm-3 control-label altura_i">Inventario</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<input type="text" <?php echo "$aa";?> class="form-control altura_i" id="mod_inv" name="mod_inv" placeholder="Precio de costo del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>

      <div class="form-group">
      <label for="precio" class="col-sm-3 control-label altura_i">Caducidad</label>
      <div class="col-sm-8">
      <input type="date" class="form-control" id="mod_caducidad" name="mod_caducidad" placeholder="Stock minimo del producto">
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
