<?php

include_once 'config.php';

function conectadb(){  
    global  $dbhost,$dbuser,$dbpass,$dbname, $conn;
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die ('Error
            connecting to mysql');
}

function closedb(){
    global $conn;
    mysqli_close($conn);
    }
?>