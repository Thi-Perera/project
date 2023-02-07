<?php
// sessione per entrare come un utente unico.
session_start();
if (!isset($_SESSION['loggato']) || $_SESSION['loggato'] !== true) {
	 header("location: account-page.html");
	 exit;
}
else{
	$id_cliente = $_SESSION['id_cliente'];
}


?>

  <!-- fixa questa parte sopra di php, che dopo il login
   indirizza a "account-page.html" invece dell html di "home.php"
   (che viene letto solo se tolgo il php qui sopra) -->


<!doctype html>
<html lang="en">
  <head>
  	<title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

	<?php 
		// Include database connection
		include "admin/inc/db.php";

		try {
    		// Create sql statment
    		$sql = "SELECT * FROM articolo ORDER BY Data_inserimento LIMIT 8";
    		$result = $conn->query($sql);

		} catch (Exception $e) {
    		echo "Error " . $e->getMessage();
    		exit();
		}

	?>
	
	</head>
	<body>

	<!-- adding navbar -->
	<?php include "searchbar.php"; ?>


	<!-- alert adding or fail adding to cart-->
	<?php if (isset($_GET['status']) && $_GET['status'] == "added") : ?>
		<div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  			<strong>Hey! Articolo aggiunto nel carrello.</strong>
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
		</div>
		</div>
	<?php endif ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == "fail_add") : ?>
        <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  			<strong>Errore! Articolo non aggiunto al carrello</strong>
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
		</div>
		</div>
    <?php endif ?>
	<?php if (isset($_GET['status']) && $_GET['status'] == "alreadyadded") : ?>
        <div class="container">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  			<strong>Hey! L' articolo è già presente nel carrello.</strong>
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
		</div>
		</div>
    <?php endif ?>


	</head>
	<!-- offerte -->
	<div class="offer">
		<div class="small-container">
			<h3 class="title">Novità e Promozioni</h3>
			<div class="row">
				<div class="col-2">
					<img src="/images/productimages/Zanardi.jpg" class="offer-img">
				</div>
				<div class="col-2">
					<p>Nuova promozione signora, compra 2 paga 2 olè</p>
					<h1>ZAnardi</h1>
					<small>
						propio un bel fumetto quello di andrea pazienza,
						praticamente tu lo compri e lo leggi.
					</small>
					

					<a href="product-details.php?id_cliente=<?=$id_cliente?>&ISBN=1200021233333" class="btn">Buy Now &#8594;</a>
				</div>
			</div>
		</div>
	</div>
	
	<!-- novità con db -->
	<div class="small-container">
		<h3 class="title">Ultime uscite</h3>
		
			<div class="row">
			<?php foreach ($result as $product) : ?>
				<div class="col-4">
					
					<a href="product-details.php?id_cliente=<?=$id_cliente?>&ISBN=<?=$product['ISBN']?>"><img src=<?= $product['image1'] ?>></a>
					<h5><?= $product['Nome'] ?></h5>
					<p><?= number_format($product['Prezzo'], 2) ?>  €</p>

				</div>
			<?php
				endforeach
			?>
			</div>
	</div>


	



        </section>

        <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>

        </body>
    </html>

 