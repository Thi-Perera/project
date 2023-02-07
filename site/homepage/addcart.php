<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<?php 

require("admin/inc/db.php");

if ($_POST) {
    $ISBN = $_POST['ISBN'];
    $name = trim($_POST['name']);
    $qty = $_POST['qty'];


    try {
        $sql_insert = 'INSERT INTO carrello(ISBN, id_cliente, articolo, quantità) 
                VALUES(:ISBN, :id, :nome, :qty)';

        $stmt = $conn->prepare($sql_insert);
        $stmt->bindParam(":ISBN", $ISBN);
        $stmt->bindParam(":id", $id_cliente);
        $stmt->bindParam(":nome", $name);
        $stmt->bindParam(":qty", $qty);

        $stmt->execute();
        if ($stmt->rowCount()) {
            header("Location: home.php?status=added");
            exit();
        }
        header("Location: home.php?status=fail_add");
        exit();
    } catch (Exception $e) {
        header("Location: home.php?status=alreadyadded");
        exit();
    }
} else {
    header("Location: home.php?status=fail_add");
    exit();
}
?>