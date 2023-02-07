<!doctype html>
<html lang="en">
  <head>
  	<title>Product page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>


	<?php 
	// Include database connection
	require("admin/inc/db.php");
	?>
	</head>
	<body>

	<!-- adding navbar -->
	<?php include "searchbar.php"; ?>

	
	<!-- novità -->
	<div class="small-container">

		<!-- <div class="row row-2">
			<h2 class="title2" >Articoli ricercati</h2>
			<select name="sort" id="sort">
				<option>Default Sorting</option>
				<option value="prezzoasc">Ordina per prezzo</option>
				<option>Ordina per nome</option>
				<option>Ordina per saldi</option>
				<option>Ordina per data</option>
			</select>
		</div> -->

		
			<div class="small-container">
		
			<div class="row">

			<?php 
				if (isset($_GET['search'])) {
					require_once('config.php');
					$search = $connessione->real_escape_string($_GET['search']);;
					$sql = "SELECT * FROM articolo WHERE LOWER(Nome) LIKE LOWER('%$search%') OR
					 LOWER(Tipologia) LIKE LOWER('%$search%') OR
					  LOWER(Autore) LIKE LOWER('%$search%') OR
					   LOWER(Editore) LIKE LOWER('%$search%') ORDER BY Nome ASC";
					$result = $connessione->query($sql);
					$queryrows = $result->num_rows;
			?>
			<div class="container">
				<div class="alert alert-light" role="alert">
					<strong><?= $queryrows ?> Risultati</strong>
				</div>
			</div>
			<?php 
				}
			?>

			
			<?php if ($queryrows > 0) : ?>
				<?php foreach ($result as $product) : ?>

					<div class="col-4">
					
						<a href="product-details.php?ISBN=<?=$product['ISBN']?>"><img src=<?= $product['image1'] ?>></a>
						<h5><?= $product['Nome'] ?></h5>
						<p><?= number_format($product['Prezzo'], 2) ?>  €</p>

					</div>
					
				<?php endforeach ?>								  
			<?php endif ?>

			</div>
			</div>


			
			<div class="page-btn">
				<span>1</span>
				<span>2</span>
				<span>&#8594;</span>
			</div>
		</div>
	</div>

	



        </section>

        <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>

        </body>
    </html>

 