<?php
// De variabelen die in de invoervelden worden aangepast
$l_email = isset($_POST['l_email']) ? $_POST['l_email'] : "";
$l_password = isset($_POST['l_password']) ? $_POST['l_password'] : "";

if (isset($_POST['l_submit'])) {

	// Kijken of het email adres al in de database staat. Dit wordt gedaan door het ingevulde email adres m.b.v een WHERE en een COUNT statement te tellen. Als er 0 zijn, dan kan de persoon zich registeren. Als het op 1 staat, dan volgt er een error.
	$query = "SELECT MED_Wachtwoord FROM Medewerkers WHERE MED_Mail = '" . $l_email . "' ";
	$result = mysqli_query($con, $query);
	$password = '';

	while($row = mysqli_fetch_array($result)) {
		$password = $row['MED_Wachtwoord'];
	}
}
?>
<center>
<div class="content">
        <form class="form-signin" method="post">
            <h2>Inloggen Medewerker</h2>
            <?php
             if(isset($_POST['l_submit']) && $password == $l_password){
                echo '<div class="success">Succesvol ingelogd!</div><br>';

                // Alle gegevens van de ingelogde gebruiker opslaan in een sessie
                $query = "SELECT * FROM Medewerkers WHERE MED_Mail = '" . $l_email . "' ";
                $result = mysqli_query($con, $query);
                $_SESSION['soortgebruiker'] = "medewerker";
                $_SESSION['gegevens'] = mysqli_fetch_array($result);

                header ('location: index.php');

            }elseif(isset($_POST['l_submit']) && $password != $l_password){
                echo '<div class="error">Onjuiste gegevens ingevoerd</div><br>';
            }
            ?>
            <input type="email" class="invoerveld" name="l_email" placeholder="Email" required autofocus value=<?php echo '"' . $l_email . '"'; ?>><br><br>
            <input type="password" class="invoerveld" name="l_password" placeholder="Wachtwoord" required value=<?php echo '"' . $l_password . '"'; ?>><br><br>
            <br>
            <button type="submit" name="l_submit" class="submit">Inloggen</button>
        </form>
</div>
</center>