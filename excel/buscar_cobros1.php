
<?php
        include('../ajax/is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
        $rr=253;
	$tienda1=$_SESSION['tienda'];
	header("Content-type: application/vnd.ms-excel" ) ; 
        header("Content-Disposition: attachment; filename=facturas.xls" ) ;
	
		$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
                $q1 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q1'], ENT_QUOTES)));
                $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q2'], ENT_QUOTES)));
                $q3 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q3'], ENT_QUOTES)));
                $sTable = "facturas,clientes, users";
                $rr=$_SESSION['cliente'];
                
		$sWhere = "WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id and facturas.ven_com=3 and facturas.activo=1";
                
                if ( $_GET['q'] == "" and $rr>0)
		{
			$sWhere.= " and (clientes.id_cliente=$rr)";
			
		}
                
                if ( $_GET['q'] != "" )
		{
			$sWhere.= " and (clientes.nombre_cliente LIKE '%".$q."%' or clientes.documento LIKE '%".$q."%' or clientes.telefono_cliente LIKE '%".$q."%')";
			
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
		$sWhere.= " and  (DATE_FORMAT(fecha_factura, '%Y-%m-%d')<='$q3' )";
		}
                
		$sWhere.=" order by facturas.id_factura desc";
                
                //print"$sWhere";
		
		
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		
		$sql="SELECT * FROM  $sTable $sWhere ";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table id="example" class="display nowrap" style="width:100%;color:black;" border="1">
                              
                              <thead>
                        	<tr  style="font-weight: bold; ">
                                    <th>Fecha  </th>
                                    <th>Hora </th>
                                    <th>Cliente </th>
                                    <th>Cobros  </th>
                                    <th>Doc  </th>
                                    <th>Tipo Doc  </th>
                                    <th>Vendedor </th>
                                    <th>Tipo<br> de Cobro </th>
                                    <th>Operacion<br> y Cobro </th>
                                    <th>Eliminar  </th>
				</tr>
                                </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                    	$fecha3=$row['fecha_factura'];
                                        $fecha4=date("d/m/Y",strtotime($fecha3));
                                        $hora=date("H:i",strtotime($fecha3)); 
                                        $nombre_cliente=$row['nombre_cliente'];
                                        $total_venta=$row['total_venta'];
                                        $id=$row['id_factura']; 
                                        $mon=moneda;
                                        $numero_factura=$row['numero_factura'];
                                        $estado_factura=$row['estado_factura'];
                                        $sql1="select * from comprobante_pago where id_comprobante=$estado_factura";
                                        $rs1=mysqli_query($con,$sql1);
                                        $row1= mysqli_fetch_array($rs1);
                                        $tipo=$row1['des_comprobante'];
                                        $nombre_vendedor=$row['nombres'];
                                        $condiciones=$row['condiciones'];
                                        if($condiciones==1){
                                            $condiciones1="Efectivo";
                                        }
                                        if($condiciones==2){
                                            $condiciones1="Cheque";
                                        }
                                        if($condiciones==3){
                                            $condiciones1="Transferencia Bancaria";
                                        }
                                        if($condiciones==4){
                                            $condiciones1="Deposito";
                                        }
                                        $obs=$row['obs']; 
					?>
					<tr id="valor1">
                                            <td class=" "><?php print"$fecha4";?></td>
                                            <td class=" "><?php print"$hora";?></td>
                                            <td class=" "><?php echo $nombre_cliente;?></td>
                                            <td class=" "><?php echo $total_venta;?></td>
                                            <td class=" "><?php echo $numero_factura;?></td>
                                            <td class=" "><?php echo $tipo;?></td>
                                            <td class=" "><?php echo $nombre_vendedor;?></td>
                                            <td class=" "><?php echo $condiciones1;?></td>
                                            <td class=" "><?php echo $obs;?></td>
                                            <td class=" ">
                                                
                                                 <a href="#" class='btn btn-danger btn-xs' title='Borrar Cobros' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                            
                                            </td>    
					</tr>
					<?php
                                }
				?>
				
			  </table>
			</div>
			<?php
		}
               	
?>
