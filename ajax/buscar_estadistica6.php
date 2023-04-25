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
        
        
        //if($q==2){
            $r1="SELECT nombre_cliente,";
            $r2="FROM clientes, facturas WHERE clientes.id_cliente=facturas.id_cliente GROUP BY nombre_cliente";
            $r3="nombre_cliente";
            $r4="Clientes/Proveedores";
        //}
        $q6="=$q";    
        if($q==7){
            $q6=">=1";
        }
        
        if($q1==1){
            $r5="Cobros por día";
            $r6="Ventas";
           
        }
        if($q1==2){
            $r5="Pagos por día";
            $r6="Compras";
           
        }
        if($q1==3){
            $r5="Diferencia por día";
            $r6="Dif";
           
        }
        if($q1==4){
            $r5="Cobros-Pagos-Dif por día";
            $r6="Dif";
           
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

 for($i=$f1;$i<=$f2;$i++){
     $fec[$j]=date('Y-m-d', $i*24*3600);
     $fec1[$j]=date('d-m-Y', $i*24*3600);
     
     
     //if($q==1 or $q==2){
     if($i<$f2){
         $text=$text." SUM(IF(DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' and ven_com=5 and condiciones$q6  and activo=1 and facturas.tienda$tienda,total_venta,0)) AS '$fec[$j]',";
         $text=$text." SUM(IF(DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' and ven_com=6 and condiciones$q6  and activo=1 and facturas.tienda$tienda,total_venta,0)) AS '$fec1[$j]',";
         
        //$text2=$text2." SUM(IF(DATE_FORMAT(fecha1, '%Y-%m-%d')='$fec[$j]' and activo>=0,total,0)) AS '$fec[$j]',";
        // $text1=$text1." SUM(IF(DATE_FORMAT(fecha, '%Y-%m-%d')='$fec[$j]' ,numero,0)) AS '$fec[$j]',";
         
     }else{
         $text=$text." SUM(IF(DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' and ven_com=5 and condiciones$q6 and activo=1 and facturas.tienda$tienda,total_venta,0)) AS '$fec[$j]',";
         $text=$text." SUM(IF(DATE_FORMAT(fecha_factura, '%Y-%m-%d')='$fec[$j]' and ven_com=6 and condiciones$q6  and activo=1 and facturas.tienda$tienda,total_venta,0)) AS '$fec1[$j]'";
        // $text2=$text2." SUM(IF(DATE_FORMAT(fecha1, '%Y-%m-%d')='$fec[$j]' and activo>=0,total,0)) AS '$fec[$j]'";
        // $text1=$text1." SUM(IF(DATE_FORMAT(fecha, '%Y-%m-%d')='$fec[$j]' ,numero,0)) AS '$fec[$j]'";
     }
    // }
     
     $j=$j+1;
}
$sql="$r1
$text
$r2";

for($i=0;$i<=$j-1;$i++){
        $dato1[$i]=0;                    
        $dato[$i]=0; 
        
         $dato2[$i]=0;  
        
       
    } 

//print"$sql";
$rs1=mysqli_query($con,$sql);
//$j=0;
$suma6=0;
$suma7=0;
//$suma5=0;
while($row1=mysqli_fetch_array($rs1)){
    for($i=0;$i<=$j-1;$i++){
        $dato1[$i]=$dato1[$i]+$row1[$fec1[$i]];                    
        $dato[$i]=$dato[$i]+$row1[$fec[$i]]; 
        
         $dato2[$i]=$dato2[$i]+$row1[$fec[$i]]-$row1[$fec1[$i]];  
        
        $suma6=$suma6+$row1[$fec[$i]];
        $suma7=$suma7+$row1[$fec1[$i]];
    } 
} 
$suma5=$j;

$j1=0;
for($i=0;$i<=$j-1;$i++){                          
    if($dato[$i]+$dato[$i]>0){
        $j1=$j1+1; 
    }        
}
$j2=$j1;
if($j1==0){
    $j2=1;
}

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
                  <div id="graph_line" style="width:100%; height:280px;"></div>
                </div>
              </div>
                  <div class="container" style="background:black;padding:1px;" >     
                 <div class="col-md-2 col-sm-2 col-xs-12" style="width:20%;color:white;font-weight:bold;font-size: 12pt;background:#00BFFF;border:3px solid white;">
                                                                Total Cobros:
                                                                <br><?php $suma8=$suma6-$suma7;$suma6=number_format($suma6,2);print"<strong><font color=black>$mon $suma6</font></strong>";?>
							</div>     
                <div class="col-md-2 col-sm-2 col-xs-12" style="width:20%;color:white;font-weight:bold;font-size: 12pt;background:#FF8000;border:3px solid white;">
                                                                Total Pagos:
                                                                <br><?php $suma7=number_format($suma7,2);print"<strong><font color=black>$mon $suma7</font></strong>";?>
		</div> 
                <div class="col-md-3 col-sm-3 col-xs-12" style="width:20%;color:white;font-weight:bold;font-size: 12pt;background:#F7D358;border:3px solid white">
                                                                Total Diferencia:
                                                                <br><?php $suma8=number_format($suma8,2);print"<strong><font color=black>$mon $suma8</font></strong>";?>
		</div>
                      
                <div class="col-md-2 col-sm-2 col-xs-12" style="width:20%;color:white;font-weight:bold;font-size: 12pt;background:#FE642E;border:3px solid white">
                
                                                                Nro Días:
                                                                <br><?php print"<strong><font color=black>$j2</font></strong>";?>
							</div> 
                <div class="col-md-3 col-sm-3 col-xs-12" style="width:20%;color:white;font-weight:bold;font-size: 12pt;background:#01DF74;border:3px solid white">
                
                                                                Diferencia Promedio:
                                                                <br><?php $suma7=number_format($suma8/$j2,2);print"<strong><font color=black>$mon $suma7</font></strong>";?>
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
                       <th>Total <?php echo $r6;?></th>
                      <?php
                       for($i=0;$i<=$j-1;$i++){
                           ?>
                           <th><?php echo $fec1[$i];?></th>
                       <?php
                       }
                       ?>
                      
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
            $suma1=0;
            $suma2=0;
            for($i=0;$i<=$j-1;$i++){
                           
                $suma=$suma+$row[$fec[$i]]-$row[$fec1[$i]];
                $suma1=$suma1+$row[$fec[$i]]+$row[$fec1[$i]];
                
                if($q1==4 or $q1==3){
                    $suma2=$suma;
                }
                if($q1==1){
                     $suma2=$suma2+$row[$fec[$i]];
                }
                if($q1==2){
                     $suma2=$suma2+$row[$fec1[$i]];
                }
                       
            }
            $d=$row[$r3];
        if($suma1>0){    
        ?>
                        
        <tr id="valor1">
            <td class=" "><font color="black"><strong><?php echo $d;?></strong></font></td>
            <td class=" "><font color="blue"><strong><?php echo $suma2;?></strong></font></td>
            <?php
            for($i=0;$i<=$j-1;$i++){
                
                if($q1==4){
                ?>
                <td class=" "><?php echo round($row[$fec[$i]]-$row[$fec1[$i]],2);?></td>
                <?php
                }
                
                if($q1==1){
                ?>
                <td class=" "><?php echo round($row[$fec[$i]],2);?></td>
                <?php
                }
                
                if($q1==2){
                ?>
                <td class=" "><?php echo round($row[$fec1[$i]],2);?></td>
                <?php
                }
                
                if($q1==3){
                ?>
                <td class=" "><?php echo round($row[$fec[$i]]-$row[$fec1[$i]],2);?></td>
                <?php
                }
                
            }
            ?>         
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
    var day_data = [
        
        <?php
        if($q1==4){
        
                    for($i = 0;$i<count($fec);$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Cobros": <?php print"$dato[$i]";?>, "Pagos": <?php print"$dato1[$i]";?>, "Diferencia": <?php print"$dato2[$i]";?>},
                <?php } }
                
        if($q1==1){
        
                    for($i = 0;$i<count($fec);$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Cobros": <?php print"$dato[$i]";?>},
                <?php } }        
        if($q1==2){
        
                    for($i = 0;$i<count($fec);$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Pagos": <?php print"$dato1[$i]";?>},
                <?php } }        
         if($q1==3){
        
                    for($i = 0;$i<count($fec);$i++){
                ?>
                {"period": "<?php print"$fec[$i]";?>", "Diferencia": <?php print"$dato2[$i]";?>},
                <?php } }        
                ?>
        
        
        
    ];
    Morris.Line({
        element: 'graph_line',
        data: day_data,
        xkey: 'period',
        lineColors: ['blue', 'red', 'orange'],
        Colors: ['blue', 'red', 'orange'],
        ykeys: ['Cobros', 'Pagos','Diferencia'],
        labels: ['Cobros', 'Pagos','Diferencia'],
        hideHover: 'auto',
        type: 'line',
         parseTime:false,
        xLabelAngle: 60,
        
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
     
     