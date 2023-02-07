<?php

session_start();
if (!isset($_SESSION['loggato2']) || $_SESSION['loggato2'] !== true) {
	 header("location: ../account-pageadmin.html");
	 exit;
}

/* la sessione per la registration page degli admin, aperta solo agli admin. */
$_SESSION['loggato3'] = true;

?>


<?php 
// Include database connection
require("inc/db.php");

try {
    // Create sql statment
    $sql = "SELECT * FROM articolo";
    $result = $conn->query($sql);

} catch (Exception $e) {
    echo "Error " . $e->getMessage();
    exit();
}

?>
<?php include("inc/header.php") ?>
    <div class="container">
        <?php if (isset($_GET['status']) && $_GET['status'] == "deleted") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Deleted</strong>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == "fail_delete") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Fail Delete</strong>
        </div>
        <?php endif ?>
        <!-- Table Product -->
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
            <strong><i class="fa fa-database"></i> Articoli</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title float-left">Tabella Prodotti</h5>
                    <a href="create.php" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Aggiungi Articoli</a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Nome Prodotto</th>
                        <th>Prezzo</th>
                        <th>Quantità</th>
                        <th style="width: 20%;">Show\Edit\Delete</th>
                    </tr>
                </thead>
                <tbody>
                


                <?php if ($result->rowCount() > 0) : ?>
                    <?php foreach ($result as $product) : ?>
                    <tr>
                        <td><?= $product['ISBN'] ?></td>
                        <td><?= $product['Nome'] ?></td>
                        <td>$<?= number_format($product['Prezzo'], 2) ?></td>
                        <td><?= $product['Quantità'] ?></td>
                        <td>
                            <a href="show.php?ISBN=<?=$product['ISBN']?>" class="btn btn-sm btn-light"><i class="fa fa-th-list"></i></a>
                            <a href="edit.php?ISBN=<?=$product['ISBN']?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-<?= $product['ISBN'] ?>"><i class="fa fa-trash"></i></a>
                            <?php include("inc/modal.php") ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>
      </div>
      <!-- End Table Product -->
      <br>
    </div><!-- /.container -->
<?php include("inc/footer.php") ?>