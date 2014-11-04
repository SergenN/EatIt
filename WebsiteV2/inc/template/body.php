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
            $stocked = true;
            if (!$res2) continue;
            while($row2 = mysqli_fetch_assoc($res2)){
                $voorraad = $row2['ART_TechnischeVoorraad'] - $row2['ART_Gereserveerd'];
                if ($row2['ING_Aantal'] > $voorraad) {
                    $stocked = false;
                    break;
                }

                $am = $voorraad / $row2['ING_Aantal'];
                if (!isset($mogelijk) || $mogelijk > $am) {
                    $mogelijk = $am;
                }
            }
            if ($stocked){
                $action = "index.php?a=bestelForm&id={$row['GerNR']}";
                if(isset($_SESSION['bes'])){
                $val = array_key_exists($row['GerNR'], $_SESSION['bes']) ? $_SESSION['bes'][$row['GerNR']] : "";
				} else {$val = "";}
                $toret .= '<li>'. $row['GerNR'] ." - ". $row['GER_Naam'] .' <form action="'.$action.'" method="post"><input type="number" name="bes_aantal" required min="1" max="'.$mogelijk.'" value="'.$val.'"><input  type="submit" name="bes_submit" value="Bestellen"></form></li>';
            }
        }
    }
    return $toret;
}
?>
<div class="content">

    <ul>
        <?php
            echo getGerechten();
        ?>
    </ul>

</div>