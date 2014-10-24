<?php
// De variabelen die in de invoervelden worden aangepast
$l_email = isset($_POST['l_email']) ? $_POST['l_email'] : "";
$l_password = isset($_POST['l_password']) ? $_POST['l_password'] : "";

if (isset($_POST['l_submit'])) {

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
        <img src="inc/template/img/logo_notext.png" action="index.php?p=register" class="logo">
        <form class="form-signin" method="post">
            <h2>Inloggen</h2>
            <?php
             if(isset($_POST['l_submit']) && $password == $l_password){
                echo '<div class="success">Succesvol ingelogd!</div><br>';
            }elseif(isset($_POST['l_submit']) && $password != $l_password){
                echo '<div class="error">Onjuiste gegevens ingevoerd</div><br>';
            }
            ?>
            <a href="index.php?p=register">Nog geen lid? Registreer je hier!</a><br><br>
            <input type="email" class="invoerveld" name="l_email" placeholder="Email" required autofocus value=<?php echo '"' . $l_email . '"'; ?>><br><br>
            <input type="password" class="invoerveld" name="l_password" placeholder="Wachtwoord" required value=<?php echo '"' . $l_password . '"'; ?>><br><br>
            <br>
            <button type="submit" name="l_submit" id="submit">Inloggen</button>
        </form>
	</center>
</div>