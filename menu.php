﻿<?php
require_once ("config/db.php");
$db_db=DB_NAME;
$db_products = $db_db.'.products';
$db_clientes = $db_db.'.clientes';
$db_users = $db_db.'.users';
$db_facturas = $db_db.'.facturas';
$db_categorias= $db_db.'.categorias';
$db_datosempresa = $db_db.'.datosempresa';
$db_sucursal= $db_db.'.sucursal';
$db_detalle_factura= $db_db.'.detalle_factura';
$db_documento = $db_db.'.documento';
$db_comprobante_pago= $db_db.'.comprobante_pago';
$db_sub_tipo= $db_db.'.sub_tipo';
$db_servicio= $db_db.'.servicio';
$db_consultas= $db_db.'.consultas';
$db_laborales= $db_db.'.laborales';
$db_fotos= $db_db.'.fotos';
$db_documento = $db_db.'.documento';
function conectar2(){
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if (!$db) {
        print "<p>Imposible conectarse con la base de datos.</p>";
        exit();
    } else {
        return($db);
    }
}
function recoge1($var){
    $tmp = (isset($_REQUEST[$var])) ? trim(strip_tags($_REQUEST[$var])) : '';
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
    $tmp = str_replace('í', '&iacute;', $tmp);
    return $tmp;
}

function menu0(){
?>

<?php
}
function menu1(){
    ?>
    <?php
    $db_db=DB_NAME;
    $db_users = $db_db.'.users';
    $db = conectar2();
    $consulta1 = "SELECT * FROM $db_users ";
    $result1 = mysqli_query($db, $consulta1);
    while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        if($valor1['user_id']==$_SESSION['user_id']){
            $name=$valor1['nombres'];
            $foto=$valor1['foto'];
        }
    }
    ?>
    <div class="profile" style="text-align: center;">

            <img src="img/man_default.svg" width="30%" height="30%" class="img-circle"><br><span>SUNAT</span><br><h6><?php echo $name; ?></h6>

    </div>
   <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >

            <div class="menu_section" >
              <ul class="nav side-menu">
                <li><a href="resumen2.php"><i class="fa fa-home" style="height:50%;"></i> Inicio </a> </li>
                 <li><a><i class="fa fa-home" style="height:50%;"></i> Empresa <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="empresa.php">Empresa</a></li>
                    <li><a href="sucursal.php">Sucursales</a></li>
                    <li><a href="caja.php">Caja</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-lock"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="usuarios.php">Usuarios</a></li>
                    <li><a href="acceso.php">Accesos</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-barcode"></i> Productos y Servicios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="categorias.php">Categorias</a></li>
                    <li><a href="laboratorio.php">Laboratorio</a></li>
                    <li><a href="ingresoproductos.php">Ingresar Productos</a></li>
                    <li><a href="productos.php">Lista de Productos</a></li>
                    <li><a href="servicio.php">Lista de Servicios</a></li>
                    <li><a href="kardex.php">Kardex de Productos</a></li>
                    <li><a href="kardex2.php">Entradas y Salidas Productos</a></li>
                    <li><a href="transferencia.php">Transferencia</a></li>
                    <li><a href="transferencia1.php">Lista de Transferencias</a></li>
                    <li><a href="transferencia3.php">Conversion de pack</a></li>
                    <li><a href="consultaproductos.php">Consultas</a></li>
                    <li><a href="masvendidos.php">Productos mas vendidos</a></li>
                    <li><a href="consultaprecios.php">Consulta Precios</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-truck"></i> Proveedores <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="proveedores.php">Proveedores</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-user"></i> Clientes <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="clientes.php">Clientes</a></li>
                  <li><a href="consulta_historial.php">Historial del cliente</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-list-alt"></i> Ventas<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="config_moneda_iva.php">Conf Moneda / Impuesto / Colores</a></li>
                  <li><a href="documentos.php">Conf Documentos</a></li>
                  <li><a href="nueva_factura.php">Ventas Fact/Bol/Nota</a></li>
                  <li><a href="nueva_cotizacion.php">Ingreso Cotizacion</a></li>
                  <li><a href="nueva_nota.php">Ingreso Nota de debito y credito</a></li>
                  <li><a href="facturas.php">Lista de Ventas Fac/Bol/Notas</a></li>
                  <li><a href="detalle_factura.php">Lista detalle</a></li>
                  <li><a href="cotizacion.php">Lista de Cotizacion</a></li>
                  <li><a href="credito-debito.php">Lista de Notas de credito/debito </a></li>
                  <li><a href="cobros.php">Ventas por Cobrar</a></li>
                  <li><a href="cobrosclientes.php">Lista de cobros</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-list-alt"></i> Facturación electrónica<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="conf_electronica.php"><strong>Configuracion</strong> </a></li>
                    <li><a href="facturaelectronica.php">Documentos electrónicos </a></li>
                    <li><a href="resumen_documentos.php">Lista Resumen diario boletas</a></li>
                    <li><a href="facturaseliminadas.php"><strong>Lista Comunicacion de baja</strong></a></li>
                    <li><a href="listaguia.php">Lista de Guias de Remision </a></li>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-shopping-cart"></i> Compras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="nueva_compras.php">Compras Fact/Bol</a></li>
                    <li><a href="nueva_requerimiento.php">Requrimiento</a></li>
                    <li><a href="requerimiento.php">Lista de Req</a></li>
                    <li><a href="compras.php">Consulta Compras</a></li>
                    <li><a href="pagos.php">Compras por Pagar</a></li>
                    <li><a href="pagosproveedores.php">Lista de pagos</a></li>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-barcode"></i> Ent/sal mercaderia <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                <li><a href="nueva_entsal.php">Guia Entradas/Salidas</a></li>
                <li><a href="listaguias.php">Lista Guias</a></li>
                </ul>
                </li>

              <li><a><i class="fa fa-money"></i> Tesoreria <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
              <li><a href="otrospagos.php">Tesoreria(Ingreso / Egreso)</a></li>
              <li><a href="estadistica8.php">Reporte Tesoreria</a></li>
              </li>
              </ul>
              </li>

                <li><a><i class="fa fa-line-chart"></i> Reportes<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="resumen2.php">Resumen</a></li>
                    <li><a href="estadistica2.php">Ventas/Compras diario</a></li>
                    <li><a href="estadistica3.php">Ventas/Compras mensual</a></li>
                    <li><a href="estadistica4.php">Ventas-Compras-Diferencia diario</a> </li>
                    <li><a href="estadistica5.php">Ventas-Compras-Diferencia Mensual</a> </li>
                    <li><a href="estadistica6.php">Ventas-Costo-Utilidad diario</a></li>
                    <li><a href="estadistica7.php">Ventas-Costo-Utilidad Mensual</a></li>
                    <li><a href="balance2.php">Reporte Entradas/Salidas</a></li>
                    <li><a href="balance.php">Reporte Ventas/Compras</a></li>
                  </ul>
                </li>



                <li><a><i class="fa fa-line-chart"></i> Reporte de Ventas<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="consulta5.php">Ventas por vendedor mensual/anual</a></li>
                    <li><a href="consulta11.php">Ventas por vendedor diario</a></li>
                    <li><a href="consulta28.php">Libro de entradas y salidas</a></li>
                    <li><a href="consulta1.php">Ventas por cliente mensual/anual</a></li>
                    <li><a href="consulta7.php">Ventas por cliente diario</a></li>
                    <li><a href="consulta2.php">Ventas por producto mensual/anual</a></li>
                    <li><a href="consulta8.php">Ventas por producto diario</a></li>
                  </ul>
                </li>

                <li><a><i class="fa fa-bar-chart"></i> Reporte de Compras <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                <li><a href="consulta6.php">Compras por Vendedor mensual/anual</a></li>
                <li><a href="consulta12.php">Compras por Vendedor diario</a></li>
                <li><a href="consulta3.php">Compras por Proveedor mensual/anual</a></li>
                <li><a href="consulta9.php">Compras por Proveedor diario</a></li>
                <li><a href="consulta4.php">Compras por producto mensual/anual</a></li>
                <li><a href="consulta10.php">Compras por producto diario</a></li>
                </ul>
                </li>

               <li><a><i class="fa fa-calculator"></i> Contabilidad <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="contabilidad.php">Calculo del IGV</a></li>
                  <li><a href="kardex_valorizado.php">Kardex valorizado</a></li>
                  </ul>
                </li>

            <li><a><i class="fa fa-check-square"></i> Manual sistema <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
              <li><a href="video.php">Manual del sistema</a></li>
              </ul>
            </li>

              </ul>
            </div>


          </div>
            <?php
}



