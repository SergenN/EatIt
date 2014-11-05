<?php
/**
 * Created by PhpStorm.
 * User: Sergen Nurel
 * Date: 5-11-2014
 * Time: 23:21
 */

    //Wordt gekeken of alles is ingevoerd en of alles correct is igevoerd.
    if (isset($_POST['submit'])) {
        //Alle $_POST data wordt in variabelen gezet
        $artnr = $_POST['ArtNR'];
        $aantal = $_POST['Aantal'];
        $ordernr = $_POST['OrderNR'];

        //Query voor toevoegen ingevulde waardes.
        $query = "INSERT INTO Bestelorder (ArtNR, OrderNR, Aantal)
                  VALUES ($artnr, $ordernr, $aantal);";
        $result = mysqli_query($con, $query);

        if (!$result) {
            header("location: index.php?p=inkooporder&res=failed");
        }

        $query3  = "select ART_Prijs from Artikelen where ArtNR = $artnr;";
        $result3 = mysqli_fetch_assoc(mysqli_query($con, $query3));


        $prijs =  $result3['ART_Prijs'] * $aantal;
        $query2  = "insert into Inkoopfactuur (InkfNR, Inkf_Status, Bedrag)
                    values ($ordernr, 'verwerken', $prijs);";
        $result2 = mysqli_query($con, $query2);

        if(!$result2){
            header("location: index.php?p=inkooporder&res=failed");
        }
        header("location: index.php?p=inkooporder&res=success");
    }
?>