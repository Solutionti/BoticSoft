<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#001394;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#001394;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #001394;

}
.border-left{
	border-left: solid 1px #001394;
}
.border-right{
	border-right: solid 1px #001394;
}
.border-bottom{
	border-bottom: solid 1px #001394;
}
tr.border_bottom td {
  border:1px solid #001394;
  color:#001394;
}
#border_bottom2 {
  border:0px solid #001394;
  color:#001394;

}
#border_bottom21 {
  border:1px solid #001394;
  color:white;
 font-weight:bold;
}
#border_bottom3 {
  border:1px solid #001394;
  color:#001394;
}
tr.border_bottom1 td {
  border-left:1px solid #001394;
}
tr.border_bottom4 td {
  border-left:1px solid #001394;
 border-bottom: 1px solid #001394;
}
table.page_footer {width: 100%; border: none; background-color: #001394; padding: 2mm;border-collapse:collapse; border: none;}

</style>
<?php
$sql_factura1=mysqli_query($con,"select * from guia where id_doc='".$id_factura."'");
$rw_factura1=mysqli_fetch_array($sql_factura1);
$guia=$rw_factura1['guia'];
$sql_factura2=mysqli_query($con,"select * from users where user_id='".$id_vendedor."'");
$rw_factura2=mysqli_fetch_array($sql_factura2);
$vendedor=$rw_factura2['nombres'];
$telefono=$rw_factura2['telefono'];
$sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
$rw_factura2=mysqli_fetch_array($sql_factura2);
$logo=$rw_factura2['foto'];
$dir=$rw_factura2['direccion'];
$telf=$rw_factura2['telefono'];
$ruc=$rw_factura2['ruc'];
$correo=$rw_factura2['correo'];
$nombre=$rw_factura2['nombre'];
$descripcion=$rw_factura2['descripcion_sucursal'];
$igv=18;
//if($tienda1==$tienda2){
    ?>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 9pt; font-family: arial" >
    <?php
	$sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
	$rw_cliente=mysqli_fetch_array($sql_cliente);
        $sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
        $rw_cliente1=mysqli_fetch_array($sql_cliente1);
        if($estado==1 or $estado==2 or $estado==5 or $estado==6){
            $tipo2="FACTURA ELECTRÓNICA";
        if($estado==2){
            $tipo2="BOLETA ELECTRÓNICA";
        }
        if($estado==5){
            $tipo2="NOTA DE DEBITO";
        }
        if($estado==6){
            $tipo2="NOTA DE CREDITO";
        }
	?>


    <table cellspacing="0" style="width: 100%;" border="0">
    	<tr>
           <td style="width: 25%; " height="10" ><img src="<?php echo $logo;?>" width="205" height="100" ></td>
           <td style="width: 40%; " align="center">
						 <font style="font-size: 14pt;color:#001394;" ><strong><?php echo strtoupper($nombre);?></strong></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($dir);?></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($telf);?></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($correo);?></font>
					 </td>
           <td style="width: 31%; " height="10" align="center">
						 <table cellspacing="0" style="width: 100%; text-align: center; font-size: 12pt; border: 1px solid #001394; ">
 						<tr>
 							<td align="center" bgcolor="#001394" style="width: 100%; font-size: 10pt;">
 								<font style="color:white" size="7"><strong><?php echo PJ;?><?php echo $ruc;?></strong></font>
 							</td>
 						</tr>
 						<tr>
 							<td style="color:#001394; font-size: 10pt;">
									<?php echo $tipo2;?>
 							</td>
 						</tr>
 						<tr><td><font style="color:#001394" size="4"><strong><?php print"$folio-";echo str_pad($rw_cliente1['numero_factura'], 8, "0", STR_PAD_LEFT);?></strong></font></td></tr>
 						</table>
           </td>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%; border: 0px solid #001394; font-size: 8pt;" >
			<?php
									if($rw_cliente['doc']>0){

											$tipo1=PJ;
											$doc=$rw_cliente['doc'];
									}
									if($rw_cliente['doc']==0){

											$tipo1=PN;
											$doc=$rw_cliente['dni'];
									}

				?>

        <tr>
           <td style="width: 14%; " ></td>
           <td style="width: 60%; " ></td>
					 <td style="width: 11%; "></td>
					 <td style="width: 15%; "></td>
        </tr>
        <tr>
           <td colspan="1" bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color:white;"><strong>CLIENTE </strong></font></td>
					 <td colspan="1" style="border: 1px solid #001394; color:#001394"><font style="color:#001394"><?php echo $rw_cliente['nombre_cliente']; ?></font></td>
					 <td colspan="1"  bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color: white" ><strong><?php echo $tipo1;?>:</strong></font></td>
					 <td colspan="1" style="border: 1px solid #001394; color:#001394" ><font style="color: #001394" ><strong><?php echo $doc;?></strong></font></td>
            <?php
                $dia=date("d",strtotime($rw_cliente1['fecha_factura']));
                $mes=date("m",strtotime($rw_cliente1['fecha_factura']));
                $ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
                $mes2=mes1($mes);
                $ano1=$ano%1000;
            ?>
        </tr>
        <?php
        if($rw_cliente['doc']>0){
         ?>
         <?php
        }
        ?>
        <tr>
					<td bgcolor=" #001394" style="border: 1px solid #001394;" colspan="1"><font style="color:white;"><strong>DIRECCIÓN</strong></font></td>
          <td style="border: 1px solid #001394; color:#001394" colspan="1"><font style="color:#001394;"><?php echo $rw_cliente['direccion_cliente'];?></font></td>
          <td bgcolor=" #001394" style="border: 1px solid #001394;" colspan="1"><font style="color:white"><strong>F.EMISIÓN</strong></font></td>
					<td style="border: 1px solid #001394; color:#001394" colspan="1"><font style="color:#001394"><?php print" $dia/$mes/$ano";?></font></td>
        </tr>
				<tr>
				  <td colspan="1" bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color:white"><strong>TIPO MONEDA </strong></font></td>
					<td colspan="3" style="border: 1px solid #001394; color:#001394"><font style="color:#001394;">SOLES</font></td>
				</tr>
</table>
<table cellspacing="0" style="width: 100%; border: 0px solid #001394; font-size: 8pt;" >
        <tr>
            <td style="width:14%;"></td>
						<td style="width:38%;"></td>
						<td style="width:12%;"></td>
						<td style="width:10%;"></td>
            <td style="width:11%;"></td>
            <td style="width:15%;"></td>
        </tr>
        <tr>
						<td colspan="1" bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color:white"><strong>VENDEDOR</strong></font></td>
            <td colspan="1" style="border: 1px solid #001394; color: #001394;"><font><?php echo strtoupper($vendedor);?></font></td>
						<td colspan="1" bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color:white"><strong>ESTADO</strong></font></td>
						<td colspan="1" style="border: 1px solid #001394; color: #001394;"></td>
						<td colspan="1" bgcolor=" #001394" style="border: 1px solid #001394;"><font style="color:white"><strong>CONDICION</strong></font></td>
            <td colspan="1" style="border: 1px solid #001394; color: #001394;"><font style="color: #001394" ><?php if($rw_cliente1['condiciones']==4){
                print"CREDITO";
            }else{
                print"CONTADO";
            }
            ?></font>
					</td>
        </tr>
    </table>
		<table cellspacing="0" style="width: 100%; border: 0px solid #001394; font-size: 8pt;" >
			<tr>
				 <td style="width: 25%; " ></td><td style="width: 25%; " ></td><td style="width: 25%; "></td><td style="width: 25%; "></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid #001394; color:#001394;">
						 <?php
						 $motivo=$rw_cliente1['motivo'];
							if($estado==6){
								if($motivo=="01") {$r="ANULACION DE LA OPERACION";}
								if($motivo=="02") {$r="ANULACION POR ERROR EN EL RUC";}
								if($motivo=="03") {$r="CORRECION POR ERROR EN LA DESCRIPCION";}
								if($motivo=="04") {$r="DESCUENTO GLOBAL";}
								if($motivo=="05") {$r="DESCUENTO POR ITEM";}
								if($motivo=="06") {$r="DEVOLUCION TOTAL";}
								if($motivo=="07") {$r="DEVOLUCION POR ITEM";}
							 if($motivo=="08") {$r="BONIFICACION";}
							 if($motivo=="09") {$r="DISMINUCION EN EL VALOR";}
							}
							if($estado==5){
								if($motivo=="01") {$r="INTERES POR MORA";}
								if($motivo=="02") {$r="AUMENTO EN EL VALOR";}
								if($motivo=="03") {$r="PENALIDADES";}
							}
							if($estado>=5){
								print'<font style="color:#001394"><strong>MOTIVO:</strong></font>'.$r.'';
							}
							?>
				</td>
				<td colspan="1" style="border: 1px solid #001394; color:#001394;">
						 <?php
						 if($estado<=2 and $guia>0){
							 ?>
							 	<font style="background-color: red; color:#001394"><strong>GUIA:</strong></font><?php echo $guia; ?>
							 <?php
						 }
						 if($estado>=5){
								 print'<font style="color:#001394"><strong>DOC-MODIF:</strong></font> '.$rw_cliente1['doc_mod'].'';
						 }
						 ?>
				 </td>
			</tr>
		</table>
		<br>
<?php
}
if($estado==3 or $estado==8){
    if($estado==3 ){
            $tipo2=doc;
    }
    if($estado==8 ){
            $tipo2="COTIZACION";
    }
    ?>
		<table cellspacing="0" style="width: 100%;" border="0">
			<tr>
					 <td style="width: 25%; " height="10" ><img src="<?php echo $logo;?>" width="205" height="100" ></td>
					 <td style="width: 40%; " align="center">
						 <font style="font-size: 14pt;color:#001394;" ><strong><?php echo strtoupper($nombre);?></strong></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($dir);?></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($telf);?></font><br>
						 <font style="font-size: 8pt; color:#001394;"><?php echo strtoupper($correo);?></font>
					 </td>
					 <td style="width: 31%; " height="10" align="center">
						<table cellspacing="0" style="width: 100%; text-align: center; font-size: 12pt; border: 1px solid #001394; ">
						<tr>
							<td align="center" bgcolor="#001394" style="width: 100%; font-size: 10pt;">
								<font style="color:white" size="7"><strong><?php echo PJ;?><?php echo $ruc;?></strong></font>
							</td>
						</tr>
						<tr>
							<td>
								<?php if ($estado==3) {
									?>
									<font style="font-size: 10pt; color: red;"><strong><?php echo strtoupper($tipo2);?></strong></font>
									<?php
							}elseif ($estado==8) {
							?>
							<table cellspacing="0" style="width: 100%; text-align: center; font-size: 8pt; border: 0px solid #001394; ">
								<tr>
									<td  style="width: 10%; border: 0px"></td><td  style="width: 10%; border: 0px"></td>
									<td  style="width: 40%; border: 0px solid solid #001394; font-size: 8pt; color:#001394;font-weight: bold;">CONTRATO</td>
									<td  style="width: 10%; border: 1px solid solid #001394; font-size: 8pt; color:#001394;"></td>
									<td  style="width: 10%; border: 0px"></td><td  style="width: 10%; border: 0px"></td>
								</tr>
								<tr>
									<td style="width: 10%; border: 0px"></td><td style="width: 10%; border: 0px"></td>
									<td style="width: 40%; border: 0px solid solid #001394; font-size: 8pt; color:#001394;font-weight: bold;">PROFORMA</td>
									<td style="width: 10%; border: 1px solid solid #001394; font-size: 8pt; color:#001394;"></td>
									<td style="width: 10%; border: 0px"></td><td style="width: 10%; border: 0px"></td>
								</tr>
							</table>
							<?php
							}
								?>
							</td>
						</tr>
						<tr><td><font style="color:red" size="4"><strong><?php print"$folio-";echo str_pad($rw_cliente1['numero_factura'], 8, "0", STR_PAD_LEFT);?></strong></font></td></tr>

						</table>
					 </td>
				</tr>
		</table>

		<table background-color="#001394" cellspacing="0" border="0" style="width: 100%; text-align: left; font-size: 8pt;">
				<tr>
						<td style="width:100%;"></td>
				</tr>
				<tr bgcolor="#001394">
				<td bgcolor="#001394" align="center" style="border: 1px solid  #001394;"><font style="color:white"><strong><?php echo strtoupper($descripcion);?></strong></font></td>
				</tr>
				<tr>
				<td  align="center" style="border: 1px solid solid #001394;"><font style="color:#001394"><strong>VENTA DE PERFUMES, MEDICAMENTOS, REGALOS, ACCESORIOS</strong></font></td>
				</tr>
		</table>
<br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
        <tr>
            <td style="width:10%;"></td>
            <td style="width:70%;"></td>
            <td style="width:10%;"></td>
						<td style="width:10%;"></td>
        </tr>
                       <?php
                        $dia=date("d",strtotime($rw_cliente1['fecha_factura']));
                        $mes=date("m",strtotime($rw_cliente1['fecha_factura']));
                        $ano=date("Y", strtotime($rw_cliente1['fecha_factura']));
                        $mes2=mes1($mes);
                        $ano1=$ano%1000;
                        ?>
        <tr >
				<td colspan="1" bgcolor="#001394" style="border: 1px solid #001394;"><font style="color:white"><strong>CLIENTE</strong></font></td>
        <td colspan="1" style="border: 1px solid #001394;"><font style="color:#001394"><?php echo $rw_cliente['nombre_cliente'];?></font></td>
				<td colspan="1" bgcolor="#001394" style="border: 1px solid #001394;"><font style="color:white"><strong>FECHA</strong></font></td>
				<td colspan="1" style="border: 1px solid s#001394;"><font style="color:#001394"><?php print" $dia/$mes/$ano";?></font></td>
        </tr>
        <tr>
				<td colspan="1" bgcolor="#001394" style="border: 1px solid #001394;"><font style="color:white"><strong>DIRECCIÓN</strong></font></td>
				<td colspan="1" style="border: 1px solid #001394;"><font style="color:#001394"><strong>  <?php echo strtoupper($rw_cliente['direccion_cliente']);?></strong></font></td>
				<td colspan="1" bgcolor="#001394" style="border: 1px solid #001394;"><font style="color:white"><strong>DNI</strong></font></td>
				<td colspan="1" style="border: 1px solid #001394;"><font style="color:#001394"> <?php echo $rw_cliente['dni'];?></font></td>
        </tr>
    </table>
<br>
<?php
}
?>
<table cellspacing="0" style="width: 100%; text-align: left;border: 1px solid #001394;font-size: 8pt; margin-top: 1px;" >
<tr class="border_bottom">
    <td bgcolor="#001394" style="width: 13%; " align="center"><font style="color:white"><strong>CODIGO.</strong></font></td>
    <td bgcolor="#001394" style="width: 51%; " align="center"><font style="color:white"><strong>DESCRIPCION:</strong></font></td>
    <td bgcolor="#001394" style="width: 8%;  " align="center"><font style="color:white"><strong>MEDIDA</strong></font></td>
    <td bgcolor="#001394" style="width: 8%;  " align="center"><font style="color:white"><strong>CANT.</strong></font></td>
    <td bgcolor="#001394" style="width: 10%; " align="center"><font style="color:white"><strong>PRECIO</strong></font></td>
    <td bgcolor="#001394" style="width: 10%; " align="center"><font style="color:white"><strong>IMPORTE</strong></font></td>
</tr>
<?php
$nums=1;
$sumador_total=0;
$sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
$row1=mysqli_fetch_array($sql1);
$servicio=$row1["servicio"];
$tipo1=$row1["estado_factura"];
$id_cliente=$row1["id_cliente"];
$numero_factura1=$row1["numero_factura"];
if($servicio==0){
$sql=mysqli_query($con, "select * from products, detalle_factura, facturas where products.id_producto=detalle_factura.id_producto and detalle_factura.precio_venta>0 and detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.numero_factura=$numero_factura1 and detalle_factura.tienda=$tienda1 and facturas.ven_com=detalle_factura.ven_com and detalle_factura.tipo_doc='".$tipo1."' and facturas.id_factura='".$id_factura."' and detalle_factura.id_cliente='".$id_cliente."'" );
}else{
 $sql=mysqli_query($con, "select * from detalle_factura, facturas where detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.precio_venta>0 and detalle_factura.numero_factura=$numero_factura1 and detalle_factura.tienda=$tienda1 and facturas.id_factura='".$id_factura."' and detalle_factura.tipo_doc='".$tipo1."' and detalle_factura.id_cliente='".$id_cliente."'" );
}
$suma=0;

$r=1;
while ($row=mysqli_fetch_array($sql))
	{
	$id_producto=$row["id_producto"];

        $tipo=$row["tipo"];
        $codigo_producto="SER";
	$medida="UND";
        if($id_producto>0 and is_numeric($id_producto)){
            $sql2=mysqli_query($con, "select * from products,und where und.id_und=products.und_pro and id_producto='".$id_producto."'");
            $row2=mysqli_fetch_array($sql2);
            $nombre_producto=$row2["nombre_producto"];
            $codigo_producto=$row2["codigo_producto"];
            $medida=$row2["etiqueta"];
        }
        else{
            $nombre_producto=$row['id_producto'];
        }

  $cantidad=$row['cantidad'];
	$precio_venta=$row['precio_venta'];
  $moneda=$row['moneda'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
        if($estado==6 OR $estado==5){
            $num=20;
        }
        if($estado==3 OR $estado==8){
            $num=25;
        }
	if($estado==3 OR $estado==5 OR $estado==6 OR $estado==8){
        if($suma<=$num){
        ?>
        <tr class="border_bottom1">
            <td  style="width: 13%;"  align="center"><?php echo $codigo_producto; ?></td>
            <td  style="width: 45%;"><?php echo $nombre_producto;?> </td>
            <td  style="width: 8%;" align="center"><?php echo $medida;?></td>
            <td  style="width: 8%;"  align="center"><?php echo $cantidad; ?></td>
            <td  style="width: 10%;" align="right"><?php echo $precio_venta_f;?>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</td>
            <td  style="width: 10%;" align="right"><?php echo $precio_total_f;?>&nbsp; </td>
        </tr>
	<?php
        $suma=$suma+1;
        }
        }
        if($estado==1 or $estado==2){
            if($suma<=35){
            ?>
        <tr class="border_bottom1">
            <td style="width: 13%;"  align="center"><?php echo $r; ?></td>
            <td style="width: 45%; "><?php echo $nombre_producto;?> </td>
            <td style="width: 8%;  " align="center"><?php echo $medida;?></td>
            <td style="width: 8%; "  align="center"><?php echo $cantidad; ?></td>
            <td style="width: 10%;" align="right"><?php echo $precio_venta_f;?>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</td>
            <td style="width: 10%;" align="right"><?php echo $precio_total_f;?>&nbsp; </td>
        </tr>
	<?php
        $suma=$suma+1;
        }
        }
        $r=$r+1;
     //fin
	}
        if($estado==3 OR $estado==5 OR $estado==6 OR $estado==8){
        for($i=$suma;$i<=$num;$i++){
        $r1=1;
            if($i==$num){
            $r1=4;
        }
        ?>
        <tr class="border_bottom<?php echo $r1;?>">
            <td>&nbsp;</td>
            <td height="20">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
	<?php
        }
        }
        if($estado==1 or $estado==2){
        for($i=$suma;$i<=35;$i++){
        $r1=1;
            if($i==35){
            $r1=4;
        }
        ?>
        <tr class="border_bottom<?php echo $r1;?>">
            <td>&nbsp;
            </td>
            <td  height="10">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
	<?php
        }
        }
	$subtotal=number_format($sumador_total,2,'.','');
	$total_factura=number_format($sumador_total/(1+iva),2,'.','');
        $igv=number_format(iva*$sumador_total/(1+iva),2,'.','');
        $grav=$total_factura;
        $exo="0.00";
        $ina="0.00";
        if($tipo==1){
            $igv=0;$grav=0;
            $exo=number_format($subtotal,2);
            $ina=0;

        }
        if($tipo==2){
            $igv=0;$grav=0;
            $exo=number_format(0,2);
            $ina=number_format($subtotal,2);

        }
        $mon=moneda;
        $mo1=moneda;
        $mon2=moneda;
        if($estado<=2 or $estado==5 or $estado==6){
            $decimales = explode(".",number_format($subtotal,2));
            $entera=explode(".",$subtotal);
            $texto=convertir($entera[0]).' y '. $decimales[1].'/100 '.$mo1;
           ?>



	<tr>
			<td> </td><td> </td><td> </td><td> </td><td  id="border_bottom2"> OP. GRAV:</td>
			<td id="border_bottom2" align="right"> <?php print"$mon2 ";echo number_format($grav,2);?>&nbsp; </td>
	</tr>

	<tr>
			<td > </td><td > </td><td> </td><td> </td><td  id="border_bottom2">IGV <?php echo 100*iva;?>%:</td>
			<td id="border_bottom2" align="right"> <?php print"$mon2";echo number_format($igv,2);?>&nbsp; </td>
	</tr>

	<tr>
			<td > </td><td > </td><td> </td><td> </td><td  id="border_bottom2">EXON:</td>
			<td id="border_bottom2" align="right"> <?php print"$mon2";echo $exo;?>&nbsp; </td>
	</tr>

	<tr>
			<td > </td><td > </td><td> </td><td> </td><td  id="border_bottom2">INA:</td>
			<td id="border_bottom2" align="right"> <?php print"$mon2";echo $ina;?>&nbsp; </td>
	</tr>


	<tr >
			<td  bgcolor="#001394" id="border_bottom21" colspan="4" height="10" ><font><strong>SON:</strong><?php echo $texto;?></font></td>
			<td  bgcolor="#001394" id="border_bottom21"> TOTAL:</td><td bgcolor="#001394" id="border_bottom21" align="right"><?php print"$mon2";echo number_format($subtotal,2);?>&nbsp; </td>
	</tr>

        <?php
        }
        if($estado==3 or $estado==8){
        ?>

      <br><br><br>
        <tr>
            <td ></td><td ></td><td ></td><td> </td><td align="center" id="border_bottom2"> TOTAL:</td>
            <td id="border_bottom3" align="center"><?php print"$mon2";echo number_format($subtotal,2);?></td>
        </tr>
        <?php
        }
        if($estado==1 or $estado==2 or $estado==5 or $estado==6){
        ?>
        <tr>
            <td colspan="4" style="color: #001394"><br><br><br>Representación Impresa de la <?php echo $tipo2;?>, Autorizado Mediante<br>
               Resolución de Intendencia Nº 034-005-0005315 <br>Para Consultar el Comprobante Sirvase Ingresar a: www.sunat.com<br><br>
               HASH:&nbsp;&nbsp;&nbsp;<?php echo $rw_cliente1['cod_hash'];?>
            </td><td align="right" colspan="2"><br><img src="qr/<?php echo $id_factura;?>.png" width="90" height="90" style="color: #001394;"></td><td colspan="2"></td>
        </tr>
        <?php
        }
				if($estado==8){
        ?>
				<tr>
						<td colspan="6" ></td>
				</tr>
				<tr>
						<td colspan="1" style="border: 1px solid #001394; color: white;" bgcolor="#001394">A cuenta S/:</td>
						<td colspan="2" style="border: 1px solid #001394;"></td>
						<td colspan="1" style="border: 1px solid #001394; color: white;" bgcolor="#001394">Saldo S/:</td>
						<td colspan="2" style="border: 1px solid #001394;"></td>

				</tr>
				<tr>
						<td colspan="3" style="border: 1px solid #001394; color: #001394;">PLAZO DE ENTREGA..INCLUIDO IGV </td>
						<td colspan="1" style="border: 1px solid #001394; color: #fff;" bgcolor="#001394">INCLUIDO IGV </td>
						<td align="center" colspan="1" style="border: 1px solid #001394; color: #001394;">Si</td>
						<td align="center" colspan="1" style="border: 1px solid #001394; color: #001394;">No</td>
				</tr>
				<tr>
						<td colspan="6" >
							<fieldset style="height: 30px; border: 0px;position: relative;">
								<legend style=" border: 0px; color: red;">Observaciones:</legend>
								</fieldset>
						</td>

				</tr>
				<?php
        }
        ?>
    </table>
<br>

</page>
<?php
//}
function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
}
case 6:
{
$numu = "SEIS";
break;
}
case 5:
{
$numu = "CINCO";
break;
}
case 4:
{
$numu = "CUATRO";
break;
}
case 3:
{
$numu = "TRES";
break;
}
case 2:
{
$numu = "DOS";
break;
}
case 1:
{
$numu = "UN";
break;
}
case 0:
{
$numu = "";
break;
}
}
return $numu;
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".(unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".(unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".(unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".(unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".(unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".(unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".(unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".(unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
}
}
else
$numd = unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.(decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.(decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.(decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.(decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.(decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.(decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.(decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.(decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".(decena($numc - 100));
}
}
else
$numce = decena($numc);

return $numce;
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".(centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
}
if ($nummero < 1000)
$numm = centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
}
if ($numdmero < 10000)
$numde = miles($numdmero);

return $numde;
}

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
}
if ($numcmero < 100000)
$num_letracm = decmiles($numcmero);
return $num_letracm;
}

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = cienmiles($nummiero);

return $num_letramm;
}

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
}
if ($numerodm < 10000000)
$num_letradmm = millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
}
if ($numcmeros < 100000000)
$num_letracms = decmillon($numcmeros);
return $num_letracms;
}

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = cienmillon($nummierod);

return $num_letrammd;
}


function convertir($numero){
$numf = milmillon($numero);
return $numf;
}

function mes1($texto)
{
  if($texto=='01') {

    return "enero";
}elseif($texto=='02'){
    return "febrero";
}elseif($texto=='03'){
    return "marzo";
}elseif($texto=='04'){
    return "abril";
}elseif($texto=='05'){
    return "mayo";
}elseif($texto=='06'){
    return "junio";
}elseif($texto=='07'){
    return "julio";
}elseif($texto=='08'){
    return "agosto";
}elseif($texto=='09'){
    return "setiembre";
}elseif($texto=='10'){
    return "octubre";
}elseif($texto=='11'){
    return "noviembre";
}elseif($texto=='12'){
    return "diciembre";
}


}

?>
