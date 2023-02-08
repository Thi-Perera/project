<?php 
		// Include database connection
		require("db.php");

		try {
    		// Create sql statment
    		$sql = "SELECT * FROM articolo";
    		$result = $conn->query($sql);
			$i=0;

		} catch (Exception $e) {
    		echo "Error " . $e->getMessage();
    		exit();
		}
?>
<?php
    $rows=$result->rowCount();
    echo $rows;
?>