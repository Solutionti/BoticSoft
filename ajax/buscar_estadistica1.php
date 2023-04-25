<?php
	include('is_logged.php');
?>
<style>
.dt-button.red {
        color: black;
        
        background:red;
    }
 
    .dt-button.orange {
        color: black;
        background:orange;
    }
 
    .dt-button.green {
        color: black;
        background:green;
    }
    
    .dt-button.green1 {
        color: black;
        background:#01DFA5;
    }
    
    .dt-button.green2 {
        color: black;
        background:#2E9AFE;
    } 
</style>    
<?php
        
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
        $q4 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
        //$dd1=$ano1."-".$mes1."-".$dia1;
        
        if($q==1){
            $r1="SELECT nombres,";
            $r2="FROM users, facturas WHERE users.user_id=facturas.id_vendedor GROUP BY nombres";
            $r3="nombres";
            $r4="Vendedores";
           
        }
        if($q==2){
            $r1="SELECT nombre_cliente,";
            $r2="FROM clientes, facturas WHERE clientes.id_cliente=facturas.id_cliente GROUP BY nombre_cliente";
            $r3="nombre_cliente";
            $r4="Clientes/Proveedores";
        }
        if($q==3){
            $r1="SELECT nombre_producto,";
            $r2="FROM products, detalle_factura WHERE products.id_producto=detalle_factura.id_producto GROUP BY nombre_producto";
            $r3="nombre_producto";
            $r4="Producto";
        }
        
        if($q1==1){
            $r5="Ventas por día";
            $r6="Ventas";
           
        }
        if($q1==2){
            $r5="Compras por día";
            $r6="Compras";
           
        }
        
        $dd1=date("Y/m/d", strtotime($q2));
        $dd2=date("Y/m/d", strtotime($q3));
        $fech1=strtotime($dd1);
        $fech2=strtotime($dd2); 
        $f1=$fech1/(24*3600);
$f2=$fech2/(24*3600);

//print"$f1 $f2";
$fech=array();
$fech1=array();

$dato=array();
$dato1=array();
$dato2=array();

