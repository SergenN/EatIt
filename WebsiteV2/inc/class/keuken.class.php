<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 5-11-2014
 * Time: 12:37
 */

if (isset($_POST['keuken_submit'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if (!updateStock($id)){header('location: index.php?p=keuken&res=fail');}
    if (!updateStatus($id)){header('location: index.php?p=keuken&res=fail');}
    header('location: index.php?p=keuken');
}

function updateStatus($id){
    global $con;
    $query = "UPDATE Bestelling SET BEST_Status = 'bezorgen' WHERE BestNR = $id";
    mysqli_query($con, $query);
    if (mysqli_error($con)){
        return false;
    }
    return true;
}

function updateStock($id){
    global $con;
    $query = "SELECT * FROM AantalVerkocht WHERE BestNR = $id;";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
        $query2 = "SELECT * FROM Gerecht g JOIN Aantalingredienten a ON g.GerNR = a.GerNR WHERE g.GerNR = {$row['GerNR']};";
        $res2 = mysqli_query($con, $query2);
        while($row2 = mysqli_fetch_assoc($res2)){
            $query3 = "SELECT * FROM Artikelen WHERE ArtNR = {$row2['ArtNR']}";
            $row3 = mysqli_fetch_assoc(mysqli_query($con, $query3));

            $aantalIngredient = $row['Aantal'] * $row2['ING_Aantal'];
            $newTV = $row3['ART_TechnischeVoorraad'] - $aantalIngredient;
            $newGER = $row3['ART_Gereserveerd'] - $aantalIngredient;
            $query4 = "UPDATE Artikelen SET ART_TechnischeVoorraad=$newTV ,ART_Gereserveerd=$newGER WHERE ArtNR = {$row3['ArtNR']};";
            mysqli_query($con, $query4);
            if (mysqli_error($con)){
                return false;
            }
        }
        if (mysqli_error($con)){
            return false;
        }
    }
    if(mysqli_error($con)){
        return false;
    }
    return true;
}

?>