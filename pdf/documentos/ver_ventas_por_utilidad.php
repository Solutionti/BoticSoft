<?php
date_default_timezone_set("America/Lima");

$fecha_inicio=$_GET['fechainicio'];
$fecha_finall=$_GET['fechafinal'];

$sucursal_vendedor=$_GET['sucursal'];
$vendedor_vendedor=$_GET['vendedor'];

$anio = date("Y", strtotime($fecha_inicio));
$mes = date("m", strtotime($fecha_inicio));
$dia = date("d", strtotime($fecha_inicio));

$anio2 = date("Y", strtotime($fecha_finall));
$mes2 = date("m", strtotime($fecha_finall));
$dia2 = date("d", strtotime($fecha_finall));

$fecha_inicial=($anio.'-'.$mes.'-'.$dia.' 00:00:00');
$fecha_final=($anio2.'-'.$mes2.'-'.$dia2.' 23:59:00');

session_start();
include("../../config/db.php");
include("../../config/conexion.php");
$sql_count=mysqli_query($con,"SELECT * FROM detalle_factura WHERE id_vendedor='".$vendedor_vendedor."' AND tienda='".$sucursal_vendedor."' AND fecha>='".$fecha_inicial."' AND fecha<='".$fecha_final."'");
$count=mysqli_num_rows($sql_count);
if ($count==0)
{
echo "<script>alert('venta no encontrada')</script>";
echo "<script>window.close();</script>";
exit;
}


require_once(dirname(__FILE__).'/../html2pdf.class.php');
  // get the HTML
   ob_start();
   include(dirname('__FILE__').'/res/ver_utilidad_html.php');
  $content = ob_get_clean();

  try
  {
      // init HTML2PDF
      $html2pdf = new HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
      // display the full page
      $html2pdf->pdf->SetDisplayMode('fullpage');
      // convert
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      // send the PDF
      ob_end_clean();
      $html2pdf->Output('Reportes_ventas_y_utilidades.pdf');
      //Header("Content-type: application/pdf");
      //Header("Content-Disposition: attachment; filename=Factura.pdf");
      readfile("Reportes_ventas_y_utilidades.pdf");
      //unlink("Factura.pdf");
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
