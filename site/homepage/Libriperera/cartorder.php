<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<?php 
require("admin/inc/db.php");

if (isset($id_cliente)) {
    // Delete record
    try {

        //  <---Data from Paypal transaction--->
        $address1 = $_POST['address1'];
        $adminarea1 = $_POST['adminarea1'];
        $adminarea2 = $_POST['adminarea2'];
        $countrycode = $_POST['country'];
        $postalcode = $_POST['postalcode'];
        $payer_email = $_POST['payer_email'];
        $payment_status = $_POST['payment_status'];
        $id_transaction = $_POST['id_transaction'];

        //  <---FINE Data from Paypal transaction--->



        //  <---Costo totale--->
        $isbns_query = "SELECT * FROM carrello WHERE id_cliente = '$id_cliente'";
        $isbns = $conn->query($isbns_query);
        $costo_totale = 0;
        foreach($isbns as $prodottonelcarrello){ 

                $prodotto_isbn = $prodottonelcarrello['ISBN'];
                $prodotto_qty = $prodottonelcarrello['quantità'];
                $sql_prezzo = "SELECT * FROM articolo WHERE ISBN = '$prodotto_isbn'";
                $prezzo = $conn->query($sql_prezzo);
                $result = $prezzo->fetch(PDO::FETCH_ASSOC);
                $res_prezzo = $result['Prezzo'];
                $costo_totale_unico_articolo = $res_prezzo * $prodotto_qty;
                $costo_totale = $costo_totale + $costo_totale_unico_articolo;

        }
        //  <---FINE Costo totale--->



        //  <---verifica degli articoli da inserire nell'ordine--->
        $errore = 0;
        $lista_prodotti = ' ';
        $sql_carrello = "SELECT * FROM carrello WHERE id_cliente = '$id_cliente'";
        $result_carrello = $conn->query($sql_carrello);
        $i = -1;

        foreach($result_carrello as $carrello){
            $i++;
            $isbn_prodotto = $carrello['ISBN'];
            $sql_articolo = "SELECT * FROM articolo WHERE ISBN = '$isbn_prodotto'";
            $result_articolo = $conn->query($sql_articolo);
            foreach($result_articolo as $articolo){
                   //verifica sulle quantità richieste e disponibili
                if($articolo['Quantità'] < $carrello['quantità']){

                    $quantità_disponibile = $articolo['Quantità'];
                    $prodotto_errore = $carrello['ISBN'];
                    $prodotto_errore_nome = $carrello['articolo'];
                    $errore = 1;
                    header("Location: cart.php?status2=fail_order");

                }else{//aggiorna la lista dei prodotti (ordine)

                    $new_qty = $articolo['Quantità'] - $carrello['quantità'];
                    $array_qty_prodotto[$i][0] = $new_qty;
                    $array_qty_prodotto[$i][1] = $isbn_prodotto;
                    $nome_prodotto = $articolo['Nome'];
                    $linea = '- (' . $nome_prodotto . ' x' . $carrello['quantità'] . ')' . PHP_EOL; 
                    $lista_prodotti = $lista_prodotti . $linea; 

                }
            }
         /*   if($errore == 0){//toglie l'articolo dell'ordine dal "magazzino"

                $result2_articolo = "UPDATE articolo SET Quantità=$new_qty WHERE ISBN = '$isbn_prodotto'";
                $conn->query($result2_articolo);

            }*/
        }
        //  <---FINE verifica degli articoli da inserire nell'ordine--->



        //  <---crea ordine e salva indirizzo di spedizione--->
        if($errore == 0){

            //dati del pagamento
            $pagamento = "INSERT INTO pagamento(id_transazione, id_cliente, payment_status, payer_email, costo) VALUES ('$id_transaction', '$id_cliente','$payment_status','$payer_email','$costo_totale')";
            $conn->query($pagamento);

            //estraggo l'id del pagamento dal mio db (non è quella della transazione ma del pagamento nel mio sito)
            $sql_id_pagamento = "SELECT id_pagamento FROM pagamento WHERE id_cliente = '$id_cliente' AND id_transazione = '$id_transaction'";
            $id_pagamento_obj = $conn->query($sql_id_pagamento);
            $res = $id_pagamento_obj->fetch(PDO::FETCH_ASSOC);
            $id_pagamento_value = $res["id_pagamento"];

            //crea l'ordine.
            $ordine = "INSERT INTO ordine(id_cliente, lista_prodotti, costo, id_pagamento) VALUES ('$id_cliente', '$lista_prodotti', '$costo_totale', '$id_pagamento_value')";
            $conn->query($ordine);
            

            //controlla se l'indirizzo del cliente è già salvato
            $indir_cliente = "SELECT * FROM indirizzo WHERE id_cliente = '$id_cliente'";
            $indir_cliente_query = $conn->query($indir_cliente);
            $indirizzo_esiste = 0;
            
            foreach($indir_cliente_query as $indirizzo){
                if($indirizzo['countrycode'] == $countrycode){
                    if($indirizzo['adminarea2'] == $adminarea2){
                        if($indirizzo['adminarea1'] == $adminarea1){
                            if($indirizzo['postalcode'] == $postalcode){
                                
                                if($indirizzo['ship_address1'] == $address1){

                                    $indirizzo_esiste = $indirizzo_esiste + 1;
                                    break;
            
                                }
                                
                            }    
                        }
                    }
                }
            }


        //    if ($stmt->rowCount()){
        //        header("Location: cart.php?status2=ordered");
        //    }
        //    else{
        //        header("Location: cart.php?status2=fail_order");
        //    }



            //se necessario modifico tutti i carelli.
        //    $errore = 0;
            $lista_prodotti = ' ';
            $sql_carrello = "SELECT * FROM carrello";
            $result_carrello = $conn->query($sql_carrello);

            foreach($result_carrello as $carrello){

                $isbn_prodotto = $carrello['ISBN'];
                $sql_articolo = "SELECT * FROM articolo WHERE ISBN = '$isbn_prodotto'";
                $result_articolo = $conn->query($sql_articolo);
                foreach($result_articolo as $articolo){

                    if($articolo['Quantità'] < $carrello['quantità']){

                        $quantità_disponibile = $articolo['Quantità'];
                        $prodotto_errore = $carrello['ISBN'];
                        $prodotto_errore_nome = $carrello['articolo'];
                        
                        if($quantità_disponibile != 0){

                            // prodotto disponibile in quantità minore, modifica la quantità nel carrello.
                            $sql = "UPDATE carrello SET quantità = :qty_disponibile WHERE ISBN = :ISBN AND quantità > :qty_disponibile";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(":qty_disponibile", $quantità_disponibile, PDO::PARAM_INT);
                            $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
                            $stmt->bindParam(":ISBN", $prodotto_errore, PDO::PARAM_INT);
                            $stmt->execute();
                        
                /*          if ($stmt->rowCount()) {
                                header("Location: cart.php?prodotto=<?= $prodotto_errore_nome ?>&status2=ordertoomuch");
                                exit();
                            }
                            else{
                            header("Location: cart.php?status2=fail_order");
                            }*/
                        }elseif($quantità_disponibile == 0){
                
                            // Prodotto non disponibile, lo toglie dal carrello del cliente
                            $sql = 'DELETE FROM carrello WHERE ISBN = :ISBN';
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(":ISBN", $prodotto_errore, PDO::PARAM_INT);
                            $stmt->execute();
                    /*        if ($stmt->rowCount()) {
                                header("Location: cart.php?prodotto=<?= $prodotto_errore_nome ?>&status2=orderoutofstocks");
                                exit();
                            }
                            else{
                                header("Location: cart.php?status2=fail_order");
                            } */
                        }
                    //    exit();
                    }
                }


                //salva l indirizzo di spedizione se non esiste
                if($indirizzo_esiste == 0){
                    $indir = "INSERT INTO indirizzo(id_cliente, ship_address1, admin_area1, admin_area2,  countrycode, postalcode)
                                VALUES (:id, :ship_ad1, :adminarea1, :adminarea2, :countrycode, :postalcode)";
                    $stmttt = $conn->prepare($indir);
                    $stmttt->bindParam(":ship_ad1", $address1);
                    $stmttt->bindParam(":adminarea1", $adminarea1);
                    $stmttt->bindParam(":adminarea2", $adminarea2);
                    $stmttt->bindParam(":countrycode", $countrycode);
                    $stmttt->bindParam(":postalcode", $postalcode);
                    $stmttt->bindParam(":id", $id_cliente);
                    $stmttt->execute();
                }
                

                //cancella elementi dal carrello dopo aver effettuato l'ordine.
                $sql = 'DELETE FROM carrello WHERE id_cliente = :id';
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
                $stmt->execute();


                //toglie l'articolo dell'ordine dal "magazzino"
                foreach($array_qty_prodotto as $prodotto){
                    $result2_articolo = "UPDATE articolo SET Quantità = '$prodotto[0]' WHERE ISBN = '$prodotto[1]'";
                    $conn->query($result2_articolo);
                }
            }
        }
             
    } catch (Exception $e) {
        echo "Erroreeeeeeeeeeeeeeeee " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to index.php
    header("Location: cart.php?status=fail_delete");
    exit();
}