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

<?php
// De variabelen die in de invoervelden worden aangepast
$email = "";
$voornaam = "";
$achternaam = "";
$telefoonnummer = "";
$plaats = "";
$adres = "";
$postcode = "";

// print_r($gegevens);
if(isset($_POST['submit_settings'])){
	// Kijken of de variables zijn invuld. Als er een onderdeel is ingevoerd, dan wordt de functie update_data uitgevoerd en worden er hierbij parameters meegegeven. Deze functie
	// zorgt ervoor dat de data wordt aangepast in de database.

	if ($_POST['email'] != '') {
		$email = $_POST['email'];
		update_data('email', $gegevens['email'], $con);
	}

	if ($_POST['voornaam'] != '') {
		$voornaam = $_POST['voornaam'];
		update_data('voornaam', $gegevens['email'], $con);
	}

	if ($_POST['achternaam'] != '') {
		$achternaam = $_POST['achternaam'];
		update_data('achternaam', $gegevens['email'], $con);
	}

	if ($_POST['telefoonnummer'] != '') {
		$telefoonnummer = $_POST['telefoonnummer'];
		update_data('telefoonnummer', $gegevens['email'], $con);
	}

	if ($_POST['plaats'] != '') {
		$plaats = $_POST['plaats'];
		update_data('plaats', $gegevens['email'], $con);
	}

	if ($_POST['adres'] != '') {
		$adres = $_POST['adres'];
		update_data('adres', $gegevens['email'], $con);
	}

	if ($_POST['postcode'] != '') {
		$postcode = $_POST['postcode'];
		update_data('postcode', $gegevens['email'], $con);
	}

	// Wachtwoord wijzigen. Dit heeft extra voorwaardes nodig. Zo moet het oude wachtwoord kloppen en moet het nieuwe wachtwoord twee keer identiek worden ingevuld.
	if(isset($_POST['wachtwoord'])){
		if( $_POST['wachtwoord'] != ''){
			if(strlen($_POST['password_new']) > 5){
				if ($_POST['wachtwoord'] == $gegevens['wachtwoord']) {
					if($_POST['password_new2'] == $_POST['password_new']){
						// Verander het wachtwoord in de database
						$query = "UPDATE klant SET wachtwoord= '" . $_POST['password_new'] . "' WHERE email='" . $gegevens['email'] . "'";
						echo '<br><br>';
						$result = mysqli_query($con, $query);

						// Een melding van alle aanpassingen
						echo '<center><div class="success">Wachtwoord is succesvol aangepast!</div></center>';
					}
				}
			}
		}
	}
}	
	
	// Een functie die ervoor zorgt dat de klantgegevens worden aangepast in de database
	function update_data($name, $email, $con){
		// De update query
		$query = "UPDATE klant SET " . $name. "= '" . $_POST[$name] . "' WHERE email='" . $email . "'";
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
	<?php
	// Hier wordt gekeken of er bij het aanvragen van een nieuw wachtwoord errors optraden. Als dit het geval is, dan wordt de error op het scherm weergegeven.
    if(isset($_POST['wachtwoord'])){
		if( $_POST['wachtwoord'] != ''){
	    	if(strlen($_POST['password_new']) < 5){
	    		echo '<center><div class="error"> Het nieuwe wachtwoord moet meer dan 5 tekens bevatten.</div></center>';
	    	}

	    	if($_POST['password_new2'] != $_POST['password_new']){
				echo '<center><div class="error"> Vul uw nieuwe wachtwoord twee keer identiek in.</div></center>';
			}

			if ($_POST['wachtwoord'] != $gegevens['wachtwoord']) {
				echo '<center><div class="error"> Het oude wactwoord klopt niet.</div></center>';
			}
		}
    }
	?>
	<!-- Het formulier -->
	<h2>Persoonlijke gegevens</h2>
		<!-- Alle invoervelden voor het wijzigen van de persoonlijke gegevens. Niets is required, dus velden kunnen ook worden overgeslagen als ze hetzelfde moeten blijven. -->
		<form class="form-signin" name="changedata" method="post" action="instellingen.php">
		Email:<br><input type="email" name="email" class="invoerveld" placeholder= <?php echo '"' . $gegevens['email'] . '"'; ?> value=<?php echo '"' . $email . '"'; ?>><br><br>
		Voornaam:<br><input type="text" class="invoerveld" name="voornaam" placeholder=<?php echo '"' . $gegevens['voornaam'] . '"'; ?>><br><br>
		Achternaam:<br><input type="text" class="invoerveld" name="achternaam" placeholder=<?php echo '"' . $gegevens['achternaam'] . '"'; ?> value=<?php echo '"' . $achternaam . '"'; ?>><br><br>
		Telefoonnummer:<br><input type="number" class="invoerveld" name="telefoonnummer" placeholder=<?php echo '"' . $gegevens['telefoonnummer'] . '"'; ?> value=<?php echo '"' . $telefoonnummer . '"'; ?>><br><br>
		Plaats:<br><input type="text" class="invoerveld" name="plaats" placeholder=<?php echo '"' . $gegevens['plaats'] . '"'; ?> value=<?php echo '"' . $plaats . '"'; ?>><br><br>
		Adres:<br><input type="text" class="invoerveld" name="adres" placeholder=<?php echo '"' . $gegevens['adres'] . '"'; ?> value=<?php echo '"' . $adres . '"'; ?>><br><br>
		Postcode:<br><input type="text" class="invoerveld" name="postcode" placeholder=<?php echo '"' . $gegevens['postcode'] . '"'; ?> value=<?php echo '"' . $postcode . '"'; ?>><br><br>
		
		<!-- Hier kunnen de gebruikers hun wachtwoord veranderen. Het wijzigingsproces wordt ALLEEN geactiveerd als het eerste veld hiervan wordt ingevuld. -->
		<h2>Wachtwoord wijzigen</h2>
		Voer je huidige wachtwoord in:<br><input type="password" class="invoerveld" name="wachtwoord" value=<?php echo '"' . $postcode . '"'; ?>><br><br>
		Voer je gewenst wachtwoord twee keer in:<br><input type="password" class="invoerveld" name="password_new" value=<?php echo '"' . $postcode . '"'; ?>><br>
		<br><input type="password" class="invoerveld" name="password_new2" value=<?php echo '"' . $postcode . '"'; ?>><br><br>

		<!-- Het formulier verzenden. -->
		<button type="submit" name="submit_settings" id="submit">Wijzigingen opslaan</button>
	</form>

	</div>

	<!-- De footer -->
	<div class="footer">
		Copyright &#169; 2014 EatIt
	</div>
</div>
</body>