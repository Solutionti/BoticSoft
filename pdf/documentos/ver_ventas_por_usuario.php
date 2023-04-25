<?php
$fecha_vendedor=$_GET['fecha'];
$sucursal_vendedor=$_GET['sucursal'];
$vendedor_vendedor=$_GET['vendedor'];

$anio = date("Y", strtotime($fecha_vendedor));
$mes = date("m", strtotime($fecha_vendedor));
$dia = date("d", strtotime($fecha_vendedor));

$fecha_inicial=($anio.'-'.$mes.'-'.$dia.' 00:00:00');
$fecha_final=($anio.'-'.$mes.'-'.$dia.' 23:59:00');

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
   include(dirname('__FILE__').'/res/ver_ventas_html.php');
  $content = ob_get_clean();

  try
  {
      // init HTML2PDF
      $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
      // display the full page
      $html2pdf->pdf->SetDisplayMode('fullpage');
      // convert
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      // send the PDF
      $html2pdf->Output('Ventas_users.pdf');
      //Header("Content-type: application/pdf");
      //Header("Content-Disposition: attachment; filename=Factura.pdf");
      readfile("Ventas_users.pdf");
      //unlink("Factura.pdf");
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
