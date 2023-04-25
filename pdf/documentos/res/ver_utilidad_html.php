<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{background:#001394;padding: 4px 4px 4px;color:white;font-weight:bold;font-size:12px;}
.silver{background:white;padding: 3px 4px 3px;}
.clouds{background:#001394;padding: 3px 4px 3px;}
.border-top{border-top: solid 1px #001394;}
.border-left{border-left: solid 1px #001394;}
.border-right{border-right: solid 1px #001394;}
.border-bottom{border-bottom: solid 1px #001394;}
tr.border_bottom td {border:1px solid #001394;color:black;}
#border_bottom2 {  border:1px solid #001394;  color:black;}
#border_bottom3 {border:1px solid #001394;color:black;}
tr.border_bottom1 td {border-left:1px solid #001394;}
tr.border_bottom4 td {border-left:1px solid #001394;border-bottom: 1px solid #001394;}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
</style>
<?php


$sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$sucursal_vendedor."'");
$rw_factura2=mysqli_fetch_array($sql_factura2);
$logo=$rw_factura2['foto'];
$dir=$rw_factura2['direccion'];
$ruc=$rw_factura2['ruc'];
$telf=$rw_factura2['telefono'];
$correo=$rw_factura2['correo'];
$nombre=$rw_factura2['nombre'];
$color="#FAAC58";
    ?>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 100%; text-align: left">
                </td>
            </tr>
        </table>
    </page_footer>

    <br>
    <?php
	$sql_users=mysqli_query($con,"select * from users where user_id='".$vendedor_vendedor."'");
	$rw_users=mysqli_fetch_array($sql_users);
	$users_name=$rw_users['nombres'];
	$users_dni=$rw_users['dni'];
	$users_sucursal=$rw_users['sucursal'];
  $tipo1="LISTA DE VENTAS";
        ?>
    <table cellspacing="0" style="width: 100%; color: #001394" >
    	<tr>
           <td style="width: 30%; " ><img src="<?php echo $logo;?>" width="100" height="60"></td>
           <td style="width: 50%; " align="center"><strong><?php echo $nombre;?></strong><br><font style="font-size: 8pt;"><?php echo $dir;?><br><?php echo $telf;?><br><?php echo $correo;?></font></td>
           <td style="width: 20%; ">
           <table  cellspacing="0" style="width: 100%; text-align:center; font-size: 12pt; border: 1px solid #001394; color: #001394; ">
             <tr><td align="center"  bgcolor="#001394" ><font style="color: #fff;"><strong>R.U.C.<?php echo $ruc;?></strong></font></td></tr>
             <tr><td align="center"><font style="color: #001394;"><strong><?php echo $tipo1;?></strong></font></td></tr>
           </table>
           </td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%;font-size: 8pt; border: 1px solid #001394" >

         <tr>
           <td height="10" bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>Vendedor</strong></font></td>
           <td bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>Rango de fechas del reporte</strong></font></td>
           <td bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>sucursal</strong></font></td>
        </tr>
        <tr>
           <td style="width: 40%;"><?php echo $users_name; ?></td>
           <td style="width: 35%;"><?php echo "DESDE   ".$fecha_inicio."    HASTA  ".$fecha_finall; ?></td>
           <td style="width: 25%;"><?php echo $nombre; ?></td>
        </tr>
    </table>
    <br>







    <table cellspacing="0" style="width: 100%; text-align: left;border: 1px solid #001394;font-size: 8pt; " >
    <TR><TH COLSPAN='8' align="center" bgcolor="red" ><strong style="color: #fff;font-size: 8pt;">Compras y ventas generales</strong></TH></TR>
    <tr class="border_bottom">
        <td style="width: 5%; " align="center" bgcolor="#001394"> <strong style="color: #fff;font-size: 8pt;">Nro</strong></td>
        <td style="width: 8%; " align="center" bgcolor="#001394"> <strong style="color: #fff;font-size: 8pt;">Fecha</strong></td>
        <td style="width: 47%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Producto</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">costo unidad</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Cantidad</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Compra total</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Venta total</strong></td>
    </tr>
    <?php
    $sum_vent=mysqli_query($con,"SELECT detalle_factura.*,facturas.* FROM facturas, detalle_factura WHERE facturas.numero_factura = detalle_factura.numero_factura AND detalle_factura.	ot='1' AND detalle_factura.fecha>='".$fecha_inicial."' AND detalle_factura.fecha<='".$fecha_final."'");
    $total_venta=0;
    $total_compra=0;
    $contador=1;
    while ($rw_ventas=mysqli_fetch_array($sum_vent)) {

    ?>
    <tr class="border_bottom1">
        <td  align="center"><?php  echo $contador;?></td>
        <td  align="center"><?php echo $rw_ventas['fecha'];?></td>
<?php
$sql_producto=mysqli_query($con,"select * from products where id_producto='".$rw_ventas['id_producto']."'");
$rw_producto=mysqli_fetch_array($sql_producto);

$compra_total_1 = $rw_ventas['cantidad'] * $rw_producto['costo_producto'];
$venta_total_1 =  $rw_ventas['cantidad'] * $rw_ventas['precio_venta'];
 ?>

        <td  align="center"><?php echo $rw_producto['nombre_producto']; ?></td>
        <td  align="center"><?php echo $rw_producto['costo_producto'];?></td>
        <td  align="center"><?php echo $rw_ventas['cantidad'];?></td>
        <td  align="center"><?php echo $compra_total_1;?></td>
        <td  align="center"><?php echo $venta_total_1;?></td>

    </tr>
    <?php
    $total_compra=$total_compra + $compra_total_1;
    $total_venta=$total_venta + $venta_total_1;

    $contador = $contador +1;
    }
    $utilidad_bruta=$total_venta - $total_compra;
    ?>

            <tr class="border_bottom">
            <td colspan="5" align="right">Sub total : </td>
            <td align="center"><?php echo round($total_compra,2); ?></td>
            <td align="center"><?php echo round($total_venta,2); ?></td>
            </tr>
            <tr class="border_bottom">
            <td colspan="6" align="right">Total de utilidades: </td>
            <td colspan="1" align="center"><?php echo round($utilidad_bruta,2); ?></td>
            </tr>


    </table>

    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;border: 1px solid #001394;font-size: 8pt; " >
    <TR><TH COLSPAN='8' align="center" bgcolor="red" ><strong style="color: #fff;font-size: 8pt;">Ventas eliminadas</strong></TH></TR>
    <tr class="border_bottom">
        <td style="width: 5%; " align="center" bgcolor="#001394"> <strong style="color: #fff;font-size: 8pt;">Nro</strong></td>
        <td style="width: 8%; " align="center" bgcolor="#001394"> <strong style="color: #fff;font-size: 8pt;">Fecha</strong></td>
        <td style="width: 47%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Producto</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">costo unidad</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Cantidad</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Compra total</strong></td>
        <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">Venta total</strong></td>
    </tr>
    <?php
    $sum_vent=mysqli_query($con,"SELECT detalle_factura.*,facturas.* FROM facturas, detalle_factura WHERE facturas.numero_factura = detalle_factura.numero_factura AND detalle_factura.	ot='2' AND detalle_factura.fecha>='".$fecha_inicial."' AND detalle_factura.fecha<='".$fecha_final."'");
    $total_venta=0;
    $total_compra=0;
    $contador=1;
    while ($rw_ventas=mysqli_fetch_array($sum_vent)) {

    ?>
    <tr class="border_bottom1">
        <td  align="center"><?php  echo $contador;?></td>
        <td  align="center"><?php echo $rw_ventas['fecha'];?></td>
<?php
$sql_producto=mysqli_query($con,"select * from products where id_producto='".$rw_ventas['id_producto']."'");
$rw_producto=mysqli_fetch_array($sql_producto);

$compra_total_1 = $rw_ventas['cantidad'] * $rw_producto['costo_producto'];
$venta_total_1 =  $rw_ventas['cantidad'] * $rw_ventas['precio_venta'];
 ?>

        <td  align="center"><?php echo $rw_producto['nombre_producto']; ?></td>
        <td  align="center"><?php echo $rw_producto['costo_producto'];?></td>
        <td  align="center"><?php echo $rw_ventas['cantidad'];?></td>
        <td  align="center"><?php echo $compra_total_1;?></td>
        <td  align="center"><?php echo $venta_total_1;?></td>

    </tr>
    <?php
    $total_compra=$total_compra + $compra_total_1;
    $total_venta=$total_venta + $venta_total_1;

    $contador = $contador +1;
    }
    $utilidad_bruta=$total_venta - $total_compra;
    ?>

            <tr class="border_bottom">
            <td colspan="5" align="right">Sub total : </td>
            <td align="center"><?php echo round($total_compra,2); ?></td>
            <td align="center"><?php echo round($total_venta,2); ?></td>
            </tr>
            <tr class="border_bottom">
            <td colspan="6" align="right">Total de utilidades: </td>
            <td colspan="1" align="center"><?php echo round($utilidad_bruta,2); ?></td>
            </tr>


    </table>
<br>
     <table cellspacing="0" style="width: 100%;font-size: 8pt; color: #001394;" >

         <tr>
           <td align="justify">En la fecha <?php echo date("j F, Y"); ?>, se constata que las actividades diarias de la empresa <?php echo $nombre;?>, se ha concluido satisfactoriamente,<br>
						 cumpliendose con los terminos de referencia y las especificaciones de las actividades diarias, por lo tanto se emite la conformidad de las ventas.
					  </td>
        </tr>

    </table>
		<br>
		<table cellspacing="0" style="width: 100%;font-size: 8pt; color: #001394;" >

				<tr>
					<td>
					<fieldset style="height: 100px; border: #001394;position: relative;">
						<legend style=" border: 0px;">Observaciones</legend>

						</fieldset>
					</td>
			 </tr>

	 </table>
    <BR>
			<br><br>
			<table cellspacing="0" style="width: 100%;font-size: 8pt;color: #001394; " >

					 <tr>
						 <td align="center">______________________________________</td>
						 <td align="center">______________________________________</td>
					</tr>
					<tr>
						 <td align="center" style="width: 50%;"><?php echo $users_dni; ?><br><?php echo $users_name; ?></td>
						 <td align="center" style="width: 50%;"><?php echo $ruc; ?><br><?php echo $nombre; ?></td>
					</tr>
			</table>
<br>
</page>
