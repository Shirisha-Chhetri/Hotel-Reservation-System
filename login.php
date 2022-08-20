<?php include('header2.html');?> 
<link rel="stylesheet" type="text/css" href="css/log.css">

    <?php
     $err=$errors="";
     session_start();
      if(isset($_POST['submit'])){
       $username = $_POST['username'];
       $password = base64_encode($_POST['password']);

       if(empty($_POST['password']) || empty($_POST['username'])){
        $err="Cannot be empty.";
      }
      else{
          $conn =new mysqli('localhost','root', '','hotelsystem');

       $sql="SELECT * FROM customers WHERE username='$username' AND password='$password'";

        $result= $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
         if(mysqli_num_rows($result)>0){
          
          $_SESSION['user1']=$username;
          $_SESSION['customerID'] = $row['CUS_ID'];
          header("location: home.php");
          }
        else{
        $errors = "username or password is invalid.";
        }
      }  
}
        ?>

	  	<div id="sec4">
      <div class="container">
      <div class="col-md-12">
		<form method="POST" action="" name="fill">
		<h1 class="head">WELCOME!</h1>
		<img class="image" src="image/human.png" name="icon">
		<input type="text" name="username" id="user" placeholder="USERNAME" required/>
    <span class="error"><?php echo "$err"; ?></span><br> 

		<input type="password" name="password" id="password" placeholder="PASSWORD" required/>
    <i class="fa fa-eye" id="togglePassword"></i>
    <span class="error"><?php echo "$err";?></span><br><br>

		<button name="submit" id="log" value="login" onclick="return login()">Log In</button><br>

    <p class="error" style="text-align: center;"><?php echo "$errors";?></p> 
    <p id="register">Don't have an account?<a href="signin.php">Sign up</a></p>
</form>
</div>
</div>
</div>

  <script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye icon
    this.classList.toggle('fa-eye-slash');
});
    function login(){
      User = document.fill.username.value;
      Pass = document.fill.password.value;

      if(User == ""){
        alert("Please enter username");
        return false;
      }
      if(Pass == ""){
        alert("Please enter password");
        return false;
      }
      if(Pass.length<5){
        alert("password must be greater than 5");
        return false;
      }
      return true;
    }
  </script>


<?php include('footer.html');?>