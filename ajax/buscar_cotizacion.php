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
	//include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
 	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_factura=intval($_GET['id']);
		$del1="UPDATE facturas set activo=0 where id_factura='".$id_factura."'";
                $sql1=mysqli_query($con, "select * from facturas where id_factura='".$id_factura."'");
                while ($row1=mysqli_fetch_array($sql1))
                {
                    $numero_factura=$row1["numero_factura"];
                    $folio=$row1["folio"];
                    $tipo_doc=$row1["estado_factura"];
                    $tienda=$row1["tienda"];
                    $id_cliente=$row1["id_cliente"];
                    $deuda=$row1["deuda_total"];
                    $nombre=$row1["nombre"];
                    $cuenta1=$row1["des"];
                }
                $del4="UPDATE clientes SET deuda=deuda-$deuda WHERE id_cliente='".$id_cliente."'";
                $del2="UPDATE detalle_factura set activo=0 where folio='".$folio."' and numero_factura='".$numero_factura."' and ven_com=1 and tienda=$tienda and tipo_doc=$tipo_doc and id_cliente=$id_cliente";
                $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM pagos  where id_factura=$id_factura");
		$row2= mysqli_fetch_array($count_query);
		$numrows = $row2['numrows'];
          	if ($cuenta1>0 and $numrows==0 and $delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2) and $delete4=mysqli_query($con,$del4)){
                  $sql=mysqli_query($con, "select * from detalle_factura where folio='".$folio."' and numero_factura='".$numero_factura."' and ven_com=1 and tienda=$tienda and id_cliente=$id_cliente and tipo_doc=$tipo_doc" );
                    while ($row=mysqli_fetch_array($sql))
                    {
                        $id_producto=$row["id_producto"];
                        $tienda=$row["tienda"];
                        $cantidad=$row["cantidad"];
                        $b="b".$tienda;
                        if($cuenta1==1){
                        $productos1=mysqli_query($con, "UPDATE products SET $b=$b+$cantidad WHERE id_producto=$id_producto");
                        $cuenta2=2;
                        }
                        if($cuenta1==2){
                        $productos1=mysqli_query($con, "UPDATE products SET $b=$b-$cantidad WHERE id_producto=$id_producto");
                        $cuenta2=1;
                        }
                        $sql1=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
                        while ($row1=mysqli_fetch_array($sql1))
                        {
                            $b=$row1["b$tienda"];
                        }
                        $c=$b-$cantidad;  
                        $insert=mysqli_query($con,"INSERT INTO detalle_factura VALUES ('','$id_cliente','$usuario','$numero_factura','$cuenta2','$id_producto','$cantidad','0','$tienda1','0','2','$fecha1','0','$tipo_doc','$c','3.2','$folio')");  
         
                    }
                    ?>
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else{
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos existen cobros asociados.
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
                $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
                $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
		$sTable = "facturas, clientes, users";
		$sWhere = "";
		$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.tienda=$tienda1 and facturas.id_vendedor=users.user_id and facturas.ven_com=1 and facturas.estado_factura=8 and facturas.activo=0 and facturas.numero_factura>0";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' )";
		}
                if ( $_GET['q1'] != "" )
		{
		$sWhere.= " and  (facturas.numero_factura like '%$q1%' )";
		}
                
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')<='$q3' )";
		}
		$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
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
			<div class="table-responsive">
			  <table class="table" style="color:black;">
				<tr  style="background-color:<?php echo tablas;?>;color:white; ">
                                <th>Nro Doc</th>
                                <th class='text-right'>Tipo de Doc</th>
                                <th>Fecha</th>
				<th>Cliente</th>
				<th class='text-right'>Total</th>
                               
                                <th>Vendedor</th>
                               
                                <th class='text-right'>PDF</th>
                                
                               
                                <th class='text-right'>Acciones</th>
				</tr>
                		<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                $activo=$row['activo'];
						
                                                $id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
                                                $ruc=$row['doc'];
						$email_cliente=$row['email_cliente'];
                                                $folio=$row['folio'];
                                                $dni=$row['dni'];
                                                
						$nombre_vendedor=$row['nombres'];
                                                $aceptado=$row['aceptado'];
                                                $estado_factura1=$row['estado_factura'];
 						$estado_factura=$row['condiciones'];
                                                $ven_com=$row['ven_com'];
                                                $moneda=$row['moneda'];
                                                $mon=moneda;
                                                if($estado_factura==1){
                                                    $estado2="Efectivo";
                                                }
                                                if($estado_factura==2){
                                                    $estado2="Cheque";
                                                    
                                                }
                                                if($estado_factura==3){
                                                    $estado2="Transf Bancaria";
                                                }
                                                if($estado_factura==4){
                                                    $estado2="Crédito";
                                               }
                                                $deuda=$row['deuda_total'];
                                                $servicio=$row['servicio'];
                                                $guia=0;
                                                $sql1="SELECT * FROM  servicio;";
                                                $query1 = mysqli_query($con, $sql1);
                                               
                                                while ($row1=mysqli_fetch_array($query1)){
                                                  if($row1['doc_servicio']==$numero_factura && $row1['tip_doc']==$estado_factura1)  {
                                                     $guia=$row1['guia'];
                                                 }
                                                }
                                                if ($servicio==0){$text_estado1="Productos";$label_class1='label-success';}
                                                else{$text_estado1="Servicios";$label_class1='label-warning';}
                                           	if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
					?>
					<tr id="valor1">
                                           
						<td><?php print"$folio $numero_factura" ; ?></td>
                                                <td>Cotización</td>
                                                <td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>					
                                                
                                                <td><?php echo $nombre_vendedor; ?></td>
                                               
                                                 <td><a href="#" class='btn btn-primary btn-xs' title='Descargar pdf' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> </td>
                                                
                                                 <td class="text-right">
					
						<?php  
                                                if ($estado_factura1==1){
                                                    ?>
                                                <a href="guia.php?accion=<?php echo $id_factura;?>" class='btn btn-info btn-xs' title='Guia de remision' ><i class="glyphicon glyphicon-download"></i></a> 
                                                 <?php
                                                }   
                                                ?>
                                                
                                                
                                                    <a href="nueva_factura.php?folio=<?php echo $folio;?>&numero_factura=<?php echo $numero_factura;?>" class='btn btn-info btn-xs' title='Vender' ><i class="glyphicon glyphicon-download"></i></a>    
                                                    
						
                                                </td>
					</tr>
					<?php
                                        $numrows=$numrows-1;
                   		
                                }
				?>
				<tr style="background:white;">
					<td colspan=10><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
                }
	
?>

