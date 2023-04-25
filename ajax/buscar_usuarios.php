<?php
include('is_logged.php');
?>
<style>
    table tr:nth-child(odd) {background-color: #FBF8EF;}
table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {
border-bottom: 2px solid #F5ECCE;
}
#valor1:hover {
background-color: white;
border-bottom: 2px solid #A9E2F3;
}
.dt-button.red {
  background-image: radial-gradient( circle 905.6px at 4.9% 7.9%,  rgba(218,0,0,1) 14.1%, rgba(168,2,144,1) 65%, rgba(102,2,110,1) 90% );
  border: none;
  color: white;
  padding: 4px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
.dt-button.red:hover{
  background-image: radial-gradient( circle 905.6px at 4.9% 7.9%,  rgba(218,0,0,1) 14.1%, rgba(168,2,144,1) 65%, rgba(102,2,110,1) 90% );
  border-bottom: 2px solid #A9E2F3;
}
.dt-button.orange {
background-image: radial-gradient( circle 597px at 93% 9.8%,  rgba(255,61,89,1) 1.7%, rgba(252,251,44,1) 97% );
  border: none;
  color: white;
  padding: 4px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
.dt-button.green {
  background-image: linear-gradient( 73.1deg,  rgba(34,126,34,1) 8%, rgba(99,162,17,1) 86.9% );
  border: none;
  color: white;
  padding: 4px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
.dt-button.green1 {
  background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(0,152,155,1) 0.1%, rgba(0,94,120,1) 94.2% );
  border: none;
  color: white;
  padding: 4px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
.dt-button.green2 {
  background-image: radial-gradient( circle 976px at 51.2% 51%,  rgba(11,27,103,1) 0%, rgba(16,66,157,1) 0%, rgba(11,27,103,1) 17.3%, rgba(11,27,103,1) 58.8%, rgba(11,27,103,1) 71.4%, rgba(16,66,157,1) 100.2%, rgba(187,187,187,1) 100.2% );
  border: none;
  color: white;
  padding: 4px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 10px;
}
tfoot {
    display: table-header-group;
}
</style>
<?php

	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$user_id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from users where user_id='".$user_id."'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['user_id'];
                $query1=mysqli_query($con, "select * from detalle_factura where id_vendedor='".$user_id."'");
		$count1=mysqli_num_rows($query1);
                $query3=mysqli_query($con, "select * from facturas where id_vendedor='".$user_id."'");
		$count3=mysqli_num_rows($query3);
                $query4=mysqli_query($con, "select * from servicio where user_id='".$user_id."'");
		$count4=mysqli_num_rows($query4);
		if ($count>1 && $count1==0 && $count3==0 && $count4==0){
			if ($delete1=mysqli_query($con,"DELETE FROM users WHERE user_id='".$user_id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php

		}
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede eliminar el usuario porque esta enlazado a otros datos .
			</div>
			<?php
		}
        }
	if($action == 'ajax'){
		$aColumns = array('nombres', 'user_name');//Columnas de busqueda
		$sTable = "users";
		$sWhere = "";
		$sWhere.=" order by user_id desc";
		include 'pagination.php';
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './usuarios.php';
		$sql="SELECT * FROM  $sTable $sWhere";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table id="example" class="display nowrap" style="width:100%;color:black;">

                              <thead>
				<tr  style="background-color:<?php echo tablas;?>;color:white; ">
					<th></th>
					<th>Nombres</th>
					<th>Usuario</th>
					<th>Email</th>
          <th>DNI</th>
          <th>Sucursal</th>
					<th><span class="pull-right">Acciones</span></th>

				</tr>
                                </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
                                    $user_id=$row['user_id'];
                                    $fullname=$row['nombres'];
                                    $user_name=$row['user_name'];
                                    $user_email=$row['user_email'];
                                    $dni=$row['dni'];
                                    $dom=$row['domicilio'];
                                    $tel=$row['telefono'];
                                    $hora=$row['hora'];
                                    $sucursal=$row['sucursal'];
                                    $foto=$row['foto'];
                                    $date_added= date('d/m/Y', strtotime($row['date_added']));
                                    $accesos=$row['accesos'];
                                    $a=explode(".",$accesos);



                                    $query_sucursal="select * from sucursal where id_sucursal='".$sucursal."' ";
                                    $query_result_sucursal=mysqli_query($con,$query_sucursal);
                                    while ($row_suc=mysqli_fetch_array($query_result_sucursal)){
                                      $sucursal_nombre=$row_suc['nombre'];
                                    }
                             	?>
				<tr id="valor1">
                                        <input type="hidden" value="<?php echo $row['nombres'];?>" id="nombres<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $user_name;?>" id="usuario<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_email;?>" id="email<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $dni;?>" id="dni<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $dom;?>" id="dom<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $tel;?>" id="tel<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $hora;?>" id="hora<?php echo $user_id;?>">
                                        <input type="hidden" value="<?php echo $sucursal;?>" id="sucursal<?php echo $user_id;?>">
                                        <td>
                                            <img src="images/<?php echo $foto;?>" class="avatar" alt="Avatar">
                                        </td>
						<td><?php echo $fullname; ?></td>
						<td ><?php echo $user_name; ?></td>
						<td ><?php echo $user_email; ?></td>
						<td><?php echo $dni;?></td>
            <td> <?php echo $sucursal_nombre;?> </td>

					<td ><span class="pull-right">
					<a href="acceso.php?usuario=<?php echo $fullname;?>" class='btn btn-info btn-xs' title='Acceso'><i class="fa fa-pencil"></i>Acceso</a>
                                        <a href="user2.php?accion=<?php echo $user_id;?>" class='btn btn-success btn-xs' title='Editar foto'><i class="fa fa-pencil"></i>Foto</a>
                                        <a href="#" class='btn btn-warning btn-xs' title='Editar usuario' onclick="obtener_datos('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i>Editar</a>
					<a href="#" class='btn btn-primary btn-xs' title='Cambiar contraseña' onclick="get_user_id('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog">Clave</i></a>

                                        <a href="#" class='btn btn-danger btn-xs' title='Borrar usuario' onclick="eliminar('<?php echo $user_id; ?>')"><i class="glyphicon glyphicon-trash"></i> Borrar</a></span>

                                        </td>
                                    </tr>
                                    <?php
				}
				?>

			</table>
                    </div>
		<?php
            }
	}
?>

<script>

$(document).ready(function() {

        $('#example').DataTable( {
        language: {
        "url": "/dataTables/i18n/de_de.lang",
                "decimal": "",
        "show": "Mostrar",
        "emptyTable": "No hay informacion",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        buttons: {
                copyTitle: 'Copiar filas al portapapeles',

                copySuccess: {
                    _: 'Copiado %d fias ',
                    1: 'Copiado 1 fila'
                },

                pageLength: {
                _: "Mostrar %d filas",
                '-1': "Mostrar Todo"
            }
            },
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
         bDestroy: true,
            dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
        ],
        buttons:
        [

                {
                    extend: 'pageLength',
                    text: 'MOSTRAR FILAS',
                    className: 'orange'
                },

                {
                    extend: 'copy',
                    text: 'COPIAR',
                    className: 'red'
                },
                {
                    extend: 'excel',
                    text: 'EXCEL',
                    className: 'green'
                },
                {
                    extend: 'csv',
                    text: 'CSV',
                    className: 'green1'
                },
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    className: 'green2'
                }
            ],

    } );
} );
</script>
