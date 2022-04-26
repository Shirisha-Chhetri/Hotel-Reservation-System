<?php
	$conn = new mysqli("localhost","root","","hotelsystem");

	$sql = "DROP table RESERVATIONS";

	if ($conn->query($sql)==TRUE) {
		echo "Table is deleted successfully";
	}
	else{
		echo "Error creating table: ".$conn->error;
	}
?>