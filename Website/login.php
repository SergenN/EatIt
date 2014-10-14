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
		<title>Inloggen</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<?php
// De variabelen die in de invoervelden worden aangepast
$l_email = "";
$l_password = "";
$password = "1";

if (isset($_POST['l_submit'])) {

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

	echo $query;

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
	 if($password == $l_password && isset($_POST['l_submit'])){
		echo '<div class="success">Succesvol ingelogd!</div><br>';
	}elseif($password != $l_password && isset($_POST['l_submit'])){
		echo '<div class="error">Onjuiste gegevens ingevoerd</div><br>';
	}
	?>
	  <a href="register.php">Nog geen lid? Registreer je hier!</a><br><br>
	    <input type="email" class="invoerveld" name="l_email" placeholder="Email" required autofocus value=<?php echo '"' . $l_email . '"'; ?>><br><br>
	    <input type="password" class="invoerveld" name="l_password" placeholder="Wachtwoord" required value=<?php echo '"' . $l_password . '"'; ?>><br><br>

	    <br>
	    <button type="submit" name="l_submit" id="submit">Inloggen</button>
	</form>
	</center>
</div>

</body>