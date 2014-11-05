<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 3-11-2014
 * Time: 13:54
 */

if (isset($_POST['ger_addIng'])){
    savePost();
    header("location: index.php?p=gerechtForm");
}

if (isset($_POST['ger_delIng'])){
    savePost();
    unset($_SESSION['ger']['ger_ing'][$_POST['id']]);
    unset($_SESSION['ger']['id']);
    header("location: index.php?p=gerechtForm");
}

if (isset($_POST['ger_submit'])){
    $sqnaam = isset($_POST['ger_naam']) ? mysqli_real_escape_string($con, $_POST['ger_naam']) : "";
    $sqprijs = isset($_POST['ger_prijs']) ? mysqli_real_escape_string($con, $_POST['ger_prijs']) : "";
    $sqbes = isset($_POST['ger_bes']) ? mysqli_real_escape_string($con, $_POST['ger_bes']) : "";
    $sqid = isset($_POST['ger_id']) ? mysqli_real_escape_string($con, $_POST['ger_id']) : "";
}

if (isset($_GET['q'])){
    switch($_GET['q']){
        case("add") :
            if (isset($_POST['ger_submit'])){
                if (!addGerecht()){
                    savePost();
                    header("location: index.php?p=gerechtForm&res=failed");
                    break;
                }
                unset($_SESSION['ger']);
                header("location: index.php?p=Toevoegen&res=added");
            }
            break;
        case("mod") :
            if (isset($_POST['ger_submit'])){
                if(!modGerecht()){
                    savePost();
                    header("location: index.php?p=gerechtForm&q=mod&id=$sqid&res=failed");
                    break;
                }
                unset($_SESSION['ger']);
                header("location: index.php?p=Toevoegen&res=modified");
            }
            break;
        case("del") :
            $id = $_GET['id'];
            if (!deleteGerecht($id)){
                header("location: index.php?p=Toevoegen&res=failed");
                break;
            }
            unset($_SESSION['ger']);
            header("location: index.php?p=Toevoegen&res=deleted");
            break;
    }
}

function modGerecht(){
    global $sqnaam, $sqprijs, $sqbes, $sqid, $con;
    $query = "UPDATE Gerecht SET GER_Naam='$sqnaam', GER_Prijs='$sqprijs', GER_Beschrijving='$sqbes' WHERE GerNR = $sqid;";
    $res = mysqli_query($con, $query);
    if (mysqli_error($con)){
        die("Kon gerechten niet updaten query:" . $query);
    }
    $res1 = deleteIngredients($sqid);
    $res2 = addIngredients($sqid);
    return ($res1 && $res2);
}

function addGerecht(){
    global $sqnaam, $sqprijs, $sqbes, $con;
    $query = "INSERT INTO Gerecht(GER_Naam, GER_Prijs, GER_Beschrijving) VALUES ('$sqnaam', '$sqprijs', '$sqbes');";
    $res = mysqli_query($con, $query);
    if (mysqli_error($con)){
        return false;
    }
    $gerId = mysqli_insert_id($con);
    return (addIngredients($gerId));
}

function deleteGerecht($id){
    global $con;
    $id = mysqli_real_escape_string($con, $id);
    if (!deleteIngredients($id)){
        return false;
    }

    $query = "DELETE FROM Gerecht WHERE GerNR = $id;";
    mysqli_query($con, $query);
    if (mysqli_error($con)){
        return false;
    }
    return true;
}

function deleteIngredients($gerId){
    global $con;
    $query = "DELETE FROM Aantalingredienten WHERE GerNR = $gerId;";
    mysqli_query($con, $query);
    if (mysqli_error($con)){
        return false;
    }
    return true;
}

function addIngredients($gerId){
    global $con;
    $ingredients = merge($_POST['ingredient'], $_POST['hoeveelheid']);
    $gerId = mysqli_real_escape_string($con, $gerId);
    foreach ($ingredients as $key => $value){
        $query = "INSERT INTO Aantalingredienten(GerNR, ArtNR, ING_Aantal) VALUES ($gerId, $key, $value);";
        mysqli_query($con, $query);
        if (mysqli_error($con)){
            return false;
        }
    }
    return true;
}

function savePost(){
    $_SESSION['ger'] = $_POST;
    $_SESSION['ger']['ger_ing'] = merge($_POST['ingredient'], $_POST['hoeveelheid']);
    unset($_SESSION['ger']['hoeveelheid']);
    unset($_SESSION['ger']['ingredient']);
}

function merge($array1, $array2){
    for($i = 0; $i < count($array1); $i++){
        if ($array2[$i] == "") continue;
        $merged[$array1[$i]] = $array2[$i];
    }
    return $merged;
}
?>
