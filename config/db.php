<?php

define('DB_HOST', 'localhost');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'root');//Usuario de tu base de datos
define('DB_PASS', '');//Contraseña del usuario de la base de datos
define('DB_NAME', 'botica');//Nombre de la base de datos


function conectar5()
{ 
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if (!$db) {
        print "<p>Imposible conectarse con la base de datos.</p>";
        exit();
    } else {
        return($db);
    }
}

$db_db=DB_NAME;
$db_globales = $db_db.'.globales';
$db1 = conectar5();
$consulta1 = "SELECT * FROM $db_globales ";
$result1 = mysqli_query($db1, $consulta1);
while ($valor1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                if($valor1['id_global']==1){
                    define('COLOR', "$valor1[med]");
                } 
                if($valor1['id_global']==2){
                    define('COLOR1', "$valor1[med]");
                }
                if($valor1['id_global']==3){
                    define('COLOR2', "$valor1[med]");
                }
                if($valor1['id_global']==4){
                    define('COLOR3', "$valor1[med]");
                }
                if($valor1['id_global']==5){
                    define('iva', "$valor1[med]");
                }
                if($valor1['id_global']==6){
                    define('nom_iva', "$valor1[med]");
                }
                if($valor1['id_global']==7){
                    define('doc', "$valor1[med]");
                }
                if($valor1['id_global']==8){
                    define('moneda', "$valor1[med]");
                }
                if($valor1['id_global']==9){
                    define('videos', "$valor1[med]");
                }
                if($valor1['id_global']==10){
                    define('des1', "$valor1[med]");
                }
                if($valor1['id_global']==11){
                    define('des2', "$valor1[med]");
                }
                if($valor1['id_global']==12){
                    define('des3', "$valor1[med]");
                }
                if($valor1['id_global']==13){
                    define('PN', "$valor1[nombre]");
                    define('PN1', "$valor1[med]");
                }
                if($valor1['id_global']==14){
                    define('PJ', "$valor1[nombre]");
                     define('PJ1', "$valor1[med]");
                }
                
                
            } 


define('tablas', '#084B8A');
//define('COLOR', '#A9E2F3');
//define('COLOR1', '#D8D8D8');
//define('COLOR2', '#58FAAC');
//define('COLOR3', '#F3F781');
//define('iva', '0.18');
//define('nom_iva', 'IGV');
//define('doc', 'Nota de Venta');
//define('moneda', 'S/. ');
//define('videos', '1');

//define('des1', 'Modelo');
//define('des2', 'Color ');
//define('des3', 'Marca');
//define('PN', 'D.N.I ');
//define('PN1', '8');
//define('PJ', 'R.U.C ');
//define('PJ1', '11');

?>