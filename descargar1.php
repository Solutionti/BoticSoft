<?php
session_start();
include('menu.php');
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
header("Content-type: application/vnd.ms-excel" ) ; 
header("Content-Disposition: attachment; filename=productos.xls" ) ; 
        
        $sTable = "products,und";
        $tienda=$_SESSION['tienda'];   
        
		$cat=recoge1("cat");
                $cat1="";
                if($cat>0){
                    $cat1=" and products.cat_pro=$cat ";
                }
		$sWhere="where products.b$tienda<=products.min $cat1 and products.und_pro=und.id_und order by b$tienda asc";
                $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
                $sql="SELECT * FROM  $sTable $sWhere ";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			?>
			
                           
			 <table id="example" class="display nowrap" style="width:100%">
                            <thead>
				<tr >
                                       
					<th>Código</th>
					<th>Producto</th>
                                        <th>Und Medida</th>
                                        <th>Stock</th>
                                        <th>Stock Min</th>
					<th>Tipo</th>
                                        <th><?php echo des3;?></th>
                                        <th><?php echo des1;?></th>
                                        <th><?php echo des2;?></th>
                                        <th>Costo</th>
					
                                        
				</tr>
                                </thead>
				<?php
                                $i=0;
				while ($row=mysqli_fetch_array($query)){
					$pro_ser=$row['pro_ser'];
                                        if ($pro_ser==1){
                                            
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
                                            
                                            $b=$row["b$tienda"];
                                            $mon_venta=$row['mon_venta'];
                                            $dolar=$row['mon_costo'];
                                            $mon_costo=1;
                                            $nom_und=$row["nom_und"];
                                            $min=$row["min"];
                                            $label_class='label-success';
                                            if ($status_producto==1){$estado="Nuevo";}
                                            if ($status_producto==0){$estado="Segunda";}
                                            if ($status_producto==2){$estado="Repuesto";}
                                            $mon=moneda;
                                            $date_added= date('d/m/Y', strtotime($row['date_added']));
                                            $costo_producto=$row['costo_producto'];
                                            $precio2=$row['precio2'];
                                            $precio3=$row['precio3'];
                                            $und_pro=$row['und_pro'];
                                            $costo_producto=$row['costo_producto']/$row['mon_costo'];
                                            $costo=$row['costo_producto'];
                                            $utilidad=$row['precio_producto']-$row['costo_producto'];
                                             
					?>
                                        <tr id="<?php echo $table;?>">
                                        
                                          	
                                            <td><?php echo $codigo_producto; ?></td>
                                            <td width="50px"><?php echo $nombre_producto; ?></td>
                                             <td width="50px"><?php echo $nom_und; ?></td>
                                            <td ><span class="label <?php echo $label_class;?>"><?php echo $b; ?></span></td>
                                            <td ><span class="label"><?php echo $min; ?></span></td>
                                            <td><?php echo $estado;?></td>
                                            <td><?php echo $marca;?></td>
                                            <td><?php echo $modelo;?></td>
                                            <td><?php echo $color;?></td>
                                            <td><span class='pull-right'><?php echo number_format($costo_producto,2);?></span></td>
                                           
                                           
					</tr>
					<?php
                                    }
                                }
				?>
				
			  </table>

			
<?php
                                    }
                              
				?>
