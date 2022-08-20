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
			<h2 class="ml-5">Cutsomer Details</h2>
		</div>
	</div>

	<form method="post" name="fill">
		<label class="label1">Enter Customer_Id:</label>
		<input type="text" name="customer">
		<button type="submit" class="button" name="send" onclick="return detail()">Submit</button><br>
		<br><br>
	</form>
	<!-- 	<h3 class="ml-5" align="center">Generated Report</h3><br>
		<table class="table table-sm" border="2">
  	<thead>
    <tr>
      <th>S.N.</th>
			<th scope="col">FullName</th>
			<th scope="col">Email</th>
			<th scope="col">Contact</th>
			<th scope="col">Room_Type</th>
			<th scope="col">No. of Rooms</th>
			<th scope="col">Check_In</th>
			<th scope="col">Amount</th>
			<th scope="col">Transaction_Id</th>
			<th scope="col">Status	</th>
			<th scope="col">Delete</th>
    </tr>
  </thead>
 -->
		<?php 
		$conn = new mysqli("localhost","root","","hotelsystem");
          if(isset($_POST['send'])){
					$cus=$_POST['customer'];

					if(empty($cus)){
						echo "Please fill id number";
					}
					else if(!is_numeric($cus)){
						echo "Id must be in number";
					}
					?>
						<h3 class="ml-5" align="center">Generated Report</h3><br>
		<table class="table table-sm" border="2">
  	<thead>
    <tr>
      <th>S.N.</th>
			<th scope="col">FullName</th>
			<th scope="col">Email</th>
			<th scope="col">Contact</th>
			<th scope="col">Room_Type</th>
			<th scope="col">No. of Rooms</th>
			<th scope="col">Check_In</th>
			<th scope="col">Amount</th>
			<th scope="col">Transaction_Id</th>
			<th scope="col">Status	</th>
			<th scope="col">Delete</th>
    </tr>
  </thead>

					<?php
         $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) AS name, c.email, r.* ,ro.room_type, ro.	price,c.cus_id
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          WHERE r.customer_id = $cus";
          
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {?>
      
    <tbody>
			<tr>
			 <td class="td"><?php echo $row['RES_ID'];?></td>
			 <td class="td"><?php echo $row['name']; ?></td>
			 <td class="td"><?php echo $row['email']; ?></td>
			 <td class="td"><?php echo $row['CONTACT']; ?></td>
			 <td class="td"><?php echo $row['room_type']; ?></td>
			 <td class="td"><?php echo $row['NUMBER_OF_ROOMS']; ?></td>
			 <td class="td"><?php echo $row['CHECK_IN']; ?></td>
			 <td class="td"><?php echo $row['PAID_AMOUNT']; ?></td>
			 <td class="td"><?php echo $row['TRANSACTION_ID']; ?></td>
			 <td class="td"><?php echo $row['STATUS']; ?></td>
			 
			 <td class="td"><a href="delete.php?reservationdelete=<?php echo 
			 $row["RES_ID"]?>"><i class="fa fa-fw fa-trash"></i> Delete</a>
			 </td>
			</tr>
		</tbody>
	
					<?php
							}
						}
						else{
							 echo "<script>alert('The respective customer_id is not present');window.location='detail.php';</script>";
						}
					}
				?>
				</table>
		</div>
	</div>
</body>
</html>
<?php include('../../js.html');?>