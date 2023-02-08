<?php 
require("inc/db.php");

if ($_POST) {
    //$id      = (int) $_POST['id'];
    $ISBN = (int) $_POST['ISBN'];
    $name    = trim($_POST['name']);
    $autore    = trim($_POST['autore']);
    $editore    = trim($_POST['editore']);
    $description = trim($_POST['description']);
    $price   = (float) $_POST['price'];
    $qty     = (int) $_POST['qty'];
    $tipologia    = trim($_POST['tipologia']);
    $image1   = "/site/homepage/productimages/" . trim($_POST['image1']);
    $image2   = "/site/homepage/productimages/" . trim($_POST['image2']);
    $image3   = "/site/homepage/productimages/" . trim($_POST['image3']);

    try {
        $sql = 'UPDATE articolo
                SET Nome = :name, Autore = :autore, Editore = :editore, Descrizione = :description, prezzo = :price, Quantità = :qty, Tipologia = :tipologia, image1 = :image1,  image2 = :image2,  image3 = :image3
                WHERE ISBN = :ISBN';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":ISBN", $ISBN);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":autore", $autore);
        $stmt->bindParam(":editore", $editore);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":qty", $qty);
        $stmt->bindParam(":tipologia", $tipologia);
        $stmt->bindParam(":image1", $image1);
        $stmt->bindParam(":image2", $image2);
        $stmt->bindParam(":image3", $image3);
        //$stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            header("Location: edit.php?id=".$ISBN."&status=updated");
            exit();
        }
        header("Location: edit.php?id=".$ISBN."&status=fail_update");
        exit();
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
} else {
    header("Location: edit.php?id=".$ISBN."&status=fail_update");
    exit();
}
?>