<?php
	session_start();
	//session related to username from login
	if (isset($_SESSION['user1'])){
		session_destroy();
		header("location:login.php");
	}
?>