<?php
ob_start();
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
$consulta1 = "SELECT * FROM clientes ";
$result1 = mysqli_query($con, $consulta1);
$sql1="select * from users where user_id=$_SESSION[user_id]";
$rw1=mysqli_query($con,$sql1);//recuperando el registro
$rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
$modulo=$rs1["accesos"];
$sql2="select * from sucursal ORDER BY  `sucursal`.`tienda` DESC ";
$rw2=mysqli_query($con,$sql2);//recuperando el registro
$rs2=mysqli_fetch_array($rw2);//trasformar el registro en un vector asociativo
$tienda1=$rs2["tienda"];
$a = explode(".", $modulo); 
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
if($a[50]==0){
    header("location:error.php");    
}
$a1=recoge1('fecha1');
$a2=recoge1('fecha2');

$a3=recoge1('tienda');
$a4=1;
$a5=recoge1('tipo');;
$a6="";
$delete=mysqli_query($con,"DELETE FROM consultas");
$insert=mysqli_query($con,"INSERT INTO consultas VALUES (NULL,'70','$a1','$a2','$a3','$a4','$a5','$a6')");          
date_default_timezone_set('America/Lima');
$anio1=date("Y");        
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> 
 Calculo del <?php echo nom_iva;?>
  
  </title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"/>
-->
<link rel="stylesheet" type="text/css" href="DataTables/DataTables/css/dataTables.bootstrap.min.css"/>
<script type="text/javascript" src="Buttons/js/jszip.min.js"></script>
<!--<script type="text/javascript" src="Buttons/js/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>
<script type="text/javascript">
var mostrarValor = function(x){
      var x;
      var y="Anual";

      
     if(x>1) {
        document.getElementById('anio').value=y;
        document.getElementById("anio").disabled = true;
     }
     
     if(x==1) {
        document.getElementById('anio').value=<?php echo $anio1;?>;
        document.getElementById("anio").disabled = false;
     }
     
};  

</script>


<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}

table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {
              

border-bottom: 2px solid #F5ECCE;

}  

#valor1:hover {
              
background-color: white;
border-bottom: 2px solid #A9E2F3;

} 

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
</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

        
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <?php
          menu2();
    
          menu1();
          
          ?>
          <!-- /menu prile quick info -->

          <br />

      
        </div>
      </div>

        
        <?php
          menu3();
          
    
        
        ?>

      <div class="right_col" role="main">
<?php 

