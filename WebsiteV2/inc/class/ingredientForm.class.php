<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 31-10-2014
 * Time: 22:54
 */

if (isset($_POST['ing_id'])){
    $sqid = mysqli_real_escape_string($con, $_POST['ing_id']);
} else if (isset($_GET['id'])){
    $sqid = mysqli_real_escape_string($con, $_GET['id']);
} else {
    $sqid = "";
}

if (isset($_POST['ing_submit'])) {
    $sqnaam = isset($_POST['ing_naam']) ? mysqli_real_escape_string($con, $_POST['ing_naam']) : "";
    $sqtv = isset($_POST['ing_tv']) ? mysqli_real_escape_string($con, $_POST['ing_tv']) : "";
    $sqib = isset($_POST['ing_ib']) ? mysqli_real_escape_string($con, $_POST['ing_ib']) : "";
    $sqg = isset($_POST['ing_g']) ? mysqli_real_escape_string($con, $_POST['ing_g']) : "";
    $sqbn = isset($_POST['ing_bn']) ? mysqli_real_escape_string($con, $_POST['ing_bn']) : "";
    $sqlev = isset($_POST['ing_lev']) ? mysqli_real_escape_string($con, $_POST['ing_lev']) : "";
    $sqprijs = isset($_POST['ing_prijs']) ? mysqli_real_escape_string($con, $_POST['ing_prijs']) : "";
}

$location = "index.php?p=toevoegen";

if(isset($_GET['q'])){
    switch ($_GET['q']){
        case("del") :
            if($sqid != ""){
                $query = "DELETE FROM ingredienten WHERE IngNR = $sqid";
                $result = mysqli_query($con, $query);
                if(mysqli_error($con)){
                    $location = "index.php?p=toevoegen&res=failed";
                }
                $location = "index.php?p=toevoegen&res=deleted";
            }
            break;
        case("add") :
            if (isset ($_POST['ing_submit'])){
                $query = "INSERT INTO ingredienten(ING_Naam, ING_TechnischeVoorraad, ING_InBestelling, ING_Gereserveerd, ING_BestelNiveau, ING_Leverancier, ING_prijs) VALUES ('$sqnaam', $sqtv, $sqib, $sqg, $sqbn, $sqlev, $sqprijs);";
                $results = mysqli_query($con, $query);
                if(mysqli_error($con)){
                    $_SESSION['ing'] = $_POST;
                    $location = "index.php?p=ingredientform&res=failed";
                }
                unset($_SESSION['ing']);
                $location = "index.php?p=toevoegen&res=added";
            }
            break;
        case("mod") :
            if (isset($_POST['ing_submit']) && $sqid != ""){
                $query = "UPDATE ingredienten SET ING_Naam='$sqnaam', ING_TechnischeVoorraad=$sqtv, ING_InBestelling=$sqib, ING_Gereserveerd=$sqg, ING_BestelNiveau=$sqbn, ING_Leverancier=$sqlev, ING_prijs=$sqprijs WHERE IngNR=$sqid;";
                $result = mysqli_query($con, $query);
                if(mysqli_error($con)) {
                    $_SESSION['ing'] = $_POST;
                    $location = "index.php?p=ingredientform&id=$sqid&res=failed";
                }
                unset($_SESSION['ing']);
                $location = "index.php?p=toevoegen&res=modified";
            }
            break;
    }
}
header('location:'.$location);
