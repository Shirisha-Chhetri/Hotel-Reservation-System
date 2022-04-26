<?php 
	session_start();
   if (!isset($_SESSION['user'])) {
     header('location: http://localhost/HOTEL/Admin/login.php');
   }
	require "dashboard.php";?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../..//bootstrap/bootstrap.min.css">
</head>
<style type="text/css">
	.myima{
		height:15pc;
		width:20pc;
	}
	.error{
		color: red;
	}
</style>
<body>
	<?php 
		$erna=$erd=$erp=$ert="";
		$conn = new mysqli("localhost","root","","hotelsystem");
		$room = $_GET['roomedit'];
		$sql = "SELECT * FROM rooms WHERE ROOM_ID=$room";
		$result = $conn->query($sql);

		if (isset($_POST['update'])) {
			//for 1st image
			$old_image = $_POST['first'];
		$new_image = $_FILES['image1']['name']??"" ;

		if ($new_image !="") {
 			$updated = $new_image;
 		}
 		else{
 			$updated = $old_image;
 		}

		#for second image
		$old_image1 = $_POST['second'];
		$new_image1 = $_FILES['image2']['name']??"";	
 		
 		if ($new_image1 !="") {
 			$updated1 = $new_image1;
 		}
 		else{
 			$updated1 = $old_image1;
 		}

			$name = $_POST['name'];
			$describe = $_POST['description'];
			$total = $_POST['number'];
			$price = $_POST['price'];

	   if (empty($name)) {
        $erna= "Room type cannot be empty";
      }
      if (is_numeric($name)) {
          $erna= "Room type cannot be numeric";
       }
       
       if (!is_numeric($price)) {
          $erp= "Price cannot be in characters";
       }
       
      if (empty($price)) {
          $erp= "Price cannot be empty";
        }
        if($price<= 4000){
        $erp= "Price must be greater than 4000.";
       }
      if (!is_numeric($total)) {
          $ert= "Total rooms cannot be in characters";
       }
       
        if($total<15 || $total>30){
        $ert= "Room must be greater than 15 or less than 30.";
       }
      if (empty($total)) {
          $ert= "Total rooms cannot be empty";
        }
     if (empty($describe)) {
        $erd= "Description cannot be empty";
      }
 			else{
 				 if ($name && $describe && $price && $room ) {

 			$uproom = "UPDATE rooms SET ROOM_TYPE='{$name}',DESCRIPTION='{$describe}',PRICE='{$price}',TOTAL_ROOM='{$total}',IMAGE1='{$updated}',IMAGE2='{$updated1}' WHERE ROOM_ID=$room";
			$result = mysqli_query($conn,$uproom);
			
 			if($result){
				if($new_image != ''){
				if($new_image != $old_image){
					move_uploaded_file($_FILES['image1']['tmp_name'],"upload/".$new_image);
					unlink("upload/".$old_image);	
				}
			}
				if($new_image1 != ''){
					if($new_image1 != $old_image1){
				move_uploaded_file($_FILES['image2']['tmp_name'],"upload/".$new_image1);
				unlink("upload/".$old_image1);
						}
					}
				//}
				?>
			<script type="text/javascript">
					alert("room is updated");
					window.location="user.php";
				</script>

				<?php
			}
    		
					}
			// 		else{
			// 	echo '<script type="text/javascript">
			// 		alert(" Images are not updated");
			// 	</script>';
			// }
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

				Room_Type: <input class="form-control" type="text" name="name" value="<?php echo $row['ROOM_TYPE'];?>">
				<span class="error"><?php echo $erna;?></span><br>
				Description: <input class="form-control" type="text" name="description" value="<?php echo $row['DESCRIPTION'];?>"><span class="error"><?php echo $erd;?></span><br>
				Price:<input class="form-control" type="text" name="price" value="<?php echo $row['PRICE'];?>"><span class="error"><?php echo $erp;?></span><br>
				Total Room:<input class="form-control" type="text" name="number" value="<?php echo $row['TOTAL_ROOM'];?>"><span class="error"><?php echo $ert;?></span><br>

				Image1:
				<input class="form-control" type="file" name="image1" accept="image/*"><br>
				<input type="text" name="first" value="<?php echo $row['IMAGE1'];?>" >
				<img src="rooms/<?php echo $row['IMAGE1'];?>" class="myima">	<br><br>
				Image2: 
				<input class="form-control" type="file" name="image2" accept="image/*"><br>
				<input type="text" name="second" 	value="<?php echo $row['IMAGE2'];?>">
				<img src="rooms/<?php echo $row['IMAGE2'];?>" class="myima"><br><br>

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