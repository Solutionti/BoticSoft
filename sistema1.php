<?php
session_start();

require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
include('menu2.php');
//include('menu.php');
//if($a[0]==0){
 //   header("location:error.php");    
//}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> 
  
  Precios
  </title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/formularios.css"/>
<script src="js/jquery.min.js"></script>
 <script>
  function limpiarFormulario() {
    document.getElementById("guardar_producto").reset();
    
  }
</script>
<style type="text/css"> 
    .fijo {
	background: #333;
	color: white;
	height: 10px;
	
	width: 100%; /* hacemos que la cabecera ocupe el ancho completo de la página */
	left: 0; /* Posicionamos la cabecera al lado izquierdo */
	top: 0; /* Posicionamos la cabecera pegada arriba */
	position: fixed; /* Hacemos que la cabecera tenga una posición fija */
} 




</style>
 

</head>

<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <?php echo menu1();?>

       <div class="right_col" role="main">
        <div class="">
         
          <div class="clearfix"></div>

          <div class="row" style="color:black;">

            <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-info">
                            
                            <h3><font color=#0040FF><strong>Sistema de Ventas + facturación electrónica + tienda Online:</strong></font></h3>
                                   
                        </div>  
                <font size="4">&nbsp;&nbsp;<span style="color:#FF8000;">Contacto: </span><strong>Carlos Gustavo Velazco Solano</strong>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF8000;">Wasap:</span><strong> 51976248185</strong>
                        &nbsp;&nbsp;&nbsp;&nbsp; <span style="color:#FF8000;">Correo:</span> <strong>cg_velazco@hotmail.com </strong> </font>
               
                  <div class="row">

                    <div class="col-md-12">

                      <!-- price element -->
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="pricing" >
                          <div class="title" style="height:150px;background:#0174DF;">
                            <h2>SISTEMA DE VENTAS</h2>
                            <h2>&nbsp;</h2>
                            <h2>&nbsp;</h2>
                            <h2>&nbsp;</h2>
                            <h1>$100</h1>
                          </div>
                          <div class="x_content">
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                 
                                  <li><i class="fa fa-check text-success"></i><strong>Codigo  fuente</strong> php version >=7.2</li>
                                  <li><i class="fa fa-check text-success"></i><strong>Base de datos</strong> Mysql</li>
                                  <li><i class="fa fa-check text-success"></i><strong> Manual de uso</strong></li>
                                  <li><i class="fa fa-check text-success"></i><strong> Videos</strong></li>
                                </ul>
                              </div>
                            </div>
                            <div class="pricing_footer">
                              <a href="login.php" target="_blank" class="btn btn-success btn-block" role="button">Demo Sistema Ventas</a>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- price element -->
                      
                      <!-- price element -->
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="pricing ui-ribbon-container">
                          <div class="ui-ribbon-wrapper">
                            
                          </div>
                          <div class="title" style="height:150px;background:#0174DF;">
                             <h2>SISTEMA DE VENTAS+</h2>
                             <h2><font color="#FFFF00">TIENDA ONLINE</font></h2>
                             <h2>&nbsp;</h2>
                             <h2>&nbsp;</h2>
                             <h1>$200</h1>
                            
                          </div>
                          <div class="x_content">
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                   <li><i class="fa fa-check text-success"></i><strong>Codigo  fuente</strong> php version >=7.2</li>
                                  <li><i class="fa fa-check text-success"></i><strong>Base de datos</strong> Mysql</li>
                                  <li><i class="fa fa-check text-success"></i><strong> Manual de uso</strong></li>
                                   <li><i class="fa fa-check text-success"></i><strong> Videos</strong></li>
                                </ul>
                              </div>
                            </div>
                            <div class="pricing_footer">
                              <a href="login.php" target="_blank" class="btn btn-success btn-block" role="button">Demo Sistema Ventas</a>
                              <a href="http://ofertasde.net/tienda3/" target="_blank" class="btn btn-primary btn-block" role="button">Demo Tienda</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- price element -->

                      <!-- price element -->
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="pricing">
                          <div class="title" style="height:150px;background:#0174DF;">
                             <h2>SISTEMA DE VENTAS+</h2>
                             <h2><font color="red">FACTURACION ELECTRÓNICA</font></h2>
                             <h2>&nbsp;</h2>
                             
                             <h1>$240</h1>
                          </div>
                          <div class="x_content">
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                  <li><i class="fa fa-check text-success"></i><strong>Codigo  fuente</strong> php version >=7.2</li>
                                  <li><i class="fa fa-check text-success"></i><strong>Base de datos</strong> Mysql</li>
                                  <li><i class="fa fa-check text-success"></i><strong> Manual de uso y videos</strong></li>
                                  <li><i class="fa fa-check text-success"></i><strong> Instalación</strong></li>
                                  
                                  <li><i class="fa fa-check text-success"></i><strong> Conexion Sunat <font color="red">(Perú)</font></strong></li>
                                </ul>
                              </div>
                            </div>
                            <div class="pricing_footer">
                              <a href="login.php" target="_blank" class="btn btn-success btn-block" role="button">Demo Sistema Ventas<span></span></a>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- price element -->

                      <!-- price element -->
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="pricing">
                          <div class="title" style="height:150px;background:#0174DF;">
                            <h2>SISTEMA DE VENTAS+</h2>
                            <h2><font color="red">FACTURACION ELECTRÓNICA+</font></h2>
                            <h2><font color="#FFFF00">TIENDA ONLINE</font></h2>
                            <h1>$340</h1>
                          </div>
                          <div class="x_content">
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
                                  <li><i class="fa fa-check text-success"></i><strong>Codigo  fuente</strong> php version >=7.2</li>
                                  <li><i class="fa fa-check text-success"></i><strong>Base de datos</strong> Mysql</li>
                                  <li><i class="fa fa-check text-success"></i><strong> Manual de uso y videos</strong></li>
                                  <li><i class="fa fa-check text-success"></i><strong> Instalación</strong></li>
                                  <li><i class="fa fa-check text-success"></i><strong> Conexion Sunat <font color="red">(Perú)</font></strong></li>
                                </ul>
                              </div>
                            </div>
                            <div class="pricing_footer">
                              <a href="login.php" target="_blank" class="btn btn-success btn-block" role="button">Demo Sistema Ventas <span></span></a>
                              <a href="http://ofertasde.net/tienda3/" target="_blank" class="btn btn-primary btn-block" role="button">Demo Tienda</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- price element -->
                    </div>
                    
                      <font color="red" size="4"><strong>SISTEMA DE VENTAS</strong></font><br><br> 
                    <table class="table" style="color:black;">
                    <thead>
                      <tr style="background:#084B8A;color:white;">
                        
                        <th>Modulos Sistema de Ventas</th>
                        <th>Contiene</th>
                        <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td>Modulo Empresa:</td>
                        <td>Administracion Empresa</td>
                        <td>Editar datos generales de la Empresa</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Resumen</td>
                        <td>Consultar la tendencia de movimientos de la empresa</td>
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion de Sucursales</td>
                        <td>Permite agregar,consultar y editar sucursales (maximo seis sucursales)</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Caja</td>
                        <td>Permite agregar caja por usuario</td>
                        
                      </tr>
                      
                      <tr>
                        
                        <td>Modulo Usuarios:</td>
                        <td>Administracion Usuarios</td>
                        <td>Permite agregar, editar,consultar y eliminar usuarios.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion Accesos</td>
                        <td>Permite dar accesos a los usuarios a distintas partes del sistema.</td>
                        
                      </tr>
                       <tr>
                        
                        <td>Modulo Productos y Servicios:</td>
                        <td>Administracion productos</td>
                        <td>Permite agregar, editar, consultar y eliminar productos <font color="red"><strong>(con codigo de barras).</strong></font></td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Administracion servicios</td>
                        <td>Permite agregar, editar, consultar y eliminar servicios.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion kardex</td>
                        <td>Permite consultar kardex de los productos.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion transferencia</td>
                        <td>Permite agregar y consultar las transferencias.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Proveedores:</td>
                        <td>Administracion proveedores</td>
                        <td>Permite agregar, editar, consultar y eliminar proveedores <font color="red"><strong>(consultar ruc/dni Perú).</strong>.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Clientes:</td>
                        <td>Administracion clientes</td>
                        <td>Permite agregar, editar, consultar y eliminar clientes <font color="red"><strong>(consultar ruc/dni Perú).</strong></font>.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Ventas de productos:</td>
                        <td>Administracion de ventas</td>
                        <td>Permite agregar, consultar y eliminar las ventas.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Administracion de notas</td>
                        <td>Permite agregar, consultar las notas de crédito o débito.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Administracion cotización</td>
                        <td>Permite agregar, consultar las cotizaciones.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion ventas x cobrar</td>
                        <td>Permite agregar y consultar cobros de ventas al crédito.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Compras:</td>
                        <td>Administracion de compras</td>
                        <td>Permite agregar, consultar y eliminar las compras.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Administracion compras x pagar</td>
                        <td>Permite agregar y consultar pagos de compras al crédito.</td>
                        
                      </tr>
                       <tr>
                        
                        <td>Entrada/salida mercaderia:</td>
                        <td>Administracion de entrada/salida<br> mercaderia</td>
                        <td>Permite agregar, consultar, eliminar las entradas y salidas de mercaderia.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Pagos/Cobros - reportes:</td>
                        <td>Reporte entradas y salidas</td>
                        <td>Consultar entradas y salidas entre un rango de fechas.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Reporte ventas/compras</td>
                        <td>Consultar ventas y compras entre un rango de fechas.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Otros pagos y cobros</td>
                        <td>Permite crear, editar y eliminar otros pagos y cobros.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Reporte de ventas:</td>
                        <td>Reporte de ventas por cliente</td>
                        <td>Consultar ventas por cliente diario,mensual y anual.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Reporte de ventas por vendedor</td>
                        <td>Consultar ventas por vendedor diario,mensual y anual.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Reporte de ventas por producto</td>
                        <td>Consultar ventas por producto diario,mensual y anual.</td>
                        
                      </tr>
                      <tr>
                        
                        <td>Reporte de Compras:</td>
                        <td>Reporte de compras por proveedor</td>
                        <td>Consultar ventas por proveedor diario,mensual y anual.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Reporte de compras por vendedor</td>
                        <td>Consultar compras por vendedor diario,mensual y anual.</td>
                        
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Reporte de compras por producto</td>
                        <td>Consultar compras por producto diario,mensual y anual.</td>
                        
                      </tr>
                      
                      <tr>
                        
                        <td>Reporte de Contabilidad:</td>
                        <td>Administracion de Calculo Impuesto</td>
                        <td>Calcular los impuestos según ventas y compras entre un rango de fechas.</td>
                        
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Administracion de kardex valorizado</td>
                        <td>Consultar kardex valorizado entre un rango de fechas.</td>
                        
                      </tr>
                     
                    </tbody>
                  </table>
                    
                      
                   
                   <font color="red" size="4"><strong>FACTURACION ELECTRÓNICA (valido para Perú)</strong></font><br><br> 
                    <table class="table" style="color:black;">
                    <thead>
                      <tr style="background:#084B8A;color:white;">
                        
                        <th>Modulos facturación electrónica</th>
                        <th>Contiene</th>
                        <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td>Modulo facturación electrónica:</td>
                        <td>Configuracion</td>
                        <td>Configurar el sistema en modo demo o en modo producción</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Documentos electrónicos</td>
                        <td>Listar y envias facturas,boletas, notas de crédito y débito.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Lista de Resumen diario de boletas</td>
                        <td>Crear y listar resumen diario de boletas.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Lista comunicación de baja</td>
                        <td>Crear y listar comunicación de baja.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Lista guías de remisión</td>
                        <td>Crear y listar guías de remisión.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>Tipos de documentos</td>
                        <td>Factura electrónica.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Boleta electrónica.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Notas de crédito.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Notas de débito.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Comunicación de baja.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Resumen diario de boletas.</td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td></td>
                        <td>Guías de Remisión.</td>
                      </tr>
                      
                      <tr>
                        
                        <td></td>
                        <td>Otras Características</td>
                        <td>Creación del xml, envio y recepción de la respuesta de la Sunat (CDR).</td>
                      </tr>
                    </tbody>
                  </table>   
                      
                   <font color="red" size="4"><strong>TIENDA ONLINE</strong></font><br><br> 
                    <table class="table" style="color:black;">
                    <thead>
                      <tr style="background:#084B8A;color:white;">
                        
                        <th>Páginas</th>
                        <th>Contiene</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td>Visión:</td>
                        <td>Visión de la Empresa </td>
                        
                      </tr>
                      <tr>
                        
                        <td>Misión:</td>
                        <td>Misión de la Empresa </td>
                        
                      </tr>
                      <tr>
                        
                        <td>Contacto:</td>
                        <td>Teléfonos, correos y dirección de la empresa </td>
                        
                      </tr>
                      <tr>
                        
                        <td>Categorias:</td>
                        <td>Lista categorias de las empresas</td>
                        
                      </tr>
                       <tr>
                        
                        <td>Productos:</td>
                        <td>Ver fotos y detalle de los productos</td>
                        
                      </tr>
                       <tr>
                        
                        <td>Carrito de Compras:</td>
                        <td>Permite por parte de los clientes comprar y enviarlos</td>
                        
                      </tr>
                      
                      
                    </tbody>
                  </table>
                  <table class="table" style="color:black;">
                    <thead>
                      <tr style="background:#084B8A;color:white;">
                        
                        <th>Modulos Sistema </th>
                        <th>Contiene</th>
                        <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td>Modulo Tienda Online:</td>
                        <td>Ventas Online</td>
                        <td>Permite ver la lista de pre ventas online para luego ser convertido en ventas</td>
                      </tr>
                       <tr>
                        
                        <td></td>
                        <td>Fotos Tienda</td>
                        <td>Permite agregar y eliminar fotos para las distintas paginas de la tienda online.</td>
                      </tr>
                  </table>
                   
                </div>
              </div>
            </div>  
                      
                      
                      
                  </div>
                

              
            </div>
          </div>
        </div>

        <!-- footer content -->
        <footer>
          <?php echo footer();?>
        </footer>
        <!-- /footer content -->

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

  
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>


  <!-- Datatables -->
  <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });

    var asInitVals = new Array();
    $(document).ready(function() {
      var oTable = $('#example').dataTable({
        "oLanguage": {
          "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
          } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
          "sSwfPath": "js/datatables/tools/swf/copy_csv_xls_pdf.swf"
        }
      });
      $("tfoot input").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
      });
      $("tfoot input").each(function(i) {
        asInitVals[i] = this.value;
      });
      $("tfoot input").focus(function() {
        if (this.className == "search_init") {
          this.className = "";
          this.value = "";
        }
      });
      $("tfoot input").blur(function(i) {
        if (this.value == "") {
          this.className = "search_init";
          this.value = asInitVals[$("tfoot input").index(this)];
        }
      });
    });
  </script>
  
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
  
  
  
</body>

</html>




