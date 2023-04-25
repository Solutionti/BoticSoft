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
if($a[23]==0){
    header("location:error.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Consulta de historia del cliente</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/DataTables/css/dataTables.bootstrap.min.css"/>
<script type="text/javascript" src="Buttons/js/jszip.min.js"></script>
<link rel="stylesheet" type="text/css" href="Buttons/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="Buttons/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="Buttons/js/buttons.print.min.js"></script>

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
          <?php
          menu2();
          menu1();
          ?>
          <br />
        </div>
      </div>
        <?php
          menu3();
        ?>
      <div class="right_col" role="main">

               <div class="row">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="x_panel" style="background:<?php echo COLOR;?>;">
                        <form  name="myForm" id="demo-form2" style="color:black;" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="consulta_historial.php">

                          <div class="panel panel-info">
                            <div class="panel-heading">
                                <h6>Seleccione el rango de fechas y el cliente</h6>
                            </div>
                        </div>


                         <div class="col-md-4 col-sm-4 col-xs-12" style="width:35%">

                             <label>Fecha inicial:</label>
                               <input class="textfield10" class="form-control col-md-10" value="<?php  if(!empty($_POST['fecha1'])){echo $_POST['fecha1'];} ?>" id="fecha1" name="fecha1" type="date" required="required" >
                          </div>



                       <div class="col-md-4 col-sm-4 col-xs-12" style="width:35%">

                           <label>Fecha final:</label>
                               <input class="textfield10" class="form-control col-md-10" value="<?php if(!empty($_POST['fecha2'])){echo $_POST['fecha2'];} ?>" id="fecha2" name="fecha2" type="date" required="required" >
                          </div>


                       <div class="col-md-4 col-sm-4 col-xs-12" style="width:30%">
                        <label>Cliente (DNI / RUC):</label>
                         <input class="textfield11" class="form-control col-md-10" name="doc_cli" id="doc_cli" name="cliente" type="number" required="required" value="<?php if(!empty($_POST['doc_cli'])){echo $_POST['doc_cli'];} ?>" >
                        <br>
                      <br>
                      </div>
                      <input type="hidden" name="d" value="1">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button id="submit" type="submit" name="submit" class="btn btn-success">Buscar</button>
                      </div>
                    </form>


                   </div>
                   </div>
               </div>

          <div class="row">

   <div class="table-responsive">


 <?php
            if(isset($_POST['submit']) ){
?>
            <table id="example" class="display" style="width:100%;color:black;">
                    <thead>
                      <tr style="background-color:<?php echo tablas;?>;color:white; ">
                       <th>Sucursal</th>
                       <th>Documento</th>
                       <th>Nª doc</th>
                       <th>Fecha</th>
                       <th>Tipo de pago</th>
                       <th>Vendedor</th>
                       <th>Cliente</th>
                       <th>Monto</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
$fecha_ini=$_POST['fecha1'];
$anio = date("Y", strtotime($fecha_ini));
$mes = date("m", strtotime($fecha_ini));
$dia = date("d", strtotime($fecha_ini));
$fecha_inicial=($anio.'-'.$mes.'-'.$dia.' 00:00:00');


$fecha_fin=$_POST['fecha2'];
$anio2 = date("Y", strtotime($fecha_fin));
$mes2 = date("m", strtotime($fecha_fin));
$dia2 = date("d", strtotime($fecha_fin));
$fecha_final=($anio2.'-'.$mes2.'-'.$dia2.' 23:59:00');

$doc_cliente=$_POST['doc_cli'];
$sql="SELECT facturas.*, clientes.* FROM facturas, clientes WHERE clientes.id_cliente=facturas.id_cliente AND clientes.documento='".$doc_cliente."'  AND facturas.fecha_factura>='".$fecha_inicial."' AND facturas.fecha_factura<='".$fecha_final."'";
$rs=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($rs)){

  if($row['estado_factura']==1){
      $Tipo_doc="Factura";
  }
  if($row['estado_factura']==2){
      $Tipo_doc="Boleta";
  }
  if($row['estado_factura']==3){
      $Tipo_doc=doc;
  }
  if($row['estado_factura']==5){
      $Tipo_doc="Nota de Debito";
  }
  if($row['estado_factura']==6){
      $Tipo_doc="Nota de Credito";
 }


 if($row['condiciones']==1){
      $tipo_pago="Efectivo";
  }
  if($row['condiciones']==2){
      $tipo_pago="Cheque";

  }
  if($row['condiciones']==3){
      $tipo_pago="Transf Bancaria";
  }
  if($row['condiciones']==4){
      $tipo_pago="Crédito";
  }
  if($row['condiciones']==5){
      $tipo_pago="Tarjeta";
  }


  $sql_vendedor=mysqli_query($con,"select * from users where user_id='".$row['id_vendedor']."'");
  $rw_vendedor=mysqli_fetch_array($sql_vendedor);

  $sql_sucursal=mysqli_query($con,"select * from sucursal where id_sucursal='".$row['tienda']."'");
  $rw_sucursal=mysqli_fetch_array($sql_sucursal);

        ?>
        <tr>
            <td class=""><font color="black"><strong><?php echo $rw_sucursal['nombre'];  ?></strong></font></td>
            <td class=""><font color="black"><strong><?php echo $Tipo_doc; ?></strong></font></td>
            <td class=""><font color="blue"><strong><?php echo $row['folio']." - ".$row['numero_factura']; ?></strong></font></td>
            <td class=""><?php echo $row['fecha_factura']; ?></td>
            <td class=""><?php echo $tipo_pago; ?></td>
            <td class=""><?php echo $rw_vendedor['nombres']; ?></td>
            <td class=""><?php echo $row['nombre_cliente']; ?></td>
            <td class=""><?php echo $row['total_venta']; ?></td>
        </tr>
        <?php
    }
}
?>

                    </tbody>

                  </table>

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
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="js/icheck/icheck.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <script src="js/pace/pace.min.js"></script>
  <script src="js/select/select2.full.js"></script>


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


    } );
} );



</script>



</body>

</html>
<?php
ob_end_flush();
?>
