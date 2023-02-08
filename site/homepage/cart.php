
<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Cart page</title>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://www.paypal.com/sdk/js?currency=EUR&client-id=AeUkN_qomN95w-RO9T3wQuNMPebzntp2WXsDoGl5gdJxDqSYris2piqbOj76xOBcgPsHxlbrn-CrvI5P"></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

	<script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js”></script>

	</head>
	<body>

        
        <div class="container">
            <div class="navbar2">
                <div class="col">
					<a class="navbar-brand" href="home.php">Libri Perera<span>Books - Comics - Gadjets</span></a>
				</div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="ituoiordini.php">I Tuoi Ordini</a></li>
                    </ul>
                </nav>
            </div>
        </div>

	<!--     ALERT rimozione/aggiunta al carrello , ordini effettuati ecc..    -->

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
    </div>

    <div class="container">
        <?php if (isset($_GET['status2']) && $_GET['status2'] == "ordered") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Ordine effettuato</strong> troverai il codice dell'ordine nella sezione <strong>I tuoi ordini</strong>
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status2']) && $_GET['status2'] == "ordertoomuch") : ?>
        <div class="alert alert-warning" role="alert">
            <strong>Ops..</strong> la quantità richiesta dell'articolo <strong><?=$_GET['prodotto']?></strong> non è disponibile.
            <strong>Abbiamo inserito una quantità minore.</strong> Riprova ad effettuare l'acquisto!
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status2']) && $_GET['status2'] == "orderoutofstocks") : ?>
        <div class="alert alert-warning" role="alert">
            <strong>Ops..</strong> l'articolo <strong><?=$_GET['prodotto']?></strong> non è più disponibile.
            Riprova ad effettuare l'acquisto con gli articoli rimanenti nel carrello.
        </div>
        <?php endif ?>
        <?php if (isset($_GET['status2']) && $_GET['status2'] == "fail_order") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Errore </strong>l'ordine non è stato effettuato
        </div>
        <?php endif ?>
    </div>
    <!--alerts---->

      <?php 
		// Include database connection
		require("admin/inc/db.php");
        
        $id_cliente = $_SESSION['id_cliente'];
		try {

    		// Create sql statment
    		$sql2 = "SELECT * FROM carrello WHERE id_cliente = '$id_cliente'";
    		$result2 = $conn->query($sql2);


		} catch (Exception $e) {
    		echo "Error " . $e->getMessage();
    		exit();
		}

        // tutti gli ISBN dentro un array
        $y = 0;
        $i=0;
        $array_qtyxprice;
        $array_isbn;
        $array_qty;
        $tot = 0;
        foreach ($result2 as $product2){
            $array_isbn[$i] = $product2['ISBN'];
            $array_qty[$i] = $product2['quantità'];
            $i++;
        }
    ?>

        
<div id="cart" class="small-container cart-page">

    <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>




    <?php // estraggo da db gli articoli in base a quelli presenti nel carrello(ISBN) per cliente, e li stampa. ?>
    
    <?php foreach ($array_isbn as $ISBN) : ?>

        <?php
            $sql1 = "SELECT * FROM articolo WHERE ISBN = '$ISBN'";
            $result1 = $conn->query($sql1);
        ?>

        <?php foreach ($result1 as $product1) : ?>
            <tr>
                <td>
                    <div class="cart-info">
                    
                        <img src=<? echo $product1['image1'] ?> alt="compra">
                    
                        <div>
                            <p><? echo $product1['Nome']?></p>
                            <small>prezzo: <? echo $product1['Prezzo'] ?> euro</small>
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal2-cartdelete-<?= $product1['ISBN'] ?>"><i class="fa fa-trash"></i></a>
                            <?php include("modal2.php") ?>
                        </div>
                    </div>
                </td>
                <?php $subtotal = $array_qty[$y] * $product1['Prezzo']; ?>
                <td> <?php echo $array_qty[$y] ?> </td>
                <td> <? echo $subtotal ?> euro</td>
                <?php 
                    $tot = $tot + $subtotal;
                    $y = $y + 1;
                ?>
            </tr>
            
        <?php endforeach ?>

    <?php endforeach ?>




    </table>
    <?php if( $i > 0 ) : ?> 

    <div class="total-price">

        <table>
            <tr>
                <td>
                <div id="paypal-button-container"></div>
                <script>
                    function myFunction() {
                        var pass_data = $('form').serialize({ 
                                            "first_name"  :  "Sammy", 
                                            "last_name"   :  "Shark", 
                                            "online"      :  true 
                                            });

                        $.post("cartorder.php",
                        pass_data,
                        function(result){
                            console.log("Data: " + result);
                        }
                        );
                    }

                tot = '<?php echo $tot ;?>';
                paypal.Buttons({
                    // Sets up the transaction when a payment button is clicked
                    createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units:[{
                        amount: {
                            value: tot
                        }
                        }]
                    });
                    },
                    // Finalize the transaction after payer approval
                    onApprove: (data, actions) => {
                    console.log("transazione apppprovata");
                    //effettuaordine();

                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        console.log('brooo',JSON.stringify(orderData.purchase_units[0].payee.address));
                        // non ricordo pervhè const, nel dubbio non cambio.
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        const element = document.getElementById('cart');
                        const address_lin_1 = orderData.purchase_units[0].shipping.address.address_line_1;
                        const admin_are_1 = orderData.purchase_units[0].shipping.address.admin_area_1;
                        const admin_are_2 = orderData.purchase_units[0].shipping.address.admin_area_2;
                        const country_cod = orderData.purchase_units[0].shipping.address.country_code;
                        const postalcode = orderData.purchase_units[0].shipping.address.postal_code;
                        const id_transaction1 = orderData.id;
                        const payer_email1 = orderData.payer.email_address;
                        const payment_status1 = orderData.purchase_units[0].payments.captures[0].status;
                        //provo a inviare a cartone.php questo json per poi stamparlo li se arriva.(non arriva credo)
                        $.post("cartorder.php",
                            {
                                address1: address_lin_1,
                                adminarea1: admin_are_1,
                                adminarea2: admin_are_2,
                                country: country_cod,
                                postalcode: postalcode,
                                id_transaction: id_transaction1,
                                payment_status: payment_status1,
                                payer_email: payer_email1,

                            },
                            function(data)
                            {
                                console.log("Data: " + data + 'ma perche spuntaa il codice di cart.php ');
                            }
                        ); 

                        element.innerHTML = "<h3> Grazie! </h3> l'ordine è stato aggiunto ai Tuoi Ordini  ";
                    });
                    }
                }).render('#paypal-button-container');

                </script>

                </td>
                <td>Subtotal</td>
                <td><?php echo $tot ?> euro</td>
            </tr>
        </table>

    </div>
<?php endif ?>


<?php if( $i == 0 ) : ?>

	<h3>  Carrello Vuoto  </h3>

<?php endif ?>




			</div>
	</div>

    </body>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
          <span class="text-muted">&copy; LibriPerera projectDB</span>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="admin/js/jquery-3.2.1.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>

    
</html>

 