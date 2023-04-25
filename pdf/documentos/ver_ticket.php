<?php
error_reporting(0);
ob_start();
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
	/* Connect To Database*/
	include("../../config/db.php");
	include("../../config/conexion.php");
	$id_factura= intval($_GET['id_factura']);

	$sql_count=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Factura no encontrada')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql_factura=mysqli_query($con,"select * from facturas where id_factura='".$id_factura."'");
	$rw_factura=mysqli_fetch_array($sql_factura);
	$numero_factura=$rw_factura['numero_factura'];
        $folio=$rw_factura['folio'];

	$id_cliente=$rw_factura['id_cliente'];
	$id_vendedor=$rw_factura['id_vendedor'];
	$fecha_factura=$rw_factura['fecha_factura'];
	$condiciones=$rw_factura['condiciones'];
        $moneda=$rw_factura['moneda'];
        $obs=$rw_factura['obs'];
        $estado=$rw_factura['estado_factura'];
        if($estado==1){
            $doc="Factura electronica";
        }
        if($estado==2){
            $doc="Boleta de Venta Electronica";
        }
        if($estado==3){
            $doc=doc;
        }
        if($estado==5){
            $doc="Nota de Debito Electronico";
        }
        if($estado==6){
            $doc="Nota de Credito Electronico";
        }
        if($estado==8){
            $doc="Cotizacion";
        }
        $total=$rw_factura['total_venta'];
        $deuda=$rw_factura['deuda_total'];
        $acuenta=$total-$deuda;

        $tienda2=$rw_factura['tienda'];

        if($condiciones==1){
            $condiciones1="Efectivo";
        }
        if($condiciones==2){
            $condiciones1="Cheque";
        }
        if($condiciones==3){
            $condiciones1="Transferencia Bancaria";
        }
        if($condiciones==4){
            $condiciones1="Credito";
        }

        $sql11="select * from users where user_id=$_SESSION[user_id]";
        $rw11=mysqli_query($con,$sql11);//recuperando el registro
        $rs11=mysqli_fetch_array($rw11);//trasformar el registro en un vector asociativo
        $suc=$rs11['sucursal'];

        $sql31="select * from sucursal where id_sucursal='".$suc."'";
        $rw31=mysqli_query($con,$sql31);//recuperando el registro
        $rs31=mysqli_fetch_array($rw31);//trasformar el registro en un vector asociativo
        $sucursal_actual=$rs31['tienda'];


        $tienda1=$sucursal_actual;
	//require_once(dirname(__FILE__).'/../html2pdf.class.php');


        $sql_factura1=mysqli_query($con,"select * from guia where id_doc='".$id_factura."'");
        $rw_factura1=mysqli_fetch_array($sql_factura1);
        $guia=$rw_factura1['guia'];

        $sql_factura2=mysqli_query($con,"select * from sucursal where tienda='".$tienda1."'");
        $rw_factura2=mysqli_fetch_array($sql_factura2);
        $logo=$rw_factura2['foto'];
        $dir=$rw_factura2['direccion'];
        $nombre=$rw_factura2['nombre'];
        $ruc=$rw_factura2['ruc'];
        $correo=$rw_factura2['correo'];

