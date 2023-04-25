<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_cantidad'])){
			$errors[] = "Cantidad vacía";
	} 
        else if (
            
            !empty($_POST['mod_cantidad'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		
		$cantidad=$_POST['mod_cantidad'];
                $id_pack=$_POST['mod_id'];
		$sql="UPDATE pack SET cantidad='".$cantidad."'WHERE id_pack='".$id_pack."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Ha sido actualizado satisfactoriamente.";
			} else{
                            $errors []= "Duplicado.";
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