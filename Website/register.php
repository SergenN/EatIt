<?php 
	// Create connection
	$con=mysqli_connect("localhost","root","","eatit");

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Kan niet verbinden met de database: " . mysqli_connect_error();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registreren</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<?php
// De variabelen die in de invoervelden worden aangepast
$email = "";
$voornaam = "";
$achternaam = "";
$telefoonnummer = "";
$plaats = "";
$adres = "";
$postcode = "";
$emailcheck = 0;

// Kijken of de variables zijn invuld. Zoja: zet de postdata om naar de variabelen
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
		$query = "INSERT INTO klant VALUES ('" . $email . "', '" . $voornaam . "', '" . $achternaam . "', '" . $telefoonnummer . "', '" . $plaats . "', '" . $adres . "', '" . $postcode . "', '" . $secretcode . "')";
		$result = mysqli_query($con, $query);
	}
}

?>

<!-- Het formulier waarin de invoervelden staan om je te registreren -->
<div class="login">
	<center>
	<img src="img/logo_notext.png" action="registreren.php" class="logo">
	<form class="form-signin" method="post">
	  <h2>Registreren</h2>
	  <a href="login.php">Al lid? Log hier in!</a><br><br>
	  	<?php
	  		// Errorcode weergeven wanneer een email in bezet is
			if($emailcheck == 1 && isset($_POST['submit'])){
				echo '<div class="error">Dit email adres is al in gebruik.</div>';
			}
		?>
	    <input type="email" class="invoerveld" name="email" placeholder="Email" required autofocus value=<?php echo '"' . $email . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="voornaam" placeholder="Voornaam" required value=<?php echo '"' . $voornaam . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="achternaam" placeholder="Achternaam" required value=<?php echo '"' . $achternaam . '"'; ?>><br><br>
	    <input type="number" class="invoerveld" name="telefoonnummer" placeholder="Telefoonnummer" required value=<?php echo '"' . $telefoonnummer . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="plaats" placeholder="Plaats" required value=<?php echo '"' . $plaats . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="adres" placeholder="Adres" required value=<?php echo '"' . $adres . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="postcode" placeholder="Postcode" required value=<?php echo '"' . $postcode . '"'; ?>><br><br>

	    <br>
	    <button type="submit" name="submit" id="submit">Aanmelding voltooien</button>
	</form>
	</center>
</div>

</body>