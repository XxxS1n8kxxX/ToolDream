<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

$nuevo_email_usuario = $_REQUEST['nuevo_email_usuario'];

$query= "UPDATE USER_BD SET EMAIL = '$nuevo_email_usuario' WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);

$_SESSION['cambios'] = "Se ha cambiado el email correctamente";

closedb();

header("location: tooldream.php");

?>