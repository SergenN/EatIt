<div class="content">
<?php
//redirect functie wordt gedefineerd
function redirect_to($new_location)
{header("location: " . $new_location); 
exit;}
	echo "U heeft besteld";
?>
<form action="" method="post">
	<input type="submit" name="back" class="button" value="terug naar bestellen"/>
</form>
<?php 
if(isset($_POST['back'])){
	redirect_to("?p=bestellen");
}
?>
</div>