<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

$borrar_cancion = $_REQUEST['borrar_cancion'];

$query= "DELETE FROM SONGS WHERE URL_SONG = '$borrar_cancion'";

$res= mysqli_query($conn,$query) or die($query);

closedb();

header("location: tooldream.php");

?>