<?php 
require("inc/db.php");

if (isset($_GET['ISBN'])) {
    // Delete record
    try {
        // SQL Statement da modificare.
        $sql = 'DELETE FROM articolo WHERE ISBN = :barcode LIMIT 1';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":barcode", $_GET['ISBN'], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount()) {
            header("Location: index.php?status=deleted");
            exit();
        }
        header("Location: index.php?status=fail_delete");
        exit();
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to index.php
    header("Location: index.php?status=fail_delete");
    exit();
}