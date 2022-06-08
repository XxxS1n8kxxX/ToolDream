<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

//Obtener un identificador aleatorio para la imagen añadida

function get_random_name($num = 9){

    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;

        for($i = 0; $i < $num; $i++){
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;

}

$imagen = $_FILES['imagen']['name'];

$uploadDir = "usuarios/$user/" . "img_perfil/";
$newFileName = get_random_name() . "." . pathinfo($imagen, PATHINFO_EXTENSION);


$query= "UPDATE USER_BD SET IMG = '$newFileName' WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);

move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $newFileName);

$_SESSION['cambios'] = "Se ha cambiado la foto de perfil correctamente";

closedb();

header("location: tooldream.php");

?>