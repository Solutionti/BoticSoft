<?php
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");
include('ajax/is_logged.php');
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
<div class="container display_box" align="left">
    <table class="styled-table">
    <thead>
      <tr><th  align="center">Codigo</th><th style=" text-align:center;">Nombre</th><th astyle=" text-align:center;">Categoria</th><th style=" text-align:center;">Laboratorio</th><th  style=" text-align:center;">Stock</th><th style=" text-align:center;">Cantidad</th><th  style=" text-align:center;">Precio</th><th></th>
      </tr>
    </thead>

<?php


$sql_res=mysqli_query($con,"select * from products where nombre_producto like '%$q%' OR codigo_producto like '%$q%' LIMIT 0 , 20");
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id_producto'];
$nombre=$row['nombre_producto'];
$codigo=$row['codigo_producto'];
$precio_venta=round($row['costo_producto'], 2);
$foto=$row['foto1'];
$cod_categoria=$row['cat_pro'];
$cod_laboratorio=$row['cod_laboratorio'];

$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$suc=$rs1['sucursal'];

$sql3="select * from sucursal where id_sucursal='".$suc."'";
$rw3=mysqli_query($con,$sql3);//recuperando el registro
$rs3=mysqli_fetch_array($rw3);//trasformar el registro en un vector asociativo
$sucursal_actual=$rs3['tienda'];


$tienda=$sucursal_actual;

$b=round($row["b$tienda"], 2);
$i=$i+1;
?>

<?php


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
        <td><?php echo $codigo; ?></td>
        <td><?php echo $nombre; ?></td>
        <td style=" text-align:center;"><?php echo $categoria; ?></td>
        <td style=" text-align:center;"><?php if(!empty($laboratorio)){echo $laboratorio;} ?></td>
        <td  style=" text-align:center;">
          <input type="text"  style="text-align:center;width:50%;" disabled id="stoc_<?php echo $id; ?>" value="<?php echo $b;?>">
        </td>
        <td  style=" text-align:center;">
            <input type="text"  style="text-align:center;width:50%;" id="cant_<?php echo $id; ?>" value="1" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '1';}">
        </td>
        <td  style=" text-align:center;">
            <input type="text"   style="text-align:center;width:50%;" id="precio_<?php echo $id; ?>"  value="<?php echo $precio_venta;?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $precio_venta;?>';}">
        </td>
        <td>
            <a class='btn btn-info'href="#" onclick="agregar2('<?php echo $id ?>')"><i class="glyphicon glyphicon-plus"></i></a>
        </td>
    </tr>
</tbody>

<?php
}
?>
    </table></div>
<?php
}


}


?>
