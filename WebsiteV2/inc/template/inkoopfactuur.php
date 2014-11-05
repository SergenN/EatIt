<div class="content">
<?php
$query  = "select InkfNR, Inkf_Status, Bedrag, OrderNR, IngNR, LevNR, Aantal ";
$query .= "from Inkooporder o, Inkoopfactuur f ";
$query .= "where o.OrderNR = f.InkfNR; ";
$result = mysqli_query($con,$query);
if(!$result){
	die("Query failed");
}

while ($row = mysqli_fetch_assoc($result)) {
	echo "Factuurnummer: " . $row['InkfNR'] . "<br/>Factuurstatus: " . $row["Inkf_Status"] . "<br/>" . "Ordernummer: " . $row["OrderNR"] . "<br/>Bedrag: $" . $row["Bedrag"];
	echo "<br/>Leveranciernummer: " . $row["LevNR"] . "<br/>Ingredientnummer: " . $row["IngNR"] .  "<br/>Aantal: " . $row["Aantal"];
	echo "<hr/>";
}

?>
</div>