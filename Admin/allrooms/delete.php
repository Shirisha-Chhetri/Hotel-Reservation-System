	<?php
		session_start();
   if (!isset($_SESSION['user'])) {
     header('location: http://localhost/HOTEL/Admin/login.php');
   }
   		$room = intval($_GET['roomdelete']);
		$conn = new mysqli("localhost","root","","hotelsystem");

		$sq = "SELECT * FROM rooms WHERE room_id = $room";
		$result1 = mysqli_query($conn,$sq);
		$row = mysqli_fetch_assoc($result1);
		unlink("upload/".$row['IMAGE1']);
		unlink("upload/".$row['IMAGE2']);

		$sql = "DELETE FROM rooms WHERE room_id = $room";
		$result = mysqli_query($conn,$sql);
		if ($result) {?>
			<script type="text/javascript">
				alert("room is deleted");
				window.location="user.php" ;
			</script>
				<?php
			}
?>