<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 31-10-2014
 * Time: 04:23
 */
$exists = false;
$levNaam = isset($_POST['lev_naam']) ? $_POST['lev_naam'] : "";
$levadres = isset($_POST['lev_adres']) ? $_POST['lev_adres'] : "";
$levpost = isset($_POST['lev_post']) ? $_POST['lev_post'] : "";
$levplaats = isset($_POST['lev_plaats']) ? $_POST['lev_plaats'] : "";
$levmail = isset($_POST['lev_mail']) ? $_POST['lev_mail'] : "";
$levtel = isset($_POST['lev_tel']) ? $_POST['lev_tel'] : "";

if (isset ($_POST['lev_submit'])){
    $sqnaam = mysqli_real_escape_string($con, $levNaam);
    $sqadres = mysqli_real_escape_string($con, $levadres);
    $sqpost = mysqli_real_escape_string($con, $levpost);
    $sqplaats = mysqli_real_escape_string($con, $levplaats);
    $sqmail = mysqli_real_escape_string($con, $levmail);
    $sqtel = mysqli_real_escape_string($con, $levtel);

    $query = "SELECT COUNT(*) AS total FROM leverancier WHERE LEV_Naam = '$sqnaam' OR LEV_Adres = '$sqadres' OR LEV_Postcode = '$sqpost' OR LEV_Plaats = '$sqplaats';";
    $results = mysqli_query($con, $query);
    $values = mysql_fetch_assoc($results);
    $num_rows = $values['total'];
    if ($num_rows == 0){
        $query = "INSERT INTO leverancier (LEV_Adres, LEV_Mail, LEV_Naam, LEV_Plaats, LEV_Postcode, LEV_Telefoonnummer) VALUES ('$sqadres','$sqmail','$sqnaam', '$sqplaats','$sqpost', '$sqtel')";
        $results = mysqli_query($con, $query);
    } else {
        $exists = true;
    }
}
?>

<div class="content">
    <center>
    <h2>Leverancier Toevoegen/Wijzigen</h2>
        <?php if($exists){echo '<div class="error">Er bestaat al een leverancier met soortgelijke gegevens!</div><br>';}?>
    <form action="index.php?p=leverancierForm" method="post">
        <?php if(isset($_POST['id'])){echo "<input type=\"hidden\" name=\"lev_id\" value=\"{$_post['id']}\">";}?>
        <table>
            <tr><td>Leverancier Naam</td>
                <td><input type="text" class="invoerveld" name="lev_naam" placeholder="Naam" required autofocus value="<?php echo $levNaam; ?>"></td></tr>
            <tr><td>Leverancier Adres</td>
                <td><input type="text" class="invoerveld" name="lev_adres" placeholder="Adres" required value="<?php echo $levadres; ?>"></td></tr>
            <tr><td>Leverancier Postcode</td>
                <td><input type="text" class="invoerveld" name="lev_post" placeholder="Postcode" required value="<?php echo $levpost; ?>"></td></tr>
            <tr><td>Leverancier Plaats</td>
                <td><input type="text" class="invoerveld" name="lev_plaats" placeholder="Plaats" required value="<?php echo $levplaats; ?>"></td></tr>
            <tr><td>Leverancier E-mail</td>
                <td><input type="email" class="invoerveld" name="lev_mail" placeholder="E-Mail" value="<?php echo $levmail; ?>"></td></tr>
            <tr><td>Leverancier Telefoon</td>
                <td><input type="number" class="invoerveld" name="lev_tel" placeholder="Telefoon" min="0" value="<?php echo $levtel; ?>"></td></tr>
            <tr><td></td>
                <td><button type="reset" id="submit">Opnieuw</button> <button type="submit" name="lev_submit" id="submit">Opslaan</button></td></tr>
        </table>
    </form>
    </center>
</div>

