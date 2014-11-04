<?php 
//redirect functie wordt gedefineerd
function redirect_to($new_location)
{header("location: " . $new_location); 
exit;}
?>
<div class="content">
<?php
	//de bestellingen die klaarstaan worden opgehaald
	$query  = "select bestNR, KL_Voornaam, KL_Achternaam, KL_Plaats, KL_Adres ";
	$query .= "from Besteling b, Klant k ";
	$query .= "where k.Klantnr = b.Klantnr ";
	$query .= "and BEST_Status = 'bezorgen' ";
	$query .= "order by KL_Plaats; ";
	$result = mysqli_query($connection, $query);
	
	if(mysqli_num_rows($result) == 0){
		echo "	<form action\"\" method=\"post\">
					<input type=\"submit\" name=\"herladen\" value=\"Opnieuw Checken\" /> 
				</form> ";
		if(isset($_POST["herladen"])){
			redirect_to("Routeplanning.php");
		}
		die("Geen bestellingen klaar" . mysqli_connect_error());
	}
	//de bestellingen worden weergegeven in een tabel en de bestellingsnummers komen in de array $bestnr te staan
	echo "<table><tr><td><b>Bestellingsnummer</b></td><td><b>Voornaam</b></td><td><b>Achternaam</b></td><td><b>Plaats</b></td><td><b>Adres</b></td></tr>";
	while($row = mysqli_fetch_assoc($result)){
		$bestnr[] = $row["bestNR"];
		echo "<tr><td>". $row["bestNR"]. "</td><td>". $row["KL_Voornaam"]. "</td><td>". $row["KL_Achternaam"]. "</td><td>". $row["KL_Plaats"]. "</td><td>" . $row["KL_Adres"] . "</td></tr>";
		;
	}
	//de array $bestnr wordt in een session gezet om hem mee te geven aan de volgende pagina
	if(isset($bestnr)){
	$_SESSION['bestnr'] = $bestnr;
	}
	
?>
<!-- deze button stuurt je door naar de volgende pagina en geeft post de waarde "klaar" mee -->
<form action="?p=routeplanning2" method="post">
<input type="submit" name="done" value="klaar" />
</form>

<!-- als je op deze button drukt wordt de pagina geprint -->
<form action="" method="post">
<input type="button" onClick="window.print()" value="Print"/>
</form>
</div>


