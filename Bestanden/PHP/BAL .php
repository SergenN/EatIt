<?php

	//Connectie database.
	$connectie = mysqli_connect("localhost", "root", "", "EatIT");
	
	//Connectie testen.
	if(mysqli_connect_errno()) {
		die("Database connection failed: " .
			mysqli_connect_error() .
			" (" . mysqli_connect_errno() . ")"
			);
	}

?>

<?php

	//Opstellen BAL
	
	
	$economische_voorraad;
	$bestelniveau;
	
	//Qeury opzoeken bestelniveau
	$query = "SELECT ArtNR, ART_Naam, ART_TechnischeVoorraad, ART_InBestelling, ART_Gereserveerd, ART_BestelNiveau ";
	$query .= "FROM Artikelen ";
	
	//Resultaat query
	$result = mysqli_query($connectie, $query);
	
	//Wordt gekeken of de query werkt.
	if (!$result) {
		die("Query werkt niet");
	}
	
	//Query wordt in een array gezet.
	while ($artikelen = mysqli_fetch_assoc($result)) {
		$artikelen_tabel[] = array('ArtikelNR' => intval($artikelen["ArtNR"]), 'Naam' => $artikelen["ART_Naam"], 'Technischevoorraad' => intval($artikelen["ART_TechnischeVoorraad"]), 
			'In bestelling' => intval($artikelen["ART_InBestelling"]), 'Gereserveerd' => intval($artikelen["ART_Gereserveerd"]), 'Bestelniveau' => intval($artikelen["ART_BestelNiveau"]), 
			);
		}
	
	//Gaat $artikelen_tabel array doorlopen.
	foreach ($artikelen_tabel as $nummer) {
		
		//Variabelen worden gevuld met verschillende waardes.
		$bestelniveau = $nummer["Bestelniveau"];
		$TV = $nummer["Technischevoorraad"];
		$IB = $nummer["In bestelling"];
		$GR = $nummer["Gereserveerd"];
		
		//Wordt berekent wat de economische voorraad is.
		$economische_voorraad = $TV + $IB - $GR;
		
		//Wordt bekeken of er bij bestelt moet worden.
		if ($economische_voorraad <= $bestelniveau) {
			$aantal_bestellen = $bestelniveau - $economische_voorraad;
			$bestellen[] = array('ArtikelNR' => intval($nummer["ArtikelNR"]), 'Naam' => $nummer["Naam"], 'Aantal' => intval($aantal_bestellen));
		}
		
	}
	
	//Wordt bekeken of er producten bij moet worden bestelt. Zo ja wordt er een overzicht weergegeven.
	if (!empty($bestellen)) {
		echo "Het volgende product of de volgende producten moeten worden bestelt:</br>";
		echo "</br>";
		echo "<table border=1><tr><td>Artikel nummer</td><td>Artikel naam</td><td>Aantal</td></tr>";
		foreach ($bestellen as $i) {
			echo "<tr><td>". $i['ArtikelNR']. "</td><td>". $i['Naam']. "</td><td>". $i['Aantal']. "</td></tr>";
		}
		echo "</table>";
	}
	
?>