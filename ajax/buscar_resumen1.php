<?php
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
        function generar_numero_aleatorio($longitud) {
            $key = '';
            $pattern = '1234567890';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }
        $mon=moneda;
        
        $tienda=$_SESSION['tienda'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
	$query1=mysqli_query($con, "select * from datosempresa where id_emp=1");
        $row1=mysqli_fetch_array($query1);
        $alerta=$row1['alerta'];
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
        $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
        $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
        //print"$q2";
        
        $q4 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
        //$dd1=$ano1."-".$mes1."-".$dia1;
        
        $dd1=date("Y/m/d", strtotime($q2));
        $dd2=date("Y/m/d", strtotime($q3));
        $fech1=strtotime($dd1);
        $fech2=strtotime($dd2); 
        $f1=$fech1/(24*3600);
        $f2=$fech2/(24*3600);
        
        if($q4==">=1"){
            $tienda=$q4; 
        }else{
            $tienda="=$q4"; 
        }
        
        
        
        $dato=array();
$dato1=array();
$dato2=array();
$dato3=array();
$dato4=array();

$a=array();
$a1=array();
$a2=array();
$a3=array();


$j=0;
$text="";
$text1="";
$text2="";
if($q4==">=1"){
   $tienda=$q4; 
}else{
   $tienda="=$q4"; 
}
$j=0;
$anio=2021;
 for($i=$f1;$i<=$f2;$i++){
     $fec[$j]=date('Y-m-d', $i*24*3600);
     
     
    $suma= mysqli_query($con, "SELECT SUM(total_venta) AS total FROM facturas  where estado_factura<=3 and activo=1 and ven_com=1 and tienda$tienda and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' )");
    $row= mysqli_fetch_array($suma);
    $dato[$j] = $row['total'];
    //print"<br>";
    //echo $row['total'];
     
    $suma1= mysqli_query($con, "SELECT SUM(total_venta) AS total1 FROM facturas  where estado_factura<=3 and activo=1 and ven_com=2 and tienda$tienda and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' )");
    $row1= mysqli_fetch_array($suma1);
    $dato1[$j] = $row1['total1']; 
   //  print"<br>";
   // echo $row1['total1'];
    
    $suma2= mysqli_query($con, "SELECT SUM(total_venta) AS total2 FROM facturas  where estado_factura<=3 and activo=1 and ((ven_com=1 and estado_factura<=3 and condiciones<>4) or (ven_com=5) or (ven_com=3) or (ven_com=1 and estado_factura=5)) and tienda$tienda and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' )");
    $row2= mysqli_fetch_array($suma2);
    $dato2[$j] = $row2['total2']; 
  // print"<br>";
    //echo $row2['total2'];  //}
    $suma3= mysqli_query($con, "SELECT SUM(total_venta) AS total3 FROM facturas  where estado_factura<=3 and activo=1 and ((ven_com=2 and estado_factura<=3 and condiciones<>4) or (ven_com=6) or (ven_com=4) or (ven_com=1 and estado_factura=6)) and tienda$tienda and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' )");
    $row3= mysqli_fetch_array($suma3);
    $dato3[$j] = $row3['total3']; 
    
    if($row['total']=="NULL"){
        $dato1[$j]=0;
    }
    if($row1['total']=="NULL"){
        $dato2[$j]=0;
    }
    if($row2['total']=="NULL"){
        $dato3[$j]=0;
    }
    if($row3['total']=="NULL"){
        $dato4[$j]=0;
    }
     $j=$j+1;
}
$j1=1;        
for($i=1;$i<=12;$i++)
{
        
    $suma= mysqli_query($con, "SELECT SUM(total_venta) AS total FROM facturas  where estado_factura<=3 and activo=1 and ven_com=1 and tienda$tienda and MONTH(fecha_factura)=$i and YEAR(fecha_factura)=$anio");
    
    //print"SELECT SUM(total_venta) AS total FROM facturas  where estado_factura<=3 and activo=1 and ven_com=1 and tienda$tienda and MONTH(fecha_factura)=$i and YEAR(fecha_factura)=$anio )";
    $row= mysqli_fetch_array($suma);
    $a[$j1] = $row['total'];
     
    $suma1= mysqli_query($con, "SELECT SUM(total_venta) AS total1 FROM facturas  where estado_factura<=3 and activo=1 and ven_com=2 and tienda$tienda and MONTH(fecha_factura)=$i and YEAR(fecha_factura)=$anio");
    $row1= mysqli_fetch_array($suma1);
    $a1[$j1] = $row1['total1']; 
     
    $suma2= mysqli_query($con, "SELECT SUM(total_venta) AS total2 FROM facturas  where estado_factura<=3 and activo=1 and ((ven_com=1 and estado_factura<=3 and condiciones<>4) or (ven_com=5) or (ven_com=3) or (ven_com=1 and estado_factura=5)) and tienda$tienda and MONTH(fecha_factura)=$i and YEAR(fecha_factura)=$anio");
    $row2= mysqli_fetch_array($suma2);
    $a2[$j1] = $row2['total2']; 
     //}
    $suma3= mysqli_query($con, "SELECT SUM(total_venta) AS total3 FROM facturas  where estado_factura<=3 and activo=1 and ((ven_com=2 and estado_factura<=3 and condiciones<>4) or (ven_com=6) or (ven_com=4) or (ven_com=1 and estado_factura=6)) and tienda$tienda and MONTH(fecha_factura)=$i and YEAR(fecha_factura)=$anio");
    $row3= mysqli_fetch_array($suma3);
    $a3[$j1] = $row3['total3']; 
    $j1=$j1+1;
}

?>
     <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p style="color:#045FB4;"> <strong>Grafica de barras Ventas y Compras (Últimos 10 días)</strong></p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  <div id="graph_bar_group1" style="width:100%; height:280px;"></div>
                  
                  
                </div>
              </div>
            </div>

               <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p style="color:#045FB4;"> <strong>Grafica de barras Entradas y Salidas (Últimos 10 días)</strong></p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
             
              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p style="color:#DF3A01;"> <strong>Grafica de barras Ventas y Compras (Últimos Meses)</strong></p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group2" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
              
              
              
               <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                    
                    <p style="color:#DF3A01;"> <strong>Grafica de barras Entradas y Salidas (Últimos Meses)</strong></p>
                  
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  
                  
                  <div id="graph_bar_group3" style="width:100%; height:280px;"></div>
                </div>
              </div>
            </div>
      </div>    
           

  <?php
  
 }

