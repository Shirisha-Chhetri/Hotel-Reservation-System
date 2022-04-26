<link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
<?php
  session_start();
   if (!isset($_SESSION['user'])) {
     header('location:login.php');
   }
       require "dashboard.php";
       ?>

<div class="main">
	<div class="row">
 	<div class="contact">
      <h2>Contact Details:</h2><br>
      <h5>Hotel Dream</h5>
      <p>Chabahil,Kathmandu</p>
      <p>Reception: 01-6654654,01-6654655</p>
      <p>Email:hoteldream@gmail.com</p>
  </div>
</div>
</div>