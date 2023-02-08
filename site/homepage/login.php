<?php

require_once('config.php');

$username = $connessione->real_escape_string($_POST['username']);
$password = $connessione->real_escape_string($_POST['password']);

if($_SERVER["REQUEST_METHOD"] === "POST"){

$sql_select = "SELECT * FROM utente WHERE username = '$username' ";
if($result = $connessione->query($sql_select)){

    if($result->num_rows == 1){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if(password_verify($password, $row['password'])){
            session_start();
            
            if($row['ruolo'] == 'Cliente'){
                //apro la sessione cliente
                $_SESSION['loggato'] = true;
                $_SESSION['id_cliente'] = $row['id_utente'];
                $_SESSION['username'] = $row['username'];

                header("location: home.php");
            }
            if($row['ruolo'] == 'Admin'){
                //apro la sessione sia da cliente che da admin
                $_SESSION['loggato2'] = true;
                $_SESSION['loggato'] = true;
                $_SESSION['id_cliente'] = $row['id_utente'];
                $_SESSION['username'] = $row['username'];
                
                header("location: admin/index.php");
            }
        }else{
            header("location: error-page/nopassword.html");
            
        }
    }else{
        
        header("location: error-page/nousername.html");
    }
}else{
    header("location: error-page/loginerror.html");
}

$connessione->close();

}

?>