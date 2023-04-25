<?php
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$laboratorio=$_GET['id'];
		$query=mysqli_query($con, "select * from products where cod_laboratorio='".$laboratorio."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM laboratorio WHERE id_laboratorio='".$laboratorio."'")){
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
			  <strong>Error!</strong> No se puede eliminar.
			</div>
			<?php
		}
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  Laboratorio. Existen datos vinculadas
			</div>
			<?php
		}
        }
	if($action == 'ajax'){

        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
        $aColumns = array('id_laboratorio', 'nom_laboratorio');//Columnas de busqueda
        $sTable = "laboratorio";
        $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}


		$sWhere.=" order by id_laboratorio desc";
		include 'pagination.php';
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
                if($q==""){
                $count_query= mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable WHERE id_laboratorio>0 $sWhere");}
                else
                {
                $count_query= mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
                }

		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './laboratorio.php';
		if($q==""){
                $sql="SELECT * FROM  $sTable WHERE id_laboratorio > 0 $sWhere LIMIT $offset,$per_page";}
                else{
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";}
		$query = mysqli_query($con, $sql);

		if ($numrows>0){
			?>
			<div class="table-responsive">
			<table id="example" class="display nowrap" style="width:100%;color:black;">
      <thead>
				<tr style="background-color:<?php echo tablas;?>;color:white; ">
					<th>Código</th>
					<th>Nombre del Laboratorio</th>
          <th class='text-right'>Acciones</th>
				</tr>
      </thead>
				<?php
        $i=0;
				while ($row=mysqli_fetch_array($query)){
          $id_laboratorio=$row['id_laboratorio'];
          $nom_laboratorio=$row['nom_laboratorio'];
					?>
          <tr>
          <input type="hidden" value="<?php echo $id_laboratorio?>" id="id_laboratorio<?php echo $id_laboratorio;?>">
					<input type="hidden" value="<?php echo $nom_laboratorio;?>" id="nom_laboratorio<?php echo $id_laboratorio;?>">

          <td><?php echo $id_laboratorio; ?></td>
          <td><?php echo $nom_laboratorio; ?></td>
          <td><span class="pull-right">
          <a href="#" class='btn btn-warning btn-xs' title='Editar servicio' onclick="obtener_datos('<?php echo $id_laboratorio;?>');" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil"></i></a>
          <a href="#" class="btn btn-danger btn-xs" title='Borrar servicio' onclick="eliminar('<?php echo $id_laboratorio; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
          
					</td>
					</tr>
					<?php
          }
				?>
				<tr>
					<td colspan=5><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>

			</div>
			<?php
		}
	}
?>
