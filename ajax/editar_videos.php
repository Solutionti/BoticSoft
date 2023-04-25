<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_menu'])) {
           $errors[] = "Menu vacío";
        }else if (trim($_POST['mod_menu'])=="") {
           $errors[] = "Menu vacío";
        }   else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_menu']) &&
			$_POST['mod_menu']!="" 
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		
                
                $menu=mysqli_real_escape_string($con,(strip_tags($_POST["mod_menu"],ENT_QUOTES)));
                $submenu=mysqli_real_escape_string($con,(strip_tags($_POST["mod_submenu"],ENT_QUOTES)));
                $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
                $video=mysqli_real_escape_string($con,(strip_tags($_POST["mod_video"],ENT_QUOTES)));
               
		$id_video=intval($_POST['mod_id']);
		$sql="UPDATE video SET menu='".$menu."', submenu='".$submenu."',descripcion='".$descripcion."', video='".$video."' WHERE id_video='".$id_video."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Video ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Video duplicado.";
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