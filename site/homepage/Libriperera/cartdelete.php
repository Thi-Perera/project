<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<?php 
require("admin/inc/db.php");

if (isset($_GET['ISBN'])) {
    // Delete record
    try {
        // SQL Statement da modificare.
        $sql = 'DELETE FROM carrello WHERE ISBN = :barcode AND id_cliente = :id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":barcode", $_GET['ISBN'], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) {
            header("Location: cart.php?status=deleted");
            exit();
        }
        header("Location: cart.php?status=fail_delete");
        exit();
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to index.php
    header("Location: cart.php?status=fail_delete");
    exit();
}