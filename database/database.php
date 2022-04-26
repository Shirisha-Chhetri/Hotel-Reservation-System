<?php
	 require "connect.php";

	$sql = "CREATE DATABASE hotelsystem";
	if ($conn->query($sql)===TRUE) {
		echo "Database created successfully";
	}
	else{
		echo "Error creating databse: ".$conn->error;
	}
	$conn->close();
?>