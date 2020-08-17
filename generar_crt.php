<?php
include "conexiondb.php";

$mysqli = conectardb();

date_default_timezone_set('UTC');

$fecha = date("d/m/Y"); 


$IP = $_POST['IP'];
$hostname = $_POST['hostname'];
$OrgName = $_POST['OrgName'];
$OrgUnitName = $_POST['OrgUnitName'];
$duracion = "";

$duracion_tmp = $_POST['duracion'];

if($duracion_tmp == 365){
	
	$ano = date("Y")+1;

	$duracion_db = date("d/m/".$ano);

	$duracion = 365;

}else if($duracion_tmp == 730){
	
	$ano = date("Y")+2;

	$duracion_db = date("d/m/".$ano);

	$duracion = 730;

}else{


	$ano = date("Y")+3;

	$duracion_db = date("d/m/".$ano);

	$duracion = 1095;
}	




$path_cert = '/opt/lampp/htdocs/SecOpsCert/certificados/'.$hostname;

if (!file_exists($path_cert)) {
    mkdir($path_cert,0777, true);
}

$comando = 'cd /opt/lampp/htdocs/SecOpsCert/certificados/'.$hostname.' && openssl req -x509 -newkey rsa:4096 -keyout '.$hostname.'-key.pem -out '.$hostname.'-cert.pem -nodes -subj "/C=US/ST=Utah/L=Lehi/O='.$OrgName.', Inc./OU='.$OrgUnitName.'/CN=yourdomain.com" -days '.$duracion;


shell_exec($comando);

$ruta_certificado = 'http://localhost/SecOpsCert/certificados/'.$hostname;


$consulta = $mysqli -> query("INSERT INTO certificados (`fecha_creacion`,`ip`,`hostname`,`valido_desde`,`valido_hasta`,`ruta_certificado`) VALUES ('$fecha','$IP','$hostname','$fecha','$duracion_db','$ruta_certificado')");


header('Location: dashboard.php');

?>