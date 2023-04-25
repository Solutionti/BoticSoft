<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$id_producto=$_SESSION['id_producto'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_pack=intval($_GET['id']);
		$query=mysqli_query($con, "select * from detalle_factura where id_producto='".$id_producto."'");
		$count=mysqli_num_rows($query);
                
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM pack WHERE id_pack='".$id_pack."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar porque el producto ha sido utilizado en otro proceso. 
			</div>
			<?php
		}
	
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
          
          
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 
		 $sTable = "pack,products,und";
		 $sWhere = "";
		$sWhere.=" WHERE products.und_pro=und.id_und and pack.tipo=0 and pack.id_producto=$id_producto and products.id_producto=pack.id_producto1";
                if ( $_GET['q'] != "" )
		{
			$sWhere .= " and (products.nombre_producto LIKE '%".$q."%')";
			
		}
                
		$sWhere.=" order by id_pack desc";
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
		$reload = './pack.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table" style="color:black;">
				<tr  class="info">
					<th>Producto</th>
                                        <th>Unidad de medida</th>
					<th>Cantidad</th>
                                        <th>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_pack=$row['id_pack'];
						$cantidad=$row['cantidad'];
                                                $id_producto1=$row['id_producto1'];
                                                $id_producto=$row['id_producto'];
                                                $nombre_producto=$row['nombre_producto'];
                                                $nom_und=$row["nom_und"];
					?>
					
					<input type="hidden" value="<?php echo $cantidad;?>" id="cantidad<?php echo $id_pack;?>">
					
                                        <tr>
						
						<td><?php echo $nombre_producto; ?></td>
                                                <td><?php echo $nom_und; ?></td>
                                                <td ><?php echo $cantidad; ?></td>
									<td><span class="pull-right">
                                                                               
					<!--<a href="#" class='btn btn-warning btn-xs' title='Editar' onclick="obtener_datos('<?php echo $id_pack;?>');" data-toggle="modal" data-target="#myModal2" readonly><i class="fa fa-pencil"></i>Editar</a> -->
                                        <a href="#" class='btn btn-danger btn-xs' title='Borrar' onclick="eliminar('<?php echo $id_pack; ?>')"><i class="glyphicon glyphicon-trash"></i> Borrar</a></span>
                                             </td>
					
                                           
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>