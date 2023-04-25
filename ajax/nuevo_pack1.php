<?php
        include('is_logged.php');
	
	if (empty($_POST['cantidad'])) {
           $errors[] = "Cantidad vacía";
        } else if (empty($_POST['cantidad'])){
			$errors[] = "Cantidad vacía";
		} 
                else if (
			!empty($_POST['cantidad']) 
			
		){
		
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$id_producto1=$_POST["id_producto1"];
                $cantidad=$_POST["cantidad"];
                $id_producto=$_SESSION['id_servicio'];
                $editar=mysqli_query($con, "UPDATE servicios SET tipo=1 WHERE id_servicio='$id_producto'");
                
		$query=mysqli_query($con, "select * from pack where tipo=1 and id_producto='".$id_producto."' and id_producto1='".$id_producto1."'");
		$count=mysqli_num_rows($query);
                if($count==0){
		$sql="INSERT INTO pack (id_producto,id_producto1,cantidad,tipo) VALUES ('$id_producto','$id_producto1','$cantidad','1')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Producto duplicado. ";
			}
		}else{
				$errors []= "Producto duplicado. ";
			}
                        
                } else {
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