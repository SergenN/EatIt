<?php
// Winkelwagen is alleen te gebruiken voor klanten.
if($_SESSION['soortgebruiker'] != "klant"){
	header ('location: index.php');
}

//redirect functie wordt gedefineerd
function redirect_to($new_location)
	{header("location: " . $new_location); 
	exit;}
?>
<div class="content">
<?php
if(isset($_GET['res'])){
    if($_GET['res'] == 'succes'){
        echo '<div class="success">Uw heeft besteld!</div><br>';
    } else if($_GET['res'] == 'error'){
        echo '<div class="error">Oeps er ging iets fout</div><br>';
    } else if($_GET['res'] == 'fail') {
        echo '<div class="success">U kunt artikel '.$_GET['gid'].' niet meer bestellen, want die hebben wij niet meer op voorraad!</div><br>';
    }
}

if(isset($_POST["delete"])){
	$_SESSION['bes'] = null;
}

//alle orders die zijn besteld worden weergegeven	
if(isset($_SESSION['bes'])){
	foreach ($_SESSION['bes'] as $gerecht => $aantal) {
		$query2  = "select GER_Naam from Gerecht ";
		$query2 .= "where GerNR = $gerecht; ";
		$result2 = mysqli_query($con, $query2);
		if(!$result2){
			die("Database query failed");
		}
		while ($naam = mysqli_fetch_assoc($result2)) {
		
		echo "Het gerecht " . $naam['GER_Naam'] . " is " . $aantal. " keer door U besteld";
		echo "<hr/>";
		}
	}
//als er geen gerechten besteld zijn wordt dat weergegeven
} else {
	echo "Je hebt nog geen gerechten besteld.<br><br>";
}
//als er gerechten besteld zijn wordt de verwijder knop weergegeven
if(isset($_SESSION['bes'])){
	echo "		<form action=\"\" method=\"post\">
					<input type=\"submit\" name=\"delete\" class=\"submit\" value=\"Verwijderen\" />
				</form><br>";
}
		

?>
<!-- als er gerechten besteld zijn wordt de bevestig knop weergegeven-->
<form action="" method="post">
	<?php 	if(isset($_SESSION['bes'])) {
				echo"<input type=\"submit\" name=\"confirm\" class=\"submit\" value=\"Bevestigen\"/><br><br>";
			} ?>
	<input type="submit" name="back" class="submit" value="Terug naar bestellen"/>
</form>

<?php
//als er op bevestigen wordt gedrukt wordt de bestelling ingevoerd in de database
if (isset($_POST["confirm"]) == "bevestigen ") {
    foreach ($_SESSION['bes'] as $gerecht => $aantal) {
        $query = "SELECT * FROM Aantalingredienten a JOIN Artikelen i ON i.ArtNR = a.ArtNR WHERE a.GerNR = $gerecht;";
        $res2 = mysqli_query($con, $query);
        $stocked = 0;
        if (!$res2) continue;
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $voorraad = $row2['ART_TechnischeVoorraad'] - $row2['ART_Gereserveerd'];
            if (($row2['ING_Aantal'] * $aantal) > $voorraad) {
                header("location: index.php?res=error&gid=$gerecht");
            }
        }
    }
    
	foreach ($_SESSION['bes'] as $gerecht => $aantal) {
	
	//query die de data in de bestelling tabel zet
	$query  = "insert into Bestelling
                (KlantNR, Best_Datum, BEST_Status)
                values (" . $_SESSION['gegevens']['KlantNR'] . " ,str_to_date( '" . date('d-m-Y ') . "' , '%d-%m-%Y' ), 'besteld'); ";
	$result = mysqli_query($con, $query);
	if(!$result){
        header("location: index.php?res=error");
	}
	
	//query die de bij behorende data in de aantalverkocht tabel zet en aan de  bestelling tabel linkt
	$query3  = "insert into AantalVerkocht (GerNR, Aantal, BestNR)
                values ($gerecht, $aantal, " .mysqli_insert_id($con) . ");";
	$result3 = mysqli_query($con, $query3);
	if(!$result3){
        header("location: index.php?res=error");
	}
	//query die het aantal ingredienten samen met het ingredientnummer ophaalt
	$query4  = "select ING_Aantal, ArtNR
                from Gerecht g, Aantalingredienten a
                where g.GerNR = a.GerNR
                and g.GerNR = $gerecht; ";
	$result4 = mysqli_query($con,$query4);
		if(!$result4){
            header("location: index.php?res=error");
		}
		while ($row = mysqli_fetch_assoc($result4)) {
			//query dat het aantal gereserveerd van het ingredient wordt opgehaald
			$query6  = "select ART_Gereserveerd from Artikelen where ArtNR =" . $row['ArtNR'] . ";";
			$result6 = mysqli_query($con, $query6);
			while ($gereserveerd = mysqli_fetch_assoc($result6)) {
			var_dump($gereserveerd);
				//query die het aantal gereserveerd aanpast
				$query5  = "update Artikelen
                            set ART_Gereserveerd ={$gereserveerd['ART_Gereserveerd']} + {$row['ING_Aantal']}
                            where ArtNR = {$row['ArtNR']};";
			}
		}
	}
	//de bestelling wordt verwijderd en je wordt door verwezen 
	$_SESSION['bes'] = null;
	header("location: index.php?res=besteld");
	}
