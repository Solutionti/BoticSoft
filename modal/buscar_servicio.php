<script>

        var mostrarValor = function(x){
            var x;
            var porciones = x.split('----');
            document.getElementById('precio_ventaa_2').value=porciones[1];
    };
</script>

<style media="screen">
.inputss{

  font-family: Arial, Sans-Serif;
      font-size: 12px;
      color: #black;
      padding: 6px;
      outline: none;
      float: left;
      border: solid 1px #adadad;
      width: 150px;
      transition: all 2s ease-in-out;
      -webkit-transition: all 2s ease-in-out;
      -moz-transition: all 2s ease-in-out;

      -moz-box-shadow: inset 0 0 5px 5px #E6E6E6;
      -webkit-box-shadow: inset 0 0 5px 5px #e6e6e6;
      box-shadow: inset 0 0 5px 5px #e6e6e6;
      clear: right;
}
</style>
	<?php
        $id_producto=1;
		if (isset($con))
		{
	?>
			<!-- Modal -->
			<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header" style="background: #001394;">
					<button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 style="color:white;" class="modal-title" id="myModalLabel">Ingresar venta o servicio:</h4>
				  </div>
				  <div class="modal-body" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">


					<form class="form-horizontal">
        <table class="" >
				<tr  style="background:<?php echo tablas;?>;color:white;">
          <th></th><th></th><th></th><th></th>
				</tr>
          <tr>
            <td colspan="4" >
              <div class="form-group">
              <label style="color: black;" for="nom_cat" class="col-sm-3 control-label">Precio general</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
              <input style="text-align:left; width: 100%; color: black;" type="text"  class="inputss" name="txt_precio_general" id="txt_precio_general" onkeyup="opcion_unidadf()" placeholder="Precio" autocomplete="off">
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4" >
              <div class="form-group">
              <label style="color: black;" for="nom_cat" class="col-sm-3 control-label">Seleccione unidad</label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select name="unidades_seleccionadoss" id="unidades_seleccionadoss" style="width: 100%;color: black;" class="inputss" onchange="opcion_unidadf()">
                <option value="0">--- Seleccione ---</option>
                <option value="Cuarta Docena">Cuarta Docena</option>
                <option value="Media Docena">Media Docena</option>
                <option value="Docena">Docena</option>
                <option value="Cuarto ciento">Cuarto ciento</option>
                <option value="Medio ciento">Medio ciento</option>
                <option value="Ciento">Ciento</option>
                <option value="Media caja">Media caja</option>
                <option value="Caja">Caja</option>
                <option value="Medio cajon">Medio cajon</option>
                <option value="Cajon">Cajon</option>
                </select>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <div id="cantidad_caja" style="display: none;">
                <div class="form-group">
                <label style="color: black;" for="nom_cat" class="col-sm-3 control-label" >Cantidad caja</label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                <input style="text-align:left;width: 100%;color: black;" type="text" class=" inputss" name="txt_cantidad_caja"  onkeyup="opcion_unidadf()" id="txt_cantidad_caja" placeholder="Cantidad contiene" autocomplete="off">
                </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <div class="form-group">
              <label style="color: black;" for="nom_cat" class="col-sm-3 control-label" id="label_name"></label>
              <div class="col-md-8 col-sm-8 col-xs-12">
              <input disabled style="text-align:left;width: 100%;color: black;" type="text" class=" inputss" name="txt_pre_precio" onkeyup="opcion_unidadf()" id="txt_pre_precio" placeholder="Precio unidad" autocomplete="off">
              </div>
              </div>
            </td>
          </tr>

          <tr bgcolor="#001394">
            <td colspan="1" style="border: 1px solid  #001394; color: white;" >Descripcion</td>
            <td colspan="1" align="center" style="border: 1px solid  #001394; color: white;">Cant.</td>
            <td colspan="1" align="center" style="border: 1px solid  #001394; color: white;">Prec_uni.</td>
            <td colspan="1" style="border: 1px solid  #001394; color: white;"></td>
          </tr>
          <tr style="border-bottom: 1pt solid #001394;">




             <script type="text/javascript">

      function opcion_unidadf() {
                   var r;
                   var precio_gen = document.getElementById("txt_precio_general").value;
                   var precio = document.getElementById("txt_pre_precio").value;
                   var option_select = document.getElementById("unidades_seleccionadoss").value;
                   var cantidad_caja = document.getElementById("txt_cantidad_caja").value;
                   var precio_pre;

                   if (option_select=="Cuarta Docena") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen)/4;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre)/ 3;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 3;
                     document.getElementById("descripcion_1").value ="Cuarta docena de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/4 docena';

                   }else if (option_select=="Media Docena") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen)/2;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre) / 6;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 6;
                     document.getElementById("descripcion_1").value ="Media docena de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/2 docena';

                   }else if (option_select=="Docena") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen);
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre) / 12;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 12;
                     document.getElementById("descripcion_1").value ="Docena de ";
                     document.querySelector('#label_name').innerText = 'Precio docena';

                   }else if (option_select=="Cuarto ciento") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen)/4;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre) / 25;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 25;
                     document.getElementById("descripcion_1").value ="Cuarto ciento de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/4 ciento';

                   }else if (option_select=="Medio ciento") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen)/2;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre) / 50;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 50;
                     document.getElementById("descripcion_1").value ="Medio ciento de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/2 ciento';

                   }else if (option_select=="Ciento") {
                     $("#cantidad_caja").hide();
                     precio_pre=parseFloat(precio_gen);
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     r = parseFloat(precio_pre) / 100;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = 100;
                     document.getElementById("descripcion_1").value ="Ciento de ";
                     document.querySelector('#label_name').innerText = 'Precio ciento';
                   }
                   else if (option_select=="Caja") {
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     $("#cantidad_caja").show();
                     r =  precio_gen / cantidad_caja;
                     precio_pre=parseFloat(precio_gen);
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = cantidad_caja;
                     document.getElementById("descripcion_1").value ="Caja de ";
                     document.querySelector('#label_name').innerText = 'Precio caja';

                   }
                   else if (option_select=="Media caja") {
                     $("#cantidad_caja").show();
                     r = (precio_gen/2) / (cantidad_caja/2);
                     precio_pre=parseFloat(precio_gen)/2;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = cantidad_caja/2;
                     document.getElementById("descripcion_1").value ="Media caja de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/2 caja';
                   }
                   else if (option_select=="Cajon") {
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     $("#cantidad_caja").show();
                     r =  precio_gen / cantidad_caja;
                     precio_pre=parseFloat(precio_gen);
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = cantidad_caja;
                     document.getElementById("descripcion_1").value ="Cajon de ";
                     document.querySelector('#label_name').innerText = 'Precio cajon';

                   }else if (option_select=="Medio cajon") {
                     $("#cantidad_caja").show();
                     r = (precio_gen/2) / (cantidad_caja/2);
                     precio_pre=parseFloat(precio_gen)/2;
                     document.getElementById("txt_pre_precio").value =precio_pre;
                     document.getElementById("precio_ventaa_1").value = r;
                     document.getElementById("cantidada_1").value = cantidad_caja/2;
                     document.getElementById("descripcion_1").value ="Medio cajon de ";
                     document.querySelector('#label_name').innerText = 'Precio 1/2 cajon';
                   }

    }

             </script>


          <td colspan="1" style="background: white; border: 1px solid  #001394;">
					<div class="pull-right">
          <input type="text"  style="text-align:left;width: 410px; border: 0px solid;color: black;" id="descripcion_1" autocomplete="off" placeholder="Detalle de la descripción o servicio" >
          <input type="hidden"  style="text-align:left;" id="stocka_1"  value="100000" >
          </div>
          </td>


          <td colspan="1" style="background: white;border: 1px solid  #001394;">
					<div class="pull-right">
          <input type="text"  style="text-align:center;width: 50px;border: 0px solid;color: black;" id="cantidada_1"  value="1" >
					</div>
          </td>

          <td colspan="1" style="background: white;border: 1px solid  #001394;">
          <div class="pull-right">
          <input type="text"  style="background: white;text-align:center;width: 60px;border: 0px solid;color: black;" id="precio_ventaa_1"  >
          </div>
          </td>

          <td bgcolor="#5bc0de"style="border: 1px solid  #5bc0de;" colspan="1" class='text-center'><a class='btn btn-info'href="#" onclick="agregar1(1)"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>

        <tr style="border: 1px solid  #001394;">


          <td colspan="1" style="background: white;border: 1px solid  #001394;">
					<div class="pull-right">
          <select  style="text-align:left;width: 410px;border: 0px solid;color: black;" id="descripcion_2" onchange="mostrarValor(this.value);" name="descripcion" required>
					<option value="">-- Selecciona servicio --</option>

                                         <?php

                                        $sql3="select * from servicios ";
                                        $rs3=mysqli_query($con,$sql3);
                                        while($row4=mysqli_fetch_array($rs3)){
                                            $nom_servicio=$row4["nom_servicio"];
                                            $id_servicio=$row4["id_servicio"];
                                            $pre_servicio=$row4["pre_servicio"];
                                            $valor=$nom_servicio."----".$pre_servicio;
                                            //$id_und=$row4["id_und"];
                                        ?>

                                        <option value="<?php echo $valor;?>"><?php  echo $nom_servicio;?></option>

                                           <?php
                                        }
                                        ?>
          </select>
          <input type="hidden" class="inputss" style="text-align:left;" id="stocka_2"  value="1000000" >
          </div>
          </td>

          <td colspan="1" style="background: white; border: 1px solid  #001394;">
          <div class="pull-right">
          <input type="text"  style="text-align:center; width: 50px;border: 0px solid;color: black;" id="cantidada_2"  value="1" >
          </div>
          </td>

          <td colspan="1" style="background: white; border: 1px solid  #001394;">
          <div class="pull-right">
          <input type="text" style="text-align:center;width: 60px; border: 0px solid;color: black;" value="" id="precio_ventaa_2">
          </div>
          </td>

          <td bgcolor="#5bc0de" style="border: 1px solid  #5bc0de;" colspan="1" class='text-center'><a class='btn btn-info'href="#" onclick="agregar1(2)"><i style="width: 100%; height:100%"class="glyphicon glyphicon-plus"></i></a></td>
				  </tr>
          </table>
          </form>






          </div>

          <div class="modal-footer" style="background-color: #CDDCDC; background-image: radial-gradient(at 50% 100%, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), linear-gradient(to bottom, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.25) 100%); background-blend-mode: screen, overlay;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
		</div>
    </div>
	</div>
<?php
}
?>
