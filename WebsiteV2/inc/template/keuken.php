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
    foreach (getBestellingen() as $bestelling){
        $toret .= '<tr><td><h2>Bestelling: '.$bestelling['BestNR'].'</h2></td><td><h2>Klant: '.$bestelling['KlantNR'].'</h2></td></tr>';
        foreach(getReceptenFromBestelling($bestelling['BestNR']) as $gerecht){
            $toret .= '<tr><td>Gerecht: '.$gerecht['GER_Naam'].'</td><td>Aantal: '. $gerecht['Aantal'].'</td></tr>';
            $toret .= '<tr><td>&nbsp;</td></tr>';
            foreach (getIngredientenFromRecept($gerecht['GerNR']) as $ingredient){
                $toret .=  '<tr><td>Artikel:'.$gerecht['ArtNR'].' '. $gerecht['ART_Naam'] .' Hoeveelheid: '.$gerecht['ING_Aantal'].'</td></tr>';
            }
            $action = "index.php?a=keuken&id={$bestelling['BestNR']}";
            $toret .= '<tr><td>&nbsp;</td></tr>';
            $toret .= '<tr><td><form action="'. $action.'" method="post"><input class="submit" type="submit" name="keuken_submit" value="Klaar"></form></td></tr>';
        }
        $toret .= '<tr class="UL"><td>&nbsp;</td><td>&nbsp;</td></tr>';
    }
    return $toret;
}

function getIngredientenFromRecept($Gernr){
    global $con;
    $query = "SELECT * FROM Aantalingredienten ai JOIN Artikelen ar ON ai.ArtNR = ar.ArtNR WHERE GerNR = $Gernr;";
    $result = mysqli_query($con, $query);
    return resToArray($result);
}

function getReceptenFromBestelling($Bestelnr){
    global $con;
    $query = "SELECT * FROM AantalVerkocht a JOIN Gerecht g ON a.GerNR = g.GerNR WHERE BestNR = $Bestelnr;";
    $result = mysqli_query($con, $query);
    return resToArray($result);
}

function getBestellingen() {
    global $con;
    $query = "SELECT * FROM Bestelling WHERE BEST_Status='besteld';";
    $result = mysqli_query($con, $query);
    return resToArray($result);
}

function resToArray($result){
    $toret = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($toret, $row);
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