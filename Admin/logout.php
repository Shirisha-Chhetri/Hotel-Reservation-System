<?php
	session_start();
	//session related to username from login of admin panel
	if (isset($_SESSION['user'])) {
		session_destroy();
		header("location: login.php");
	}
?>