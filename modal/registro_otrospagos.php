<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script>
  function limpiarFormulario() {
    document.getElementById("guardar_otrospagos").reset();
  }
</script>
</head>
<?php
//header("Content-Type: text/html;charset=utf-8");

		if (isset($con))
		{
	?>
        <body>
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
		<div class="modal-content" >
		  <div class="modal-header" style="background: #001394;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i><font color="white"> Agregar nueva operación en la Sucursal<?php echo $_SESSION['tienda']; ?></font></h4>
		  </div>
		  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
			<form style="color:black;" class="form-horizontal" method="post" id="guardar_otrospagos" name="guardar_otrospagos">
			<div id="resultados_ajax_productos"></div>
			<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Registrar Operación</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
					<input type="text" class="form-control" id="nombre" autocomplete="off" name="nombre" placeholder="Breve descripción de la operación" required>

				</div>
			</div>
                        <div class="form-group">
				<label for="tipo" class="col-sm-3 control-label">Operacion</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="ven_com" name="ven_com" required>
					<option value="">-- Seleccionar tipo de operación --</option>
		                      <option value="6">Pagos</option>
                          <option value="5">Cobros</option>
                          <option value="15">Otros gastos</option>
                            </select>
                                </div>
			</div>

                        <div class="form-group">
				<label for="tipo" class="col-sm-3 control-label">Tipo</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				<select class="form-control" id="motivo" name="motivo" required>
				<option value="">-- Seleccionar tipo de operación --</option>
		                      <option value="Fijo">Fijo</option>
                          <option value="Variable">Variable</option>
         </select>
        </div>
			</div>


                        <div class="form-group">
				<label for="cliente" class="col-sm-3 control-label">Destinatario</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="cliente" name="cliente" required>
					<option value="1">-- CLIENTES VARIOS  --</option>
                        <?php

                            $sql2="select * from clientes ORDER BY  `clientes`.`nombre_cliente` ASC ";

                            $rs1=mysqli_query($con,$sql2);
                            while($row3=mysqli_fetch_array($rs1)){
                                $nombre=$row3["nombre_cliente"];
                                $id_cliente=$row3["id_cliente"];
                                $id_cliente1=$id_cliente;
                            ?>
                            <option value="<?php  echo $id_cliente1;?>"><?php  echo $nombre;?></option>
                            <?php
                        }
                        ?>
                                </select>
				</div>
                        </div>

                        <div class="form-group">
				<label for="tipo" class="col-sm-3 control-label">Medio de Pago</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="condiciones" name="condiciones" required>
					<option value="">-- Elegir medio --</option>
                                        <option value="1">Efectivo</option>
                                        <option value="2">Cheque</option>
                                        <option value="3">Transferencia</option>

                                </select>
				</div>
			</div>
                        <div class="form-group">
				<label for="pago" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="number" min="0.01" step="0.01" class="form-control" autocomplete="off" id="pago" name="pago" placeholder="Cantidad a pagar o cobrar en <?php echo moneda;?>" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
                         <div class="form-group">
				<label for="vendedor" class="col-sm-3 control-label">Tipo de comprobante</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				 <select class="form-control" id="estado_factura" name="estado_factura" required>
					<option value="">-- Selecciona Tipo de Comprobante --</option>

                        <?php
                        $sql2="select * from comprobante_pago ";
                        $i=0;
                        $rs1=mysqli_query($con,$sql2);
                        while($row3=mysqli_fetch_array($rs1)){
                            $nom_cat=$row3["des_comprobante"];
                            $id_categoria=$row3["id_comprobante"];
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
				<label for="codigo" class="col-sm-3 control-label">Nro Documento</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
				  <input type="text" class="form-control" autocomplete="off" id="numero_factura" name="numero_factura" placeholder="Nro del documento" required>
				</div>
			</div>

			 <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Detalle</label>
				<div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea class="form-control" autocomplete="off" id="obs" name="obs"  placeholder="Detalle"></textarea>

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
