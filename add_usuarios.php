<?php

session_start();

include_once 'db.php';

conectadb();

$nombre = $_REQUEST['user'];
$contraseña = $_REQUEST['pswd'];
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);
$email = $_REQUEST['email'];

$query = "INSERT INTO user_bd (NAME_USER, PASS, EMAIL, IMG)
values ('$nombre', '$contraseña_hash', '$email', 'img_usuario_predeterminada.png')";

$res = mysqli_query($conn,$query) or die('Error, insert query failed');

$query= "UPDATE USER_BD SET IMG = '$newFileName' WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);

if(!is_dir("usuarios/$nombre")){
    mkdir("usuarios/$nombre");
    mkdir("usuarios/$nombre" . "/canciones");
    mkdir("usuarios/$nombre" . "/img_perfil");
    mkdir("usuarios/$nombre" . "/playlist");
    mkdir("usuarios/$nombre" . "/playlist/img_playlist");
    mkdir("usuarios/$nombre" . "/albumes");
    mkdir("usuarios/$nombre" . "/albumes/img_albumes");
}

$imagen_predeterminada_origen = "img_predeterminadas/img_usuario_predeterminada.png";
$imagen_predeterminada_destino = "usuarios/$nombre" . "/img_perfil/img_usuario_predeterminada.png";

copy($imagen_predeterminada_origen, $imagen_predeterminada_destino);

// Añadir playlist null para el usuario

$query_playlist = "INSERT INTO PLAYLIST (NAME_PLAYLIST, IMG, OWNER_PLAYLIST)
values ('Ninguna', 'img_album_playlist_predeterminada.jpg', '$nombre')";

$res_playlist = mysqli_query($conn,$query_playlist) or die('Error, insert query failed');

$imagen_predeterminada_origen_playlist = "img_predeterminadas/img_album_playlist_predeterminada.jpg";
$imagen_predeterminada_destino_playlist = "usuarios/$nombre" . "/playlist/img_playlist/img_album_playlist_predeterminada.jpg";

copy($imagen_predeterminada_origen_playlist, $imagen_predeterminada_destino_playlist);

// Añadir album null para el usuario

$query_album = "INSERT INTO ALBUM (NAME_ALBUM, ARTIST, GENRE, ALBUM_LABEL, ALBUM_YEAR, IMG, OWNER_ALBUM)
values ('Ninguno', NULL, NULL, NULL, NULL, 'img_album_playlist_predeterminada.jpg', '$nombre')";

$res_album = mysqli_query($conn,$query_album) or die('Error, insert query failed');

$imagen_predeterminada_origen_album = "img_predeterminadas/img_album_playlist_predeterminada.jpg";
$imagen_predeterminada_destino_album = "usuarios/$nombre" . "/albumes/img_albumes/img_album_playlist_predeterminada.jpg";

copy($imagen_predeterminada_origen_album, $imagen_predeterminada_destino_album);

$_SESSION["mensaje2"] = "El usuario se ha creado correctamente";

closedb();

header("location: index.php");

?>