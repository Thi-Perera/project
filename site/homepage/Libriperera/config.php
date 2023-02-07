<?php
$host = "127.0.0.1";
$user = "libriperera";
$password = "";
$database = "my_libriperera";


$connessione = new mysqli($host, $user, $password, $database);

if($connessione === false){
    die("errore di connessione: " . $connessione->connect_error);
}

?>