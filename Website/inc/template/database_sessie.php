<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Dit script kan worden ingelade op PHP pagina's. Het zorgt ervoor dat de sessie wordt gestart en dat de database connectie wordt opgezet.
// ?>

<?php 
	//Sessie starten 
	session_start();

	// Connecten met de database
	$con=mysqli_connect("localhost","root","","eatit");

	// Kijken of de connectie succesvol was
	if (mysqli_connect_errno()) {
	  echo "Kan niet verbinden met de database: " . mysqli_connect_error();
	}
	
	// Hier wordt gekeken of de gebruiker is ingelogd. Zoja: zet de variabel $gegevens om naar de sessie variabel.
	if(isset($_SESSION['gegevens'])){
		$gegevens = ($_SESSION['gegevens']);
		// Alle gegevens van de ingelogde gebruiker opslaan in een sessie
		$query = "SELECT * FROM klant WHERE email = '" . $gegevens['email'] . "' ";
		$result = mysqli_query($con, $query);
		$_SESSION['gegevens'] = mysqli_fetch_array($result);
		$gegevens = ($_SESSION['gegevens']);
		}else{
		$gegevens = 'gast';
	}
?>