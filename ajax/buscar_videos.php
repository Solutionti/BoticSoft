<?php
 include('is_logged.php');
?>
<style>
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
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_video=intval($_GET['id']);
		//$query=mysqli_query($con, "select * from video where id_video='".$id_video."'");
		$count=0;
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM video WHERE id_video='".$id_video."'")){
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
			  <strong>Error!</strong> No se pudo eliminar este video. 
			</div>
			<?php
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
		
		$sTable = "video";
		$sWhere = "WHERE id_video>0";
                if ( $_GET['q'] != "" )
		{
			$sWhere.= " and (video.submenu LIKE '%".$q."%' or video.descripcion LIKE '%".$q."%' )";
			
		}
                 if ( $_GET['q1'] != "" )
		{
			$sWhere.= " and (video.menu ='$q1')";
			
		}
                $sWhere.=" order by video.id_video desc";
                include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
                $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere ");
                $row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
                $reload = './clientes.php';
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
                $query = mysqli_query($con, $sql);
                //print"$sql";
		if ($numrows>0){	
			?>
			<div class="table-responsive">
			  <table id="example"  style="width:100%;color:black;" border="1" cellspadding="0">
                             
                              <thead>
				<tr style="background-color:<?php echo tablas;?>;color:white; ">
                                   
                                    <th>Menu</th>
                                    <th>Submenu</th>
                                    <th style="width:50%;">Descripcion</th>
                                    <th>Video</th>
                                   
                                    <th class='text-right'>Acciones</th>
					
				</tr>
                                 </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_video=$row['id_video'];
						$menu=$row['menu'];
						$submenu=$row['submenu'];
						$descripcion=$row['descripcion'];
						$video=$row['video'];
                                            
						
					?>
				    <tr id="valor1">
                                        <input type="hidden" value="<?php echo $menu;?>" id="menu<?php echo $id_video;?>">
					<input type="hidden" value="<?php echo $submenu;?>" id="submenu<?php echo $id_video;?>">
					<input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id_video;?>">
                                        <input type="hidden" value="<?php echo $video;?>" id="video<?php echo $id_video;?>">
                                       
					<td ><?php echo $menu; ?></td>
                                        <td><?php echo $submenu; ?></td>
                                        <td><?php echo $descripcion; ?></td>
                                        <td><a href="<?php echo $video; ?>" target="_blank"><img src="images/youtube.jpg" width="50" height="30"></a></td>
					
					<td ><span class="pull-right">
					<a href="#" class='btn btn-warning btn-xs' title='Editar video' onclick="obtener_datos('<?php echo $id_video;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-danger btn-xs' title='Borrar video' onclick="eliminar('<?php echo $id_video; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>	
					</tr>
					<?php
                                        
                                        
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>
