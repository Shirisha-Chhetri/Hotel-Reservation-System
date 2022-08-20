<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<body>
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
               $sql="SELECT * FROM admins WHERE username='$username' AND password='$password'";

                $result= $conn->query($sql);

                 if($result !== false && mysqli_num_rows($result)>0  ){  
                  $_SESSION['user']=$username;
                    header("location:home.php");
                  }
                else{
                $errors = "username or password is invalid.";
                }
              }
          }      
        ?>
         
	  	<div id="sec4">
      <div class="col-md-12">
		<form method="POST" action="" name="fill">
		<h1 class="head">WELCOME!</h1>
		<img class="image" src="../image/human.png" name="icon">
		<input type="text" name="username" id="user" placeholder="USERNAME">
    <span class="error"><?php echo "$err"; ?></span><br> 

		<input type="password" name="password" id="pass" placeholder="PASSWORD" autocomplete="on">
    <span class="error"><?php echo "$err";?></span><br><br>
		<button name="submit" id="login" value="login" onclick="return login1()">Log In</button><br>

    <p class="error" style="text-align: center;"><?php echo "$errors";?></p><br> 
</form>
</div>
</div>
<script type="text/javascript">
  function login1(){
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
</body>
</html>