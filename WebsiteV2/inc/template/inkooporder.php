<div class="content">
		<form method="POST">
			<input type="submit" value="Inkoop order maken" name="maken" />
		</form>
		
		<?php
			
			//Als er op Inkoop order maken wordt gedrukt gebeurt het onderstaande.
			if (isset($_POST['maken'])) {
				//Qeury inkooporder nummer wordt automatisch gemaakt.
				$query = "INSERT INTO Inkooporder (Aantal) ";
				$query .= "VALUES (0) ";
				
				//Resultaat query
				$result = mysqli_query($con, $query);
				
				//Wordt gekeken of de query werkt.
				if (!$result) {
					die("Query werkt niet");
				}
				
				//Ordernr wordt meegestuurd naar Inkooporder2.php.
				$_SESSION["OrderNR"] = mysqli_insert_id($con);
				
				//Wordt doorgestuurd naar Inkooporder2.php.
				header("location:?p=Inkooporder2");
				
			}
			
		?>
</div>