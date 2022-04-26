<link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
<style type="text/css">
  .error{
    color: red;
    margin-left: 1pc;
  }
</style>

      <?php 
      session_start();
   if (!isset($_SESSION['user'])) {
     header("Location: http://localhost/HOTEL/Admin/login.php");
   }
      require "dashboard.php";
    $conn = new mysqli("localhost","root","","hotelsystem");
    $erim="";
    if (isset($_POST['uploadimage'])) {
      $image1 = $_FILES['ima1']['name'];
      $image2 = $_FILES['ima2']['name'];

  $target_dir = "Uploads/";
  $target_file = $target_dir.basename($_FILES['ima1']['name']);
  $target_file1 = $target_dir.basename($_FILES['ima2']['name']);
  $uploadOk = 1;
  $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $imagefiletype1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
   if (empty($_FILES['ima1']['name']) && empty($_FILES['ima2']['name'])) {
      $erim = "Image is not choosen";
    }
    # check if file already exists
  else if (file_exists($target_file) || file_exists($target_file1)) {
    $erim = "Sorry, file already exists.";
    $uploadOk = 0;
  }
  //check file size
  else if (($_FILES["ima1"]["size"] > 5000000) || ($_FILES["ima2"]["size"] > 5000000)) {
    $erim ="Sorry, your file is too large";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
   else if ($uploadOk == 0) {
   $erim ="Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else {
      if ((move_uploaded_file($_FILES["ima1"]["tmp_name"], $target_file)) && (move_uploaded_file($_FILES["ima2"]["tmp_name"], $target_file1)))  {
       $sql="INSERT INTO gallerys(image1,image2) 
      VALUES('$image1','$image2')";
          if ($conn->query($sql)==TRUE) {
              echo '<script>alert("Image is added");
              window.location="image.php";</script>';
            }
            else{
              echo "Error creting table: ".$conn->error;
            }
      } 
    else {
    $erim = "Sorry, there was an error uploading your file.";
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
        <span style="font-size:22px;"><b>Add Image</b></span><br><br>

        Image1:<input class="form-control" type="file" name="ima1" accept="image/*"><br>
        
        Image2:<input class="form-control" type="file" name="ima2" accept="image/*"><br>  
        <span class="error"><?php echo $erim;?></span><br>
        
        <button type="submit" class="btn btn-block btn-primary my-3" name="uploadimage" onclick=" return image()">Add New Image</button>
      </div> 
     </form>
  </div>
</div>
</div>
</div>

<?php include('../../js.html');?>