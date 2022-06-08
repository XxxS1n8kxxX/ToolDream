<?php

session_start();

include_once 'db.php';

conectadb();

$user = $_SESSION['usuario'];

// Posible borrado de carpeta forzando un fallo

// rename ("usuarios/$user", "usuarios/$nuevo_nombre_usuario");

// Eliminar album null

$query= "DELETE FROM ALBUM WHERE OWNER_ALBUM = '$user'";

$res= mysqli_query($conn,$query) or die($query);

// Eliminar album null

$query= "DELETE FROM PLAYLIST WHERE OWNER_PLAYLIST = '$user'";

$res= mysqli_query($conn,$query) or die($query);

// Eliminar usuario

$query= "DELETE FROM USER_BD WHERE NAME_USER = '$user'";

$res= mysqli_query($conn,$query) or die($query);

$_SESSION["mensaje2"] = "Se ha eliminado la cuenta correctamente";

function rrmdir($dir) { 
    if (is_dir($dir)) { 
      $objects = scandir($dir);
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
            rrmdir($dir. DIRECTORY_SEPARATOR .$object);
          else
            unlink($dir. DIRECTORY_SEPARATOR .$object); 
        } 
      }
      rmdir($dir); 
    } 
  }

$directorio = "usuarios/$user";

rrmdir($directorio);

closedb();

header("location: index.php");

?>