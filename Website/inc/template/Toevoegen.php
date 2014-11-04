<?php
/**
* Created by PhpStorm.
* Date: 28-10-2014
* Time: 11:00
*/
/*
if((!isset($_SESSION['gegevens'])) || ($gegevens['permissies'] != 'beheerder')){
    header ('location: index.php');
}*/
?>

<div class="content">
    <?php if (isset($_GET['res'])){
        echo '<center>';
        switch($_GET['res']) {
            case("added") :
                echo '<div class="success">Object toegevoegd aan database.</div><br>';
                break;
            case("modified") :
                echo '<div class="success">Object gewijzigd.</div><br>';
                break;
            case("deleted") :
                echo '<div class="success">Object gedelete</div><br>';
                break;
            case("failed") :
                echo '<div class="success">Kon object niet wijzigen!</div><br>';
                break;
        }
        echo '</center>';
    }?>
    <div class="box">
        <div class="edittabtitle">
            <p class="title">Gerechten verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u gerechten verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=gerechtForm"><div id="newGerecht" class="newitem">Gerecht toevoegen</div></a>
        </div>
        <table class="edittable" rules="groups">
            <thead>
            <tr>
                <th class="a">Gerecht</th>
                <th class="b">GerechtId</th>
                <th class="c">Prijs</th>
                <th class="d">Invoorraad</th>
                <th class="e"></th>
            </tr>
            </thead>

            <tbody class="editbody">
            <?php
            $query = "SELECT * FROM Gerecht;";
            $result = mysqli_query($con, $query);
            $rows = 0;
            while($row = mysqli_fetch_assoc($result)){
                $levnr = $row["GerNR"];
                echo "<tr>
                <td class=\"a\">{$row['GER_Naam']}</td>
                <td class=\"b\">{$row['GerNR']}</td>
                <td class=\"c\">{$row['GER_Prijs']}</td>
                <td class=\"d\">{$row['GER_Naam']}</td>
                <td class=\"e\"><a href=\"index.php?p=gerechtForm&id=$levnr\"><img src=\"inc/template/img/otf_edit.svg\" class=\"editico\"></a><a href=\"index.php?a=gerechtform&q=del&id=$levnr\"><img src=\"inc/template/img/otf_delete.svg\" class=\"delico\"></a></td>
            </tr>";
                $rows++;
            }?>
            </tbody>
        </table>
        <div class="edittabfooter"><?php echo $rows?> gerecht(en) in totaal.</div>
    </div>

    <div class="box">
        <div class="edittabtitle">
            <p class="title">Ingredienten verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u Ingredienten verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=ingredientform"><div id="newIngredient" class="newitem">Ingredient toevoegen</div></a>
        </div>
        <table class="edittable" rules="groups">
            <thead>
            <tr>
                <th class="a">Product</th>
                <th class="b">In voorraad</th>
                <th class="c">Prijs</th>
                <th class="d">Fabrikant</th>
                <th class="e"></th>
            </tr>
            </thead>

            <tbody class="editbody">
            <?php
            $query = "SELECT * FROM Artikelen i JOIN Leverancier l ON l.LevNr = i.ART_Leverancier;";
            $result = mysqli_query($con, $query);
            $rows = 0;
            while($row = mysqli_fetch_assoc($result)){
            $levnr = $row["ArtNR"];
            echo "<tr>
                <td class=\"a\">{$row['ART_Naam']}</td>
                <td class=\"b\">{$row['ART_TechnischeVoorraad']}</td>
                <td class=\"c\">{$row['ART_Prijs']}</td>
                <td class=\"d\">{$row['LEV_Naam']}</td>
                <td class=\"e\"><a href=\"index.php?p=ingredientForm&id=$levnr\"><img src=\"inc/template/img/otf_edit.svg\" class=\"editico\"></a><a href=\"index.php?a=ingredientForm&q=del&id=$levnr\"><img src=\"inc/template/img/otf_delete.svg\" class=\"delico\"></a></td>
            </tr>";
            $rows++;
            }?>
            </tbody>
        </table>
        <div class="edittabfooter"><?php echo $rows?> ingredient(en) in totaal.</div>
    </div>

    <div class="box">
        <div class="edittabtitle">
            <p class="title">Leveranciers verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u leveranciers verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=leverancierForm"><div id="newLeverancier" class="newitem">Leverancier toevoegen</div></a>
        </div>
        <table class="edittable" rules="groups">
            <thead>
            <tr>
                <th class="a">Adres</th>
                <th class="b">Postcode</th>
                <th class="c">Plaats</th>
                <th class="d">Naam</th>
                <th class="e"></th>
            </tr>
            </thead>

            <tbody class="editbody">
            <?php
            $query = "SELECT * FROM Leverancier;";
            $result = mysqli_query($con, $query);
            $rows = 0;
            while($row = mysqli_fetch_assoc($result)){
                $levnr = $row["LevNR"];
                echo "<tr>
                <td class=\"a\">{$row['LEV_Adres']}</td>
                <td class=\"b\">{$row['LEV_Postcode']}</td>
                <td class=\"c\">{$row['LEV_Plaats']}</td>
                <td class=\"d\">{$row['LEV_Naam']}</td>
                <td class=\"e\"><a href=\"index.php?p=leverancierForm&id=$levnr\"><img src=\"inc/template/img/otf_edit.svg\" class=\"editico\"></a><a href=\"index.php?a=leverancierform&q=del&id=$levnr\"><img src=\"inc/template/img/otf_delete.svg\" class=\"delico\"></a></td>
                    </tr>";
                $rows++;
            }
            ?>
            </tbody>
        </table>
        <div class="edittabfooter"><?php echo $rows?> leverancier(s) in totaal.</div>
    </div>
</div>