$consulta2 = "SELECT * FROM consultas ";
$result2 = mysqli_query($con, $consulta2);
$d=0;
$cliente="";
$fecha1="";
$fecha2="";
$tienda=0;
$dd1="";
$dd2="";
$mon="";
$tipo1="";
$tipo2="";
$tipo3="";
while ($valor1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        
     if ($valor1['tipo']==70){
         
         $fecha1=$valor1['a1'];
          //$nom_pro=trim($nom_pro1);
          $fecha2=$valor1['a2'];
          $tienda=$valor1['a3'];
          $tipo=$valor1['a5'];
          
          if($tipo=="=1"){
              $tipo1="selected";
          }
          if($tipo=="=2"){
              $tipo2="selected";
          }
          if($tipo=="3"){
              $tipo3="selected";
              $tipo="<=2";
          }
          //print"$tipo";
     }
    
}
    
            ?>
              
               <div class="row">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="x_panel" style="background:<?php echo COLOR;?>;">
                        <form style="color:black;" name="myForm" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="contabilidad.php">
                      
                          <div class="panel panel-info">
                            <div class="panel-heading">
                                 <?php 
                                    $video=videos;
                    
                                    if($video==1){
                                    $v="97IFMrYNeY0";
                                    include("modal/registro_video.php");
                                    ?>
                                    <div class="btn-group pull-right">
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#nuevoVideo"><span class="glyphicon glyphicon-play" ></span>Video Tutorial</button>
                                    </div>
                                    <?php
                    
                                    }
                                ?>
                                <h2>Reporte del <?php echo nom_iva;?></h2>
                            </div>        
                        </div> 
                     
                     
                         <div class="col-md-3 col-sm-3 col-xs-12">
                           
                             <label>Fecha1:</label>
                               <input class="textfield10" class="form-control col-md-10" value="<?php echo $fecha1; ?>" id="fecha1" name="fecha1" type="date" required="required" >
                          </div>
                            
                        
                      
                       <div class="col-md-3 col-sm-3 col-xs-12">
                            
                           <label>Fecha2:</label>
                               <input class="textfield10" class="form-control col-md-10" value="<?php echo $fecha2; ?>" id="fecha2" name="fecha2" type="date" required="required" >
                          </div>
                     
                      
                       <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Sucursal:</label>
                           <select class="textfield11" class="form-control col-md-10" name="tienda" required="required" tabindex="-1">
                            <?php
                            if($tienda>0){
                                
                                if($tiend==7){
                                    $t="Todas";
                                }else{
                                    $t="Sucursal $tienda";
                                }
                                
                                ?>
                               <option value="<?php echo $tienda; ?>" ><?php echo $t; ?></option>
                                <?php
                            }else{
                                  ?>
                               <option value="" >Escoger</option>
                            <?php  
                            }
                             for($i=1 ;$i<=$tienda1;$i++){
                                ?>
                                <option value="<?php echo $i;?>" >Sucursal <?php echo $i;?></option>              
                               <?php
        
                            } 
                                ?>
                                                                                 
                        </select>
                        <br>
                      <br>
                      </div>
                      
                            
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Tipo:</label>
                           <select class="textfield11" class="form-control col-md-10" name="tipo" required="required" tabindex="-1">
                               <option value="=1" <?php echo $tipo1;?>>Ventas</option>
                               <option value="=2" <?php echo $tipo2;?>>Compras</option>
                              <option value="3" <?php echo $tipo3;?>>Todo</option>
                                                                                 
                        </select>
                        <br>
                      <br>
                      </div>      
                            
                            
                 
                      <input type="hidden" name="d" value="1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button id="send" type="submit" name="enviar" class="btn btn-success">Buscar</button>
                      </div>
                   
                      
                    
                    </form>
                  
          
                   </div>
                   </div>
               </div>
         
          <div class="row">
        
                <div class="table-responsive">
                    <?php
                    if ($tienda>0){
                        ?>
                    <table id="example" border="1" style="width:100%;color:black;">
                        <thead>
                        <tr style="background-color:<?php echo tablas;?>;color:white; ">
                            
                            <th> Fecha </th>
                            <th> Cliente/Proveedor </th>
                            <th> Doc Cliente</th>
                            <th> Numero de<br> Documento</th>
                            <th> Tipo <br>Documento</th>
                            <th> Activo</th>
                            <th> Tipo1</th>
                            <th> Tipo</th>
                            
                            <th style="background-color:#01A9DB;"> Total <br>Venta</th>
                            <th style="background-color:#01A9DB;"> <?php echo nom_iva;print" ";  echo 100*iva;?>% </th>
                            <th style="background-color:red;"> Total <br>Compra </th>
                            <th style="background-color:red;"> <?php echo nom_iva;print" "; echo 100*iva;?>% </th>
                            <th>TOTAL<BR><?php echo nom_iva;?></th>
                        </tr>
                        </thead>

                        <tbody>  
                            <?php
                            $id=0;
                            $suma1=0;
                            $suma2=0;
                            $igv2=0; 
                            $igv3=0; 
                            
                            $sql3="select * from facturas,clientes where facturas.id_cliente=clientes.id_cliente  and facturas.tienda=$tienda and facturas.ven_com$tipo and facturas.estado_factura<=2 and DATE_FORMAT(facturas.fecha_factura, '%Y-%m-%d')>='$fecha1' and  DATE_FORMAT(facturas.fecha_factura, '%Y-%m-%d')<='$fecha2'"; 
                            $rs3=mysqli_query($con,$sql3);
                            while($row1= mysqli_fetch_array($rs3)){
                                $fecha=date("d/m/Y", strtotime($row1['fecha_factura']));
                                $cliente=$row1['nombre_cliente'];
                                $documento=$row1['documento'];
                                $activo=$row1['activo'];
                                $tipo2=$row1['tipo'];
                                if($activo==1){
                                    $activo1="si";
                                }else{
                                    $activo1="no";
                                }
                                
                                $numero_factura=$row1['numero_factura'];
                                $folio=$row1['folio'];
                                $estado_factura=$row1['estado_factura'];
                                if($estado_factura==1){
                                    $tipo="Factura";
                                }
                                if($estado_factura==2){
                                    $tipo="Boleta";
                                }
                                $ven_com=$row1['ven_com'];
                                $total_venta1=$row1['total_venta'];
                                 $total_venta=number_format($row1['total_venta'], 2, '.', '');
                                $igv1=0;
                                $igv=0;
                                $tipo3="EXO";
                                if($tipo2==0) {
                                    $igv1=iva*($row1['total_venta']/(1+iva));
                                    $igv=number_format(iva*($row1['total_venta']/(1+iva)), 2, '.', '');
                                    $tipo3="IGV";
                                }
                                if($tipo2==2) {
                                    $igv1=0;
                                    $igv=number_format(0, 2, '.', '');
                                    $tipo3="INA";
                                }
                                if($ven_com==1){
                                    $tipo1="Ventas";
                                    if($activo==1){
                                    $suma1=$suma1+$total_venta1;
                                    $igv2=$igv2+$igv1;
                                    }
                                    print"<tr><td>$fecha</td><td>$cliente</td><td>$documento</td><td>$folio $numero_factura</td><td>$tipo</td><td>$activo1</td><td>$tipo3</td><td>$tipo1</td><td align=right>$total_venta</td><td align=right>$igv</td><td></td><td></td><td></td></tr>";
                                }
                                if($ven_com==2){
                                    $tipo1="Compras";
                                    if($activo==1){
                                    $suma2=$suma2+$total_venta1;
                                    $igv3=$igv3+$igv1;
                                    }
                                    print"<tr><td>$fecha</td><td>$cliente</td><td>$documento</td><td>$folio $numero_factura</td><td>$tipo</td><td>$activo1</td><td>$tipo3</td><td>$tipo1</td><td></td><td></td><td align=right>$total_venta</td><td align=right>$igv</td><td></td></tr>";
                                }
                                $id=$id+1;
                            }
                            $suma1=number_format($suma1, 2, '.', '');
                            $suma2=number_format($suma2, 2, '.', '');
                            $igv2=number_format($igv2, 2, '.', '');
                            $igv3=number_format($igv3, 2, '.', '');
                            $igv4=number_format($igv2-$igv3, 2, '.', '');
                            $mon=moneda;
                            print"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td align=right>$mon $suma1</td><td align=right>$mon $igv2</td><td align=right>$mon $suma2</td><td align=right>$mon $igv3</td><td align=right><font color=#0000FF><strong>$mon $igv4</strong></font></td></tr>";
                            ?>
           

                        </tbody>

                    </table>
                <?php
                    }
                        ?>
                </div>
           
            </div>
   
          </div>
         
        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <script src="js/pace/pace.min.js"></script>
  
 
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  
  
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->
  
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Seleccionar",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "Con Max Selección límite de 4",
        allowClear: true
      });
    });
  </script>
  
  
  
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#example").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
 
 
<script>
 
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
            
        "pageLength": 100,
        "order": [],
    } );
} );



</script>



</body>

</html>
<?php
ob_end_flush();
?>



