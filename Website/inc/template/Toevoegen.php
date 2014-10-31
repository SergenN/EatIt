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
    <div class="box">
        <div class="edittabtitle">
            <p class="title">Gerechten verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u gerechten verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=formulier&a=gerecht"><div id="newGerecht" class="newitem">Gerecht toevoegen</div></a>
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
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            </tbody>
        </table>
        <div class="edittabfooter">xx items in totaal</div>
    </div>

    <div class="box">
        <div class="edittabtitle">
            <p class="title">Ingredienten verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u Ingredienten verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=formulier&a=ingredient"><div id="newIngredient" class="newitem">Ingredient toevoegen</div></a>
        </div>
        <table class="edittable" rules="groups">
            <thead>
            <tr>
                <th class="a">Product</th>
                <th class="b">Artikel-NR</th>
                <th class="c">Prijs</th>
                <th class="d">Fabrikant</th>
                <th class="e"></th>
            </tr>
            </thead>

            <tbody class="editbody">
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>

            <tr>
                <td class="a">f</td>
                <td class="b">g</td>
                <td class="c">h</td>
                <td class="d">i</td>
                <td class="e"><img src="inc/template/img/otf_edit.svg" class="editico"><img src="inc/template/img/otf_delete.svg" class="delico"></td>
            </tr>
            </tbody>
        </table>
        <div class="edittabfooter">xx items in totaal</div>
    </div>

    <div class="box">
        <div class="edittabtitle">
            <p class="title">Leveranciers verwijderen en/of aanpassen</p>
            <p class="blue">Hier kunt u leveranciers verwijderen uit en/of aanpassen in de database.</p>
            <a href="index.php?p=formulier&a=leverancierForm"><div id="newLeverancier" class="newitem">Leverancier toevoegen</div></a>
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
            $query = "SELECT * FROM leverancier;";
            $result = mysqli_query($con, $query);
            $rows = 0;
            while($row = mysqli_fetch_assoc($result)){
                $levnr = $row["LevNR"];
                echo "<tr>
                <td class=\"a\">{$row['LEV_Adres']}</td>
                <td class=\"b\">{$row['LEV_Postcode']}</td>
                <td class=\"c\">{$row['LEV_Plaats']}</td>
                <td class=\"d\">{$row['LEV_Naam']}</td>
                <td class=\"e\"><a href=\"index.php?p=leverancierForm&id=$levnr\"><img src=\"inc/template/img/otf_edit.svg\" class=\"editico\"></a><a href=\"index.php?a=leverancierForm&a=delete&i=$levnr\"><img src=\"inc/template/img/otf_delete.svg\" class=\"delico\"></a></td>
                    </tr>";
                $rows++;
            }
            ?>
            </tbody>
        </table>
        <div class="edittabfooter"><?php echo $rows?> leverancier(s) in totaal.</div>
    </div>
</div>