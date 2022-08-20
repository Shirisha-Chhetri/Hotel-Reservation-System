	<?php
	session_start();
   if (!isset($_SESSION['user'])) {
     header('location: http://localhost/HOTEL/Admin/login.php');
   }
    include('dashboard.php');?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../../bootstrap/bootstrap.min.css">
</head>
<style type="text/css">
	.myima{
		height:15pc;
		width:20pc;
	}
</style>
<body>
	<?php 
	$erim="";
		$conn = new mysqli("localhost","root","","hotelsystem");
		$image = $_GET['imageedit'];
		$sql = "SELECT * FROM gallerys WHERE IMG_ID=$image";
		$result = $conn->query($sql);

		if (isset($_POST['update'])) {
			//for 1st image
		$old_image = $_POST['first'];
		$new_image = $_FILES['image1']['name']??"" ;

		if ($new_image != '') {
 			$updated = $new_image;
 		}
 		else{
 			$updated = $old_image;
 		}

		#for second image
		$old_image1 = $_POST['second'];
		$new_image1 = $_FILES['image2']['name']??"";	
 		
 		if ($new_image1 !='') {
 			$updated1 = $new_image1;
 		}
 		else{
 			$updated1 = $old_image1;
 		}
 		if($updated && $updated1){
 			if ($new_image !=='' && $new_image1 !==''){
 			$update = "UPDATE gallerys SET IMAGE1='{$updated}',IMAGE2='{$updated1}' WHERE IMG_ID = $image";
			$result = mysqli_query($conn,$update);
			
 			if ($result) {
				if ($new_image != ''){
				if($new_image != $old_image){
					move_uploaded_file($_FILES['image1']['tmp_name'],"uploads/".$new_image);
					unlink("uploads/".$old_image);	
				}
			}
				if($new_image1 != ''){
					if($new_image1 != $old_image1){
				move_uploaded_file($_FILES['image2']['tmp_name'],"uploads/".$new_image1);
				unlink("uploads/".$old_image1);
			}
			}
		}?>
			<script type="text/javascript">
					alert("image is updated");
					window.location="image.php";
				</script>
				<?php
			}
			else{
				echo '<script type="text/javascript">
					alert(" Images are not updated");
				</script>';
			}
			}
		}
 ?>

		<div id="sec">
		<div class="main">
		<div class="row my-5">
			<div class="col-md-4 offset-md-4">

			<?php 
	        if($result !== false && $result->num_rows>0){
	        while($row = $result->fetch_assoc()){  ?>

				<form method="post" action="" enctype="multipart/form-data">
					<div class="form-group">

				<span style="font-size:22px;"><b>Update Rooms</b></span><br><br>
				Image1:
				<input class="form-control" type="file" name="image1" accept="image/*"><br>
				<input type="text" name="first" value="<?php echo $row['IMAGE1'];?>">
				<img src="image/<?php echo $row['IMAGE1'];?>" class="myima"><br><br>

				Image2:
				<input class="form-control" type="file" name="image2" accept="image/*"><br>
				<input type="text" name="second" value="<?php echo $row['IMAGE2'];?>">
				<img src="image/<?php echo $row['IMAGE2'];?>" class="myima"><br><br>

				<button type="submit" class="btn btn-block btn-primary my-3" name="update">Update</button>
					</div> 
				 </form>
				<?php 
			}
		}	
			$conn->close();
			?>
			</div>
		</div>
	</div>
</div>
</body>
</html>