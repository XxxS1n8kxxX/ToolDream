<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

$nuevo_nombre_usuario = $_REQUEST['nuevo_nombre_usuario'];

rename ("usuarios/$user", "usuarios/" . $nuevo_nombre_usuario);

// Playlist null drop

$query= "UPDATE ALBUM SET OWNER_ALBUM = '$nuevo_nombre_usuario' WHERE OWNER_ALBUM = '$user'";

$res= mysqli_query($conn,$query) or die($query);

// Album null drop

$query= "UPDATE PLAYLIST SET OWNER_PLAYLIST = '$nuevo_nombre_usuario' WHERE OWNER_PLAYLIST = '$user'";

$res= mysqli_query($conn,$query) or die($query);

// Cambio de nombre

$query= "UPDATE USER_BD SET NAME_USER = '$nuevo_nombre_usuario' WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);


$_SESSION['usuario'] = $nuevo_nombre_usuario;

$_SESSION['cambios'] = "Se ha cambiado el nombre de usuario correctamente";

closedb();

header("location: tooldream.php");

?>