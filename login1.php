<?php
ob_start();
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
//$c=0;
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   
   
   include('menu.php');
 // $nombres=recoge1('nombres');
//$apellidos=recoge1('apellidos');
//$cliente="$nombres $apellidos";
$email=$_SESSION['email'];
$celular=$_SESSION['celular'];
//$mensaje=recoge1('mensaje');
date_default_timezone_set('America/Lima');
$fecha  = date("Y-m-d H:i:s");
if($email<>"" and $celular<>""){
    $consulta = "INSERT INTO contacto values (NULL,'','$email','$fecha','$celular','')";
    $inser=mysqli_query($con, $consulta);
}
   
   
   
   $sql1="select * from users where user_id=$_SESSION[user_id]";
    $rw1= mysqli_query($con, $sql1);//recuperando el registro
    $rs1= mysqli_fetch_array($rw1);
    $modulo=$rs1["accesos"];
    $b = explode(".", $modulo);
   $c=0;
  if($b[47]==1){
        $_SESSION['tienda']=5; 
        $c=1;
        } 
  if($b[46]==1){
        $_SESSION['tienda']=4; 
        $c=1;
        }
        
  if($b[45]==1){
        $_SESSION['tienda']=3; 
        $c=1;
        }
  if($b[44]==1){
        $_SESSION['tienda']=2;
        $c=1;
        }
        
   if($b[43]==1){
        $_SESSION['tienda']=1;  
        $c=1;
        }
        
       
   if($c>0){
     $_SESSION['doc_ventas']=1;
     
     
 $_SESSION['tipo']=0;
     $_SESSION['tabla']=1;
   $_SESSION['servicio1']="0";
       header("location: resumen.php");   
   }else{
     header("location: login.php");   
  }
   
    
    

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Sistema de Venta con Facturación Electrónica.</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="logo.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				//print"$c";// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <font color="red"><strong>DEMO:</strong></font>
                <span id="reauth-email" class="reauth-email"></span>
                Usuario (facweb):
                <input class="form-control" placeholder="Usuario" name="user_name" type="text" autofocus="" value="facweb" required>
                Contraseña (123456):
                <input class="form-control" placeholder="Contraseña" name="user_password" type="password" value="123456" autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Iniciar Sesión</button>
                
                
                
            </form><!-- /form -->
            <style>
.example_responsive_1 { width: 320px; height: 100px; }
@media(min-width: 500px) { .example_responsive_1 { width: 468px; height: 60px; } }
@media(min-width: 800px) { .example_responsive_1 { width: 728px; height: 90px; } }
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- anuncios3 -->

