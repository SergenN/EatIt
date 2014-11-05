<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 5-11-2014
 * Time: 11:28
 */

	//Alleen beheerders en de inkoop afdeling hebben toegang tot deze pagina. Geen van deze? Terugsturen naar index.php
	if($gegevens['Afdeling'] != '6'){
	    if($gegevens['Afdeling'] != '1'){
	        header ('location: index.php');
	    }
	}
/**
 * Functie getOrders
 * verkrijg alle orders, gerechten en ingredienten die bij deze gerechten horen
 *
 * @return string - een lijst met alle orders, hun gerechten en de ingredienten van deze gerechten
 */
function getOrders() {
    global $con;
    $toret = "";
    $query = "SELECT * FROM Bestelling WHERE BEST_Status='besteld';";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        //Alle variabelen $row = {BestNR, KlantNR, MedNR, BEST_Datum, BEST_Status}
        $toret .= '<tr><td><h2>Bestelling: '.$row['BestNR'].'</h2></td><td><h2>Klant: '.$row['KlantNR'].'</h2></td></tr>';
        $query = "SELECT * FROM AantalVerkocht a JOIN Gerecht g ON a.GerNR = g.GerNR WHERE BestNR = {$row['BestNR']};";
        $result2 = mysqli_query($con, $query);
        while($row2 = mysqli_fetch_assoc($result2)){
            //Alle variabelen $row2 = {BestNR, GerNr, Aantal = Ger_NR, Ger_Naam, Ger_Prijs, Ger_Beschrijving}

            $toret .= '<tr><td>Gerecht: '.$row2['GER_Naam'].'</td><td>Aantal: '. $row2['Aantal'].'</td></tr>';
            $toret .= '<tr><td>&nbsp;</td></tr>';

            $query = "SELECT * FROM Aantalingredienten ai JOIN Artikelen ar ON ai.ArtNR = ar.ArtNR WHERE GerNR = {$row2['GerNR']};";
            $result3 = mysqli_query($con, $query);

            while($row3 = mysqli_fetch_assoc($result3)){
                //Alle variabelen $row3 = {AiNR, GerNR, ArtNR, IngAantal = ArtNR, ArtNaam}
                $toret .=  '<tr><td>Artikel:'.$row3['ArtNR'].' '. $row3['ART_Naam'] .' Hoeveelheid: '.$row3['ING_Aantal'].'</td></tr>';
            }
            $action = "index.php?a=keuken&id={$row['BestNR']}";
            $toret .= '<tr><td>&nbsp;</td></tr>';
            $toret .= '<tr><td><form action="'. $action.'" method="post"><input class="submit" type="submit" name="keuken_submit" value="Klaar"></form></td></tr>';
        }
        $toret .= '<tr class="UL"><td>&nbsp;</td><td>&nbsp;</td></tr>';
    }
    return $toret;
}

?>

<div class="content">
    <?php if(isset($_GET['res'])) {//als er een error was en de bestelstatus kon niet worden gewijzigd
        if ($_GET['res'] == 'fail'){
            echo '<center><div class="error">Kon bestel status niet wijzigen! Probeer opnieuw.</div></center><br>';
        }
    }?>
    <table>
        <?php
        echo getOrders();
        ?>
    </table>

</div>