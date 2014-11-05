<div class="content">
    <?php
    if(isset($_GET['res'])){
        if($_GET['res'] == 'succes'){
            echo '<div class="success">Uw heeft besteld!</div><br>';
        } else if($_GET['res'] == 'error'){
            echo '<div class="error">Oeps er ging iets fout</div><br>';
        } else if($_GET['res'] == 'fail') {
            echo '<div class="success">U kunt artikel '.$_GET['gid'].' niet meer bestellen, want die hebben wij niet meer op voorraad!</div><br>';
        }
    }

    if(isset($_POST["delete"])){
        $_SESSION['bes'] = null;
    }

    //alle orders die zijn besteld worden weergegeven
    if(isset($_SESSION['bes'])){
        foreach ($_SESSION['bes'] as $gerecht => $aantal) {
            $query2  = "select GER_Naam from Gerecht ";
            $query2 .= "where GerNR = $gerecht; ";
            $result2 = mysqli_query($con, $query2);
            if(!$result2){
                die("Database query failed");
            }
            while ($naam = mysqli_fetch_assoc($result2)) {

                echo "u heeft van het gerecht {$naam['GER_Naam']}, $aantal besteld";
                echo "<hr/>";
            }
        }
//als er geen gerechten besteld zijn wordt dat weergegeven
    } else {
        echo "Je hebt nog geen gerechten besteld";
    }
    //als er gerechten besteld zijn wordt de verwijder knop weergegeven
    if(isset($_SESSION['bes'])){
        echo "		<form action=\"\" method=\"post\">
					<input type=\"submit\" name=\"delete\"  value=\"verwijderen\" />
				</form>";
    }


    ?>
    <!-- als er gerechten besteld zijn wordt de bevestig knop weergegeven-->
    <form action="" method="post">
        <?php 	if(isset($_SESSION['bes'])) {
            echo"<input type=\"submit\" name=\"confirm\" value=\"bevestigen\"/>";
        } ?>
        <input type="submit" name="back" class="button" value="terug naar bestellen"/>
    </form>

    <?php
    //als er op bevestigen wordt gedrukt wordt de bestelling ingevoerd in de database
    if (isset($_POST["confirm"]) == "bevestigen ") {
        foreach ($_SESSION['bes'] as $gerecht => $aantal) {
            $query = "SELECT * FROM Aantalingredienten a JOIN Artikelen i ON i.ArtNR = a.ArtNR WHERE a.GerNR = $gerecht;";
            $res2 = mysqli_query($con, $query);
            $stocked = 0;
            if (!$res2) continue;
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $voorraad = $row2['ART_TechnischeVoorraad'] - $row2['ART_Gereserveerd'];
                if (($row2['ING_Aantal'] * $aantal) > $voorraad) {
                    header("location: index.php?p=winkelwagen&res=error&gid=$gerecht");
                }
            }
        }

        foreach ($_SESSION['bes'] as $gerecht => $aantal) {

            //query die de data in de bestelling tabel zet
            $query  = "insert into Bestelling
                (KlantNR, Best_Datum, BEST_Status)
                values (" . $_SESSION['gegevens']['KlantNR'] . " ,str_to_date( '" . date('d-m-Y ') . "' , '%d-%m-%Y' ), 'besteld'); ";
            $result = mysqli_query($con, $query);
            if(!$result){
                header("location: index.php?p=winkelwagen&res=error");
            }

            //query die de bij behorende data in de aantalverkocht tabel zet en aan de  bestelling tabel linkt
            $query3  = "insert into AantalVerkocht (GerNR, Aantal, BestNR)
                values ($gerecht, $aantal, " .mysqli_insert_id($con) . ");";
            $result3 = mysqli_query($con, $query3);
            if(!$result3){
                header("location: index.php?p=winkelwagen&res=error");
            }
            //query die het aantal ingredienten samen met het ingredientnummer ophaalt
            $query4  = "select ING_Aantal, ArtNR
                from Gerecht g, Aantalingredienten a
                where g.GerNR = a.GerNR
                and g.GerNR = $gerecht; ";
            $result4 = mysqli_query($con,$query4);
            if(!$result4){
                header("location: index.php?&winkelwagen&res=error");
            }
            while ($row = mysqli_fetch_assoc($result4)) {
                //query dat het aantal gereserveerd van het ingredient wordt opgehaald
                $query6  = "select ART_Gereserveerd from Artikelen where ArtNR =" . $row['ArtNR'] . ";";
                $result6 = mysqli_query($con, $query6);
                while ($gereserveerd = mysqli_fetch_assoc($result6)) {
                    var_dump($gereserveerd);
                    //query die het aantal gereserveerd aanpast
                    $query5  = "update Artikelen
                            set ART_Gereserveerd ={$gereserveerd['ART_Gereserveerd']} + {$row['ING_Aantal']}
                            where ArtNR = {$row['ArtNR']};";
                }
            }
        }
        //de bestelling wordt verwijderd en je wordt door verwezen
        $_SESSION['bes'] = null;
        header("location: index.php?p=winkelwagen&res=success");
    }

    ?>
</div>