<ins class="adsbygoogle example_responsive_1"
     style="display:inline-block;width:100%;height:60px"
     data-ad-client="ca-pub-7624791494445756"
     data-ad-slot="3930428203"></ins>
    
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
            </div>
              <div style="background:white;padding:10px;">
                  
                  <div id="logo">
          <a href="http://ofertasde.net/sistemas/">
              <img src="http://ofertasde.net/sistemas/images/ofertasdesistemas.jpg" style="width:70px;height:70px;">
          </a>
        
          
            <a href="https://api.whatsapp.com/send?phone=51993609943&text=Me%20interesa%20el%20Sistema"><img src="http://ofertasde.net/sistemas/images/wasap.png" style="width:70px;height:70px;"></a><a href="https://api.whatsapp.com/send?phone=993609943&text=Me%20interesa%20el%20Sistema"><font color="blue" size="6"><strong> (51)993609943</strong></font></a>
          
        </div>
                  
                  
                    <strong>Datos de Contacto:<br>
                Telefono: <font color="red">993609943-976248185</font><br>
                Email : <font color="blue">cg_velazco@hotmail.com</font><br>
                Preguntar por Carlos.<br><br></strong>
                  
                
                  <font size="5" color="blue"><strong>FACWEB:</strong></font><font size="5"><strong> El Punto de Venta que se adapta a tu negocio</strong> </font>  
    <br>Simple e intuitivo,  <font  color="blue"><strong>FACWEB </strong></font> es un sistema que te ayuda a gestionar tu negocio y generar ventas con facturación electrónica, control de inventario y mucho más. 
    <br>Contamos con una gran cantidad de sistemas desarrollados a nuestros clientes en cualquier rubro empresarial y la muestra es que podemos a disposición los demos de los más importantes sistemas. 
    <br>También desarrollamos sistemas a la medida de tu negocio con la mejor oferta del mercado.              
    <br>          
                  
                    <font size="5"><strong>Sistemas desarrollados.</strong> </font>  
                 <br>   <br> 
                  <font style="color:black;" size="4"><strong>1.-Sistemas de Ventas Estándar con facturación electrónica:</strong></font><br>
                 
                  <div style="background:#5F4C0B;text-align:center;size:14px;"><a href="http://ofertasde.net/sistemas/login.php"><strong><font style="color:white;">Sistema Estandar</font></strong></a></div>
                  
                  
                  
                  
                  <font style="color:black;" size="4"><strong><br>2.-Sistema Multimoneda, Multipagos, Multi Sucursal con facturación electrónica:</strong></font><br>
                  
                  <div style="background:green;text-align:center;size:14px;"><a href="http://ofertasde.net/demo/login.php"><strong><font style="color:white;">Sistema Multimoneda, Multipagos, Multi Sucursal</font></strong></a></div>
                  Viene con alguna de las tiendas.<br>
                  <a href="http://ofertasde.net/tienda7"><strong><font style="color:blue;">-Tienda 1</font></strong></a>
                 <br><a href="http://ofertasde.net/tienda8"><strong><font style="color:blue;">-Tienda 2</font></strong></a>
                 <br><a href="http://ofertasde.net/tienda9"><strong><font style="color:blue;">-Tienda 3</font></strong></a><br>
                  
                  <font style="color:black;" size="4"><strong><br>3.-Sistemas de Ventas con Facturación Electrónica por rubros:</strong></font><br>
                  
                    <div style="background:#0080FF;text-align:center;size:14px;"><a href="http://ofertasde.net/hotel/login.php"><strong><font style="color:white;">Sistema Hotel</font></strong></a></div>
                 <div style="background:#DBA901;text-align:center;size:14px;"><a href="http://computerchamorro.com/sistema12/sistema1"><strong><font style="color:white;">Sistema Computacion con Soporte Técnico</font></strong></a></div>
                 <div style="background:#FF4000;text-align:center;size:14px;"><a href="http://dbrence.com/sistemas"><strong><font style="color:white;">Sistema Restaurante</font></strong></a></div>
                 <div style="background:black;text-align:center;size:14px;"><a href="http://dbrence.com/sis_facturacion/botica/login.php"><strong><font style="color:white;">Sistema Botica</font></strong></a></div>
                 <div style="background:green;text-align:center;size:14px;"><a href="http://computerchamorro.com/sistema12/sistemaoptica/login.php"><strong><font style="color:white;">Sistema Optica</font></strong></a></div>
                 <div style="background:#4000FF;text-align:center;size:14px;"><a href="http://fullpolarizadoschoccasac.com/textil/login.php"><strong><font style="color:white;">Sistema Venta de Ropas</font></strong></a></div>
                  <div style="background:#5F4C0B;text-align:center;size:14px;"><a href="http://representacionesmarujitasac.com/sistemas/login.php"><strong><font style="color:white;">Sistema Carniceria</font></strong></a></div>
		<div style="background:#CC2EFA;text-align:center;size:14px;"><a href="http://computerchamorro.com/sistema12/sistemadis/login.php"><strong><font style="color:white;">Sistema Distribución</font></strong></a></div>
		
		<div style="background:#B40431;text-align:center;size:14px;"><a href="http://fullpolarizadoschoccasac.com/colegio/login.php"><strong><font style="color:white;">Sistema Colegio</font></strong></a></div>
		
		<div style="background:green;text-align:center;size:14px;"><a href="http://fullpolarizadoschoccasac.com/encomienda/login.php"><strong><font style="color:white;">Sistema Encomienda</font></strong></a></div>
		  <br>
                  <font style="color:black;" size="4"><strong>4.-Sistema de ventas con facturación electrónica MULTIEMPRESA:</strong></font><br>
                <div style="background:#FF4000;text-align:center;size:14px;"><a href="http://computerchamorro.com/sistema12/multi/login.php"><strong><font style="color:white;">Sistema MULTIEMPRESA</font></strong></a></div>
                 <br>
                  
                  <font style="color:black;" size="4"><strong>5.-Api Rest para Sistemas Propios:</strong></font><br>
                <div style="background:#0404B4;text-align:center;size:14px;"><a href="http://akademyas.com/sistemapi/"><strong><font style="color:white;">Api Rest Multiempresa</font></strong></a></div>
                 
                 
                 <font style="color:black;" size="4"><strong><br>6.-Otros Sistema de Ventas:</strong></font><br>
                  
                    <div style="background:#0080FF;text-align:center;size:14px;"><a href="http://fullpolarizadoschoccasac.com/sistema1/login.php"><strong><font style="color:white;">Sistema 1</font></strong></a></div>
                 <div style="background:#DBA901;text-align:center;size:14px;"><a href="http://computerchamorro.com/sistema12/demo"><strong><font style="color:white;">Sistema 2</font></strong></a></div>
                 <div style="background:#CC2EFA;text-align:center;size:14px;"><a href="http://akademyas.com/sistema2/login.php"><strong><font style="color:white;">Sistema Computacion con Soporte Técnico</font></strong></a></div>
                <div class="table-responsive">
                    
                    <br>  
                    <font size="5"><strong>Más de 200 clientes confían en nosotros.</strong> </font>  
                 <br>  
                 Estos son algunos de ellos:<br><br>
                 <table>
                     <tr>
                         <td style="width:20%;" align="center">
                            <img src="http://ofertasde.net/sucursal1.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td style="width:20%;" align="center">
                            <img src="http://ofertasde.net/sucursal11.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td style="width:20%;" align="center">
                            <img src="http://ofertasde.net/sucursal3.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td >
                          <td style="width:20%;" align="center">
                            <img src="http://ofertasde.net/sucursal4.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td style="width:20%;" align="center">
                            <img src="http://ofertasde.net/sucursal5.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                     </tr>
                     <tr>
                         <td align="center">
                            <img src="http://ofertasde.net/sucursal6.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td align="center">
                            <img src="http://ofertasde.net/sucursal7.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td align="center">
                            <img src="http://ofertasde.net/sucursal8.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td align="center">
                            <img src="http://ofertasde.net/sucursal9.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                          <td align="center">
                            <img src="http://ofertasde.net/sucursal10.jpg" style="width:95%;height:120px;border:1px solid black;margin:3px;">
                         </td>
                     </tr>
                 </table>
                
                </div>
                 <br>
                <br>
            <br>
            
            
            
                </div>
     
    
     
     
     
        <!-- /ultimo -->
    </div><!-- /container -->
  </body>
</html>

	<?php
}
ob_end_flush();
?>


