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
</head>
<body>
	<div id="sec">
	<div class="main1">
	<div class="row my-4">
		<div class="col-md-4">
			<h2 class="ml-5" align="center">Payment Details</h2>
		</div>
	</div>
	<?php
		 $ers=$ere="";
    
    if(isset($_POST['send'])){  
      $start = $_POST['startdate'];
      $end = $_POST['enddate'];
      $conn = new mysqli("localhost","root","","hotelsystem");

      $date = date('Y-m-d');
      if (empty($start)) {
        $ers= "Specify start date";
      }
      if($start>$date){
      	$ers= "Not valid date";
      }

      if (empty($end)) {
        $ere= "Specify end date";
      }
      if ($end<$start) {
         $ere = "Not valid date";
      }
      if($end>$date){
      	$ere = "Not valid date";
      }
      else{
      	$sql = "SELECT SUM(PAID_AMOUNT) as 'total' , status FROM reservations
      	WHERE RESERVED_DATE BETWEEN '$start' AND '$end'";

      	$result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        	if($row['status'] == 1){?>
        	<label class="label1">Total Amount: Rs:</label><?php echo $row['total'];
        		}
        		// else{
        		// 	echo "There is no transaction done";
        		// }
        	}
				}
			}
		}
      
	?>

	<form method="post" name="fill">
		<label class="label1">Start Date:</label>
		<input type="date" name="startdate"><span class="error"><?php echo $ers;?></span>

		<label class="label1">End Date:</label>
		<input type="date" name="enddate"><span class="error"><?php echo $ere;?></span>
		<button type="submit" class="button" name="send" onclick="return payment()">Submit</button><br>
		<br><br>
		
	</form>
	
		</div>
	</div>
</body>
</html>
<?php include('../../js.html');?>