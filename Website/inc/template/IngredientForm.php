<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 31-10-2014
 * Time: 22:54
 */
$action = "index.php?a=ingredientForm&q=add";

if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM ingredienten WHERE IngNR = $id;";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1){
        $row = mysqli_fetch_assoc($result);
        $qnaam = $row['ART_Naam'];
        $qtv = $row['ART_TechnischeVoorraad'];
        $qib = $row['ART_InBestelling'];
        $qg = $row['ART_Gereserveerd'];
        $qbn = $row['ART_BestelNiveau'];
        $qlev = $row['ART_Leverancier'];
        $qprijs = $row['ART_Prijs'];
        $action = "index.php?a=ingredientForm&q=mod";
    } else {
        header("index.php?p=toevoegen&res=failed");
    }
}

$ingnaam = isset($_SESSION['ing']['ing_naam']) ? $_SESSION['ing']['ing_naam'] : isset($qnaam) ? $qnaam : "";
$ingtv = isset($_SESSION['ing']['ing_tv']) ? $_SESSION['ing']['ing_tv'] : isset($qtv) ? $qtv : "";
$ingib = isset($_SESSION['ing']['ing_ib']) ? $_SESSION['ing']['ing_ib'] : isset($qib) ? $qib : "";
$ingg = isset($_SESSION['ing']['ing_g']) ? $_SESSION['ing']['ing_g'] : isset($qg) ? $qg : "";
$ingbn = isset($_SESSION['ing']['ing_bn']) ? $_SESSION['ing']['ing_bn'] : isset($qbn) ? $qbn : "";
$inglev = isset($_SESSION['ing']['ing_lev']) ? $_SESSION['ing']['ing_lev'] : isset($qlev) ? $qlev : "";
$ingprijs = isset($_SESSION['ing']['ing_prijs']) ? $_SESSION['ing']['ing_prijs'] : isset($qprijs) ? $qprijs : "";

function makeSelect(){
    global $inglev, $con;
    $query = "SELECT * FROM leverancier";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 0) {header("location: index.php?p=toevoegen&res=nolevs");}
    echo "<select name=\"ing_lev\" class=\"dropdownveld\">";
    while($row = mysqli_fetch_assoc($result)){
        if($row['LevNR'] == $inglev){
            echo "<option value={$row['ArtNR']} selected>{$row['ART_Naam']} {$row['ART_Plaats']} {$row['ART_Adres']}</option>";
        } else {
            echo "<option value={$row['ArtNR']}>{$row['ART_Naam']} {$row['ART_Plaats']}</option>";
        }
    }
    echo "</select>";
}
?>

<div class="content">
    <center>
        <h2>Ingredient Toevoegen/Wijzigen</h2>
        <form action="<?php echo $action;?>" method="post">
            <?php if(isset($_GET['res']) && $_GET['res'] == 'failed'){echo '<div class="error">Er ging iets verkeerd! Probeer opnieuw.</div><br>';}
            if(isset($_GET['id'])){echo "<input type=\"hidden\" name=\"ing_id\" value=\"{$_GET['id']}\">";}?>
            <table>
                <tr><td>Ingredient Naam</td>
                    <td><input type="text" class="invoerveld" name="ing_naam" placeholder="Naam" required autofocus value="<?php echo $ingnaam; ?>"></td></tr>
                <tr><td>Ingredient Prijs</td>
                    <td><input type="text" class="invoerveld" name="ing_prijs" placeholder="Prijs" required value="<?php echo $ingprijs; ?>"></td></tr>
                <tr><td>Ingredient Leverancier</td>
                    <td><?php makeSelect(); ?></td></tr>
                <tr><td>Ingredient In voorraad</td>
                    <td><input type="number" class="invoerveld" name="ing_tv" placeholder="Technische Voorraad" min="0" required value="<?php echo $qtv; ?>"></td></tr>
                <tr><td>Ingredient In bestelling</td>
                    <td><input type="number" class="invoerveld" name="ing_ib" placeholder="In bestelling" min="0" required value="<?php echo $qib; ?>"></td></tr>
                <tr><td>Ingredient Gereserveerd</td>
                    <td><input type="number" class="invoerveld" name="ing_g" placeholder="Gereserveerd" min="0" required value="<?php echo $qg; ?>"></td></tr>
                <tr><td>Ingredient Bestelniveau</td>
                    <td><input type="number" class="invoerveld" name="ing_bn" placeholder="Besteniveau" min="0" required value="<?php echo $qbn; ?>"></td></tr>
                <tr><td></td>
                    <td><button type="reset" class="submit">Opnieuw</button> <button type="submit" name="ing_submit" class="submit">Opslaan</button></td></tr>
            </table>
        </form>
    </center>
</div>

