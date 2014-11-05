<?php 
// de connectie wordt geopend
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "Eatit";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()){
	die("error connecting to database" . mysqli_connect_error());
	}

session_start();

//redirect functie wordt gedefineerd
function redirect_to($new_location)
{header("location: " . $new_location); 
exit;}


//Alleen beheerders en de expeditie hebben toegang tot deze pagina. Geen van deze? Terugsturen naar index.php
if($gegevens['Afdeling'] != '2'){
    if($gegevens['Afdeling'] != '1'){
	    header ('location: index.php');
	}
}

?>
<!DOCTYPE html>
<head>
	<title>Routeplanning</title>
</head>
<body>
	<?php
	//de bestellingen die klaarstaan worden opgehaald
	$query  = "select bestNR, KL_Voornaam, KL_Achternaam, KL_Plaats, KL_Adres ";
	$query .= "from Besteling b, Klant k ";
	$query .= "where k.Klantnr = b.Klantnr ";
	$query .= "and BEST_Status = 'bezorgen' ";
	$query .= "order by KL_Plaats; ";
	$result = mysqli_query($connection, $query);
	
	if(mysqli_num_rows($result) == 0){
		echo "	<form action\"\" method=\"post\">
					<input type=\"submit\" class=\"button\" name=\"herladen\" value=\"Opnieuw Checken\" /> 
				</form> ";
		if(isset($_POST["herladen"])){
			redirect_to("Routeplanning.php");
		}
		die("Geen bestellingen klaar" . mysqli_connect_error());
	}
	//de bestellingen worden weergegeven in een tabel en de bestellingsnummers komen in de array $bestnr te staan
	echo "<table><tr><td><b>Bestellingsnummer</b></td><td><b>Voornaam</b></td><td><b>Achternaam</b></td><td><b>Plaats</b></td><td><b>Adres</b></td></tr>";
	while($row = mysqli_fetch_assoc($result)){
		$bestnr[] = $row["bestNR"];
		echo "<tr><td>". $row["bestNR"]. "</td><td>". $row["KL_Voornaam"]. "</td><td>". $row["KL_Achternaam"]. "</td><td>". $row["KL_Plaats"]. "</td><td>" . $row["KL_Adres"] . "</td></tr>";
		;
	}
	//de array $bestnr wordt in een session gezet om hem mee te geven aan de volgende pagina
	if(isset($bestnr)){
	$_SESSION['bestnr'] = $bestnr;
	}
	
?>
<!-- deze button stuurt je door naar de volgende pagina en geeft post de waarde "klaar" mee -->
<form action="routeplanning2.php" method="post">
<input type="submit" class="button" name="done" value="klaar" />
</form>

<!-- als je op deze button drukt wordt de pagina geprint -->
<form action="" method="post">
<input type="button" class="button" onClick="window.print()" value="Print"/>
</form>

</body>
<?php
mysqli_free_result($result);
mysqli_close($connection); 
?>
