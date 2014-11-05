<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 3-11-2014
 * Time: 13:54
 */

$action = "index.php?a=gerechtForm&q=add";

if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM gerecht WHERE GerNR = $id;";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 1){
        $row = mysqli_fetch_assoc($result);
        $qnaam = $row['GER_Naam'];
        $qprijs = $row['GER_Prijs'];
        $qbes = $row['GER_Beschrijving'];

        $query2 = "SELECT * FROM aantalingredienten a WHERE GerNR = $id;";
        $result2 = mysqli_query($con, $query2);
        while($row = mysqli_fetch_assoc($result2)){
            $ingredienten[$row['IngNR']] = $row['ING_Aantal'];
        }
        $action = "index.php?a=gerechtForm&q=mod";
    } else {
        header("index.php?p=toevoegen&res=failed");
    }
}


$gernaam = isset($_SESSION['ger']['ger_naam']) ? $_SESSION['ger']['ger_naam'] : (isset($qnaam) ? $qnaam : "");
$gerbes = isset($_SESSION['ger']['ger_bes']) ? $_SESSION['ger']['ger_bes'] : (isset($qbes) ? $qbes : "");
$gerprijs = isset($_SESSION['ger']['ger_prijs']) ? $_SESSION['ger']['ger_prijs'] : (isset($qprijs) ? $qprijs : "");
$gering = isset($_SESSION['ger']['ger_ing']) ? $_SESSION['ger']['ger_ing'] : (isset($ingredienten) ? $ingredienten : "");
$selectRows = 1;
$canAdd = true;

function makeSelect($selected = null){
    global $con, $selectRows;
    $query = "SELECT * FROM ingredienten";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows == 0) {header("location: index.php?p=toevoegen&res=nolevs");}
    $selectRows = $rows;
    $toret = "<select name=\"ingredient[]\" class=\"dropdownveld\">";
    while($row = mysqli_fetch_assoc($result)){
        if($selected != null && $row['IngNR'] == $selected){
            $toret .= "<option value={$row['IngNR']} selected>{$row['IngNR']} {$row['ING_Naam']}</option>";
        } else {
            $toret .= "<option value={$row['IngNR']}>{$row['IngNR']} {$row['ING_Naam']}</option>";
        }
    }
    $toret .= "</select>";
    return $toret;
}

function getIngredienten(){
    global $gering, $selectRows, $canAdd;
    $totalrows = 0;
    $toret = "";
    if ($gering != ""){
        foreach($gering as $key => $value){
            $toret .= '<tr><td>' . makeSelect($key) . '</td><td><input type="number" class="invoerveld" name="hoeveelheid[]" placeholder="Hoeveelheid" value="'.$value.'"></td><td><input type="hidden" name="id" value="'.$key.'"/><button type="submit" name="ger_delIng" class="button">Verwijder Ingredient</button></td></tr>';
            $totalrows++;
        }
    }
    if ($totalrows < $selectRows) {
        $add = $totalrows == 0 ? "required" : "";
        $toret .= "<tr><td>" . makeSelect() . "</td><td><input type=\"number\" class=\"invoerveld\" name=\"hoeveelheid[]\" placeholder=\"Hoeveelheid\" ". $add ."></td></tr>";
        $totalrows++;
        if ($totalrows == $selectRows){
            $canAdd = false;
        }
    } else {
        $canAdd = false;
    }
    return $toret;
}
?>

<div class="content">
    <center>
        <h2>Ingredient Toevoegen/Wijzigen</h2>
        <form action="<?php echo $action;?>" method="post">
            <?php if(isset($_GET['res']) && $_GET['res'] == 'failed'){echo '<div class="error">Er ging iets verkeerd! Probeer opnieuw.</div><br>';}
            if(isset($_GET['id'])){echo "<input type=\"hidden\" name=\"ger_id\" value=\"{$_GET['id']}\">";}else if(isset($_SESSION['ger']['ger_id'])){ echo "<input type=\"hidden\" name=\"ger_id\" value=\"{$_SESSION['ger']['ger_id']}\">";} ?>
            <table>
                <tr><td>Gerecht Naam</td><td><input type="text" class="invoerveld" name="ger_naam" placeholder="Naam" required autofocus value="<?php echo $gernaam; ?>"></td></tr>
                <tr><td>Gerecht Prijs</td><td><input type="text" class="invoerveld" name="ger_prijs" placeholder="Prijs" required value="<?php echo $gerprijs; ?>"></td></tr>
                <tr><td>Gerecht Beschrijving</td><td><textarea class="invoerarea" name="ger_bes" placeholder="Geef hier een beschrijving van het gerecht"><?php echo $gerbes; ?></textarea></td></tr>
                <tr><td>Gerecht ingredienten:</td><td></td></tr>
                <?php echo getIngredienten(); ?>
                <tr><td></td><td><button type="reset" class="button">Opnieuw</button> <button type="submit" name="ger_submit" class="button">Opslaan</button> <?php if ($canAdd){ echo '<button type="submit" name="ger_addIng" class="button">Extra ingredient</button>'; } ?></td></tr>
            </table>
        </form>
    </center>
</div>

