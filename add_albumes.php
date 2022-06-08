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
$artista = $_REQUEST['artista'];
$genero = $_REQUEST['genero'];
$discografica = $_REQUEST['discografica'];
$ano = $_REQUEST['ano'];
$imagen = $_FILES['imagen']['name'];

$uploadDir = "usuarios/$user/" . "albumes/img_albumes/";
$newFileName = get_random_name() . "." . pathinfo($imagen, PATHINFO_EXTENSION);


$query= "INSERT INTO album (NAME_ALBUM, ARTIST, GENRE, ALBUM_LABEL, ALBUM_YEAR, IMG, OWNER_ALBUM)
values ('$nombre', '$artista', '$genero', '$discografica', '$ano', '$newFileName', '$user')";

$res= mysqli_query($conn,$query) or die($query);

move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $newFileName);

closedb();

header("location: tooldream.php");

?>