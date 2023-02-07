
    
<?php include("inc/header.php") ?>
    <div class="container">
        <a href="index.php" class="btn btn-light mb-3"><< Go Back</a>
        <?php if (isset($_GET['status']) && $_GET['status'] == "created") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Created</strong>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == "fail_create") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Fail Create</strong>
        </div>
        <?php endif ?>
        <!-- Create Form -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-plus"></i> Add New Product</strong>
            </div>
            <div class="card-body">
                <form name="myForm" action="add.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ISBN" class="col-form-label">ISBN</label>
                            <input type="number" class="form-control" min="1" id="ISBN" name="ISBN" placeholder="codice di 13 cifre" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Autore</label>
                            <input type="text" class="form-control" id="autore" name="autore" placeholder="Autore" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Editore</label>
                            <input type="text" class="form-control" id="editore" name="editore" placeholder="Editore" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Tipologia</label>
                            <select class="form-control" id="tipologia" name="tipologia">
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
                            <input type="number" class="form-control" min="0.01" step="0.01" id="price" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qty" class="col-form-label">Qty</label>
                            <input type="number" class="form-control" min="1" name="qty" id="qty" placeholder="Qty" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 1</label>
                            <input type="file" class="form-control" name="image1" id="image1" placeholder="Image URL">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 2</label>
                            <input type="file" class="form-control" name="image2" id="image2" placeholder="Image URL">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Image 3</label>
                            <input type="file" class="form-control" name="image3" id="image3" placeholder="Image URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Descrizione</label>
                        <textarea name="description" id="" rows="5" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                </form>
            </div>
        </div>
        <!-- End create form -->
        <br>
    </div><!-- /.container -->
<?php include("inc/footer.php") ?>
