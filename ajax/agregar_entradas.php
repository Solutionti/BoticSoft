<?php
include('is_logged.php');
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
if (isset($_POST['stock'])){$stock=$_POST['stock'];}
require_once ("../config/db.php");
require_once ("../config/conexion.php");	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta) and ($cantidad>0) and ($precio_venta>0))
{
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM tmp where id_producto='$id' and session_id='$session_id'");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    if($numrows==0){
        $insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id,tienda) VALUES ('$id','$cantidad','$precio_venta','$session_id','1')");
    }else{            
        print"Producto Repetido";
    }     
        
}
if (isset($_GET['id']))
{
$id_tmp=intval($_GET['id']);	
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id_tmp."'");
}
?>
<table class="table" style="color:black;">
<tr  style="background:#045FB4;color:white;">
	<th class='text-center'>CODIGO</th>
	<th class='text-center'>CANT.</th>
	<th>DESCRIPCION</th>
	<th class='text-right'>PRECIO UNIT.</th>
	<th class='text-right'>PRECIO TOTAL</th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from products, tmp where products.id_producto=tmp.id_producto and tmp.session_id='".$session_id."' ORDER BY  `tmp`.`id_tmp` ASC ");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=$precio_venta;
	$precio_venta_r=$precio_venta_f;
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=$precio_total;
	$precio_total_r=$precio_total_f;
	$sumador_total+=$precio_total_r;
		?>
		<tr style="background:white;">
			<td class='text-center' style="background:white;"><?php echo $codigo_producto;?></td>
			<td class='text-center' style="background:white;"><?php echo $cantidad;?></td>
			<td style="background:white;"><?php echo $nombre_producto;?></td>
			<td class='text-right' style="background:white;"><?php echo str_replace(",","",number_format($precio_venta_f,2));?></td>
			<td class='text-right' style="background:white;"><?php echo str_replace(",","",number_format($precio_total_f,2));?></td>
			<td class='text-center' style="background:white;"><a href="#" class='btn btn-danger btn-xs' onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>		
		<?php
	}
	$subtotal=$sumador_total;
	
	
	$total_factura=$subtotal/(1+iva);
        $total_iva=$total_factura*iva;

?>
<tr style="background:white;">
	<td class='text-right' colspan=4 style="background:white;">TOTAL</td>
	<td class='text-right' style="background:white;"><?php echo str_replace(",","",number_format($subtotal,2));?></td>
	<td></td>
</tr>
</table>
