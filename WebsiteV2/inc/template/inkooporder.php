<div class="content">
<?php
    if(isset($_GET['res'])){
        echo '<center>';
        if($_GET['res'] == 'failed'){
            echo '<center><div class="error">Kon object niet wijzigen!</div></center>';
        } else if ($_GET['res'] == 'success'){
            echo '<center><div class="success">Bestelorder is geplaatst.</div></center>';
        }
        echo '</center>';
    }

    /**
     * Functie makeSelect
     * maak een select lijst met alle artikelen en zet de default geselecteerde
     *
     * @param null $selected - wat geselecteerd moet worden (null als er niets geselecteerd moet worden)
     * @return string - een selectie lijst in HTML
     */
    function makeSelect($selected = null){
        global $con;
        $query = "SELECT * FROM Artikelen";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 0) {header("location: index.php?p=body&res=noarts");}//er zijn geen artikelen je kunt dus ook geen gerecht maken
        $toret = "<select name=\"ArtNR\" class=\"dropdownveld\">";
        while($row = mysqli_fetch_assoc($result)){//verkrijg alle ingredienten en maak een lijst
            if($selected != null && $row['ArtNR'] == $selected){
                $toret .= "<option value={$row['ArtNR']} selected>{$row['ArtNR']} {$row['ART_Naam']}</option>";//zet de geselecteerde
            } else {
                $toret .= "<option value={$row['ArtNR']}>{$row['ArtNR']} {$row['ART_Naam']}</option>";
            }
        }
        $toret .= "</select>";
        return $toret;
    }

    /**
     * Function getOrderNR
     * verkrijg de laatste ordernummer + 1;
     *
     * @return int - OrderNR
     */
    function getOrderNr(){
        global $con;
        $query = "SELECT OrderNR FROM BestelOrder ORDER BY OrderNR DESC LIMIT 1;";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) == 0){
            return 1;
        } else {
            $num = mysqli_fetch_assoc($res)['OrderNR'] + 1;
            return $num;
        }
    }
?>
    <form action="index.php?a=inkooporder" method="POST">
        <table>
            <h2>Inkooporder aanmaken<h2>
            <tr><td>Artikel nummer:</td><td><?php echo makeSelect(); ?></td></tr>
            <tr><td>Aantal:</td><td><input type="number" class="invoerveld" value="" name="Aantal" required></td></tr>
            <tr><td>OrderNR:</td><td><input readonly type="number" class="invoerveld" name="OrderNR" value="<?php echo getOrderNr();?>"></td></tr>
        </table><br>
        <input type="submit" class="submit" value="Inkooporder maken" name="submit" /><br><br>
    </form>
    <br>
    <h2>Inkooporder aftekenen<h2>
</div>