<link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
<style type="text/css">
	.error{
		color: red;
	}
</style>

<?php
    session_start();
   if (!isset($_SESSION['user'])) {
     header('location: http://localhost/HOTEL/Admin/login.php');
   }
    include("dashboard.php");
    $conn = new mysqli("localhost","root","","hotelsystem");
    $erna=$erd=$ern=$erp=$erim="";
  
	 if(isset($_POST['addroom'])){	
	    $name = $_POST['name'];
      $describe = $_POST['description'];
      $num = $_POST['number'];
      $price = $_POST['price'];

      if (empty($name)) {
        $erna= "Room type cannot be empty";
      }
      if (empty($price)) {
          $erp= "Price cannot be empty";
      }
       if (empty($num))  {
        $ern= "No. of rooms cannot be empty";
      }
      if (empty($describe)) {
        $erd= "Description cannot be empty";
      }
    
    $image1 = $_FILES['pic1']['name']??"";
    $image2 = $_FILES['pic2']['name']??"";
 
  $target_dir = "upload/";
  $target_file = $target_dir.basename($image1);
  $target_file1 = $target_dir.basename($image2);
  $uploadOk = 1;
  $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $imagefiletype1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
   if (empty($image1) && empty($image2)) {
      $erim = "Image is not choosen";
      $uploadOk = 0;
    }
    # check if file already exists
  else if (file_exists($target_file) || file_exists($target_file1)) {
    $erim = "Sorry, image already exists.";
    $uploadOk = 0;
  }
  //check file size
  else if (($_FILES["pic1"]["size"] > 5000000) || ($_FILES["pic2"]["size"] > 5000000)) {
    $erim ="Sorry, your file is too large";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
   else if ($uploadOk == 0) {
   $erim ="Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else {
    if($name && $describe && $price){
        if (is_numeric($name)) {
          $erna= "Room type cannot be numeric";
       }
       if (!is_numeric($price)) {
          $erp= "Price cannot be in characters";
       }
       else if($price<= 2000){
        $erp= "Price must be greater.";
       }
     else{
      if ((move_uploaded_file($_FILES["pic1"]["tmp_name"]??"", $target_file)) && (move_uploaded_file($_FILES["pic2"]["tmp_name"]??"", $target_file1)))  {
       
      $sql="INSERT INTO Rooms(room_type,description,price,total_room,image1,image2) 
      VALUES('$name','$describe','$price','$num','$image1','$image2')";

      if ($conn->query($sql)==TRUE) {
          echo '<script>alert("Rooms is added");
          window.location="user.php";</script>';
        }
        else{
          echo "Error creting table: ".$conn->error;
          }
        } 
      }
    }
  }
}    
?>

<div id="sec">
<div class="main">
<div class="row my-5">
	<div class="col-md-4 offset-md-4">
		<form method="post" action="" name="sign" enctype="multipart/form-data">
			<div class="form-group">

				<span style="font-size:22px;"><b>Add Rooms</b></span><br><br>
			  Room_Type: <input class="form-control" type="text" name="name">
        <span class="error"><?php echo $erna;?></span><br>
				Description: <input class="form-control" type="text" name="description"><span class="error"><?php echo $erd;?></span><br>
				Price:<input class="form-control" type="text" name="price"><span class="error"><?php echo $erp;?></span><br>
        Total Rooms:<input class="form-control" type="text" name="number"><span class="error"><?php echo $ern;?></span><br>

				Image1:<input class="form-control" type="file" name="pic1" accept="image/*">

				Image2:<input class="form-control" type="file" name="pic2" accept="image/*">
        <span class="error"><?php echo $erim;?></span><br>

				<button type="submit" class="btn btn-block btn-primary my-3" name="addroom" onclick="return add()">Add New Room</button>
			</div> 
		 </form>
	</div>
</div>
</div>
</div>
<?php include('../../js.html');?>