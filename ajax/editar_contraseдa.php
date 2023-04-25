<?php

	include('is_logged.php');
	if (empty($_POST['user_pass_ant']) and empty($_POST['user_pass_new']) and empty($_POST['user_pass_new_confirmar'])) {
           $errors[] = "Ingrese las contraseñas";
    }else if ($_POST['user_pass_new'] == $_POST['user_pass_new_confirmar']){

		require_once ("../config/db.php");
		require_once ("../config/conexion.php");

		$user_id=$_POST['id_user_mod'];

		$sql_user="select * from users where user_id='".$user_id."'";
		$rw_user=mysqli_query($con,$sql_user);//recuperando el registro
		$rs_user=mysqli_fetch_array($rw_user);//trasformar el registro en un vector asociativo
		$contaseña_anterior1=$rs_user["clave"];


    if($contaseña_anterior1 == $_POST['user_pass_ant']) {
		$sql="UPDATE users SET clave='".$_POST['user_pass_new']."' WHERE user_id='".$user_id."' ";
		$query_update = mysqli_query($con,$sql);
		if ($query_update){$messages[] = "Contraseña actualizado con exito.";}
	} else{
		$errors []= "La contraseña actual es incorrecta!!!";
	}

} else {$errors []= "La nueva contraseña no coincide";}

		if (isset($errors)){

			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong>
				<?php foreach ($errors as $error) {echo $error;}?>
			</div>
			<?php } if (isset($messages)){ ?>
				<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Bien hecho!</strong>
				<?php foreach ($messages as $message) { echo $message; } ?>
				</div>
				<?php
			}

?>
