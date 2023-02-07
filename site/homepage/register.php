<?php

require_once('config.php');

$email = $connessione->real_escape_string($_POST['email']);
$username = $connessione->real_escape_string($_POST['username']);
$password = $connessione->real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `my_libriperera`.`utente` (`username`, `email`, `password`, `ruolo` ) VALUES ('$username', '$email', '$hashed_password', 'Cliente')";
if($connessione->query($sql) === true){
    echo "Registrazione effettuata";
}else{
    echo "Errore registrazione utente $sql " . $connessione->error;
}


/*non fa i controlli su password e username
 perchè ci mette in condizione
 di farmi usare javascript da solo */

?>