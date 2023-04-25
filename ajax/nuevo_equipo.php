<?php
  include('is_logged.php');
	if (empty($_POST['equipo'])) {
           $errors[] = "Ingrese el equipo";
        } else if (empty($_POST['equipo'])){
			$errors[] = "Nombre del equipo esta vacía";
		}
    else if (
			!empty($_POST['equipo'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");

		$tipo=mysqli_real_escape_string($con,(strip_tags($_POST["equipo"],ENT_QUOTES)));

		$sql="INSERT INTO tipo (tipo) VALUES ('$tipo')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Equipo ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "equipo duplicada.";
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
