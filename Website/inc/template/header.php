<?php
/* Geschreven door:			Thijs Kuilman
 * Studentnummer:					327154
 *
 * Doel van dit bestand:
 * Dit is de header van elke pagina. Dit wordt geinclude zodat het later makkelijker wordt om voor elke pagina de header te veranderen. De header bestaat uit:
 * - Het menu
 * - Het logo
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EatIt</title>
        <link rel="stylesheet" type="text/css" href="inc/template/style.css">
    </head>

    <body>
    <div class="container">
        <div class="header">
            <a href="index.php"><img src="inc/template/img/logo.png" id="logo"></a>

            <!-- Het menu. Wordt aangepast op basis of je bent ingelogd. -->
            <div class="menu">
                <?php
                    // Niet ingelogd: krijg een inlog en registreer optie te zien
                    if(!isset($_SESSION['gegevens'])){
                        echo '<a href="index.php?p=login">Inloggen</a> |
                        <a href="index.php?p=register">Registreren</a>';
                    } else {
                        // Ingelogd: je krijgt het volledige menu te zien (instellingen, winkelwagen, uitloggen)
                        echo 'Welkom, ' . $gegevens['voornaam'] . ' | ' . '<a href="instellingen.php">Instellingen</a> ' . ' | ' . '<a href="winkelwagen.php">Winkelwagen</a>' . ' | ' . (($gegevens['permissies'] == 'beheerder')?'<a href="beheerder.php">Beheerderspaneel</a> | ':"") . '<a href="uitloggen.php">Uitloggen</a>';
                    }
                ?>
            </div>
        </div>