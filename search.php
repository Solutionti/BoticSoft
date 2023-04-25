<?php
include('ajax/is_logged.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");

if($_POST)
{
$i=0;
$q=$_POST['palabra'];//se recibe la cadena que queremos buscar
if(strlen ($q)>=1)
{
?>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #001394;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #001394;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #001394;
}
</style>






<div class="container">
  <div class="display_box" align="left">
      <table class="styled-table" WIDTH="60%">
        <thead>
       <tr>
         <th style="">Codigo</th>
         <th style=""> Nombreff </th>
         <th style=" text-align:center;">Categoria </th>
         <th style=" text-align:center;">Laboratorio </th>
         <th style=" text-align:center;">Precio blister</th>
         <th style=" text-align:center;" >Descuento</th>
         <th style=" text-align:center;" >Stock</th>
         <th style=" text-align:center;" >Caducidad</th>
         <th style=" text-align:center;">Cantidad</th>
         <th style=" text-align:center; ">Precio</th>
         <th style=" text-align:center;"></th>
       </tr>
     </thead>
  <?php
  $sql_res=mysqli_query($con,"select * from products where nombre_producto like '%$q%' or  codigo_producto like '%$q%' LIMIT 0 , 20");
  while($row=mysqli_fetch_array($sql_res))
  {
  $id=$row['id_producto'];
  $nombre=$row['nombre_producto'];
  $cod_categoria=$row['cat_pro'];
  $min=$row['min'];
  $codigo=$row['codigo_producto'];
  $precio_mayor=$row['precio_blister'];
  $cantidad_blister=$row['cantidad_blister'];
  $descuento=$row['dcto'];
  $cod_laboratorio=$row['cod_laboratorio'];
  $precio_venta=round($row['precio_producto'], 2);
  $foto=$row['foto1'];
  $f_caducidad=$row['fecha_caducidad'];
  $tienda=$_SESSION['tienda'];



  $sql1="select * from users where user_id=$_SESSION[user_id]";
  $rw1=mysqli_query($con,$sql1);//recuperando el registro
  $rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
  $suc=$rs1['sucursal'];

  $sql3="select * from sucursal where id_sucursal='".$suc."'";
  $rw3=mysqli_query($con,$sql3);//recuperando el registro
  $rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
  $sucursal_actual=$rs3['tienda'];

  $b=round($row["b$sucursal_actual"], 2);
  $i=$i+1;

  if($b<=$min)
  {$label_class='label-danger';}
  else
  {$label_class='label-success';}

  $fecha_hoyy      = new DateTime(date('Y-m-d'));
  $fecha_final_cad = new DateTime($f_caducidad);
  $rango_fecha = $fecha_hoyy->diff($fecha_final_cad);
  if($rango_fecha->days<=100)
  {$label_class_fecha='label-danger';}
  else
  {$label_class_fecha='label-success';}

  $sql_categoria=mysqli_query($con,"select * from categorias where id_categoria='".$cod_categoria."' ");
  while($row_cate=mysqli_fetch_array($sql_categoria))
  {
    $categoria=$row_cate['nom_cat'];
  }

  $sql_laboratorio=mysqli_query($con,"select * from laboratorio where id_laboratorio='".$cod_laboratorio."' ");
  while($row_lab=mysqli_fetch_array($sql_laboratorio))
  {
    $laboratorio=$row_lab['nom_laboratorio'];
  }
  ?>
    <tbody>
      <tr>
          <td style="text-align:center;"><?php echo $codigo; ?></td>
          <td><?php echo $nombre; ?></td>
          <td><?php echo $categoria; ?></td>
          <td><?php if(!empty($laboratorio)){echo $laboratorio;} ?></td>
          <td>

          <?php

          if ($precio_mayor>0 and $precio_mayor<>"") {
            ?>

            <input type="text"    name="cantidad_blist_<?php echo $id; ?>" id="cantidad_blist_<?php echo $id; ?>" value="<?php echo $cantidad_blister;?>" hidden>
            <input type="number" onchange="aumentar_blister_<?php echo $id; ?>()"  style="text-align:center; border: 1px solid #5cb85c; width: 50px;"  name="mas_blist_<?php echo $id; ?>" id="mas_blist_<?php echo $id; ?>" value="0" >
            <div class="input-group">
            <input type="text"  style="text-align:center; width: 30px; border: 1px solid #5cb85c;" disabled name="precio_blist_<?php echo $id; ?>" id="precio_blist_<?php echo $id; ?>" value="<?php echo $precio_mayor;?>">
    				<span class="input-group-btn"><input   onclick="opcion_blister_<?php echo $id; ?>()" type="checkbox"  value="Si"id="activar_blist_<?php echo $id; ?>" hidden></span>
  					</div>
            <?php
          }
           ?>


<script>
    function opcion_blister_<?php echo $id; ?>() {
    var precio_blister = document.getElementById("precio_blist_<?php echo $id; ?>").value;
    var cantidad_blister = document.getElementById("cantidad_blist_<?php echo $id; ?>").value;
    var cantidad = document.getElementById("cant_<?php echo $id; ?>").value;
    var new_precio;
    new_precio=precio_blister/cantidad;
    document.getElementById("precio_<?php echo $id; ?>").value = new_precio;
    document.getElementById("cant_<?php echo $id; ?>").value = cantidad_blister;
  }

  function aumentar_blister_<?php echo $id; ?>() {
  var precio_blister = document.getElementById("precio_blist_<?php echo $id; ?>").value;
  var cantidad_blister = document.getElementById("cantidad_blist_<?php echo $id; ?>").value;
  var mas_blister = document.getElementById("mas_blist_<?php echo $id; ?>").value;
  var new_precio;
  var new_cantidad;
  if(mas_blister==1){
      document.getElementById("cant_<?php echo $id; ?>").value = cantidad_blister;
      new_precio=precio_blister/cantidad_blister;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio;
  }else if (mas_blister==2) {
      new_cantidad=cantidad_blister * 2;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 2)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==3) {
      new_cantidad=cantidad_blister * 3;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 3)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==4) {
      new_cantidad=cantidad_blister * 4;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 4)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==5) {
      new_cantidad=cantidad_blister * 5;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 5)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==6) {
      new_cantidad=cantidad_blister * 6;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 6)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==7) {
      new_cantidad=cantidad_blister * 7;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 7)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==8) {
      new_cantidad=cantidad_blister * 8;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 8)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==9) {
      new_cantidad=cantidad_blister * 9;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 9)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }else if (mas_blister==10) {
      new_cantidad=cantidad_blister * 10;
      document.getElementById("cant_<?php echo $id; ?>").value = new_cantidad;
      new_precio=(precio_blister * 10)/new_cantidad;
      document.getElementById("precio_<?php echo $id; ?>").value = new_precio
  }


}
</script>


          </td>
          <td style="text-align:center;"><?php echo $descuento;?></td>
          <td>
          <span style="font-size: 10px;" class="label <?php echo $label_class;?>"><?php echo $b; ?></span>
            <input type="text"  style="text-align:center;width:40%;" disabled id="stoc_<?php echo $id; ?>" value="<?php echo $b;?>" hidden>
          </td>
          <td><span style="font-size: 10px;" class="label <?php echo $label_class_fecha;?>"><?php echo $f_caducidad; ?></span></td>
          <td ><input type="text"  style="text-align:center;width:35px;" id="cant_<?php echo $id; ?>" value="1" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '1';}"></td>
          <td><input type="text"   style="text-align:center;width:40px;" id="precio_<?php echo $id; ?>"  value="<?php echo $precio_venta;?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $precio_venta;?>';}"></td>
          <td ><a class='btn btn-info'href="#" onclick="agregar2('<?php echo $id ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
      </tr>
    </tbody>
  <?php
  }
  ?>
      </table>
    </div>
</div>


<?php
}
}
?>
