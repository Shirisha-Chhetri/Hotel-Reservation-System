 <?php include('header2.html');?> 
<link rel="stylesheet" type="text/css" href="css/signin.css">
	   
     <?php
    $erfn=$erln=$erem=$erus=$erpa="";
    if(isset($_POST['submit'])){
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = base64_encode($_POST['password']);

      $conn = new mysqli("localhost","root","","hotelsystem");

        if (empty($fname)) {
          $erfn= "firstname cannot be empty";
        }
        if (empty($lname)) {
          $erln= "Lastname cannot be empty";
        }
        if (empty($email))  {
          $erem= "Email cannot be empty";
        }
         if (empty($username)) {
          $erus= "Username cannot be empty";
        }
        if (empty($password)) {
          $erpa= "Password is not written";
        }
         if (is_numeric($fname)) {
              $erfn= "firstname cannot be numeric";
            }
          if (is_numeric($lname)) {
              $erln= "lastname cannot be numeric";
            }
        
            
          if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $erem="Email is not in format";
          }
          
          if(strlen($password)<=5){
            $erpa= "Password must be greater than 5 characters";
          } 
          
        else{
          $query ="SELECT * from customers WHERE username='".$username ."' LIMIT 1 ";
          $result = mysqli_query($conn,$query) or die(mysqli_error($conn));

          $query1 ="SELECT * from customers WHERE email='".$email."' LIMIT 1 ";
          $result1=mysqli_query($conn,$query1) or die(mysqli_error($conn));
          if($result && $result1 && $fname && $lname && $password){
             //for unique username
       
          // if (is_numeric($fname)) {
          //     $erfn= "firstname cannot be numeric";
          //   }
          // if (is_numeric($lname)) {
          //     $erln= "lastname cannot be numeric";
          //   }
        
          //   //if value becomes greater than 0 it means tha data in the row of username is not unique
          if (mysqli_num_rows($result)>0) {
          $erus="Sorry! This Username is not available.Please choose another";
          }
          // if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          //  $erem="Email is not in format";
          // }
          if (mysqli_num_rows($result1)>0) {
          $erem="Sorry! Email is not unique";
          }
          
      
          else{
          $sq = "INSERT INTO CUSTOMERS(firstname,lastname,email,username,password)
          VALUES('$fname','$lname','$email','$username','$password')";
            if($conn->query($sq)==TRUE){
              echo "<script>alert('Signin successfully');window.location='login.php';</script>";
                }
              else{
                  "Error".$sq."<br>".$conn->error;
            } 
          }
        }
      }
    }
  ?>   
    
 		<div id="sec4">
 		<div class="col-md-12">
		<p class="heading">WELCOME !</p>
		<img class="image" src="image/human.png" name="icon">
		<form class="sign" name="sign" method="POST" action="">
	
		<label>First Name:<input type="text" name="fname" id="namef"><br>
      <span class="error"><?php echo $erfn;?></span><br></label>
		<label>Last Name: <input type="text" name="lname" id="namel"><br>
      <span class="error"><?php echo $erln;?></span><br></label>
    <label>Username: <input type="text" name="username" id="user"><br>
     <span class="error"><?php echo $erus;?></span><br></label>
    <label>Password: <input type="password" name="password" id="pass"><br>
      <span class="error"><?php echo $erpa;?></span><br></label>

		<label>Email: <input type="text" name="email" id="email"><br>
      <span class="error"><?php echo $erem;?></span><br></label>
		
		<button name="submit" id="signin" value="signin" onclick="return signup()">Sign Up</button><br><br>
    <p class="login">Already have an account? <a href="login.php">Login</a></p>
		</form>
	</div>
</div>
<?php include('js.html');?>
<?php include('footer.html') ;?>