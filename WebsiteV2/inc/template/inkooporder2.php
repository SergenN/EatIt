<div class="content">
		<form method="POST">
			<table>
			<tr><td>Artikel nummer:</td><td><input type="number" value="" name="ArtNR"/></td></tr>
			<tr><td>Aantal:</td><td><input type="number" value="" name="Aantal"/></td></tr>
			<tr><td>OrderNR:</td><td><input readonly type="number" name="OrderNR" value=
				<?php
					echo $_SESSION["OrderNR"];
				?>
				 /></td></tr>
			</table>
			<input type="submit" value="Inkooporder maken" name="submit" />
		</form>
		
		<?php
			
			//Qeury opzoeken alle artikelen nummers en artikel naam.
			$query = "SELECT ArtNR, ART_Naam ";
			$query .= "FROM Artikelen ";
			
			//Resultaat query
			$result = mysqli_query($con, $query);
			
			//Wordt gekeken of de query werkt.
			if (!$result) {
				die("Query werkt niet");
			}
			
			//Query wordt in een array gezet.
			while ($lev = mysqli_fetch_assoc($result)) {
				$artikelen[] = array('ArtNR' => intval($lev["ArtNR"]), 'ART_Naam' => $lev["ART_Naam"]);
			}
			
			//Wordt gekeken of er op de knop Inkooporder maken.
			if (!isset($_POST['submit'])) {
						echo "Voer gegevens in.";
						echo "</br>";
					}
			
			//Wordt gekeken of alles is ingevoerd en of alles correct is igevoerd.
			if (isset($_POST['submit'])) {
				if (empty($_POST['ArtNR'])) {
					echo "Artikel nummer invoeren!";
					echo "</br>";						
				}
				if (empty($_POST['Aantal'])) {
					echo "Aantal invoeren!";
					echo "</br>";						
				}					
				if (!empty($_POST['ArtNR'])) {
					//Wordt bekeken of artikelnummer wel bestaat.
					foreach ($artikelen as $key) {
						if ($_POST['ArtNR'] == $key['ArtNR']) {
							$error = NULL;
							break;
						}
						else {
							$error = "Artikel met opgegeven artikel nummer bestaat niet!!";
						}
					}
					echo $error;
				}
				
				//Alle $_POST data wordt in variabelen gezet
				$ordernr = (int) $_POST['OrderNR'];
				$artnr = (int) $_POST['ArtNR'];
				$aantal = (int) $_POST['Aantal'];
				
				//Query voor toevoegen ingevulde waardes.
				$query = "INSERT INTO Bestelorder (ArtNR, OrderNR, Aantal) ";
				$query .= "VALUES (". $artnr. ",". $ordernr. ",". $aantal. ") ";
				
				//Resultaat Query.
				$result = mysqli_query($con, $query);
				
				//Wordt gekeken of query werkt.
				if (!$result) {
					die("Query werkt niet");
				}
			}
		?>
</div>