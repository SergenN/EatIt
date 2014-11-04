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
	
	$query = "SELECT BestNR, KlantNR, MedNR, BEST_Datum, BEST_Status ";
	$query .= "FROM Bestelling ";
	
	$result = mysqli_query($connectie, $query);
	
	if (!$result) {
		die("Query werkt niet");
	}
	
	while ($bestelling = mysqli_fetch_assoc($result)) {
		$bestelling_tabel[] = array('BestNR' => intval($bestelling["BestNR"]), 'KlantNR' => intval($bestelling["KlantNR"]), 'MedNR' => intval($bestelling["MedNR"]), 
		'BEST_Datum' => $bestelling["BEST_Datum"], 'Status' => $bestelling["BEST_Status"]);
	}
	
	echo "Gegeven bestelling tabel";
	var_dump($bestelling_tabel);
	
	$gerechten = array();
	$juistegerechten = array();
	$aantalingredienten = array();
	
	foreach ($bestelling_tabel as $tabel) {
		if ($tabel['Status'] == 'Klaar maken') {
			
			$query = "SELECT BestNR, GerNR, Aantal ";
			$query .= "FROM AantalVerkocht ";
			$query .= "WHERE BestNR = ". $tabel['BestNR']. " ";
			
			$result = mysqli_query($connectie, $query);
	
			if (!$result) {
				die("Query werkt niet");
			}
			
			while ($maken = mysqli_fetch_assoc($result)) {
				$gerechten[] = array('BestNR' => intval($maken["BestNR"]), 'GerNR' => intval($maken["GerNR"]), 'Aantal' => intval($maken["Aantal"]));
			}
			
			foreach ($gerechten as $gerecht) {
				
				$query = "SELECT GerNR, GER_Naam, GER_Prijs ";
				$query .= "FROM Gerecht ";
				$query .= "WHERE GerNR = ". $gerecht['GerNR']. " ";
				
				$result = mysqli_query($connectie, $query);
	
				if (!$result) {
					die("Query werkt niet");
				}
				
				while ($maaltijd = mysqli_fetch_assoc($result)) {
					$juistegerechten[] = array('GerNR' => intval($maaltijd["GerNR"]), 'GER_Naam' => $maaltijd["GER_Naam"], 'GER_Prijs' => $maaltijd["GER_Prijs"]);
				}
				
				foreach ($juistegerechten as $jg) {
					
					$query = "SELECT AiNR, GerNR, ArtNR, ING_Aantal ";
					$query .= "FROM Aantalingredienten ";
					$query .= "WHERE GerNR = ". $jg['GerNR']. " ";
					
					$result = mysqli_query($connectie, $query);
	
					if (!$result) {
						die("Query werkt niet");
					}
					
					while ($querytoarray = mysqli_fetch_assoc($result)) {
						$aantalingredienten[] = array('AiNR' => intval($querytoarray["AiNR"]), 'GerNR' => intval($querytoarray["GerNR"]), 'ArtNR' => intval($querytoarray["ArtNR"]), 
						'ING_Aantal' => intval($querytoarray["ING_Aantal"]));
					}
					
				}
				
			}
		}
	}
	
	var_dump($gerechten);
	
	var_dump($juistegerechten);
	
	var_dump($aantalingredienten);

?>