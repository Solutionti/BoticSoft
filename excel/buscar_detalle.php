
<?php
	include('../ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$tienda1=$_SESSION['tienda'];
        $sql1="select * from users where user_id=$_SESSION[user_id]";
        $rw1=mysqli_query($con,$sql1);//recuperando el registro
        $rs1=mysqli_fetch_array($rw1);//trasformar el registro en un vector asociativo
        $modulo=$rs1["accesos"];
        $a = explode(".", $modulo); 
        if($a[22]==0){
            header("location:error.php");    
        }
        date_default_timezone_set('America/Lima');
        $fecha1  = date("Y-m-d H:i:s");
 	$action = 1;
	header("Content-type: application/vnd.ms-excel" ) ; 
        header("Content-Disposition: attachment; filename=facturas.xls" ) ;
	
	if($action == '1'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
                $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
                $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
                $q4 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
		$sTable = "detalle_factura, clientes, users";
		$sWhere = "";
		$sWhere.=" WHERE detalle_factura.id_cliente=clientes.id_cliente and detalle_factura.tienda=$tienda1 and detalle_factura.id_vendedor=users.user_id and detalle_factura.ven_com<=2 and detalle_factura.tipo_doc<=3 and detalle_factura.activo=1 and detalle_factura.numero_factura>=0";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' )";
		}
                if ( $_GET['q1'] != "" )
		{
		$sWhere.= " and  (detalle_factura.numero_factura like '%$q1%' )";
		}
                
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha, '%Y-%m-%d')<='$q3')";
		}
                if ( $_GET['q4'] != "" )
		{
		$sWhere.= " and  (ven_com='$q4')";
		}
		$sWhere.=" order by detalle_factura.id_detalle desc";
		
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere ";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
                       
			<div class="table-responsive">
			  <table class="table">
				<tr  style="color:black; ">
                                <th>Tipo</th>    
                                <th>Nro Doc</th>
                                <th class='text-right'>Tipo de Doc</th>
                                <th>Fecha</th>
				<th>Cliente</th>
                                <th>Producto</th>
				<th class='text-right'>Cantidad</th>
                                <th class='text-right'>Precio</th>
                                <th class='text-right'>Total</th>
                                <th>Vendedor</th>
                                
                                
				</tr>
                		<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha']));
						$nombre_cliente=$row['nombre_cliente'];
                                                $id_producto=$row['id_producto'];
						$telefono_cliente=$row['telefono_cliente'];
                                                $documento=$row['documento'];
                                                $ruc=$row['doc'];
						$email_cliente=$row['email_cliente'];
                                                $folio=$row['folio'];
                                                $dni=$row['dni'];
                                                $nombre_vendedor=$row['nombres'];
                                                $estado_factura1=$row['tipo_doc'];
 						$ven_com=$row['ven_com'];
                                                if($ven_com==1){
                                                    $tipo="Venta";
                                                    $color="Blue";
                                                }
                                                if($ven_com==2){
                                                    $tipo="Compra";
                                                    $color="red";
                                                }
                                                $moneda=$row['moneda'];
                                                
                                                    $mon=moneda;
                                                
                                                
                                                if($estado_factura1==1){
                                                    $estado1="Factura";
                                                    
                                                }
                                                if($estado_factura1==2){
                                                    $estado1="Boleta";
                                                    
                                                }
                                                if($estado_factura1==3){
                                                    $estado1=doc;
                                                }
                                                if($estado_factura1==5){
                                                    $estado1="Nota de Debito";
                                                    
                                                }
                                                if($estado_factura1==6){
                                                    $estado1="Nota de Credito";
                                               }
                                               
                                               $producto=$row['id_producto'];
                                               if($id_producto>0){
                                               $query1 = mysqli_query($con, "select * from products where products.id_producto='".$id_producto."'");
                                               $row1=mysqli_fetch_array($query1);
                                                $producto=$row1['nombre_producto'];
                                                }
                                                $precio=$row['precio_venta'];
                                                $cantidad=$row['cantidad'];
						$total_venta=$precio*$cantidad;
					?>
					<tr id="valor1">
                                                <td style="color:<?php echo $color;?>"><?php print"$tipo" ; ?></td>
						<td><?php print"$folio $numero_factura" ; ?></td>
                                                <td><?php echo $estado1; ?></td>
                                                <td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
                                                 <td><?php echo $documento;?></td>
                                                <td><?php echo $producto;?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($cantidad,2); ?></td>					
                                                <td class='text-right'><?php print"$mon"; echo number_format ($precio,2); ?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($precio*$cantidad,2); ?></td>
                                                <td><?php echo $nombre_vendedor; ?></td>
                                              
                                                
					</tr>
					<?php
                                        $numrows=$numrows-1;
                   		
                                }
				?>
				
			  </table>
			</div>
			<?php
		}
                }
	
?>

