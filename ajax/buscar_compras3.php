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
 tfoot {
    display: table-header-group;
}     
</style>
<?php

	
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	$tienda1=$_SESSION['tienda'];
        $usuario=$_SESSION['user_id'];
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
        $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
		$sTable = "facturas, clientes, users";
		$sWhere = "";
		$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and ven_com=12 and activo=0 and facturas.tienda=$tienda1";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";	
		}
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')<='$q3')";
		}
		$sWhere.=" order by facturas.id_factura desc";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table" style="color:black;">
				<tr  style="background-color:<?php echo tablas;?>;color:white; ">
                                        <th>Nro doc</th>
                                        <th>Tipo de Doc</th>
                                	<th>Fecha</th>
					<th>Proveedor</th>
					<th>Vendedor</th>
					
					<th class='text-right'>Total</th>
                                        
					<th class='text-right'>Acciones</th>	
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                                $activo=$row['activo'];
                                                $id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
                                                $moneda=$row['moneda'];
                                                $folio=$row['folio'];
                                                $mon=moneda;
                                                
                                                
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
                                                $ruc=$row['doc'];
                                                
                                                $deuda=$row['deuda_total']-$row['cuenta1'];
						$nombre_vendedor=$row['nombres'];
						
						
						$total_venta=$row['total_venta'];    
					?>
					<tr id="valor1">
						<td><?php echo $folio; ?>-<?php echo $numero_factura; ?></td>
                                                <td>Requerimiento</td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
						<td><?php echo $nombre_vendedor; ?></td>
						
						<td class='text-right'><?php print"$mon ";echo number_format ($total_venta,2); ?></td>
                                                
                                                <td class="text-right">
                                                    <a href="#" class='btn btn-primary btn-xs' title='Descargar documento' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> 
                                                    
                                                    <a href="nueva_compras.php?folio=<?php echo $folio;?>&numero_factura=<?php echo $numero_factura;?>" class='btn btn-success btn-xs' title='Realizar compra'><i class="glyphicon glyphicon-download"></i></a>
                                                   
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
