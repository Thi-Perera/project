<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<!doctype html>
<html lang="en">
  <head>

  	<title>Product-details page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

	<script 
		src="https://code.jquery.com/jquery-3.6.1.min.js" 
		integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
		crossorigin="anonymous">
	</script>

	
	<?php 
		require("admin/inc/db.php");
		$ISBN = $_GET['ISBN'] ? intval($_GET['ISBN']) : 0;
		$id_cliente = $_GET['id_cliente'];
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
    	header("Location: home.php");
    	exit();
	}
	$product = $stmt->fetch();

	?>
	
	<body>
		
	<!-- adding navbar -->
	<?php 
		include "searchbar.php";
	 ?>
	



	<!-- single product details-->
	<div class="small-container single-product">
	  <div class="row">
		<div class="col-2">
			<img src=<?= $product['image1'] ?> width="100%" id="productimg">

			<div class="small-img-row">
			<div class="small-img-col">
					<img src=<?= $product['image1'] ?> width="100%" class="small-img">
				</div>
				<div class="small-img-col">
					<img src=<?= $product['image2'] ?> width="100%" class="small-img">
				</div>
				<div class="small-img-col">
					<img src=<?= $product['image3'] ?> width="100%" class="small-img">
				</div>
			</div>
		</div>

		<div class="col-2">
			<p>Home / Product</p>
			<h1><?= $product['Nome'] ?></h1>
			<h4><?= number_format($product['Prezzo'], 2) ?>  €</h4>

		<?php if($product['Quantità'] == 0 ) : ?>
			<button>  Non Disponibile  </button>
		<?php endif ?>
		
		<?php if($product['Quantità'] > 0) : ?>
			<form action="addcart.php" method="post">
				<input type="number" id="qty" width="100" name="qty" max=<?= $product['Quantità'] ?> min="1" value="1">
				<input type="hidden" id="name" name="name" value=<?= $product['Nome'] ?>>
				<input type="hidden" id="ISBN" name="ISBN" value=<?= $product['ISBN'] ?>>
				<button class="btn"> Add to cart</button>
			</form>
		<?php endif ?>



			<h3>Descrizione <i class="fa fa-indent"></i></h3>
			<p>
				<?= $product['Descrizione'] ?>
			</p>
		</div>
	  </div>
	</div>
	<!-- end single product-->

	<!--title-->
	<div class="small-container">
		<div class="row row-2">
		  <h2>Articoli Relativi</h2>
		</div>

	</div>
 	<!--title-->

	<!-- novità -->

	<?php 
		// Include database connection
		require("admin/inc/db.php");

		try {
    		// Create sql statment
    		$sql2 = "SELECT * FROM articolo LIMIT 4";
    		$result2 = $conn->query($sql2);

		} catch (Exception $e) {
    		echo "Error " . $e->getMessage();
    		exit();
		}

	?>

	<div class="small-container">
			<div class="row">
			<?php foreach ($result2 as $product2) : ?>
				<div class="col-4">
					<?php echo "000" . $_SESSION['id_cliente'] ?>
					<a href="product-details.php?id_cliente=<?php $id_cliente ?>&ISBN=<?=$product2['ISBN']?>"><img src=<?= $product2['image1'] ?>></a>
					<h5><?= $product2['Nome'] ?></h5>
					<p><?= number_format($product2['Prezzo'], 2) ?>  €</p>
					

				</div>
			
			<?php
				endforeach
			?>
			</div>
	</div>
	<!-- endnovità -->

	
a


        </section>

        <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>

	  <script>
		var productimg =document.getElementById("productimg");
		var Smallimg = document.getElementsByClassName("small-img");

		Smallimg[0].onclick = function()
		{
			productimg.src = Smallimg[0].src;
		}
		Smallimg[1].onclick = function()
		{
			productimg.src = Smallimg[1].src;
		}
		Smallimg[2].onclick = function()
		{
			productimg.src = Smallimg[2].src;
		}
		Smallimg[3].onclick = function()
		{
			productimg.src = Smallimg[3].src;
		}
	  </script>
        </body>
    </html>

 