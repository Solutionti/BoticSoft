<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if ($_POST['inicio']>=0) {
          	
		
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$inicio=mysqli_real_escape_string($con,(strip_tags($_POST["inicio"],ENT_QUOTES)));
		$fecha=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
                date_default_timezone_set('America/Lima');
                $fecha4=date("Y-m-d H:i:s");
                $user_id=mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario"],ENT_QUOTES)));
                $tienda=$_SESSION['tienda'];
		
                $consulta9 = "SELECT * FROM caja WHERE DATE_FORMAT(fecha, '%Y-%m-%d')='$fecha' and tienda=$tienda and usuario_inicio=$user_id ";
                $result9 = mysqli_query($con, $consulta9);
                $fecha10=0;
                while ($valor9 = mysqli_fetch_array($result9)) {
                //if($valor9['fecha']==$fecha and $valor9['tienda']==$tienda and $valor9['usuario_inicio']==$user_id){
                    $fecha10=1;
                    $errors []= "Ya ha sido ingresado caja para la fecha especificada.";
                //}
                }
                //print"$fecha10";
                if($fecha10==0){
		$sql="INSERT INTO caja (usuario_inicio,fec_reg,fecha,inicio,cierre,tienda,usuario_cierre,faltante,fecha_cierre,entrada,salida) VALUES ('$user_id','$fecha4','$fecha','$inicio','0','$tienda','0','0','1000-10-10 00:00:00','0','0')";
		$query_update = mysqli_query($con,"UPDATE sucursal SET caja='1' WHERE tienda=$tienda");
                $query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Inicio de Caja ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Inicio de caja duplicada. ";
			}
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