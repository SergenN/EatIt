<?php
/**
 * Created by PhpStorm.
 * Date: 28-10-2014
 * Time: 11:00
 */

function getGerechten(){
    global $con;
    $toret = "";
    $query = "SELECT * FROM Gerecht;";
    $res = mysqli_query($con, $query);
    if ($res){
        while($row = mysqli_fetch_assoc($res)){
            $query = "SELECT * FROM Aantalingredienten a JOIN Artikelen i ON i.ArtNR = a.ArtNR WHERE a.GerNR = {$row['GerNR']};";
            $res2 = mysqli_query($con, $query);
            $stocked = 0;
            if (!$res2) continue;
            unset($mogelijk);
            while($row2 = mysqli_fetch_assoc($res2)){
                $voorraad = $row2['ART_TechnischeVoorraad'] - $row2['ART_Gereserveerd'];
                if ($row2['ING_Aantal'] > $voorraad) {
                    $stocked = 0;
                    break;
                }

                $am = $voorraad / $row2['ING_Aantal'];
                if (!isset($mogelijk) || $mogelijk > $am) {
                    $stocked = floor($am);
                    $mogelijk = floor($am);
                }
            }

            if ($stocked > 0){
                $action = "index.php?a=bestelForm&id={$row['GerNR']}";
                if(isset($_SESSION['bes'])){
                    $val = array_key_exists($row['GerNR'], $_SESSION['bes']) ? $_SESSION['bes'][$row['GerNR']] : "";
                } else {$val = "";}
                $toret .= '<li>
                                <div><p class="lijstTitle">'.$row['GER_Naam'].'</p><p class="lijstText">'.$row['GER_Beschrijving'].'</p></div>
                                <div class="prijsForm"><p class="grey">Prijs:</p><p>&euro;'.number_format($row['GER_Prijs'], 2, ',', ' ').'</p></div>
                                <div class="lijstForm"><form action="'.$action.'" method="post">
                                        <input type="number" name="bes_aantal" required min="1" max="'.floor($mogelijk).'" value="'.$val.'">
                                        <input class="inCart" type="submit" name="bes_submit" value=""></form>
                                </div></li>';
            }
        }
    }
    return $toret;
}
?>
<div class="content">
    <?php if(isset($_GET['res'])) {
        if ($_GET['res'] == 'nlog'){
            echo '<center><div class="error">Je moet ingelogd zijn om te kunnen bestellen!</div></center><br>';
        } else if ($_GET['res'] == 'success') {
            echo '<center><div class="success">Item is toegevoegd aan je winkelwagen</div></center><br>';
        } else if ($_GET['res'] == 'error'){
            echo '<center><div class="success">Er zijn geen artikelen om een bestelling te kunnen plaatsen!</div></center><br>';
        }
    }?>
    <ul class="gerechtLijst">
        <?php
        echo getGerechten();
        ?>
    </ul>

</div>