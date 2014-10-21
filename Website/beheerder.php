<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Deze pagina bevat een formulier waarmee een gebruiker zijn persoonlijke gegevens kan veranderen. Naast account instellingen kun je ook je wachtwoord aanpassen.
// ?>

<!-- Met de database connecten en de sessie laden -->
<?php include 'database_sessie.php'; ?>

<!-- Als een gebruiker niet ingelogd is, wordt het doorverwezen naar index.php -->
<?php if(!isset($_SESSION['gegevens'])){
	header ('location: index.php');
} ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Instellingen</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<!-- De header inladen -->
<?php include 'header.php'; ?>

<!-- Alleen beheerders hebben toegang tot deze pagina. Geen beheerder: terugsturen naar index.php -->
<?php if($gegevens['permissies'] != 'beheerder'){
	header ('location: index.php');
}
?>

<?php
// print_r($gegevens);
if(isset($_POST['submit_settings'])){
	// Kijken of de variables zijn invuld. Als er een onderdeel is ingevoerd, dan wordt de functie update_data uitgevoerd en worden er hierbij parameters meegegeven. Deze functie
	// zorgt ervoor dat de data wordt aangepast in de database.
		update_data('permissies', $_POST['email'], $con);
}	
		// Een functie die ervoor zorgt dat de klantgegevens worden aangepast in de database
		function update_data($name, $email, $con){
		// De update query
		$query = "UPDATE klant SET permissies= '" . $_POST['permissie'] . "' WHERE email='" . $email . "'";
		$result = mysqli_query($con, $query);

		// Een melding van alle aanpassingen
		echo '<center><div class="success">' . ucfirst($name) . ' is succesvol aangepast!</div></center>';
	}

	// Alle nieuwe gegevens van de ingelogde gebruiker opslaan in de sessie variabel
		$query = "SELECT * FROM klant WHERE email = '" . $gegevens['email'] . "' ";
		$result = mysqli_query($con, $query);
		$_SESSION['gegevens'] = mysqli_fetch_array($result);
?>

	<!-- De content. Hier komt alle inhoud van de site. -->
	<div class="content">
	<!-- Het formulier -->
	<h2>Permissies aanpassen</h2>
		<!-- Alle invoervelden voor het wijzigen van de persoonlijke gegevens. Niets is required, dus velden kunnen ook worden overgeslagen als ze hetzelfde moeten blijven. -->
		<form class="form-signin" name="changedata" method="post" action="beheerder.php">
		Email:<br><input type="email" class="invoerveld" placeholder="Email van gebruiker" name="email" required><br><br>
		Permissie omzetten naar:<br><select class="invoerveld" name="permissie" required>
		<option value="lid">Lid</option>
		<option value="bezorger">Bezorger</option>
		<option value="keuken">Keuken</option>
		<option value="inkoop">Inkoop</option>
		<option value="beheerder">Beheerder</option>
		</select><br><br>

		<!-- Het formulier verzenden. -->
		<button type="submit" name="submit_settings" id="submit">Wijzingen opslaan</button>
	</form>

	<h2>Gebruikerslijst</h2>
	<?php

	// Een lijst opstellen met alle gebruikers met bijehorende gegevens
	$query = "SELECT * from klant";
	$result = mysqli_query($con, $query);

	// De tabel met gebruikers
	echo '<table style="width:100%">';
	echo '<tr><td><b>Email</b></td><td><b>Voornaam</b></td><td><b>Achternaam</b></td><td><b>Adres</b></td><td><b>Telefoonnr</b></td><td><b>Postcode</b></td><td><b>Afdeling</b></td>';
	while($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['email'] . "</td><td>" . $row['voornaam']. "</td><td>" . $row['achternaam']. "</td><td>" . $row['adres']. "</td><td>" . $row['telefoonnummer']. "</td><td>" . $row['postcode']  . '</td><td>'. $row['permissies']. "</td><tr>";
	}
	
	echo '</table>';
	?>

	</div>

	<!-- De footer -->
	<div class="footer">
		Copyright &#169; 2014 EatIt
	</div>
</div>
</body>