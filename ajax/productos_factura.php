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

textarea {


  border  : none;
  padding : 5 5px;
  margin  : 0;
  width   : 80px;
  height: 40px;

}

.switch-holder {
    display: flex;
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    justify-content: space-around;
    align-items: center;
}

.switch-label {
    width: 10px;
}

.switch-label i {
    margin-right: 1px;
}

.switch-toggle {
    height: 30px;
}

.switch-toggle input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    z-index: -2;
}

.switch-toggle input[type="checkbox"] + label {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 20px;
    border-radius: 20px;
    margin: 0;
    cursor: pointer;
    box-shadow: inset -8px -8px 15px rgba(255,255,255,.6),
                inset 10px 10px 10px rgba(0,0,0, .25);

}

.switch-toggle input[type="checkbox"] + label::before {
    position: absolute;
    content: '';
    font-size: 13px;
    text-align: center;
    line-height: 25px;
    top: 4px;
    left: 4px;
    width: 23px;
    height: 13px;
    border-radius: 20px;
    background-color: #d1dad3;
    box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px rgba(0,0,0, .25);
    transition: .3s ease-in-out;
}

.switch-toggle input[type="checkbox"]:checked + label::before {
    left: 50%;
    content: '';
    color: #fff;
    background-color: #00b33c;
    box-shadow: -3px -3px 5px rgba(255,255,255,.5),
                3px 3px 5px #00b33c;
}

.inputs{
  font-family: Arial, Sans-Serif;
font-size: 12px;
color: #black;
padding: 6px;
outline:none;
float:left;
border: solid 1px #adadad;
width: 230px;
transition: all 2s ease-in-out;
-webkit-transition: all 2s ease-in-out;
-moz-transition: all 2s ease-in-out;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
-moz-box-shadow:inset 0 0 5px 5px #E6E6E6;
-webkit-box-shadow:inset 0 0 5px 5px #E6E6E6;
box-shadow:inset 0 0 5px 5px #E6E6E6;
clear: right;
}


</style>
<?php
	//include('is_logged.php');
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
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table table-hover" >
          <thead>
				<tr  bgcolor="#001394" style="color:white;">
          <th>Foto</th>
					<th>Código</th>
					<th>Producto</th>
          <th>Medida</th>
          <th style="text-align:center;"><span>Descuento</span></th>
          <th style="text-align:center;"><span>Blister.</span></th>
					<th style="text-align:center;"><span>Cantidad.</span></th>
					<th style="text-align:center;"><span>Precio</span></th>
          <th style="text-align:center;"><span>Stock</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
      </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$codigo_producto=$row['codigo_producto'];
					$nombre_producto=$row['nombre_producto'];
          $nom_und=$row['nom_und'];
          $foto=$row['foto1'];
          $tienda=$_SESSION['tienda'];
          $b=$row["b$tienda"];
					$precio_venta=$row["precio_producto"];
          $descuento=$row["dcto"];
          $precio_venta_mayor=$row["precio_mayor"];
					?>
					<tr style="color:black;">
          <td><a class="thumbnail1"><img  class="imagen2" src="fotos/<?php echo $foto;?>" width="30" height="30" border="0" /><span><img src="fotos/<?php echo $foto;?>" class="imagen2" width="300" height="280" border="0" /></span></a></td>
            <td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
            <td><?php echo $nom_und; ?></td>

            <td  style="text-align:center;">

              <div class="switch-holder">
                   <div class="switch-label"></i><span><?php echo $descuento; ?></span></div>
                   <div class="switch-toggle"><input type="checkbox" id="descuento_<?php echo $id_producto;?>"><label for="descuento_<?php echo $id_producto;?>"></label></div>
               </div>

            </td>

            <td  style="text-align:center;">
              <div class="switch-holder">
                  <div class="switch-label"></i><span><?php echo $precio_venta_mayor; ?></span></div>
                  <input type="hidden" name="txt_precio_mayor" id="txt_precio_mayor" value="<?php echo $precio_venta_mayor; ?>">
                  <div class="switch-toggle"><input type="checkbox" id="precio_por_mayor_<?php echo $id_producto;?>"><label for="precio_por_mayor_<?php echo $id_producto;?>"></label></div>
              </div>
            </td>

						<td  style="text-align:center;">
            <input type="text" class="inputs" style="text-align:center; width : 100px;" id="cantidad_<?php echo $id_producto; ?>">
            </td>

						<td  style="text-align:center;">
            <input type="text" class="inputs"  style="text-align:center; width : 100px;" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo str_replace(",","",number_format($precio_venta,2));?>">
            </td>

            <td  style="text-align:center;">
              <input type="text" class="inputs" style="text-align:center; width : 100px;" disabled id="stock_<?php echo $id_producto; ?>" value="<?php echo $b;?>">
            </td>
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
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
