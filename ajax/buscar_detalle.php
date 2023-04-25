<?php
include('is_logged.php');
?>
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
</style>
<?php
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
 	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
                $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
                $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
                $q4 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
		$sTable = "detalle_factura, clientes, users";
		$sWhere = "";
		$sWhere.=" WHERE detalle_factura.id_cliente=clientes.id_cliente and detalle_factura.tienda=$tienda1 and detalle_factura.id_vendedor=users.user_id and detalle_factura.ven_com<=2 and detalle_factura.tipo_doc<=3 and detalle_factura.activo=1 and detalle_factura.numero_factura>=0";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' )";
		}
                if ( $_GET['q1'] != "" )
		{
		$sWhere.= " and  (detalle_factura.numero_factura like '%$q1%' )";
		}

                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha, '%Y-%m-%d')<='$q3')";
		}
                if ( $_GET['q4'] != "" )
		{
		$sWhere.= " and  (ven_com='$q4')";
		}

		$sWhere.=" order by detalle_factura.id_detalle desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 100; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
                        <a target="_blank" href="excel/buscar_detalle.php?q=<?php echo $q;?>&q1=<?php echo $q1;?>&q2=<?php echo $q2;?>&q3=<?php echo $q3;?>&q4=<?php echo $q4;?>" target="_blanck"><img src="images/descargar-excel.png" ></a>

			<div class="table-responsive">
			  <table class="table" style="color:black;">
				<tr  style="background-color:<?php echo tablas;?>;color:white; ">
                                <th>Tipo</th>
                                <th>Nro Doc</th>
                                <th class='text-right'>Tipo de Doc</th>
                                <th>Fecha</th>
				<th>Cliente</th>
                                <th>Doc Cliente</th>
                                <th class='text-right'>Producto</th>
				<th class='text-right'>Cantidad</th>
                                <th class='text-right'>Precio</th>
                                <th class='text-right'>Total</th>
                                <th>Vendedor</th>


				</tr>
                		<?php
				while ($row=mysqli_fetch_array($query)){


						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
                                                $documento=$row['documento'];
                                                $id_producto=$row['id_producto'];
                                                $ruc=$row['doc'];
						$email_cliente=$row['email_cliente'];
                                                $folio=$row['folio'];
                                                $dni=$row['dni'];

						$nombre_vendedor=$row['nombres'];

                                                $estado_factura1=$row['tipo_doc'];

                                                $ven_com=$row['ven_com'];
                                                if($ven_com==1){
                                                    $tipo="Venta";
                                                    $color="Blue";
                                                }
                                                if($ven_com==2){
                                                    $tipo="Compra";
                                                    $color="red";
                                                }

                                                $moneda=$row['moneda'];

                                                    $mon=moneda;


                                                if($estado_factura1==1){
                                                    $estado1="Factura";

                                                }
                                                if($estado_factura1==2){
                                                    $estado1="Boleta";

                                                }
                                                if($estado_factura1==3){
                                                    $estado1=doc;
                                                }
                                                if($estado_factura1==5){
                                                    $estado1="Nota de Debito";

                                                }
                                                if($estado_factura1==6){
                                                    $estado1="Nota de Credito";
                                               }
                                               $producto=$row['id_producto'];
                                               if($id_producto>0){
                                               $query1 = mysqli_query($con, "select * from products where products.id_producto='".$id_producto."'");
                                               $row1=mysqli_fetch_array($query1);
                                                $producto=$row1['nombre_producto'];
                                                }
                                                $precio=$row['precio_venta'];
                                                $cantidad=$row['cantidad'];
						$total_venta=$precio*$cantidad;
					?>
					<tr id="valor1">
                                                <td style="color:<?php echo $color;?>"><?php print"$tipo" ; ?></td>
						<td><?php print"$folio $numero_factura" ; ?></td>
                                                <td><?php echo $estado1; ?></td>
                                                <td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
                                                <td><?php echo $documento;?></td>
                                                <td><?php echo $producto;?></td>
                                                <td class='text-right'><?php  echo number_format ($cantidad,2); ?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($precio,2); ?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($precio*$cantidad,2); ?></td>
                                                <td><?php echo $nombre_vendedor; ?></td>


					</tr>
					<?php
                                        $numrows=$numrows-1;

                                }
				?>
				<tr style="background:white;">
					<td colspan=13><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
                }

?>
