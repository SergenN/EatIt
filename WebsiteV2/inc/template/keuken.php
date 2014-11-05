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
        $toret .= '<tr><td>';
        $toret .= '<h2>Bestelling: '.$row['BestNR'].' | Klant: '.$row['KlantNR'].'</h2></td></tr>';
        $query = "SELECT * FROM AantalVerkocht a JOIN Gerecht g ON a.GerNR = g.GerNR WHERE BestNR = {$row['BestNR']};";
        $result2 = mysqli_query($con, $query);
        while($row2 = mysqli_fetch_assoc($result2)){
            //Alle variabelen $row2 = {BestNR, GerNr, Aantal = Ger_NR, Ger_Naam, Ger_Prijs, Ger_Beschrijving}

            $toret .= '<td>Gerecht: '.$row2['GER_Naam'].' '. '| Aantal: '. $row2['Aantal'].'</td>';

            $query = "SELECT * FROM Aantalingredienten ai JOIN Artikelen ar ON ai.ArtNR = ar.ArtNR WHERE GerNR = {$row2['GerNR']};";
            $result3 = mysqli_query($con, $query);

            $toret .= '<td>';
            while($row3 = mysqli_fetch_assoc($result3)){
                //Alle variabelen $row3 = {AiNR, GerNR, ArtNR, IngAantal = ArtNR, ArtNaam}
                $toret .=  'Artikel:'.$row3['ArtNR'].' '. $row3['ART_Naam'] .' Hoeveelheid: '.$row3['ING_Aantal'].'<br>';
            }
            $toret .= '</td>';
            $action = "index.php?a=keuken&id={$row['BestNR']}";
            $toret .= '<form action="'. $action.'" method="post"><input class="submit" type="submit" name="keuken_submit" value="Klaar"></form>';
        }
        $toret .= "</td></tr>";
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
    <table class="tablelist">
        <?php
        echo getOrders();
        ?>
    </table>

</div>