<?php

//devi vedere come connettere il db, il tizio lo ha
// connesso usando pdo, conviene di usare lo stesso 
// per evitare di avere conflitti con altri suoi file.
// - cerca come si connette il db con pdo
// - continua a seguire i video del tipo a partire dal secondo video nella playlist



//Define username and password
$host = "127.0.0.1";
$user = "libriperera";
$password = "";
$database = "my_libriperera";
$DNS      = "mysql:host=$host;dbname=$database";


// Connect to database using PDO
try {
    $conn = new PDO($DNS, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error ". $e->getMessage();
    exit();
}
