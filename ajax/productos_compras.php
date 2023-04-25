<?php
include('is_logged.php');
?>
<style type="text/css">
   .thumbnail1{
position: relative;
z-index: 0;
}
.thumbnail1:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail1 span{ /*Estilos del borde y texto*/
position: absolute;
background-color: white;
padding: 5px;
left: -100px;

visibility: hidden;
color: #FFFF00;
text-decoration: none;
}
.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}
.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 17px;
left: 60px; /*position where enlarged image should offset horizontally */
}
img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;
}
</style>
<?php

	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto');
		 $sTable = "products,und";
                 $sWhere="";
		 $sWhere.=" WHERE products.und_pro=und.id_und";
		if ( $_GET['q'] != "" )
		{
			$sWhere.= " and  (products.nombre_producto like '%$q%' or products.codigo_producto like '%$q%')";
		}
                $sWhere=$sWhere." ORDER BY  `products`.`id_producto` DESC ";
		include 'pagination.php';
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT  5";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  style="background-color: #001394; color: white;">
					<th>Código</th>
					<th>Producto</th>
          <th>Laboratorio</th>
					<th class='text-center'>Cant.</th>
					<th class='text-center'>Costo</th>
          <th class='text-center'>Stock</th>
					<th class='text-center' style="width: 40px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
          $cod_laboratorio=$row['cod_laboratorio'];
          $foto=$row['foto1'];
          $nom_und=$row['nom_und'];
          $tienda=$_SESSION['tienda'];
          $b=$row["b$tienda"];
          $precio_venta=$row["costo_producto"];

          $sql_laboratorio=mysqli_query($con,"select * from laboratorio where id_laboratorio='".$cod_laboratorio."' ");
          while($row_lab=mysqli_fetch_array($sql_laboratorio))
          {
            $laboratorio=$row_lab['nom_laboratorio'];
          }

					?>
					<tr >
          <td><?php echo $codigo_producto; ?></td>
					<td><?php echo $nombre_producto; ?></td>
          <td><?php if(!empty($laboratorio)){echo $laboratorio;} ?></td>
					<td ><input  style=" width:70px;text-align: justify;" type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"   ></td>
					<td ><input  style=" width:70px;text-align: justify;" type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo str_replace(",","",number_format($precio_venta,2));?>" ></td>
          <td><input   style=" width:70px;text-align: justify;" type="text" class="form-control" style="text-align:right" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo $b;?>"></td>
					<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=8><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>
