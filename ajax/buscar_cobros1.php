<?php
include('is_logged.php');
?>
<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}
table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {        
border-bottom: 2px solid #F5ECCE;
}  
#valor1:hover {             
background-color: white;
border-bottom: 2px solid #A9E2F3;
} 
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
        //include('is_logged.php');
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
        $rr=253;
	$tienda1=$_SESSION['tienda'];
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
            $id_factura=intval($_GET['id']);
            $consulta1 = "SELECT * FROM facturas where id_factura=$id_factura";
            $result1 = mysqli_query($con, $consulta1);
            while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                
                    $numero=$row["id_cliente"];
                    $pago=$row["total_venta"];
                       
            }
            $del1="DELETE FROM facturas WHERE id_factura='$id_factura'";
            $consulta3 = "UPDATE clientes set deuda=deuda+$pago WHERE id_cliente='$numero'";
            
            if ($delete1=mysqli_query($con,$del1) and $consulta10=mysqli_query($con,$consulta3)){
			$sql6="select * from pagos where id_pago='$id_factura'";   
                        $rs6=mysqli_query($con,$sql6);
                        while($row6=mysqli_fetch_array($rs6)){
                            $id1=$row6["id_factura"];
                            $pago1=$row6["pago"];
                            if($id1>0){
                                $consulta5 = mysqli_query($con,"UPDATE facturas set cuenta1=cuenta1-$pago1 WHERE id_factura='$id1'");
                                     
                            }
                        }
                        $consulta4 =mysqli_query($con, "DELETE FROM pagos WHERE id_pago='$id_factura'");
                        
                
                
                
                        ?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
            }else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
            }
	}
	if($action == 'ajax'){
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
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 20; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './cobros.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
                        <a href="excel/buscar_cobros1.php?q=<?php echo $q;?>&q1=<?php echo $q1;?>&q2=<?php echo $q2;?>&q3=<?php echo $q3;?>" target="_blanck"><img src="images/descargar-excel.png" width="80" height="25"></a>
			<div class="table-responsive">
			  <table id="example" class="display nowrap" style="width:100%;color:black;">
                              
                              <thead>
                        	<tr  style="background-color:<?php echo tablas;?>;color:white; ">
                                    <th>Fecha  </th>
                                    <th>Hora </th>
                                    <th>Cliente </th>
                                    <th>Cobros </th>
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
                                            <td class=" "><?php print"$mon ";echo $total_venta;?></td>
                                            <td class=" "><?php echo $numero_factura;?></td>
                                            <td class=" "><?php echo $tipo;?></td>
                                            <td class=" "><?php echo $nombre_vendedor;?></td>
                                            <td class=" "><?php echo $condiciones1;?></td>
                                            <td class=" "><?php echo $obs;?></td>
                                            <td class=" ">
                                                
                                                 <a href="#" class='btn btn-danger btn-xs' title='Borrar Cobros' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                                 <a href="#" class='btn btn-primary btn-xs' title='Ver documentos cobrados' onclick="imprimir_cobros('<?php echo $id;?>');"><i class="glyphicon glyphicon-download"></i></a> 
                                            </td>    
					</tr>
					<?php
                                }
				?>
				<tr>
					<td colspan=10><span class="pull-right"><?PHP
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
                }	
?>
