<?php
		session_start();
   if (!isset($_SESSION['user'])) {
     header('location: http://localhost/HOTEL/Admin/login.php');
   }
   		$reserve = intval($_GET['reservationdelete']);
   		$customer = $_SESSION['CUS_ID'];
           
    require "dashboard.php";
		$conn = new mysqli("localhost","root","","hotelsystem");

		$sq = "SELECT * FROM reservations WHERE res_id = $reserve";
		$result1 = mysqli_query($conn,$sq);
		$row = mysqli_fetch_assoc($result1);
		$sql = "DELETE FROM reservations WHERE res_id = $reserve";
		$result = mysqli_query($conn,$sql);
		
		if ($result) {?>
			<script type="text/javascript">
				alert("customer detail is deleted");
				window.location="customer.php";
			</script>
			<?php
			}
?>