<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_codigo'])) {
           $errors[] = "Código vacío";
        }
        else if ($_POST['mod_status']==""){
			$errors[] = "Selecciona el tipo de producto";
		}

         else if ($_POST['mod_cat']==""){
			$errors[] = "Selecciona la categoria";
		}
          else if (trim($_POST['mod_nombre'])==""){
			$errors[] = "Nombre del producto vacío";
		}
          else if (trim($_POST['mod_codigo'])==""){
			$errors[] = "Código vacío";
		}
        else if (empty($_POST['mod_nombre'])){
			$errors[] = "Nombre del producto vacío";
		}  else if (empty($_POST['mod_precio'])){
			$errors[] = "Precio de venta vacío";
		} else if (empty($_POST['mod_costo'])){
			$errors[] = "Precio de costo vacío";
		}
                else if ($_POST['mod_inv']<0){
			$errors[] = "Inventario no valido";
		}

                else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_codigo']) &&
			!empty($_POST['mod_nombre']) &&
            $_POST['mod_status']!="" &&
            $_POST['mod_cat']!="" &&
			!empty($_POST['mod_precio'])&&
			!empty($_POST['mod_costo'])
		){

		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		include 'barcode.php';
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
                $codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
                $contiene=mysqli_real_escape_string($con,(strip_tags($_POST["mod_contiene"],ENT_QUOTES)));
                $pts=mysqli_real_escape_string($con,(strip_tags($_POST["mod_puntos"],ENT_QUOTES)));
                $barras=mysqli_real_escape_string($con,(strip_tags($_POST["mod_barras"],ENT_QUOTES)));
                $min=mysqli_real_escape_string($con,(strip_tags($_POST["mod_min"],ENT_QUOTES)));
                $estado=intval($_POST['mod_status']);
                $mon_costo=1;
                $mon_venta=1;
								$precio_venta=floatval($_POST['mod_precio']);
		    $cantidad_blister=$_POST["mod_cantidad_blister"];
        $precio_blister=floatval($_POST['mod_precio_mayor']);
				$descuento=floatval($_POST['mod_descuento']);
				$costo_total=floatval($_POST['mod_compra_total']);
				$fecha_caducidad=$_POST['mod_caducidad'];
				$laboratorio=$_POST['mod_lab'];

                $costo=floatval($_POST['mod_costo']);
                $dolar=1;
                $precio_costo=$costo*$dolar;
                $cat_pro=intval($_POST['mod_cat']);
                $und_pro=intval($_POST['mod_und_pro']);
                $inv=$_POST['mod_inv'];
                $tienda=$_SESSION['tienda'];
                $b="b".$tienda;
								$id_producto=$_POST['mod_id'];
                $user=$_SESSION['user_id'];
                //$motivo=$_POST['motivo'];
                $barras1="";
                $barras2="";
                $select=mysqli_query($con,"select * from products where id_producto='".$id_producto."'");
                $row7=mysqli_fetch_array($select);
                $inv_ini=$row7["b$tienda"];

                if($barras*1>0 and strlen($barras)>=2){
                    barcode('codigos/'.$barras.'.png', $barras, 30, 'horizontal', 'code128', true);
                    $barras2="barras='$barras',";
                }
                date_default_timezone_set('America/Lima');
		$date_added=date("Y-m-d H:i:s");
		$sql="UPDATE products SET $barras2 cat_pro='".$cat_pro."',nombre_producto='".$nombre."',min='".$min."', codigo_producto='".$codigo."',status_producto='".$estado."', precio_producto='".$precio_venta."', costo_producto='".$precio_costo."' ,cantidad_blister='".$cantidad_blister."', pro_contiene='".$contiene."', pro_puntos='".$pts."',$b='".$inv."',mon_costo='".$mon_costo."',mon_venta='".$mon_venta."',und_pro='".$und_pro."',dcto='".$descuento."',precio_blister='".$precio_blister."', fecha_caducidad='".$fecha_caducidad."',costo_total='".$costo_total."',cod_laboratorio='".$laboratorio."' WHERE id_producto='".$id_producto."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
                                //print"$sql";
                                if($inv<>$inv_ini){
                                    $query_update = mysqli_query($con,"INSERT INTO inventario (id_producto, usuario, fecha,inventario,inv_ini,tienda,motivo) VALUES ('$id_producto','$user','$date_added','$inv','$inv_ini','$tienda','$motivo')");
                                }
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.Codigo Duplicado $sql";
			}
		} else {
			$errors []= "Error desconocido1.";
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
