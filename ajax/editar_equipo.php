<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['mod_equipo'])){
			$errors[] = "Nombre del equipo vacía";
	}
        else if (
            !empty($_POST['mod_equipo'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$equipo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_equipo"],ENT_QUOTES)));
    $id_equipo=$_POST['mod_id'];
		$sql="UPDATE tipo SET tipo='".$equipo."' WHERE id_tipo='".$id_equipo."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El equipo ha sido actualizado satisfactoriamente.";
			} else{
                            $errors []= "Equipo duplicada.";
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