if($tienda1==$tienda2){
    $sql_cliente=mysqli_query($con,"select * from clientes where id_cliente='$id_cliente'");
    $rw_cliente=mysqli_fetch_array($sql_cliente);
    if($rw_cliente['doc']>0){
        $doc1=$rw_cliente['doc'];
        $tipo_doc=PJ;
    }
    if($rw_cliente['dni']>0){
        $doc1=$rw_cliente['dni'];
        $tipo_doc=PN;
    }
    $sql_cliente1=mysqli_query($con,"select * from facturas where id_factura='$id_factura'");
    $rw_cliente1=mysqli_fetch_array($sql_cliente1);

    $sql_vendedor=mysqli_query($con,"select * from users where user_id='$id_vendedor'");
    $rw_vendedor=mysqli_fetch_array($sql_vendedor);
    $vendedor=$rw_vendedor['nombres'];

    ?>


   <html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="ticket.css" rel="stylesheet" type="text/css">
<script>
    function printPantalla()
{
   document.getElementById('cuerpoPagina').style.marginRight  = "0";
   document.getElementById('cuerpoPagina').style.marginTop = "1";
   document.getElementById('cuerpoPagina').style.marginLeft = "1";
   document.getElementById('cuerpoPagina').style.marginBottom = "0";
   document.getElementById('botonPrint').style.display = "none";
   window.print();
}
</script>
</head>
<style>
@media print {
    @page { margin: 0px;
     size: auto; }
}
</style>
<body id="cuerpoPagina">

<div class="zona_impresion">
        <!-- codigo imprimir -->
<br>
<table border="0" align="center" width="315px" style="font-size:15pt;color:black;">
     <tr>
        <td align="center">
            <img src="<?php echo $logo;?>" width="190" height="60">
       </td>
    </tr>
    <tr>
        <td align="center">
            <font size="3"><strong> <?php echo $nombre; ?></strong></font><br>
        RUC: <?php echo $ruc; ?><br>
        <font size="1"><?php echo $dir; ?></font>
       </td>
    </tr>
    <tr>
        <td align="center">
            <strong><font size="3"><?php echo $doc; ?></font></strong><br>

            <font size="3"><?php $numero_factura2=str_pad($numero_factura, 8, "0", STR_PAD_LEFT);print"$folio-$numero_factura2"; ?></font>


       </td>
    </tr>
   <tr>
        <td>VENDEDOR: <?php echo strtoupper($vendedor); ?></td>
    </tr>

    <tr>
      <td>-----------------------------------------------------------------------------</td>
    </tr>
    <tr>
        <td><?php echo "FECHA EMISIÓN:".date("d/m/Y H:i", strtotime($fecha_factura)); ?> </td>
    </tr>
    <tr>
        <td>CLIENTE: <?php echo $rw_cliente['nombre_cliente']; ?></td>
    </tr>
    <tr>
        <td>DIRECCIÓN: <?php echo $rw_cliente['direccion_cliente']; ?></td>
    </tr>
     <tr>
        <td><?php echo $tipo_doc; ?>: <?php echo $doc1; ?></td>
    </tr>
     <?php
    if($obs<>""){


     ?>
        <tr>
        <td>OBS: <?php echo $obs; ?></td>
    </tr>
    <?php


    }

    if($estado==6 or $estado==5){
        print"<tr><td>Documento modifica: $rw_factura[doc_mod]</td></tr>";
    }


     $motivo=$rw_factura['motivo'];
     $r="";
    if($estado==6){
        if($motivo=="01") {
        $r="ANULACION DE LA OPERACION";
        }
        if($motivo=="02") {
        $r="ANULACION POR ERROR EN EL RUC";
        }
        if($motivo=="03") {
        $r="CORRECION POR ERROR EN LA DESCRIPCION";
        }
        if($motivo=="04") {
        $r="DESCUENTO GLOBAL";
        }
        if($motivo=="05") {
        $r="DESCUENTO POR ITEM";
        }
        if($motivo=="06") {
        $r="DEVOLUCION TOTAL";
        }
        if($motivo=="07") {
        $r="DEVOLUCION POR ITEM";
        }
        if($motivo=="08") {
            $r="BONIFICACION";
        }
        if($motivo=="09") {
        $r="DISMINUCION EN EL VALOR";
        }
    }
    if($estado==5){
        if($motivo=="01") {
           $r="INTERES POR MORA";
        }
        if($motivo=="02") {
           $r="AUMENTO EN EL VALOR";
        }
        if($motivo=="03") {
            $r="PENALIDADES";
        }
    }


    if($estado==6 or $estado==5){
        print"<tr><td>Motivo: $r</td></tr>";
    }

    ?>
</table>

<table border="0" align="center" width="315px" style="font-size:15pt;color:black;">
    <tr>
      <td colspan="4">-----------------------------------------------------------------------------</td>
    </tr>
    <tr>


        <td style="width:15%;" align="center"><strong><font size="2">CANT.</font></strong></td>
        <td style="width:60%;"><strong><font size="2">DESCRIPCIÓN.</font></strong></td>
        <td style="width:10%;"><strong><font size="2">P.V.P</font></strong></td>
        <td align="right" style="width:15%;"><strong><font size="2">IMPORT.</font></strong></td>
    </tr>
    <tr>
      <td colspan="4">-----------------------------------------------------------------------------</td>
    </tr>

<?php
$nums=1;
$sumador_total=0;
$sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
$row1=mysqli_fetch_array($sql1);
$servicio=$row1["servicio"];
$tipo1=$row1["estado_factura"];
$id_cliente=$row1["id_cliente"];

if(empty($row1["pago_efectivo"]) or $row1["pago_efectivo"]==0){
$pago_con_efectivo=0;
}else {
$pago_con_efectivo=$row1["pago_efectivo"];
}


$numero_factura1=$row1["numero_factura"];
if($servicio==1){
$sql=mysqli_query($con, "select * from detalle_factura, facturas where  detalle_factura.numero_factura=facturas.numero_factura and detalle_factura.numero_factura=$numero_factura1 and detalle_factura.tienda=$suc and facturas.ven_com=detalle_factura.ven_com and detalle_factura.tipo_doc='".$tipo1."' and facturas.id_factura='".$id_factura."' and detalle_factura.id_cliente='".$id_cliente."'" );
}
$suma=0;
$codigo_producto="";
while ($row=mysqli_fetch_array($sql))
	{
	$id_producto=$row["id_producto"];
        $cantidad1=$row['cantidad'];
        $tipo=$row['tipo'];
        $id_producto1=$row['id_producto'];
        $inv_ini=$row['inv_ini'];
        if($id_producto>0 and is_numeric($id_producto)){
            $sql2=mysqli_query($con, "select * from products where id_producto='".$id_producto1."'");
            $row2=mysqli_fetch_array($sql2);
            $nombre_producto=$row2["nombre_producto"];

        }
        else{
            $nombre_producto=$row['id_producto'];
        }


	$precio_venta=$row['precio_venta'];
	$precio_venta_f=number_format($precio_venta,3);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad1;
	$precio_total_f=number_format($precio_total,3);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	echo "<tr>";

        echo "<td align=center>".round($cantidad1,3)."</td>";
        echo "<td>".$nombre_producto."</td>";
        echo "<td>".$precio_venta."</td>";
        echo "<td align='right'>". $precio_total_f."</td>";
        echo "</tr>";
        $suma=$suma+1;


	}

         if($estado<=2 or $estado==5 or $estado==6){


        ?>
    <tr>
      <td colspan="4">-----------------------------------------------------------------------------</td>
    </tr>
     <tr>



    <td align="right" colspan="3"><b>OP. GRAV <?php echo moneda;?>:</b></td>
    <td align="right"><b>  <?php
    if($tipo==0){
      echo $op_gravada=number_format($sumador_total/(1.+iva),3,'.','');
    }
    if($tipo==1){
      echo $op_gravada="0.00";
    }
    if($tipo==2){
      echo $op_gravada="0.00";
    }
      ?></b></td>
    </tr>
    <tr>


    <td align="right" colspan="3"><b><?php echo nom_iva; ?> (<?php echo iva*100; ?>)% <?php echo moneda;?>:  </b></td>
    <td align="right"><b>
    <?php
    if($tipo==0){
        echo $sumaigv=number_format(iva*($sumador_total/(1+iva)),3,'.','');
    }
    if($tipo==1){
        echo $sumaigv="0.00";
    }
    if($tipo==2){
        echo $sumaigv="0.00";
    }
    ?>
        </b></td>
    </tr>
    <tr>


    <td align="right" colspan="3"><b>EXO <?php echo moneda;?>:</b></td>
    <td align="right"><b>
    <?php
    if($tipo==1){
        echo number_format($sumador_total,3,'.','');
    }
    if($tipo==0){
        echo "0.00";
    }
    if($tipo==2){
        echo "0.00";
    }
    ?>
        </b></td>
    </tr>
    <tr>


    <td align="right" colspan="3"><b>INA <?php echo moneda;?>:</b></td>
    <td align="right"><b>
    <?php
    if($tipo==1){
        echo "0.00";
    }
    if($tipo==0){
        echo "0.00";
    }
    if($tipo==2){
        echo number_format($sumador_total,2,'.','');
    }
    ?>
        </b></td>
    </tr>
    <?php }

    ?>

     <tr>


    <td align="right" colspan="3"><b>TOTAL <?php echo moneda;?>:</b></td>
    <td align="right"><b>  <?php echo $subtotal=number_format($sumador_total,2,'.','');  ?></b></td>
    </tr>
    <tr>
      <td colspan="4">-----------------------------------------------------------------------------</td>
    </tr>
    <tr>
   <td align="right" colspan="3"><b>PAGO EN EFECTIVO. <?php echo moneda;?>:</b></td>
   <td align="right"><b>  <?php echo $P_efec=number_format($pago_con_efectivo,2,'.','');  ?></b></td>
   </tr>

   <tr>
  <td align="right" colspan="3"><b>CAMBIO <?php echo moneda;?>:</b></td>
  <td align="right"><b>  <?php  if($pago_con_efectivo > 0){echo $camb=number_format(($pago_con_efectivo - $sumador_total),2,'.',''); }else { echo $camb=number_format((0),2,'.','');}   ?></b></td>
  </tr>
    <tr>
      <td colspan="4">-----------------------------------------------------------------------------</td>
    </tr>


    <?php

    if($estado<=2 or $estado==5 or $estado==6){
    ?>
    <tr>
        <td colspan="4" align="center">
            <?php
            $decimales = explode(".",number_format($sumador_total,2));
            $entera=explode(".",$sumador_total);
            $texto=convertir($entera[0]).' CON '. $decimales[1].'/100 SOLES';
            ?>
            SON: <?php echo $texto;?>
        </td>
    </tr>

    <tr>
    <td colspan="4" align="center"><?php echo $rw_factura['cod_hash'];?>
        <br><img src="qr/<?php echo $id_factura;?>.png" width="120" height="120"></td>

    </tr>
     <tr>

    <td colspan="4" align="center">Autorizado mediante Resolución de Intendencia N° 032-
            005 Representación impresa de la <?php echo $doc;?>.
            Consulte su documento electrónico en: <br><span style="font-size: 14px">http://sunat.com.pe</span>
    </td>
    </tr>

    <?php
    }

    ?>

    <tr>
      <td colspan="4"><br>Nº de artículos: <?php echo $suma ?></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <?php
if ($estado==3) {
  ?>
  <tr>
    <td colspan="4" align="center">
      <strong><font size="2">¡Revise su producto y dinero antes de retirarse del local !</font></strong><br>
      No hay devolucion ni cambios de billetes <br>
      <strong><font size="2">¡Canjear por boleta de venta!</font></strong><br>
      Todo reclamo posterior a 7 dias, es presentando este boleto <br>
      <strong><font size="2">¡Gracias por su compra, que Dios lo bendiga!</font></strong>
    </td>
  </tr>
  <?php
}
     ?>



</table>
<br>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>

<div style="margin-left:245px;"><a href="#" id="botonPrint" onClick="printPantalla();"><img src="printer.png" border="0" style="cursor:pointer" title="Imprimir"></a></div>
</body>
</html>

<?php

}

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
ob_end_flush();
?>
