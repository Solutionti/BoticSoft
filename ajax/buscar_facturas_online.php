<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
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
		$sTable = "factura_carrito";
		$sWhere = "";
		$sWhere.=" WHERE nro_guia>=0";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (nombre like '%$q%' )";
		}
                if ( $_GET['q1'] != "" )
		{
		$sWhere.= " and  (nro_guia like '%$q1%' )";
		}
                
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha1, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha1, '%Y-%m-%d')<='$q3')";
		}
		$sWhere.=" order by id_factura1 desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 30; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './factura_online.php';
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
                                <th>Nro Guia</th>
                                
                                <th>Fecha</th>
				<th>Cliente</th>
                                <th>Documento</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Observacion</th>
                                <th class='text-right'>Total<br><?php echo moneda;?></th>
                                <th class='text-right'>Tipo</th>
                                
                                
                                <th class='text-right'>PDF<br>Ticket</th>
                                <th class='text-right'>Vender</th>
				</tr>
                		<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                $id=$row['codigo'];
                                                $id_factura=$row['activo'];
                                                $pro="<font color=blue>Vendido</font>";
                                                if($id_factura==0 or $id_factura==2){
                                                    $pro="<font color=red>No Vendido</font>";
                                                }
                                                
						$nro_guia=$row['nro_guia'];
						$fecha=date("d/m/Y", strtotime($row['fecha1']));
						$nombre_cliente=$row['nombre'];
                                                $documento=$row['documento'];
						$telefono_cliente=$row['telefono'];
                                                $observacion=$row['observacion'];
                                                $ruc=$row['documento'];
						$email_cliente=$row['email'];
                                                $mon=moneda;
						
						$total_venta=$row['total'];
					?>
					<tr id="valor1">
                                           
						<td><?php print" $nro_guia" ; ?></td>
                                               
                                                <td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
                                                <td><?php echo $documento;?></td>
                                                <td><?php echo $email_cliente;?></td>
                                                <td><?php echo $telefono_cliente;?></td>
                                                <td><?php echo $observacion;?></td>
                                                <td class='text-right'><?php  echo number_format ($total_venta,2); ?></td>					
                                               <td><?php echo $pro;?></td>
                                                
                                                
                                                
                                                 
                                                 <td>
                                                     
                                                     <a href="#" class='btn btn-primary btn-xs' title='Descargar pdf' onclick="imprimir_factura('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a>
                                                     <a href="#" class='btn btn-primary btn-xs' title='Descargar ticket' onclick="imprimir_factura2('<?php echo $id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a> </td>
                                                 <td class="text-right">
					
                                               
						<?php  
                                                if ($id_factura==0 or $id_factura==2){
                                                    //?>
                                                    <a href="doc.php?accion=2&tipo=1&online=<?php echo $id;?>" class='btn btn-success btn-xs' title='Crear documento electrónico' ><i class="glyphicon glyphicon-download"></i> </a>
                                                    <?php
                                               }else {
                                                   print"Vendido";
                                               }  
                                                ?>
                                                </td>
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

