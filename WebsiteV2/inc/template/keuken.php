<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 5-11-2014
 * Time: 11:28
 */

function getOrders() {
    global $con;
    $toret = "";
    $query = "SELECT * FROM Bestelling WHERE BEST_Status='besteld';";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        //Alle variabelen $row = {BestNR, KlantNR, MedNR, BEST_Datum, BEST_Status}
        $toret .= '<li>';
        $toret .= '<p class="lijstTitle">Bestelling: '.$row['BestNR'].' | Klant: '.$row['KlantNR'].'</p>';
        $query = "SELECT * FROM AantalVerkocht a JOIN Gerecht g ON a.GerNR = g.GerNR WHERE BestNR = {$row['BestNR']};";
        $result2 = mysqli_query($con, $query);
        while($row2 = mysqli_fetch_assoc($result2)){
            //Alle variabelen $row2 = {BestNR, GerNr, Aantal = Ger_NR, Ger_Naam, Ger_Prijs, Ger_Beschrijving}

            $toret .= '<p class="lijstSub">Gerecht: '.$row2['GerNR'].' '. $row2['GER_Prijs'].' | Aantal: '. $row2['Aantal'].'</p>';

            $query = "SELECT * FROM Aantalingredienten ai JOIN Artikelen ar ON ai.ArtNR = ar.ArtNR WHERE GerNR = {$row2['GerNR']};";
            $result3 = mysqli_query($con, $query);

            $toret .= '<p class="lijstIngredienten">';
            while($row3 = mysqli_fetch_assoc($result3)){
                //Alle variabelen $row3 = {AiNR, GerNR, ArtNR, IngAantal = ArtNR, ArtNaam}
                $toret .=  'Artikel:'.$row3['ArtNR'].' '. $row3['ART_Naam'] .' Hoeveelheid: '.$row3['ING_Aantal'].'<br>';
            }
            $toret .= '</p>';
            $action = "index.php?a=keuken&id={$row['BestNR']}";
            $toret .= '<div class="lijstForm"><form action="'. $action.'" method="post"><input class="submit" type="submit" name="keuken_submit" value="Klaar"></form></div>';
        }
        $toret .= "</li>";
    }
    return $toret;
}

?>

<div class="content">
    <?php if(isset($_GET['res'])) {
        if ($_GET['res'] == 'fail'){
            echo '<center><div class="error">Kon bestel status niet wijzigen! Probeer opnieuw.</div></center><br>';
        }
    }?>
    <ul class="gerechtLijst">
        <?php
        echo getOrders();
        ?>
    </ul>

</div>