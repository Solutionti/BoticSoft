<?php
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
        $tienda1=$_SESSION['tienda'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		
        }
	if($action == 'ajax'){
	
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
       
        $sTable = "products,detalle_factura";
        $sWhere=" WHERE detalle_factura.id_producto=products.id_producto and detalle_factura.tienda=$tienda1 and detalle_factura.folio='7777'";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (products.nombre_producto like '%$q%' )";
		}
		$sWhere.=" order by detalle_factura.id_detalle desc";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
                if($q==""){
                $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");}
                else
                {
                $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");    
                }
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './transferencia3.php';
		if($q==""){
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";}
                else{  
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";}
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			?>
			<div class="table-responsive">
                           
			 <table id="example"  style="width:100%;color:black;">
                            <thead>
				<tr style="background-color:<?php echo tablas;?>;color:white; ">
                                        
					<th>Código</th>
					<th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Fecha</th>
					<th>Tipo</th>
					
                                        
				</tr>
                                </thead>
				<?php
                               
				while ($row=mysqli_fetch_array($query)){
					$codigo_producto=$row['codigo_producto'];
                                        $nombre_producto=$row['nombre_producto'];
                                        $cantidad=$row['cantidad'];
                                        $fecha= date('d/m/Y', strtotime($row['fecha']));
                                        $ot=$row['ot'];
                                        if($ot==1){
                                            $tipo="Salida";
                                        }
                                        if($ot==2){
                                            $tipo="Entrada";
                                        }
					?>
                                        <tr>
                                         	
                                            <td><?php echo $codigo_producto; ?></td>
                                            <td><?php echo $nombre_producto; ?></td>
                                           <td><?php echo $cantidad; ?></td>
                                            <td><?php echo $fecha; ?></td>
                                            <td><?php echo $tipo; ?></td>
                                            
                                        
                                                
					</tr>
					<?php
                                   
                                }
				?>
				<tr>
					<td colspan=14><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>

			</div>
			<?php
		}
	}
?>

