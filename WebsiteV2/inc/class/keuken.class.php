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
    $query = "SELECT * FROM AantalVerkocht WHERE BestNR = $id";
}

?>