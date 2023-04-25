<?php
        include('is_logged.php');
	if (empty($_POST['cod_servicio'])) {
           $errors[] = "Código vacío";
        } else if (empty($_POST['nom_servicio'])){
			$errors[] = "Nombre del servicio vacía";
	} else if (trim($_POST['nom_servicio'])==""){
			$errors[] = "Nombre del servicio vacía";
	}else if (trim($_POST['cod_servicio'])==""){
			$errors[] = "cod del servicio vacía";
	}  
        else if (
                !empty($_POST['nom_servicio']) &&
		!empty($_POST['cod_servicio']) 
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$nom_servicio=$_POST["nom_servicio"];
		$cod_servicio=mysqli_real_escape_string($con,(strip_tags($_POST["cod_servicio"],ENT_QUOTES)));
                $pre_servicio=floatval($_POST['pre_servicio']);
                date_default_timezone_set('America/Lima');
                $date_added=date("Y-m-d H:i:s");
                if(!is_numeric($nom_servicio)) {
		$sql="INSERT INTO servicios (nom_servicio,cod_servicio,pre_servicio,tipo) VALUES ('$nom_servicio','$cod_servicio','$pre_servicio','0')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Servicio ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Servicio duplicado.";
			}
		
                 }else{
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