<?php
include('is_logged.php');
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        input {
  float: right;
  clear: both;
}

    </style>
</head>
<?php


$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['id1'])){$id1=$_POST['id1'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
if (isset($_POST['stock'])){$stock=$_POST['stock'];}
require_once ("../config/db.php");
require_once ("../config/conexion.php");

//print"1asass";
if (!empty($id) and !empty($cantidad) and !empty($precio_venta) and ($cantidad>0) and ($precio_venta>0) and ($cantidad<=$stock))
{
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM tmp where id_producto='$id' and session_id='$session_id'");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
    $porciones = explode("----", $id);
    $id=$porciones[0];
    $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','$stock')");


}

if (!empty($id1) )
{
    //$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM tmp where id_producto='$id' and session_id='$session_id'");
	//	$row= mysqli_fetch_array($count_query);
	//	$numrows = $row['numrows'];
    //if($numrows==0){
        $tienda1=$_SESSION['tienda'];
        $sql4=mysqli_query($con, "select * from pack,products,servicios where servicios.id_servicio=$id1 and products.id_producto=pack.id_producto1 and pack.id_producto=$id1 ");
	while ($row4=mysqli_fetch_array($sql4))
	{
            $id=$row4['id_producto'];
            $cantidad=$row4['cantidad'];
            $precio_venta=$row4['precio_producto'];
            $stock=$row4["b$tienda1"];
            $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','$stock')");
    //}else{
  }
    print"";

}

if (isset($_GET['id']))
{
$id_tmp=intval($_GET['id']);
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}
?>
<div class="display_box" align="left">
<table  style="color:black;width:100%;">
<tr style="background:#001394;color:white;">
	<th style="width:10%;" class='text-center' >CODIGO</th>
	<th style="width:5%;" class='text-center'>CANT.</th>
	<th style="width:50%;">DESCRIPCION</th>
	<th style="width:5%;" class='text-center'>PRECI UNIT.</th>
	<th style="width:10%;" class='text-center'>PRECIO TOTAL</th>
	<th style="width:10%;"></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from tmp where tmp.session_id='".$session_id."' ORDER BY  `tmp`.`id_tmp` ASC ");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id=$row["id_producto"];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row["id_producto"];
        $codigo_producto="";
        if($id>0 and is_numeric($id)){
            $sql1=mysqli_query($con, "select * from products where id_producto='".$id."'");
            $row1=mysqli_fetch_array($sql1);
            $nombre_producto=$row1['nombre_producto'];
            $codigo_producto=$row1['codigo_producto'];
            //print"1";
        }
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=$precio_venta;//Formateo variables
	$precio_venta_r=$precio_venta_f;//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=$precio_total;//Precio total formateado
	$precio_total_r=$precio_total_f;//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador

		?>
		<tr style="background:white;">
			<td class='text-center' style="background:white;"><?php echo $codigo_producto;?></td>
      <td class='text-center' style="background:white;">
      <input type="text" id="cantidad_tmp-<?php echo $id_tmp;?>" name="cantidad_tmp-<?php echo $id_tmp;?>" class="monto input" style="height:20px; width:70px;text-align: justify;" value="<?php echo round($cantidad,2);?>" >
      </td>
			<td style="background:white;"><?php echo $nombre_producto;?></td>
      <td class='text-right' style="background:white;">
      <input type="text"  id="precio_tmp-<?php echo $id_tmp;?>" name="precio_tmp-<?php echo $id_tmp;?>" class="monto input" style="height:20px; width:70px;text-align: justify;" value="<?php echo str_replace(",","",number_format($precio_venta_f,2));?>">
      </td>
      <td class='text-right' style="background:white;">
      <input class="monto total" type="text" readonly value="<?php echo str_replace(",","",number_format($precio_total_f,2));?>" style="height:20px; width:70px;text-align: justify;">
      </td>
			<td class='text-center' style="background:white;"><a href="#" class='btn btn-danger btn-xs' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
		<?php
	}
	$subtotal=$sumador_total;


	$total_factura=$subtotal/1.18;
        $total_iva=$total_factura*0.18;

        if ($_SESSION['doc_ventas']==11) {
?>
<tr style="background:white;">
	<td class='text-right' colspan=4 style="background:white;">OP-GRAV</td>
	<td class='text-right' style="background:white;"><input type="text" class="monto4" value="<?php echo number_format($subtotal/(1+iva),2);?>"></td>
	<td></td>
</tr>
<tr style="background:white;">
	<td class='text-right' colspan=4 style="background:white;"> <?php echo nom_iva;print"(";echo 100*iva;print")"?>% </td>
	<td class='text-right' style="background:white;"><input type="text" class="monto5" value="<?php echo number_format(iva*$subtotal/(1+iva),2);?>"></td>
	<td></td>
</tr>
<tr style="background:white;">
	<td class='text-right' colspan=4 style="background:white;">EXONERADA </td>
	<td class='text-right' style="background:white;"><input type="text" class="monto1" value="<?php echo number_format(0,2);?>"></td>
	<td></td>
</tr>

<?php
        }
?>
<tr style="background:white;">
	<td class='text-right' colspan=4 style="background:white;">TOTAL</td>
	<td class='text-right' style="background:white;"><input class="monto totales" id="total" style="height:20px; width:70px;text-align: justify;" type="text" value="<?php echo str_replace(",","",number_format($subtotal,2));?>"></td>
	<td></td>
</tr>
</table>
</div>
</body>
</html>
<script>
// generamos un evento click y keyup para cada elemento input con la clase .input
var input=document.querySelectorAll(".input");
input.forEach(function(e) {
    e.addEventListener("click",multiplica);
    e.addEventListener("keyup",multiplica);
});

// funcion que genera la multiplicacion
function multiplica() {

    // nos posicionamos en el tr del producto
    var tr=this.closest("tr");

    var total=1;

    // recorremos todos los elementos del tr que tienen la clase .input
    var inputs=tr.querySelectorAll(".input");
    inputs.forEach(function(e) {
        total*=e.value;

    });

    // mostramos el total con dos decimales
    tr.querySelector(".total").value=total.toFixed(2);

    // indicamos que calcule el total
    calcularTotal(this.closest("table"));
}

// funcion que calcula la suma total de los productos
function calcularTotal(e) {
    var total=0;
    var total1=0;

    // obtenemos todos los totales y los sumamos
    var totales=e.querySelectorAll(".total");
    totales.forEach(function(e) {
        total+=parseFloat(e.value);
        total1+=parseFloat(e.value);
    });


    // mostramos la suma total con dos decimales
    e.getElementsByClassName("totales")[0].value=total.toFixed(2);
    e.getElementsByClassName("monto1")[0].value=total1.toFixed(2);


}


$(document).ready(function(){

    $('textarea').blur(function(){

        var field = $(this);

        field.css('background-color','#E6E6E6');

        var dataString = 'value='+$(this).val()+'&field='+$(this).attr('name');

        $.ajax({

            type: "POST",

            url: "ajax/edit.php",

            data: dataString,

        });

    });

});

</script>