$j=0;
$text="";
$text1="";
$text2="";
if($q4==">=1"){
   $tienda=$q4; 
}else{
   $tienda="=$q4"; 
}
$anio=$q3;
 //for($i=$f1;$i<=$f2;$i++){
     //$fec[$j]=date('Y-m-d', $i*24*3600);
     //$fec1[$j]=date('d-m-Y', $i*24*3600);
     
     
     if($q==1 or $q==2){
         $text="SUM(IF(MONTH(fecha_factura)=1 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes1,
SUM(IF(MONTH(fecha_factura)=2 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes2,
SUM(IF(MONTH(fecha_factura)=3 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes3,
SUM(IF(MONTH(fecha_factura)=4 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes4,
SUM(IF(MONTH(fecha_factura)=5 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes5,
SUM(IF(MONTH(fecha_factura)=6 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes6,
SUM(IF(MONTH(fecha_factura)=7 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes7,
SUM(IF(MONTH(fecha_factura)=8 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes8,
SUM(IF(MONTH(fecha_factura)=9 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes9,
SUM(IF(MONTH(fecha_factura)=10 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes10,
SUM(IF(MONTH(fecha_factura)=11 and YEAR(fecha_factura)=$anio and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes11,
SUM(IF(MONTH(fecha_factura)=12 and YEAR(fecha_factura)=$anio  and ven_com=$q1 and estado_factura<=3 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS mes12";
         
         
         
     }
     if($q==3){
     $text="SUM(IF(MONTH(fecha)=1 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes1,
SUM(IF(MONTH(fecha)=2 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes2,
SUM(IF(MONTH(fecha)=3 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes3,
SUM(IF(MONTH(fecha)=4 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes4,
SUM(IF(MONTH(fecha)=5 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes5,
SUM(IF(MONTH(fecha)=6 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes6,
SUM(IF(MONTH(fecha)=7 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes7,
SUM(IF(MONTH(fecha)=8 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes8,
SUM(IF(MONTH(fecha)=9 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes9,
SUM(IF(MONTH(fecha)=10 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes10,
SUM(IF(MONTH(fecha)=11 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes11,
SUM(IF(MONTH(fecha)=12 and YEAR(fecha)=$anio and ven_com=$q1 and activo=1 and tipo_doc<=3 and detalle_factura.tienda$tienda,cantidad*precio_venta,0)) AS mes12
";
         
         
     }
     //$j=$j+1;
//}
$sql="$r1
$text
$r2";
//print"$sql";
$rs1=mysqli_query($con,$sql);
//$j=0;
$suma6=0;

for($i=1;$i<=12;$i++){
                         
        $dato[$i]=0; 
        
        
       
        
    } 

//$suma5=0;
$j=0;
while($row1=mysqli_fetch_array($rs1)){
    for($i=1;$i<=12;$i++){
         $mes="mes$i";                   
        $dato[$i]=$dato[$i]+$row1[$mes]; 
        if($dato[$i]>0){
           $j=$j+1; 
        }
        
        $suma6=$suma6+$row1[$mes];
        
    } 
} 
//$suma5=$j;
$fec[1]="Enero";
$fec[2]="Febrero";
$fec[3]="Marzo";
$fec[4]="Abril";
$fec[5]="Mayo";
$fec[6]="Junio";
$fec[7]="Julio";
$fec[8]="Agosto";
$fec[9]="Septiembre";
$fec[10]="Octubre";
$fec[11]="Noviembre";
$fec[12]="Diciembre";


$sql="";
?>
     <div class="row">
            
              <?php
                  if(isset($fec) && count($fec)>0){
                     
                      ?>
                
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <h2><font color="#FF4000"><strong>1.-Resumen de <?php echo $r5;?>.</strong></font> </h2>
                    
              <div class="x_panel">
                <div class="x_title">
                  
                    <h2><font color="black">Grafica de <?php echo $r5;?> por día.</font> </h2>
                    
                    
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content1">
                  <div id="graph_line1" style="width:100%; height:280px;"></div>
                </div>
              </div>
                    <div class="container" style="background:black;padding:1px;" >    
                <div class="col-md-4 col-sm-4 col-xs-12" style="color:white;font-weight:bold;font-size: 12pt;background:#00BFFF;border:3px solid white;">
                                                                Total <?php echo $r6;?>:
                                                                <br><?php $suma6=number_format($suma6,2);print"<strong><font color=black>$mon $suma6</font></strong>";?>
							</div>     
                      
                    <div class="col-md-4 col-sm-4 col-xs-12" style="color:white;font-weight:bold;font-size: 12pt;background:#FF8000;border:3px solid white;">
                                                                Meses con <?php echo $r6;?>:
                                                                <br><?php print"<strong><font color=black>$j</font></strong>";?>
							</div> 
                    <div class="col-md-4 col-sm-4 col-xs-12" style="color:white;font-weight:bold;font-size: 12pt;background:#F7D358;border:3px solid white">
                                                                <?php echo $r6;?> Promedio:
                                                                <br><?php if($j==0){$j=1;
                                                                    
                                                                } $suma7=number_format($suma6/$j,2);print"<strong><font color=black>$mon $suma7</font></strong>";?>
                    </div>  
                    </div>
                      <h2><font color="#FF4000"><strong><br><br>2.-Detalle de <?php echo $r5;?><br></strong></font> </h2> 
                      
            </div>

                  
<?php
                  }
                    ?>
        
          </div>        
           
 <div class="table-responsive">
                   
                   <table id="example" class="display" style="width:100%;color:black;">
                    <thead>
                      <tr style="background-color:<?php echo tablas;?>;color:white; ">
                       <th><?php echo $r4;?> </th>
                       <th>Total</th>
                       <th>Enero </th>
                       <th>Febrero </th>
                      <th>Marzo </th>
                      <th>Abril </th>
                      <th>Mayo </th>
                      <th>Junio </th>
                      <th>Julio </th>
                      <th>Agosto </th>
                      <th>Septiembre </th>
                      <th>Octubre </th>
                      <th>Noviembre </th>
                      <th>Diciembre </th>
                      
                      </tr>
                    </thead>

                    <tbody>  
       
            <?php
            }
 if($tienda<>""){
    $sql="$r1
$text
$r2";
    
//print"$sql";    
$rs=mysqli_query($con,$sql);

    while($row=mysqli_fetch_array($rs)){
            $suma=0;
            for($i=1;$i<=12;$i++){
                 $mes="mes$i";          
                $suma=$suma+$row[$mes];
                       
            }
            $d=$row[$r3];
        if($suma>0){    
        ?>
                        
        <tr id="valor1">
            <td class=" "><font color="black"><strong><?php echo $d;?></strong></font></td>
            <td class=" "><font color="blue"><strong><?php echo $suma;?></strong></font></td>
             <td align="right"><?php echo number_format($row['mes1'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes2'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes3'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes4'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes5'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes6'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes7'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes8'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes9'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes10'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes11'],2);?></td>
                       <td align="right"><?php echo number_format($row['mes12'],2);?></td>        
        </tr>                
        <?php
        }
    }                     
}                        
?>
</tbody>

                  </table>
  <?php
  
 //}

?>   
     
<script>

 $(function () {

    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
    var day_data1 = [
        
        <?php
                    for($i=1;$i<=count($fec);$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "<?php echo $r6;?>": <?php print"$dato[$i]";?>},
                <?php } ?>
        
        
        
    ];
    Morris.Line({
        element: 'graph_line1',
        data: day_data1,
        xkey: 'period',
        lineColors: ['#8000FF', '#8000FF', '#8000FF', '#8000FF'],
        ykeys: ['<?php echo $r6;?>'],
         parseTime:false,
        labels: ['<?php echo $r6;?>'],
        hideHover: 'auto',
        xLabelAngle: 60
    });


});
$(document).ready(function() {
    $('#example').DataTable( {
        language: {
        "url": "/dataTables/i18n/de_de.lang",
                "decimal": "",
        "show": "Mostrar",
        "emptyTable": "No hay informacion",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        buttons: {
                copyTitle: 'Copiar filas al portapapeles',
                
                copySuccess: {
                    _: 'Copiado %d fias ',
                    1: 'Copiado 1 fila'
                },
                
                pageLength: {
                _: "Mostrar %d filas",
                '-1': "Mostrar Todo"
            }
            },
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
        
             
        },
        
        "order": [[ 1, 'desc' ]],
        
         bDestroy: true,
            dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
        ],
        
        
        
        buttons: 
        
        
        [
                
                {
                    extend: 'pageLength',
                    text: 'Mostrar filas',
                    className: 'orange'
                },
                
                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red'
                },
                
                
                
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1'
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2'
                }
            ],
        
        
    } );
} );



</script>
     
     