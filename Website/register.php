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

// Kijken of de variables zijn invuld. Zoja: zet de postdata om naar de variabelen
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	echo $email;
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

// Debug
echo 
$email . " | " .
$voornaam . " | " .
$achternaam . " | " .
$telefoonnummer . " | " .
$plaats . " | " .
$adres . " | " .
$postcode;

// Voorwaarden bekijken van variables
// if(isset($_POST['submit'])){
// 	$query = "INSERT INTO klant VALUES (henk, hoi)";
// 	$result = mysqli_query($con, $query);
// }

?>

<div class="login">
	<center>
	<img src="img/logo_notext.png" action="registreren.php" class="logo">
	<form class="form-signin" method="post">
	  <h2>Registreren</h2><br>
	    <input type="email" class="invoerveld" name="email" placeholder="Email" required autofocus value=<?php echo '"' . $email . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="voornaam" placeholder="Voornaam" required value=<?php echo '"' . $voornaam . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="achternaam" placeholder="Achternaam" required value=<?php echo '"' . $achternaam . '"'; ?>><br><br>
	    <input type="number" class="invoerveld" name="telefoonnummer" placeholder="Telefoonnummer" required value=<?php echo '"' . $telefoonnummer . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="plaats" placeholder="Plaats" required value=<?php echo '"' . $plaats . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="adres" placeholder="Adres" required value=<?php echo '"' . $adres . '"'; ?>><br><br>
	    <input type="text" class="invoerveld" name="postcode" placeholder="Postcode" required value=<?php echo '"' . $postcode . '"'; ?>><br><br>

	    <br><br><br>
	    <button type="submit" name="submit" id="submit">Aanmelding voltooien</button>
	</form>
	</center>
</div>

</body>