?>   
     
<script>

$(function () {

    var day_data = [
        
        <?php
                    for($i = 0;$i<=$j-1;$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Entradas": <?php print"$dato2[$i]";?>, "Salidas": <?php print"$dato3[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group',
        data: day_data,
        xkey: 'period',
        barColors: ['#04B431', 'orange', '#ACADAC', 'orange'],
        ykeys: ['Entradas', 'Salidas'],
        labels: ['Entradas', 'Salidas'],
        hideHover: 'auto',
        xLabelAngle: 60
    });

 

});
    $(function () {

   
    var day_data1 = [
        
        <?php
                    for($i = 0;$i<=$j-1;$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Ventas": <?php print"1";?>, "Compras": <?php print"$dato1[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group1',
        data: day_data1,
        xkey: 'period',
        barColors: ['#0000FF', '#FF0000', '#ACADAC', '#3498DB'],
        ykeys: ['Ventas', 'Compras'],
        labels: ['Ventas', 'Compras'],
        hideHover: 'auto',
        xLabelAngle: 60
    });



var day_data2 = [
        
        <?php
                    for($i = 1;$i<=12;$i++){
                ?>
                {"period": "<?php print"$i";?>", "Entradas": <?php print"$a2[$i]";?>, "Salidas": <?php print"$a3[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group3',
        data: day_data2,
        xkey: 'period',
        barColors: ['#04B431', 'orange', '#ACADAC', 'orange'],
        ykeys: ['Entradas', 'Salidas'],
        labels: ['Entradas', 'Salidas'],
        hideHover: 'auto',
        xLabelAngle: 60
    });
    
    
    var day_data3 = [
        
        <?php
                    for($i = 1;$i<=12;$i++){
                ?>
                {"period": "<?php print"$i";?>", "Ventas": <?php print"$a[$i]";?>, "Compras": <?php print"$a1[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Bar({
        element: 'graph_bar_group2',
        data: day_data3,
        xkey: 'period',
        barColors: ['#0000FF', '#FF0000', '#ACADAC', '#3498DB'],
        ykeys: ['Ventas', 'Compras'],
        labels: ['Ventas', 'Compras'],
        hideHover: 'auto',
        xLabelAngle: 60
    });
 

});


</script>
     
