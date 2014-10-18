<?php // Geschreven door:			Thijs Kuilman
// Studentnummer:					327154
// 
// Doel van dit bestand:
// Dit is de indexpage van de website: oftewel het centrum. Dit is in principe de eerste pagina die een bezoeker bezoekt.
// ?>

<!-- Met de database connecten en de sessie laden -->
<?php include 'database_sessie.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Voorpagina</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

	<!-- De header inladen -->
	<?php include 'header.php'; ?>

		<!-- De content. Hier komt alle inhoud van de site. -->
		<div class="content">
			Hallo
		</div>

	<!-- De footer inladen-->
	<?php include 'footer.php'; ?>
	</div>
</body>