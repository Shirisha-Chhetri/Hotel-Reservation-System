<?php
	session_start();
   if (!isset($_SESSION['user'])) {
     header('location:login.php');
   }
     require "dashboard.php";
     ?>

<div class="main">
	<p class="p"><u>Dashboard</u></p>
	<h1 class="welcome">Welcome To Hotel Dream!</h1>
</div>