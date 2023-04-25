<?php
  include('is_logged.php');

    if (!empty($_POST['nom_laboratorio']) ){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$nom_laboratorio=$_POST["nom_laboratorio"];
    date_default_timezone_set('America/Lima');
    $date_added=date("Y-m-d H:i:s");

    if(!empty($nom_laboratorio)) {
		$sql="INSERT INTO laboratorio (nom_laboratorio) VALUES ('$nom_laboratorio')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El laboratorio ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "laboratorio duplicado.";
			}

                 }else{
                     $errors []= "Laboratorio tiene que ser texto.";
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
