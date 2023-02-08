<?php 
require("inc/db.php");

if ($_POST) {
    $ISBN = (int) $_POST['ISBN'];
    $name    = trim($_POST['name']);
    $autore    = trim($_POST['autore']);
    $editore    = trim($_POST['editore']);
    $description = trim($_POST['description']);
    $tipologia    = trim($_POST['tipologia']);
    $price   = (float) $_POST['price'];
    $qty     = (int) $_POST['qty'];
    $image1   = "/site/homepage/productimages/" . trim($_POST['image1']);
    $image2   = "/site/homepage/productimages/" . trim($_POST['image2']);
    $image3   = "/site/homepage/productimages/" . trim($_POST['image3']);


    try {
        $sql = 'INSERT INTO articolo(ISBN, Nome, Autore, Editore, Descrizione, Prezzo, Quantità, Tipologia, image1, image2, image3) 
                VALUES(:ISBN, :name, :autore, :editore, :description, :price, :qty, :tipologia, :image1, :image2, :image3)';

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
        $stmt->execute();
        if ($stmt->rowCount()) {
            header("Location: create.php?status=created");
            exit();
        }
        header("Location: create.php?status=fail_create");
        exit();
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
        exit();
    }
} else {
    header("Location: create.php?status=fail_create");
    exit();
}
?>