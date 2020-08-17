<?php
include "conexiondb.php";

$id = $_GET['id'];

$mysqli = conectardb();

$eliminar = $mysqli -> query("DELETE FROM certificados WHERE id like '$id'");

header('Location: dashboard.php')

?>