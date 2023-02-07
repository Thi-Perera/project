<?php
// sessione per prendere l'id dell utente
session_start();
$id_cliente = $_SESSION['id_cliente'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  	<title>ituoiordini</title>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

	
	</head>
<body>
<?php 
		// Include database connection
		include "admin/inc/db.php";

		try {
    		// Create sql statment  #ordini
            // metti un WHERE id_cliente   #ordini
            $sql_user = "SELECT username FROM utente WHERE id_utente = '$id_cliente'";
    		$result_user = $conn->query($sql_user);

    		$sql = "SELECT * FROM ordine WHERE id_cliente = '$id_cliente' ORDER BY Data_inserimento";
    		$result = $conn->query($sql);

		} catch (Exception $e) {
    		echo "Error " . $e->getMessage();
    		exit();
		}

?>
<?php include "searchbar.php"; ?>
<div class="container">

<h2> Ecco i tuoi ordini:</h2>

  <table class="table">
        <thead class="thead-dark">
            <tr>
            <th>ID ordine</th>
            <th>Stato</th>
            <th>Lista prodotti ordinati</th>
            <th>Costo</th> 
            <th>Data</th>
            </tr>
        </thead>

<?php foreach ($result as $product) : ?>
    <tbody>
        <tr>
            <td><?= $product['id_ordine'] ?></td>
            <td><?= $product['status_ordine'] ?></td>
            <td><?= $product['lista_prodotti'] ?></td>
            <td><?= $product['costo'] ?> euro</td>
            <td><?= $product['Data_inserimento'] ?></td>
        </tr>
    </tbody>
<?php endforeach ?>


  </table>
</div>
</body>
</html>
