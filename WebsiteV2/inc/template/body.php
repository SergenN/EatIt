<?php
/**
 * Created by PhpStorm.
 * Date: 28-10-2014
 * Time: 11:00
 */

function getGerechten($con){
    $gerechten = array();
    $query = "SELECT * FROM Gerecht g JOIN Aantalingredienten a ON g.GerNR = a.GerNR WHERE ING_Aantal >= 1";
    $result = mysqli_query($con, $query);
    if (mysqli_error($con)){
        die ('Kon query niet uitvoeren!');
    }
    while($row = mysqli_fetch_assoc($result)){
        array_push($gerechten, $row);
    }
    return $gerechten;
}

?>
<div class="content">

    <form>
        <ul>
            <?php
            $gerechten = getGerechten($con);
            if (isset($gerechten) && empty($gerechten)) {
                foreach ($gerechten as $gerecht) {
                    echo('<li>' . $gerecht['GerNR'] . '</li>');
                }
            }
            ?>
        </ul>
    </form>

</div>