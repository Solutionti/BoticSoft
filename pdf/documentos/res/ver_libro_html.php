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
  $tipo1="INGRESO / EGRESO";
        ?>
    <table cellspacing="0" style="width: 100%; color: #001394" >
    	<tr>
           <td style="width: 30%; " height="10" ><img src="<?php echo $logo;?>" width="250" height="100"></td>
           <td style="width: 35%; " align="center"><strong><?php echo $nombre;?></strong><br><font style="font-size: 8pt;"><?php echo $dir;?><br><?php echo $telf;?><br><?php echo $correo;?></font></td>
           <td style="width: 40%; " height="10" align="center">
           <table  cellspacing="0" style="width: 100%; text-align:center; font-size: 10pt; border: 1px solid #001394; color: #001394; ">
          <tr bgcolor="#001394 ">
            <td style="width: 85%;" align="center"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color: #fff;"><strong>R.U.C.<?php echo $ruc;?></strong></font></td>
          </tr>
          <tr>
            <td style="width: 85%;" align="center"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color: #001394;"size="6"><strong><?php echo $tipo1;?></strong></font></td>
          </tr>
           </table>
           </td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%;font-size: 8pt; border: 1px solid #001394" >

         <tr>
           <td height="10" bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>Vendedor</strong></font></td>
           <td bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>Fecha</strong></font></td>
           <td bgcolor="#001394"><font style="color: #fff; font-weight: bold;"><strong>sucursal</strong></font></td>
        </tr>
        <tr>
           <td style="width: 50%;"><?php echo $users_name; ?></td>
           <td style="width: 25%;"><?php echo $fecha_vendedor; ?></td>
           <td style="width: 30%;"><?php echo $users_sucursal; ?></td>
        </tr>
    </table>
    <br>

<table cellspacing="0" style="width: 100%; text-align: left;border: 1px solid #001394;font-size: 8pt; " id="mi-tabla" >
<tr class="border_bottom">
    <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">FECHA</strong></td>
    <td style="width: 70%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">DESCRIPCION</strong></td>
    <td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">INGRESO</strong></td>
		<td style="width: 10%; " align="center" bgcolor="#001394"><strong style="color: #fff;font-size: 8pt;">EGRESO</strong></td>
</tr>
<?php
$sql=mysqli_query($con,"SELECT * FROM detalle_factura WHERE id_vendedor='".$vendedor_vendedor."' AND tienda='".$sucursal_vendedor."' AND fecha>='".$fecha_inicial."' AND fecha<='".$fecha_final."'");
$sql_egreso=mysqli_query($con,"SELECT * FROM facturas WHERE nombre !='1' AND id_vendedor='".$vendedor_vendedor."' AND tienda='".$sucursal_vendedor."' AND fecha_factura>='".$fecha_inicial."' AND fecha_factura<='".$fecha_final."'");
$total_venta=0;
$total_egreso=0;
while ($row=mysqli_fetch_array($sql)) {
	$sql_producto=mysqli_query($con,"SELECT * FROM products WHERE id_producto='".$row['id_producto']."'");
	$rw_producto=mysqli_fetch_array($sql_producto);
	if ($rw_producto['nombre_producto']=="") {
		$producto=$row['id_producto'];
	}else {
		$producto=$rw_producto['nombre_producto'];
	}
?>
    <tr class="border_bottom1">
    		<td  height="10" align="center"><?php echo $row['fecha']; ?></td>
    		<td  height="10" align="center"><?php echo $producto;?></td>
    		<td  height="10" align="center"><?php echo ($row['cantidad']*$row['precio_venta']); ?></td>
    		<td  height="10" align="center">0</td>
    </tr>
<?php
$total_venta=$total_venta + ($row['cantidad']*$row['precio_venta']);
}

while ($row_egreso=mysqli_fetch_array($sql_egreso)) {
?>
    <tr class="border_bottom1">
    		<td  height="10" align="center"><?php echo $row_egreso['fecha_factura']; ?></td>
    		<td  height="10" align="center"><?php echo $row_egreso['nombre'];?></td>
    		<td  height="10" align="center">0</td>
    		<td  height="10" align="center"><?php echo $row_egreso['total_venta']; ?></td>
    </tr>
<?php
$total_egreso=$total_egreso + $row_egreso['total_venta'];
}
?>


        <tr class="border_bottom">
            <td colspan="2" align="right">Sub total : </td>
						<td align="center"><?php echo $total_venta; ?></td>
            <td align="center"><?php echo $total_egreso; ?></td>
        </tr>
       <tr class="border_bottom">
                    <td colspan="3" align="right">Total : </td>
                    <td align="center"><?php echo ($total_venta - $total_egreso); ?></td>
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
					<fieldset style="height: 100px;width: 102%;; border: #001394;position: relative;">
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
