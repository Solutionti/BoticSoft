
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
                //$q4 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q4'], ENT_QUOTES)));
                //$q5 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q5'], ENT_QUOTES)));
		$sTable = "facturas, clientes, users";
		$sWhere = "";
		$sWhere.=" WHERE facturas.id_cliente=clientes.id_cliente and facturas.tienda=$tienda1 and facturas.id_vendedor=users.user_id and facturas.ven_com=1 and facturas.estado_factura<=3 and facturas.activo=1 and facturas.numero_factura>0";
                if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (clientes.nombre_cliente like '%$q%' )";
		}
                if ( $_GET['q1'] != "" )
		{
		$sWhere.= " and  (facturas.numero_factura like '%$q1%' )";
		}
                
                if ( $_GET['q2'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')>='$q2' )";
		}
                if ( $_GET['q3'] != "" )
		{
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')<='$q3')";
		}
                //if ( $_GET['q4'] != "" )
		//{
		//$sWhere.= " and  (facturas.id_vendedor='$q4')";
		//}
                //if ( $_GET['q5'] != "" )
		//{
		//$sWhere.= " and  (facturas.deuda_total-facturas.cuenta1$q5)";
		//}
		$sWhere.=" order by facturas.id_factura desc";
		
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
                                <th>Nro Doc</th>
                                <th class='text-right'>Tipo de Doc</th>
                                <th>Fecha</th>
				<th>Cliente</th>
                                <th>Doc</th>
				<th class='text-right'>Total</th>
                                <th class='text-right'>Deuda</th>
                                <th>Vendedor</th>
                                <th>Pago</th>
                                <th class='text-right'>Estado</th>
                                
				</tr>
                		<?php
				while ($row=mysqli_fetch_array($query)){
                                    
                                                $activo=$row['activo'];
						if ($activo==1){
                                                $id_factura=$row['id_factura'];
						$numero_factura=$row['numero_factura'];
						$fecha=date("d/m/Y", strtotime($row['fecha_factura']));
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
                                                $ruc=$row['doc'];
						$email_cliente=$row['email_cliente'];
                                                $folio=$row['folio'];
                                                $dni=$row['dni'];
                                                $documento=$row['documento'];

						$nombre_vendedor=$row['nombres'];
                                                $aceptado=$row['aceptado'];
                                                $estado_factura1=$row['estado_factura'];
 						$estado_factura=$row['condiciones'];
                                                $ven_com=$row['ven_com'];
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
                                               if($estado_factura==1){
                                                    $estado2="Efectivo";
                                                }
                                                if($estado_factura==2){
                                                    $estado2="Cheque";
                                                    
                                                }
                                                if($estado_factura==3){
                                                    $estado2="Transf Bancaria";
                                                }
                                                if($estado_factura==4){
                                                    $estado2="Crédito";
                                               }
                                                $deuda=$row['deuda_total']-$row['cuenta1'];
                                                $servicio=$row['servicio'];
                                                
                                                if ($servicio==0){$text_estado1="Productos";$label_class1='label-success';}
                                                else{$text_estado1="Servicios";$label_class1='label-warning';}
                                           	if ($deuda==0){$text_estado="Pagada";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						$total_venta=$row['total_venta'];
					?>
					<tr id="valor1">
                                           
						<td><?php print"$folio $numero_factura" ; ?></td>
                                                <td><?php echo $estado1; ?></td>
                                                <td><?php echo $fecha; ?></td>
						<td><?php echo $nombre_cliente;?></td>
                                                <td><?php echo $documento;?></td>
                                                <td class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>					
                                                <td class='text-right'><?php print"$mon"; echo number_format ($deuda,2); ?></td>
                                                <td><?php echo $nombre_vendedor; ?></td>
                                                <td><span class="label label-success"><?php echo $estado2; ?></span></td>
                                                <td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
                                                
					</tr>
					<?php
                                        $numrows=$numrows-1;
                   		}
                                }
				?>
				
			  </table>
			</div>
			<?php
		}
                }
	
?>

