<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<!-- Modal Confirm Delete -->
<div class="modal fade" id="modal2-cartdelete-<?= $product1['ISBN'] ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-trash"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Vorresti togliere <strong><?= $product1['Nome'] ?></strong> dal carrello ?</p>
            </div>
            <div class="modal-footer">
                <a href="cartdelete.php?ISBN=<?= $product1['ISBN'] ?>&id_cliente=<?= $id_cliente ?>" class="btn btn-outline-success">Togli dal carrello</a>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Mantieni</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->