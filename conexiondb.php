<?php

function conectardb(){

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "gestion_certificados";

	$mysqli = new mysqli($hostname,$username,$password,$database);

	return $mysqli;

}


?>