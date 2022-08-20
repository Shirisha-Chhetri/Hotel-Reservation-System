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
			<h2 class="ml-5">All Cutsomers</h2>
		</div>
	</div>
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
        $conn = new mysqli("localhost","root","","hotelsystem");
        $limit = 3;
     	if (isset($_GET['page'])) {
     		$page = $_GET['page'];
     	}
     	else{
     		$page = 1;
     	}
        $offset = ($page-1) * $limit;

         $sql = "SELECT CONCAT(c.firstname,' ',c.lastname) AS name, c.email, r.* ,ro.room_type, ro.	price
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          ORDER BY r.res_id DESC
          LIMIT {$offset},{$limit}";
          
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
				?>
	</table>
	
		<?php 
			$sql1 = "SELECT * FROM reservations";
			$result1 = mysqli_query($conn,$sql1) or die("error");
			if (mysqli_num_rows($result1)>0) {
				$total_records = mysqli_num_rows($result1);
				$total_page = ceil($total_records/$limit);

				echo '<ul class="pagination">';
				if ($page>1) {
					echo '<li><a href="customer.php?page='.($page - 1).'">Prev</a></li>';
				}
				for ($i=1; $i <=$total_page; $i++) { 
					if ($i == $page) {
						$active = "active";
					}
					else{
						$active = "";
					}
					echo '<li class="'.$active.'"><a href="customer.php?page='.$i.'">'.$i.'</a></li>';
				}
				if ($total_page>$page) {
					echo '<li><a href="customer.php?page='.($page + 1).'">Next</a></li>';
				}
				echo '</ul>';
			}
	      ?>
		</div>
	</div>
</body>
</html>