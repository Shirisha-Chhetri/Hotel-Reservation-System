<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="css/header.css">
	<title>Hotel System</title>
</head>
<body>
	 <div id ="sec1">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <ul class="nav">
                <li class="nav-item mr-0">
                 <a class="nav-link text-white" href="#"><i class="fa fa-phone"></i> Phone: 9803628448</a>
                  </li>
                <li class="nav-item mr-0">
                   <a class="nav-link text-white" href="#"><i class="fa fa-envelope"></i> Gmail: hoteldream@gmail.com</a>
                </li>
                <li class="nav-item mr-0">
                <a class="nav-link text-white" href="#"><i class="fa fa-map-marker"></i> Address: Chabahil, Kathmandu</a>
                </li>
            </ul>
          </div>
          <div class="col-md-2">
             <ul class="excess">
                <li><i class="fa fa-facebook"></i></li>
                <li><i class="fa fa-google"></i></li>
                <li><i class="fa fa-twitter"></i></li>
                <li><i class="fa fa-instagram"></i></li>
            </ul>
         </div>
        </div>
      </div>
    </div>

    <div id="sec2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <img src="image/logos.png" class="image1">
            <span class="name"> HOTEL DREAM</span>
          </div>
          <div class="col-md-4 echo">
                    
                  <?php
                  session_start();
                     if(isset($_SESSION['user1'])){
                      echo '<div>
                       <img src="image/human.png" class="header" onclick="myFunction()"> 
                          <div class="dropdown-content" id="myDropdown">
                            <a href="checkout.php"> My Reservation</a>
                            <a href="cancel.php"> Cancel Reservation</a>
                            <a href="logout.php">Logout</a>
                          </div>
                     </div>';
                      echo "Welcome! ".$_SESSION['user1'];
                    }
                    else{
                      echo '<form action="#" method="post" class="mt-4" id="login">
                        <button><a href="login.php">Log In</a></button>
                         <button><a href="signin.php">Sign Up</a></button>
                    </form>';
                    }
                   ?>   
                </div>
              </div>
            </div>
           </div>

  <div id ="sec3">
     <div class="container-fluid">
      <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-links active" href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-links" href="about.php">About</a>
  </li>
  <li class="nav-item">
    <a class="nav-links" href="room.php">Rooms</a>
  </li>
  <li class="nav-item">
    <a class="nav-links" href="booking.php">Reservation</a>
  </li>
  <li class="nav-item">
    <a class="nav-links" href="gallery.php">Gallery</a>
  </li>
  <li class="nav-item">
    <a class="nav-links" href="contact.php">Contact</a>
  </li>
</ul>
</div>
</div>

<script type="text/javascript">
  function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.header')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>