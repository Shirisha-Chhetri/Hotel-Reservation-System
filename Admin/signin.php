<link rel="stylesheet" type="text/css" href="css/signin.css">
	   
     <?php
    $erfn=$erph=$erem=$erus=$erpa="";
    if(isset($_POST['submit'])){
      $fname = $_POST['fname'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = base64_encode($_POST['password']);

      
      $conn = new mysqli("localhost","root","","hotelsystem");

      //for unique username
       $query ="SELECT * from admins WHERE username='" . $username . "' LIMIT 1 ";
      $result=mysqli_query($conn,$query) or die(mysqli_error($conn));


      if (empty($fname)) {
        $erfn= "firstname cannot be empty";
      }
      if (empty($phone)) {
        $erph= "Contact cannot be empty";
      }
      else if (!is_numeric($phone)) {
          $erph = "Must be of numbers";
        }
      else if (!strlen($phone)>10) {
          $erph = "Must be 10 numbers";
        }

      if (empty($email))  {
        $erem= "Email cannot be empty";
      }
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $erem= "Email must be in proper format<br>";
        }
      
       if (empty($username)) {
          $erus= "Username cannot be empty";
        }
        if (empty($password)) {
          $erpa= "Password is not written";
        }
        else if(strlen($password)<5){
            $erpa= "Password must be greater than 5 characters";
          }

          //if value becomes greater than 0 it means tha data in the row of username is not unique
       if (mysqli_num_rows($result)>0) {
        $erus="Sorry! This Username is not available.Please choose another";
      }
      

    else{
      if($username && $email && $fname && $phone && $password){
       $sql = "INSERT INTO admins(fullname,phone,email,username,password)
       VALUES ('$fname','$phone','$email','$username','$password')";

      
    if ($conn->query($sql) === TRUE) {
     echo "New record created successfully";
   }
    else{
     echo "Error";
    }
  }
}
  $conn->close();
    }
  ?>   
    
 		<div id="sec4">
		<p class="heading">WELCOME !</p>
		<img class="image" src="../image/human.png" name="icon">
		<form class="sign" name="sign" method="POST" action="">
	
		<label>Full Name:<input type="text" name="fname" id="namef"><br>
      <span class="error"><?php echo $erfn;?></span><br></label>
		<label>Phone: <input type="text" name="phone" id="namel"><br>
      <span class="error"><?php echo $erph;?></span><br></label>
    <label>Username: <input type="text" name="username" id="user"><br>
     <span class="error"><?php echo $erus;?></span><br></label>
    <label>Password: <input type="password" name="password" id="pass"><br>
      <span class="error"><?php echo $erpa;?></span><br></label>
		<label>Email: <input type="email" name="email" id="email"><br>
      <span class="error"><?php echo $erem;?></span><br></label>
		
		<button name="submit" id="signin" value="signin" onclick="return userinput()">Sign Up</button><br><br>
    <p class="login">Already have an account? <a href="login.php">Login</a></p>
		</form>
	</div>
  <?php include('../js.html');?>