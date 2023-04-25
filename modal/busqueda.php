<?php
//https://api.sunat.cloud/ruc/10403322097


$a2=1;
$doc1=41364119;





if($a2==1){
    require 'simple_html_dom.php';
    error_reporting(E_ALL ^ E_NOTICE);
	
    $dni = 41364119;

//OBTENEMOS EL VALOR
    $consulta = @file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni);

//LA LOGICA DE LA PAGINAS ES APELLIDO PATERNO | APELLIDO MATERNO | NOMBRES

$partes = explode("|", $consulta);


$datos = array(
		0 => $dni, 
		1 => $partes[0], 
		2 => $partes[1],
		3 => $partes[2],
);
echo "1 2 3|||";
//echo "$partes[0] $partes[1] $partes[2]|||";
}

?>