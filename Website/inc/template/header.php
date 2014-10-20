<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Dit is de header van elke pagina. Dit wordt geinclude zodat het later makkelijker wordt om voor elke pagina de header te veranderen. De header bestaat uit:
// - Het menu
// - Het logo
// ?>

<div class="container">
<div class="header">
	<!-- Het logo van EatIt wordt geprint -->
	<a href="index.php"><img src="img/logo.png" id="logo"></a>

	<!-- Het menu. Wordt aangepast op basis of je bent ingelogd. -->
	<div class="menu">
	<?php
		// Niet ingelogd: krijg een inlog en registreer optie te zien
		if($gegevens == 'gast'){
			echo '<a href="login.php">Inloggen</a> |
			<a href="register.php">Registreren</a>';
		} else {
			// Ingelogd: je krijgt het volledige menu te zien (instellingen, winkelwagen, uitloggen)
			echo 'Welkom, ' . $gegevens['voornaam'] . ' | ' . '<a href="instellingen.php">Instellingen</a> ' . ' | ' . '<a href="winkelwagen.php">Winkelwagen</a>' . ' | ' . (($gegevens['permissies'] == 'beheerder')?'<a href="beheerder.php">Beheerderspaneel</a> | ':"") . '<a href="uitloggen.php">Uitloggen</a>';
		}
	?>
	</div>
</div>