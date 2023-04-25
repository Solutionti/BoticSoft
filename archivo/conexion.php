<?php
function conectar(){
    $host='localhost';
   //$user='akadeg3r_usuario';
   $user='oferth84_user';
    
   $password='jocelyn2016';
    //$password='jocelyn2016';
    $db='oferth84_sistema2';
    //$db='akadeg3r_sistema';
    if(!$link=mysql_connect($host,$user,$password)){
        die("Servidor esta inabilitado...");
    }elseif(!mysql_select_db($db,$link)){
        die("Base de datos ocupada...");
    }else{
        return $link;
    }
}
function conectar1()
{

    //$db = mysqli_connect('localhost','akadeg3r_usuario','jocelyn2016');
 $db = mysqli_connect('localhost', 'oferth84_user', 'jocelyn2016');
    if (!$db) {
        //cabecera('Error grave', 'menu_principal');
        print "<p>Imposible conectarse con la base de datos.</p>";
     
        exit();
    } else {
        return($db);
    }

}
function desconectar()
{
	mysql_close();
}
?>
