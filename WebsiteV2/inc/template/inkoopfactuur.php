<div class="content">
<?php
if(isset($_GET['res'])){
    echo '<center>';
    if($_GET['res'] == 'failed'){
        echo '<center><div class="error">Kon object niet wijzigen!</div></center>';
    } else if ($_GET['res'] == 'success'){
        echo '<center><div class="success">Bestelorder is geplaatst.</div></center>';
    }
    echo '</center>';
}

if(isset($_GET['nummer'])){

    $levNr = $_GET['nummer'];
    $query1 = "SELECT * FROM Inkoopfactuur if JOIN Inkooporder io ON io.LevNR = if.InkfNR JOIN Bestelorder bo ON bo.OrderNR = io.OrderNR JOIN Artikelen a ON a.ArtNR = bo.ArtNR WHERE if.InkfNR = $levNr;";
    $result = mysqli_fetch_assoc(mysqli_query($con, $query1));
    if(mysqli_error($con) || empty($result)){
        header('location: index.php?p=inkoopfacatuur&res=failed');
    }

    $artNR = $result['ArtNR'];
    $newTV = $result['TechnischeVoorraad'] + ['Aantal'];
    $newIB = $result['InBestelling'] - ['Aantal'];

    $query2 = "UPDATE Artikelen SET TechnischeVoorraad=$newTV, InBestelling=$newIB WHERE ArtNR = $artNR;";
    mysqli_query($con, $query2);
    if(mysqli_error($con)){
        header('location: index.php?p=inkoopfacatuur&res=failed');
    }

    $query3 = "UPDATE Inkoopfactuur SET Inkf_Status='geleverd' WHERE InkfNR = $levNr;";
    mysqli_query($con, $query3);
	header('location: index.php?p=inkoopfacatuur&res=success');
}

$query  = "select InkfNR, Inkf_Status, Bedrag, OrderNR, IngNR, LevNR, Aantal ";
$query .= "from Inkooporder o, Inkoopfactuur f ";
$query .= "where o.OrderNR = f.InkfNR ORDER BY Inkf_Status ASC; ";
$result = mysqli_query($con,$query);
if(!$result){
    header('location: index.php?p=inkoopfacatuur&res=failed');
}

while ($row = mysqli_fetch_assoc($result)) {
	echo "Factuurnummer: " . $row['InkfNR'] . "<br/>Factuurstatus: " . $row["Inkf_Status"] . "<br/>" . "Ordernummer: " . $row["OrderNR"] . "<br/>Bedrag: €" . $row["Bedrag"];
	echo "<br/>Leveranciernummer: " . $row["LevNR"] . "<br/>Ingredientnummer: " . $row["IngNR"] .  "<br/>Aantal: " . $row["Aantal"];

	if($row['Inkf_Status'] == 'besteld'){ 
		echo "<br><br><a href=\"?p=inkoopfactuur&nummer=" . $row["InkfNR"] . "\"> ^ Aftekenen</a><br><br>";
	}

	echo "<hr/>";
}

?>
</div>