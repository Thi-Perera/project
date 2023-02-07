<?php 
require("inc/db.php");
$ISBN = $_GET['ISBN'] ? intval($_GET['ISBN']) : 0;

try {
    $sql = "SELECT * FROM articolo WHERE ISBN = :ISBN LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":ISBN", $ISBN, PDO::PARAM_INT);
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
        <?php if (isset($_GET['status']) && $_GET['status'] == "updated") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Updated</strong>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == "fail_update") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Fail Update</strong>
        </div>
        <?php endif ?>
        <!-- Create Form -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-edit"></i> Edit Product</strong>
            </div>
            <div class="card-body">
                <form action="update.php" method="post">
                  <input type="hidden" name="ISBN" value="<?= $product['ISBN'] ?>">
                    <div class="form-row">
                
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $product['Nome'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Autore</label>
                            <input type="text" class="form-control" id="autore" name="autore" placeholder="Autore" value="<?= $product['Autore'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Editore</label>
                            <input type="text" class="form-control" id="editore" name="editore" placeholder="Editore" value="<?= $product['Editore'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Tipologia</label>
                            <select class="form-control" id="tipologia" name="tipologia" >
                                <option value="Libro">Libro</option>
                                <option value="Fumetto">Fumetto</option>
                                <option value="Manuale">Manuale</option>
                                <option value="Artbook">Artbook</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price" class="col-form-label">Prezzo</label>
                            <input type="number" class="form-control" min="0.01" step="0.01" id="price" name="price" placeholder="Price" value="<?= $product['Prezzo'] ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qty" class="col-form-label">Qty</label>
                            <input type="number" class="form-control" min="0" name="qty" id="qty" placeholder="Qty" value="<?= $product['Quantità'] ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 1</label>
                            <input type="file" class="form-control" name="image1" id="image1" placeholder="Image URL" value="<?= $product['image1'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 2</label>
                            <input type="file" class="form-control" name="image2" id="image2" placeholder="Image URL" value="<?= $product['image2'] ?>" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 3</label>
                            <input type="file" class="form-control" name="image3" id="image3" placeholder="Image URL" value="<?= $product['image3'] ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Descrizione</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descrizione" ><?=$product['Descrizione'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                </form>
            </div>
        </div>
        <!-- End create form -->
        <br>
    </div><!-- /.container -->
<?php include("inc/footer.php") ?>