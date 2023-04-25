<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['menu'])) {
           $errors[] = "Menu vacío";
        }else if (trim($_POST['menu'])=="") {
           $errors[] = "Menu vacío";
           
        } else if (!empty($_POST['menu'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$menu=mysqli_real_escape_string($con,(strip_tags($_POST["menu"],ENT_QUOTES)));
                $submenu=mysqli_real_escape_string($con,(strip_tags($_POST["submenu"],ENT_QUOTES)));
                $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
                $video=mysqli_real_escape_string($con,(strip_tags($_POST["video"],ENT_QUOTES)));
                
                
                $sql="INSERT INTO video (menu, submenu, descripcion,video) VALUES ('$menu','$submenu','$descripcion','$video')";
                $query_new_insert = mysqli_query($con,$sql);
                            if ($query_new_insert){
                                    $messages[] = "Video ha sido ingresado satisfactoriamente.";
                            } else{
                                    $errors []= "Video duplicado.";
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