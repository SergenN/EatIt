<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 31-10-2014
 * Time: 06:00
 */
if (isset($_POST['lev_id'])){
    $sqid = mysqli_real_escape_string($con, $_POST['lev_id']);
} else if (isset($_GET['id'])){
    $sqid = mysqli_real_escape_string($con, $_GET['id']);
} else {
    $sqid = "";
}
$sqnaam = isset($_POST['lev_naam']) ? mysqli_real_escape_string($con, $_POST['lev_naam']) : "";
$sqadres = isset($_POST['lev_adres']) ? mysqli_real_escape_string($con, $_POST['lev_adres']) : "";
$sqpost = isset($_POST['lev_post']) ? mysqli_real_escape_string($con, $_POST['lev_post']) : "";
$sqplaats = isset($_POST['lev_plaats']) ? mysqli_real_escape_string($con, $_POST['lev_plaats']) : "";
$sqmail = isset($_POST['lev_mail']) ? mysqli_real_escape_string($con, $_POST['lev_mail']) : "";
$sqtel = isset($_POST['lev_tel']) ? mysqli_real_escape_string($con, $_POST['lev_tel']) : "";

$location = "index.php?p=toevoegen";

if(isset($_GET['q'])){
    switch ($_GET['q']){
        case("del") :
            if(!empty($sqid)){
                $query = "DELETE FROM leverancier WHERE LevNR = $sqid";
                $result = mysqli_query($con, $query);
                if(mysqli_error($con)){
                    $location = "index.php?p=toevoegen&res=failed";
                }
                $location = "index.php?p=toevoegen&res=deleted";
            }
            break;
        case("add") :
            if (isset ($_POST['lev_submit'])){
                $query = "INSERT INTO leverancier (LEV_Adres, LEV_Mail, LEV_Naam, LEV_Plaats, LEV_Postcode, LEV_Telefoonnummer) VALUES ('$sqadres','$sqmail','$sqnaam', '$sqplaats','$sqpost', '$sqtel');";
                if(mysqli_error($con)){
                    $_SESSION['res'] = $_POST;
                    $location = "index.php?p=leverancierform&res=failed";
                }
                $location = "index.php?p=toevoegen&res=added";
            }
            break;
        case("mod") :
            if (isset ($_POST['lev_submit']) && !empty($sqid)){
                $query = "UPDATE leverancier SET LEV_Naam='$sqnaam', LEV_Adres='$sqadres', LEV_Postcode='$sqpost', LEV_Plaats='$sqplaats', LEV_Mail='$sqmail', LEV_Telefoonnummer='$sqtel' WHERE LevNR=$sqid;";
                $result = mysqli_query($con, $query);
                if(mysqli_error($con)) {
                    $_SESSION['res'] = $_POST;
                    $location = "index.php?p=leverancierform&id=$sqid&res=failed";
                }
                $location = "index.php?p=toevoegen&res=modified";
            }
            break;
    }
}
header('location:'.$location);

?>