<?php
/* Geschreven door:			Thijs Kuilman
 * Studentnummer:					327154
 *
 * Doel van dit bestand:
 * Dit script kan worden ingelade op PHP pagina's. Het zorgt ervoor dat de sessie wordt gestart en dat de database connectie wordt opgezet.
 */
/*
function initSession(){
    global $conenction;
    if(isset($_SESSION['gegevens'])){
        $gegevens = ($_SESSION['gegevens']);
        // Alle gegevens van de ingelogde gebruiker opslaan in een sessie
        $query = "SELECT * FROM klant WHERE email = '" . $gegevens['email'] . "' ";
        $result = mysqli_query($con, $query);
        $_SESSION['gegevens'] = mysqli_fetch_array($result);
        $gegevens = ($_SESSION['gegevens']);
    }
}*/
?>