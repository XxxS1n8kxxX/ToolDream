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

$nombre = $_REQUEST['nombre'];
$imagen = $_FILES['imagen']['name'];

$uploadDir = "usuarios/$user/" . "playlist/img_playlist/";
$newFileName = get_random_name() . "." . pathinfo($imagen, PATHINFO_EXTENSION);


$query= "INSERT INTO playlist (NAME_PLAYLIST, IMG, OWNER_PLAYLIST)
values ('$nombre', '$newFileName', '$user')";

$res= mysqli_query($conn,$query) or die($query);

move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $newFileName);

closedb();

header("location: tooldream.php");

?>