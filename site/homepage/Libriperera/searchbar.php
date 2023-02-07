<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	
<?php 
		include "admin/inc/db.php";
		$id_cliente = $_SESSION['id_cliente']; 
        $sql_user = "SELECT username FROM utente WHERE id_utente = '$id_cliente'";
    	$result_user = $conn->query($sql_user);
?>

<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col">
					<a class="navbar-brand" href="home.php">Libri Perera<span>Books - Comics - Gadjets</span></a>
				</div>
				<div class="col d-flex justify-content-end">
					<div class="social-media">
		    		<p class="mb-0 d-flex">

						<?php	if ($_SESSION['loggato2'] == true) : ?>
							<a href="admin/index.php" class="d-flex align-items-center justify-content-center"><span class="fa fa-user"><i class="sr-only">Admin page</i></span></a>
						<?php	endif	?>
		    			<a href="https://www.facebook.com/" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
		    			<a href="https://twitter.com/" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
		    			<a href="https://www.instagram.com/" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>

						
		    		</p>
					
	        </div>
				</div>
			</div>
		</div>



		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
			<form class="searchform order-lg-last" method="GET" action="search.php">
          <div class="form-group d-flex">
            <input type="text" class="form-control pl-3" placeholder="Cerca" name="search">
            <button type="submit" name="submit-search" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
          </div>
        	</form>


		


	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a href="home.php" class="nav-link">Home</a></li>
	        <li class="nav-item dropdown">
	        	<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogo</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="search.php?search=libro&submit-search=">Libri</a>
                <a class="dropdown-item" href="search.php?search=fumetto&submit-search=">Fumetti</a>
                <a class="dropdown-item" href="search.php?search=artbook&submit-search=">Artbooks</a>
                <a class="dropdown-item" href="search.php?search=manuale&submit-search=">Manuali</a>
				<a class="dropdown-item" href="search.php?search=&submit-search=">Tutti</a>
              </div>
            </li>
	        	<li class="nav-item"><a href="ituoiordini.php?id_cliente=<?php $id_cliente ?>" class="nav-link">I Tuoi Ordini</a></li>
				<li class="nav-item"><a href="logout.php" class="nav-link">
					Disconnetti
					<?php foreach ($result_user as $username) : ?>
					<small><?= $username['username'] ?></small>
					<?php endforeach ?>
					</a></li>
			  	<li class="nav-item"><a href="cart.php?id_cliente=<?=$id_cliente?>" class="nav-link" >
					<img src="images/cart3.png" alt="Carrello" width="20" height="20">
				</a></li>
	        </ul>
			

	      </div>
		  
	    </div>
		
	  </nav>
	 
    <!-- END nav -->
</body>
</html>
