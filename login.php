<?php

include_once 'db.php';

conectadb();

session_start();

$user = $_REQUEST["user"];
$pass = $_REQUEST["password"];

$select = "SELECT NAME_USER, PASS FROM USER_BD where NAME_USER = '$user'";

$result = mysqli_query($conn, $select);

if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    
$usuario = "{$row['NAME_USER']}";
$password = "{$row['PASS']}";

    if(password_verify($pass,$password)){

        $_SESSION["usuario"] = $user;
        header("location: tooldream.php");

    }elseif(empty($pass)){
    
        $_SESSION["mensaje1"] = "Introduca la contraseña";
        header("location: index.php");
    
    }elseif(password_verify($pass,$password) == false){

        $_SESSION["mensaje1"] = "La contraseña es incorrecta";
        header("location: index.php");
    }
    
}elseif(empty($row)){

    $_SESSION["mensaje1"] = "Los datos introducidos son incorrectos";
    header("location: index.php");

}       
    
closedb();

?>