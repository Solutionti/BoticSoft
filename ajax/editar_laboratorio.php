<?php
	include('is_logged.php');
	if (empty($_POST['mod_nom_laboratorio'])) {
           $errors[] = "Nombre del laboratorio vacio";
        }else if (!empty($_POST['mod_nom_laboratorio']) ){

		require_once ("../config/db.php");
		require_once ("../config/conexion.php");

		$id_lab=mysqli_real_escape_string($con,(strip_tags($_POST["mod_id_laboratorio"],ENT_QUOTES)));
    $nom_lab=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nom_laboratorio"],ENT_QUOTES)));

    if(!is_numeric($nom_lab)) {
		$sql="UPDATE laboratorio SET nom_laboratorio='".$nom_lab."' WHERE id_laboratorio='".$id_lab."' ";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Servicio ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado ";
			}
                }       else{
                     $errors []= "Servicio tiene que ser texto.";
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
