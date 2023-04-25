<?php
	include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
        function generar_numero_aleatorio($longitud) {
            $key = '';
            $pattern = '1234567890';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }
        $tienda=$_SESSION['tienda'];
        $cliente=279;
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
		$query=mysqli_query($con, "select * from detalle_factura where id_producto='".$id_producto."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM products WHERE id_producto='".$id_producto."'")){
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
			  <strong>Error!</strong> No se pudo eliminar éste  producto. Existen datos vinculadas a éste producto. 
			</div>
			<?php
		}
        }
	if($action == 'ajax'){
	$query1=mysqli_query($con, "select * from datosempresa where id_emp=1");
        $row1=mysqli_fetch_array($query1);
        $alerta=$row1['alerta'];
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
        $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
        //$aColumns = array('codigo_producto', 'nombre_producto');//Columnas de busqueda
        $sTable = "products";
        $sWhere = "WHERE id_producto>0";
        
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (products.codigo_producto LIKE '%".$q."%' or products.nombre_producto LIKE '%".$q."%')";
		}
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (products.cat_pro=$q2)";
		}
                if ( $_GET['q1'] != "" )
		{
                    $sWhere.=" $q1";
		}else{
                    $sWhere.=" order by id_producto desc";
                }
		
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; 
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
		$reload = './productos.php';
		if($q==""){
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";}
                else{  
                $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";}
                //$_SESSION['where']="$sWhere LIMIT $offset,$per_page";
                //print"$sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			?>
                           

			<div class="table-responsive">
                            <form style="color:black;" method="POST" name="f1" id="f1">
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                            <a href="javascript:seleccionar_todo()" >Marcar todos</a> | 
                            <a href="javascript:deseleccionar_todo()">Marcar ninguno</a>
                            
                            </div>  
                            <div class="col-md-1 col-sm-1 col-xs-12" >
                                 <button type="submit" class="btn btn-primary" id="actualizar_datos" name="enviar" value="enviar">Enviar</button>
                            </div>    
                            <table id="example"  style="width:100%;color:black;">
                                <thead>
				<tr style="background-color:<?php echo tablas;?>;color:white; ">
                                        <th>Foto</th>
					<th>Código</th>
					<th style="width:25%">Producto</th>
                                        <th>Stock</th>
                                        <th><?php echo des3;?></th>
                                        <th><?php echo des1;?></th>
                                        <th><?php echo des2;?></th>
                                        <th>Precio<br><?php echo moneda;?></th>
					<th class="text-center">Asignar</th>
                                       
				</tr>
                                </thead>
				<?php
                                $i=0;
				while ($row=mysqli_fetch_array($query)){
                                            $pro_ser=$row['pro_ser'];
                                            if($i%2==0){
                                                $table="valor1";
                                            }else{
                                                $table="valor2";
                                            }
                                            $i=$i+1;
                                            $id_producto=$row['id_producto'];
                                            $codigo_producto=$row['codigo_producto'];
                                            $nombre_producto=$row['nombre_producto'];
                                            $status_producto=$row['status_producto'];
                                            $marca=$row['marca'];
                                            $modelo=$row['modelo'];
                                            $color=$row['color'];
                                            $cat_pro=$row['cat_pro'];
                                            $pro_ser=$row['pro_ser'];
                                            $foto=$row['foto1'];
                                            $sql1="SELECT * FROM  permiso WHERE id_producto=$id_producto and id_cliente=$cliente";
                                            $query1 = mysqli_query($con, $sql1);
                                            //print"$sql1";   
                                            $id="";
                                            while ($row1=mysqli_fetch_array($query1)){
                                                //  if($row1['doc_servicio']==$numero_factura && $row1['tip_doc']==$estado_factura1)  {
                                                $id=$row1['id_producto'];
                                                
                                                // }
                                            }
                                            $dd="";
                                            if($id*1>0){
                                                $dd="checked";
                                            }
                                            
                                            
                                            $b=$row["b$tienda"];
                                            $mon_venta=$row['mon_venta'];
                                            $dolar=$row['mon_costo'];
                                            
                                            $label_class='label-success';
                                            $date_added= date('d/m/Y', strtotime($row['date_added']));
                                            $precio_producto=$row['precio_producto'];
                                            $precio2=$row['precio2'];
                                            $precio3=$row['precio3'];
                                            $und_pro=$row['und_pro'];
                                            $costo_producto=$row['costo_producto']/$row['mon_costo'];
                                            $costo=$row['costo_producto'];
                                            $utilidad=$row['precio_producto']-$row['costo_producto'];
                                             
					?>
                                        <tr id="<?php echo $table;?>">
                                                <td>
                                                <a class="thumbnail1">
                                                <img  class="imagen2" src="fotos/<?php echo $foto;?>" width="30" height="30" border="0" />
                                                </a>  
                                            </td>	
                                            <td><?php echo $codigo_producto; ?></td>
                                            <td><?php echo $nombre_producto; ?></td>
                                            <td><span class="label <?php echo $label_class;?>"><?php echo $b; ?></span></td>
                                            
                                            <td><?php echo $marca;?></td>
                                            <td><?php echo $modelo;?></td>
                                            <td><?php echo $color;?></td>
                                            <td><font color="blue"><strong><span class='pull-right'><?php echo number_format($precio_producto,2);?></strong></font></span></td>
                                            <td class="text-center">
                                                <input type="checkbox" <?php echo $dd;?> name="a<?php echo $i;?>" id="a<?php echo $i;?>" value="<?php echo $id_producto;?>">
                                                <input type="hidden"  name="b<?php echo $i;?>" id="b<?php echo $i;?>" value="<?php echo $id_producto;?>">   
                                            </td>
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
                            </form>

			</div>
			<?php
		}
	}
?>
<script>
function seleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1 
} 
function deseleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
}
function disableOthers(field) {
disableCheck(formulario.dos, field);
disableCheck(formulario.tres, field);
}
</script>

