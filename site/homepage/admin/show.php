<?php 
require("inc/db.php");
$id = $_GET['ISBN'] ? intval($_GET['ISBN']) : 0;

try {
    $sql = "SELECT * FROM articolo WHERE ISBN = :ISBN LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":ISBN", $id, PDO::PARAM_INT);
    $stmt->execute();    
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
    exit();
}

if (!$stmt->rowCount()) {
    header("Location: index.php");
    exit();
}
$product = $stmt->fetch();

?>

<?php include("inc/header.php") ?>
    <div class="container">
        <a href="index.php" class="btn btn-light mb-3"><< Go Back</a>
        <!-- Show  a Product -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-database"></i> Mostra prodotti</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>$ISBN</th>
                                <td><?= $product['ISBN'] ?></td>
                                <th>Nome</th>
                                <td><?= $product['Nome'] ?></td>
                            </tr>   
                            <tr>
                                <th>Prezzo</th>
                                <td>euro <?= number_format($product['Prezzo'], 2) ?></td>
                                <th>Qty</th>
                                <td><?= $product['Quantità'] ?></td>
                            </tr>  
                            <tr>
                                <th>Descrizione</th>
                                <td colspan="3"><?= $product['Descrizione'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-3">
                        <img src="<?= $product['image1'] ?>" alt="<?= $product['Nome'] ?>" class="img-fluid img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Show a product -->
        <br>
    </div><!-- /.container -->
<?php include("inc/footer.php") ?>