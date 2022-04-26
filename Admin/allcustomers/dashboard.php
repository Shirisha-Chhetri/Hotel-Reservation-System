<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../fontawesome/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="../css/dash.css">
  <title>Hotel System</title>
</head>
<body>
    <div id="sec2" class="position-fixed">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <img src="../../image/logos.png" class="image1">
          <p class="name"> HOTEL DREAM</p>
          </div>
            <div class="col-md-3 my-3 echo">
                    
                  <?php
                    if(isset($_SESSION['user'])){
                      echo "Welcome!".$_SESSION['user'];
                      echo '<div>
                        <img src="../../image/human.png" class="dropbtn" onclick="myFunction()"> 
                          <div class="dropdown-content" id="myDropdown">
                            <a href="../logout.php">Logout</a>
                          </div>
                        </div>';
                    }
                    else{
                      header('location: http://localhost/HOTEL/Admin/login.php');
                    }
                   ?>   
                </div> 
              </div>
            </div>
           </div>

           <div id="sec3">
            <div class="container">
              <div class="row">
            <div class="col-md-3">
           <div class="sidenav">
            <a href="../home.php"><i class="fa fa-fw fa-home"></i>Home</a>
            <a href="../allrooms/user.php"><i class="fa fa-fw fa-bed"></i>Rooms</a>
            <a href="../allimages/image.php"><i class="fa fa-fw fa-image"></i>Images</a>
             <a href="customer.php"><i class="fa fa-fw fa-users"></i>Customers</a>
            <a href="../contact.php"><i class="fa fa-fw fa-envelope"></i>Contact</a>
            <a href="detail.php">Customer Report</a>
           <!--  <a href="payment.php">Payment Report</a> -->
        </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
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
</body>
</html>