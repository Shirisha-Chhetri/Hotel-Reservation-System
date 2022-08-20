<?php 
	session_start();
   if (!isset($_SESSION['user'])) {
     header('location:http://localhost/HOTEL/Admin/login.php');
   }
		$image = intval($_GET['imagedelete']);
        require "dashboard.php";
		$conn = new mysqli("localhost","root","","hotelsystem");

		$sq = "SELECT * FROM gallerys WHERE img_id = $image ";
		$result1 = mysqli_query($conn,$sq);
		$row = mysqli_fetch_assoc($result1);
		unlink("uploads/".$row['IMAGE1']);
		unlink("uploads/".$row['IMAGE2']);


		$sql = "DELETE FROM gallerys WHERE img_id = $image";
		
		$result = mysqli_query($conn,$sql);
		if ($result) {?>
		 	<script type="text/javascript">
				alert("image is deleted");
				window.location="image.php";
			</script>
			<?php
		}
		?>