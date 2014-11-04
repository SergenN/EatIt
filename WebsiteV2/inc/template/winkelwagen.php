
<?php 

//redirect functie wordt gedefineerd
function redirect_to($new_location)
	{header("location: " . $new_location); 
	exit;}
?>
<div class="content">
<?php
if(isset($_SESSION['order'])){
	//alle orders die zijn aangevinkt worden weergegeven	
	foreach ($_SESSION['order'] as $value) {
		if(isset($i)){} else {$i = 0;}
		echo "$value";
		echo "	<form action=\"\" method=\"post\">
					<input type=\"submit\" name=\"delete". $i. "\" value=\"verwijderen\" />
				</form>";
		echo "<hr/>";
		$i = $i+1;
	}
} else {
	echo "Je hebt nog geen gerechten besteld";
}
if(isset($i)){
	if(isset($_POST["delete$i"])){
		$_SESSION["order[$i]"] = null;
	}
}
?>
<form action="" method="post">
	<?php 	if(isset($_SESSION['order'])) {
				echo"<input type=\"button\" name=\"confirm\" value=\"bevestigen\"/>";
			} ?>
	<input type="submit" name="back" value="terug naar bestellen"/>
</form>
</div>
<?php
//als er op bevestigen wordt gedrukt wordt de bestelling ingevoerd in de database
if (isset($_POST["confirm"]) == "bevestigen ") {
	$query  = "insert into Bestelling ";
	$query .= "(KlantNR, Best_Datum, Status) ";
	$query .= "values (" . $_SESSION['klantnr'] . " ,str_to_date(d-m-Y, " . date('d-m-Y ') . "), 'besteld'); ";
	$result = mysqli_query($connection, $query);
	if(!$result){
		die("database query failed" . mysqli_error());
	}
	
	$query2  = "insert into AantalVerkocht ";
	$query2 .= "(GerNR, Aantal) ";
	$query2 .= "values (" . $_SESSION['gernr'] . " , " . $_SESSION['aantal'] . ") ";
	$query2 .= "where BestNR = (select LAST_INSERT_ID()  from bestelling); ";
	$result2 = mysqli_query($connection, $query2);
	if(!$result2){
		die("database query failed" . mysqli_error());
	}
	}
//als de bestelling veranderd moet worden dan kan men op terug drukken en wordt er terugverwezen naar de bestelpagina
if (isset($_POST["back"]) == "terug naar bestellen"){
	$new_location = "?p=bestellen";
	redirect_to($new_location);
}


?>
