<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

//Obtener un identificador aleatorio para la pista añadida

function get_random_name($num = 9){

    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;

        for($i = 0; $i < $num; $i++){
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;

}

// Añadir la pista, asociada a album y playlist

$album = $_REQUEST['album-lista'];

$query_album = "SELECT ID_ALBUM FROM ALBUM WHERE NAME_ALBUM = '$album'";
$query_album_resultado = mysqli_query($conn, $query_album);
$row_album = mysqli_fetch_assoc($query_album_resultado);
$resultado_final_album = $row_album['ID_ALBUM'];

$playlist = $_REQUEST['playlist-lista'];

$query_playlist = "SELECT ID_PLAYLIST FROM playlist WHERE NAME_PLAYLIST = '$playlist'";
$query_playlist_resultado = mysqli_query($conn, $query_playlist);
$row_playlist = mysqli_fetch_assoc($query_playlist_resultado);
$resultado_final_playlist = $row_playlist['ID_PLAYLIST'];

print "$resultado_final_playlist";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save-media'])){

$uploadDir = "usuarios/$user/" . "canciones/";

if(isset($_FILES["file"]) && $_FILES['file']['error'] == 0)

    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $filesize = $_FILES['file']['size'];
    $newFileName = get_random_name() . "." . pathinfo($filename, PATHINFO_EXTENSION);

    if(file_exists($uploadDir . $newFileName)){
        echo $filename . 'is already exists';
    }else{

        $query = "INSERT INTO songs (NAME_SONG, URL_SONG, OWNER_SONG, ID_ALBUM, ID_PLAYLIST) VALUES ('$newFileName', '$filename' , '$user' , $resultado_final_album, $resultado_final_playlist)";
        mysqli_query($conn,$query) or die("$query");
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $newFileName);
    }

}

closedb();

header("location: tooldream.php");

?>