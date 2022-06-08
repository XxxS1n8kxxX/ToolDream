<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

$nueva_pass = $_REQUEST['nueva_pass'];
$old_pass = $_REQUEST['old_pass'];

$nueva_pass_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);

$query = "SELECT * FROM USER_BD WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query);

if($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){

$contraseña_user_old = $row['PASS'];
    
}

if(password_verify($old_pass,$contraseña_user_old)){

$query= "UPDATE USER_BD SET PASS = '$nueva_pass_hash' WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);

$_SESSION['cambios'] = "Se ha cambiado la contraseña correctamente";

closedb();

header("location: tooldream.php");

exit;

}else{

$_SESSION['cambios_pass'] = "La contraseña antigua es incorrecta";

closedb();

header("location: tooldream-cambiar-pass.php");

}

?>