//als de bestelling veranderd moet worden dan kan men op terug drukken en wordt er terugverwezen naar de bestelpagina
if (isset($_POST["back"]) == "terug naar bestellen"){
	$new_location = "?p=bestellen";
	redirect_to($new_location);
}
?>

<!-- ADRES WIJZIGEN -->
<?php
/* Geschreven door:			Thijs Kuilman
 * Studentnummer:					327154
 *
 * Doel van dit bestand:
 * Deze pagina bevat een formulier waarmee een gebruiker zijn persoonlijke gegevens kan veranderen. Naast account instellingen kun je ook je wachtwoord aanpassen.
 */
if(!isset($_SESSION['gegevens'])){
    header ('location: index.php');
}

// Een functie die ervoor zorgt dat de Klantgegevens worden aangepast in de database
function update_klant($name, $email, $con, $newvalue){
	// De update query
	$query = "UPDATE Klant SET " . $name . "= '" . $newvalue . "' WHERE KL_Mail='" . $email . "'";
	$result = mysqli_query($con, $query);

	// Aangeven dat de aanpassingen succesvol zijn
	echo '<center><div class="success">' . ucfirst($name) . ' is succesvol aangepast!</div></center>';
}


// Als er een klant is ingelogd, dan krijgt hij/zij het volgende te zien:
if($_SESSION['soortgebruiker'] == "klant"){
	// print_r($gegevens);
	if(isset($_POST['submit_settings'])){

		if ($_POST['plaats'] != '') {
			$plaats = $_POST['plaats'];
			update_klant('KL_Plaats', $gegevens['KL_Mail'], $con, $plaats);
		}

		if ($_POST['adres'] != '') {
			$adres = $_POST['adres'];
			update_klant('KL_Adres', $gegevens['KL_Mail'], $con, $adres);
		}

		if ($_POST['postcode'] != '') {
			$postcode = $_POST['postcode'];
			update_klant('KL_Postcode', $gegevens['KL_Mail'], $con, $postcode);
		}
	}		
?>

	<!-- De content. Hier komt alle inhoud van de site. -->
	<div class="content">
		<!-- Het formulier -->
		<h2>Adresgegevens wijzigen (optioneel)</h2>
		<!-- Alle invoervelden voor het wijzigen van de persoonlijke gegevens. Niets is required, dus velden kunnen ook worden overgeslagen als ze hetzelfde moeten blijven. -->
		<form class="form-signin" name="changedata" method="post" action="?p=winkelwagen">
		Plaats:<br><input type="text" class="invoerveld" name="plaats" placeholder=<?php echo '"' . $gegevens['KL_Plaats'] . '"'; ?>><br><br>
		Adres + Huisnummer:<br><input type="text" class="invoerveld" name="adres" placeholder=<?php echo '"' . $gegevens['KL_Adres'] . '"'; ?>><br><br>
		Postcode:<br><input type="text" class="invoerveld" name="postcode" placeholder=<?php echo '"' . $gegevens['KL_Postcode'] . '"'; ?>><br><br>

		<!-- Het formulier verzenden. -->
		<button type="submit" name="submit_settings" class="submit">Wijzigingen opslaan</button>
		</form>
	</div>
<?php } ?>

</div>