<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Deze pagina bevat een formulier waarmee een persoon zich kan registreren op de site.
// ?>

<!-- Met de database connecten en de sessie laden -->
<?php include 'database_sessie.php'; ?>

<!-- Als een gebruiker al ingelogd is, wordt het doorverwezen naar index.php -->
<?php if(isset($_SESSION['gegevens'])){
	header ('location: index.php');
} ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registreren</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<?php
// De variabelen die in de invoervelden worden aangepast.
$email = "";
$voornaam = "";
$achternaam = "";
$telefoonnummer = "";
$plaats = "";
$adres = "";
$postcode = "";

// De variabelen die gebruikt worden voor het systeem
$emailcheck = 0;
$voltooid = 0;
$secretcode = "";

// Kijken of de variables zijn invuld. Zoja: zet de postdata om naar de variabelen. Dit is puur om de query straks iets netter te maken.
if (isset($_POST['email'])) {
	$email = $_POST['email'];
}

if (isset($_POST['voornaam'])) {
	$voornaam = $_POST['voornaam'];
}

if (isset($_POST['achternaam'])) {
	$achternaam = $_POST['achternaam'];
}

if (isset($_POST['telefoonnummer'])) {
	$telefoonnummer = $_POST['telefoonnummer'];
}

if (isset($_POST['plaats'])) {
	$plaats = $_POST['plaats'];
}

if (isset($_POST['adres'])) {
	$adres = $_POST['adres'];
}

if (isset($_POST['postcode'])) {
	$postcode = $_POST['postcode'];
}


// Het account aanmaken zodra er op het knopje is geklikt.
if(isset($_POST['submit'])){
	// Kijken of het email adres al in de database staat. Dit wordt gedaan door het ingevulde email adres m.b.v een WHERE en een COUNT statement te tellen. Als er 0 zijn, dan kan de persoon zich registeren. Als het op 1 staat, dan volgt er een error.
	$query = "SELECT count(email) FROM klant WHERE email = '" . $email . "' ";
	$result = mysqli_query($con, $query);


	while($row = mysqli_fetch_array($result)) {
		$emailcheck = $row['count(email)'];
	}

	// Als het email adres niet gevonden is, dan worden de gegevens in de database gezet
	if($emailcheck == 0){
		// Een inlogcode (oftewel: wachtwoord) genereren
		// Uit deze letters kan het script kiezen
		$letters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// De variabel die de gegenereerde code opslaat 
		$secretcode = '';

		// Een loop die telkens een willekeurige positie van $letters pakt en dit aan de code toevoegt
		for ($i=0; $i < 10; $i++) { 
			$secretcode .= $letters[rand(0,strlen($letters) - 1)];
		}

		// De geheime code door een hash halen, waardoor het nog moeilijker te kraken is
		$secretcode = hash('crc32b', $secretcode);

		// De gegevens invullen
		$query = "INSERT INTO klant(email, voornaam, achternaam, telefoonnummer, plaats, adres, postcode, wachtwoord, permissies) VALUES ( '" . $email . "', '" . $voornaam . "', '" . $achternaam . "', '" . $telefoonnummer . "', '" . $plaats . "', '" . $adres . "', '" . $postcode . "', '" . $secretcode . "', '"  . 'lid' . "')";
		$result = mysqli_query($con, $query);

		$voltooid = 1;
	}
}

?>

<!-- Het formulier waarin de invoervelden staan om je te registreren -->
<div class="login">
	<center>
	<img src="img/logo_notext.png" action="registreren.php" class="logo">
	<form class="form-signin" method="post">
	  <h2>Registreren</h2>
	  <!-- Als de registratie voltooid is (wordt in regel 94 bepaald), dan laat het systeem een bevesteging op het scherm zien. Ook krijgt de gebruiker het wachtwoord en wordt
	  hij/zij aangeraden om in te loggen -->
	  <?php if ($voltooid == 1) {
	  	echo '<div class="success">Aanmelding succesvol. Uw wachtwoord:<br> ' . $secretcode . '<br><br> <a href="login.php">Log hier in!</a> </div><br>';
	  } ?>
	  <?php if ($voltooid == 0) {?>
	  <!-- Als de gebruiker al een account heeft, dan kunnen ze via deze link naar de inlogpagina -->
	  <a href="login.php">Al lid? Log hier in!</a><br><br>
	  	<?php
	  		// Errorcode weergeven wanneer een email in bezet is
			if($emailcheck == 1 && isset($_POST['submit'])){
				echo '<div class="error">Dit email adres is al in gebruik.</div>';
			}
		?>
			<!-- Alle invoervelden voor het registreren. (zijn allemaal required) -->
		    <input type="email" class="invoerveld" name="email" placeholder="Email" required autofocus value=<?php echo '"' . $email . '"'; ?>><br><br>
		    <input type="text" class="invoerveld" name="voornaam" placeholder="Voornaam" required value=<?php echo '"' . $voornaam . '"'; ?>><br><br>
		    <input type="text" class="invoerveld" name="achternaam" placeholder="Achternaam" required value=<?php echo '"' . $achternaam . '"'; ?>><br><br>
		    <input type="number" class="invoerveld" name="telefoonnummer" placeholder="Telefoonnummer" required value=<?php echo '"' . $telefoonnummer . '"'; ?>><br><br>
		    <input type="text" class="invoerveld" name="plaats" placeholder="Plaats" required value=<?php echo '"' . $plaats . '"'; ?>><br><br>
		    <input type="text" class="invoerveld" name="adres" placeholder="Adres" required value=<?php echo '"' . $adres . '"'; ?>><br><br>
		    <input type="text" class="invoerveld" name="postcode" placeholder="Postcode" required value=<?php echo '"' . $postcode . '"'; ?>><br><br>
	    <br>
	    <!-- De knop om de gegevens te versturen. Hierna worden de bovestaande systemen uitgevoerd om de gebruiker in de database te zetten. -->
	    <button type="submit" name="submit" id="submit">Aanmelding voltooien</button>
	    <?php } ?>
	</form>
	</center>
</div>

</body>