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

//Alleen beheerders hebben toegang tot deze pagina. Geen beheerder: terugsturen naar index.php
if($gegevens['Manager_ID'] == NULL){
    // header ('location: index.php');
    // VERANDER VERANDER VERANDER
}

print_r($gegevens['Manager_ID']);

// print_r($gegevens);
if(isset($_POST['submit_settings'])){
	// Kijken of de variables zijn invuld. Als er een onderdeel is ingevoerd, dan wordt de functie update_data uitgevoerd en worden er hierbij parameters meegegeven. Deze functie
	// zorgt ervoor dat de data wordt aangepast in de database.
		update_data('permissies', $_POST['email'], $con);
}	
		// Een functie die ervoor zorgt dat de klantgegevens worden aangepast in de database
		function update_data($name, $email, $con){
		// De update query
		$query = "UPDATE medewerkers SET permissies= '" . $_POST['permissie'] . "' WHERE email='" . $email . "'";
		$result = mysqli_query($con, $query);

		// Een melding van alle aanpassingen
		echo '<center><div class="success">' . ucfirst($name) . ' is succesvol aangepast!</div></center>';
	}

	// Alle nieuwe gegevens van de ingelogde gebruiker opslaan in de sessie variabel
		// $query = "SELECT * FROM medewerkers WHERE email = '" . $gegevens['MED_Mail'] . "' ";
		// $result = mysqli_query($con, $query);
		// $_SESSION['gegevens'] = mysqli_fetch_array($result);
?>

<div class="content">
	<h2>Nieuwe medewerker toevoegen</h2>
	<a href="?p=register_medewerker">Klik hier om een nieuwe medewerker toe te voegen.</a><br><br>


	<!-- Het formulier -->
	<h2>Afdeling wijzigen</h2>
		<!-- Alle invoervelden voor het wijzigen van de persoonlijke gegevens. Niets is required, dus velden kunnen ook worden overgeslagen als ze hetzelfde moeten blijven. -->
		<form class="form-signin" name="changedata" method="post" action="?p=beheerder">
		Email:<br><input type="email" class="invoerveld" placeholder="Email van gebruiker" name="email" required><br><br>
		Verplaatsen naar afdeling:<br><select class="invoerveld" name="permissie" required>
		<option value="lid">Lid</option>
		<option value="bezorger">Bezorger</option>
		<option value="keuken">Keuken</option>
		<option value="inkoop">Inkoop</option>
		<option value="beheerder">Beheerder</option>
		</select><br><br>

		<!-- Het formulier verzenden. -->
		<button type="submit" name="submit_settings" class="submit">Wijzingen opslaan</button>
	</form>

	<h2>Gebruikerslijst</h2>
	<?php

	// Een lijst opstellen met alle gebruikers met bijehorende gegevens
	$query = "SELECT * from medewerkers";
	$result = mysqli_query($con, $query);

	// De tabel met gebruikers
	echo '<table style="width:100%">';
	echo '<tr><td><b>Email</b></td><td><b>Voornaam</b></td><td><b>Achternaam</b></td><td><b>Adres</b></td><td><b>Telefoonnr</b></td><td><b>Postcode</b></td><td><b>Afdeling</b></td><td><b>Manager_ID</b></td>';
	while($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['MED_Mail'] . "</td><td>" . $row['MED_Voornaam']. "</td><td>" . $row['MED_Achternaam']. "</td><td>" . $row['MED_Adres']. "</td><td>" . $row['MED_Telefoonnummer']. "</td><td>" . $row['MED_Postcode']  . '</td><td>'. $row['Afdeling'] . '</td><td>'. $row['Manager_ID']. "</td><tr>";
	}
	
	echo '</table>';
	?>
</div>