<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Deze pagina bevat een formulier waarmee een gebruiker kan inloggen op de website.
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
		<title>Inloggen</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<?php
// De variabelen die in de invoervelden worden aangepast
$l_email = "";
$l_password = "";
$password = "1";

// Als er op het knopje 'Inloggen' is geklikt, dan wordt het volgende uitgevoerd:
if (isset($_POST['l_submit'])) {

	// POST data omzetten in variables
	if(isset($l_email)){
	$l_email = $_POST['l_email'];
	}

	if(isset($l_email)){
		$l_password = $_POST['l_password'];
	}
	
	// Kijken of het email adres al in de database staat. Dit wordt gedaan door het ingevulde email adres m.b.v een WHERE en een COUNT statement te tellen. Als er 0 zijn, dan kan de persoon zich registeren. Als het op 1 staat, dan volgt er een error.
	$query = "SELECT wachtwoord FROM klant WHERE email = '" . $l_email . "' ";
	$result = mysqli_query($con, $query);
	$password = '';

	while($row = mysqli_fetch_array($result)) {
		$password = $row['wachtwoord'];
	}
}
?>
<div class="login">
	<center>
	<img src="img/logo_notext.png" action="registreren.php" class="logo">
	<form class="form-signin" method="post">
	<h2>Inloggen</h2>  
	<?php
	// Gegevens zijn juist ingevoerd
	 if($password == $l_password && isset($_POST['l_submit'])){
	 	// Melding dat de gebruiker succesvol is ingelogd
		echo '<div class="success">Succesvol ingelogd!</div><br>';
		header ('location: index.php');

		// Alle gegevens van de ingelogde gebruiker opslaan in een sessie
		$query = "SELECT * FROM klant WHERE email = '" . $l_email . "' ";
		$result = mysqli_query($con, $query);
		$_SESSION['gegevens'] = mysqli_fetch_array($result);

	// Onjuiste gegevenns
	}elseif($password != $l_password && isset($_POST['l_submit'])){
		echo '<div class="error">Onjuiste gegevens ingevoerd</div><br>';
	}
	?>
	<!-- Als de gebruiker geen account heeft, dan wordt het hier doorverwezen naar de registreer pagina -->
	 <a href="register.php">Nog geen lid? Registreer je hier!</a><br><br>
	  	<!-- Het formulier om i te loggen (email en wachtwoord) -->
	    <input type="email" class="invoerveld" name="l_email" placeholder="Email" required autofocus value=<?php echo '"' . $l_email . '"'; ?>><br><br>
	    <input type="password" class="invoerveld" name="l_password" placeholder="Wachtwoord" required value=<?php echo '"' . $l_password . '"'; ?>><br><br>

	    <br>

	    <!-- Knopje om in te loggen -->
	    <button type="submit" name="l_submit" id="submit">Inloggen</button>
	</form>
	</center>
</div>

</body>