function menu2(){
    ?>



    <?php
}

function menu3(){
    ?>
            <?php
            $db_db=DB_NAME;
            $db_users = $db_db.'.users';
            $db = conectar2();
            $consulta1 = "SELECT * FROM $db_users ";
            $result1 = mysqli_query($db, $consulta1);
            while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                if($valor1['user_id']==$_SESSION['user_id']){
                    $name=$valor1['nombres'];
                    $foto=$valor1['foto'];
                }
            }
            ?>

<div class="top_nav"  >

        <div class="nav_menu" style="background-color:  #001394;">
            <div class="nav toggle" style="width:23%"><a id="menu_toggle" ><i style="color: #FFFFFF" class="fa fa-bars"></i></a></div>
<?php
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$a="http://".$host.$url;
?>
            <ul class="navbar-right">

              <li class="panel-heading">

                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="img/man_default.svg" alt=""><font style="color: #FFFFFF"><?php echo $name ?></font><span style="color: #FFFFFF; font-size: 20px;" class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                <?php
                $db_db=DB_NAME;
                $db_sucursal = $db_db.'.sucursal';
                $db = conectar2();
                $consulta1 = "SELECT * FROM $db_sucursal ";
                $result1 = mysqli_query($db, $consulta1);
                while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                    $tienda=$valor1['tienda'];

                }
                ?>
                <?php
                for($i = 1 ;$i<=$tienda;$i++){
                }
                ?>
                <li><a href="perfil_user.php"><i class="icon-user-plus color-indigo"></i><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Mi perfil</a></li>
                <li><a href="#"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;&nbsp;Facturación</a></li>
                <li><a href="#"><i class="fa fa-gears"></i>&nbsp;&nbsp;&nbsp;Soporte</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp;Configurar diseño</a></li>
                <li><a href="salir.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;Cerrar sesion</a></li>
                </ul>
                </li>

                <li class="panel-heading">
                  <div class="btn-group">
                    <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Caja" onclick="window.location.href='caja.php'" ><i class="fa fa-dollar" ></i></button>
                    <button class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Lista de ventas" onclick="window.location.href='facturas.php'"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button>
                    <button class="btn btn-danger"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facturación" onclick="window.location.href='nueva_factura.php'"><span class="glyphicon glyphicon-indent-right" aria-hidden="true"></span></button>

                  </div>
                </li>
            </ul>
    </div>

</div>
<?php
}

function footer(){
    ?>
<footer>



    <div class="copyright-info">
            <p class="pull-right"> Orbitek Solutions.
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>

<?php

}
?>
