<?php
        include('is_logged.php');
	
	if (empty($_POST['id_producto'])) {
           $errors[] = "Pack vacía";
        } else if (empty($_POST['id_producto'])){
			$errors[] = "Pack vacía";
		} 
                else if (
			!empty($_POST['id_producto']) 
		){
		
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$cantidad=$_POST["cantidad"];
                date_default_timezone_set('America/Lima');
                $fecha1  = date("Y-m-d H:i:s");
		$id_producto=$_POST["id_producto"];
                $tipo=$_POST["tipo"];
		$user_id=$_SESSION['user_id'];
                $tienda=$_SESSION['tienda'];
                $b1="b".$tienda;
                $d=0;
                if($tipo==2){
                $sql_count1=mysqli_query($con,"select * from pack where pack.id_producto=$id_producto");
                while ($row=mysqli_fetch_array($sql_count1)){
                    $id=$row["id_producto1"];
                    $cantidad1=$row["cantidad"];
                    $sql_count2=mysqli_query($con,"select * from products where id_producto=$id");
                    while ($row1=mysqli_fetch_array($sql_count2)){
                        if($row1["$b1"]<$cantidad1*$cantidad){
                            $d=1;
                        }
                    }
                }
                
                    //if($d==0){
                    //    $errors []= "No se puede convertir.";
                    //}
                }
                
                $sql_count3=mysqli_query($con,"select * from products where id_producto=$id_producto");
                $row4=mysqli_fetch_array($sql_count3);
                $inv1=$row4["$b1"];
                
		$r=0;
                if($cantidad>$inv1 and $tipo==1)  {
                   $r=1;
                   //$errors []= "La cantidad excede el inventario.";
                }            

                
                if($r==0 and $d==0){
                if($tipo==1){
                    $sql="INSERT INTO detalle_factura
                        values (NULL, '0','$user_id','0','1','$id_producto','$cantidad','0','$tienda','1','1','$fecha1','0','0','$inv1','0','7777')";
                    $query_new_insert = mysqli_query($con,$sql);
                    $dml=mysqli_query($con,"update products set $b1=$b1-$cantidad where id_producto=".$id_producto);
                    $sql_count1=mysqli_query($con,"select * from pack where pack.id_producto=$id_producto");
                    while ($row=mysqli_fetch_array($sql_count1)){
                        $id=$row["id_producto1"];
                        $cantidad1=$row["cantidad"];
                        $cant=$cantidad1*$cantidad;
                        $sql_count2=mysqli_query($con,"select * from products where id_producto=$id");
                        while ($row1=mysqli_fetch_array($sql_count2)){
                            $inv=$row1["$b1"];
                            $dml=mysqli_query($con,"update products set $b1=$b1+$cant where id_producto=".$id);
                            $sql="INSERT INTO detalle_factura
                                values (NULL, '0','$user_id','0','2','$id','$cant','0','$tienda','1','1','$fecha1','0','0','$inv','0','0')";
                            $query_new_insert = mysqli_query($con,$sql);
                        }
                    }
                    
                }
                if($tipo==2){
                    $sql="INSERT INTO detalle_factura
                        values (NULL, '0','$user_id','0','2','$id_producto','$cantidad','0','$tienda','1','1','$fecha1','0','0','$inv1','0','7777')";
                    $query_new_insert = mysqli_query($con,$sql);
                    $dml=mysqli_query($con,"update products set $b1=$b1+$cantidad where id_producto=".$id_producto);
                    $sql_count1=mysqli_query($con,"select * from pack where pack.id_producto=$id_producto");
                    while ($row=mysqli_fetch_array($sql_count1)){
                        $id=$row["id_producto1"];
                        $cantidad1=$row["cantidad"];
                        $cant=$cantidad1*$cantidad;
                        $sql_count2=mysqli_query($con,"select * from products where id_producto=$id");
                        while ($row1=mysqli_fetch_array($sql_count2)){
                            $inv=$row1["$b1"];
                            $dml=mysqli_query($con,"update products set $b1=$b1-$cant where id_producto=".$id);
                            $sql="INSERT INTO detalle_factura
                            values (NULL, '0','$user_id','0','1','$id','$cant','0','$tienda','1','1','$fecha1','0','0','$inv','0','0')";
                            $query_new_insert = mysqli_query($con,$sql);
                        }
                    }
                }
                        mysqli_query($con,$dml);
			if ($query_new_insert){
				$messages[] = "Transferencia ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Transferencia duplicada.";
			}
		}else{
                    $errors []= "Ha ocurrido un error.";
		}
                        
                }else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>