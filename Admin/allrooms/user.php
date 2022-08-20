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
			<h2 class="ml-5">All Rooms</h2>
		</div>
		<div class="col-md-4 offset-md-4 d-flex justify-content-center">
			<button class="button"><a href="addroom.php">Add Room</a></button></div>
	</div>

	<table border="2">
		<thead>
			<th>S.N.</th>
			<th>Room_Type</th>
			<th>Description</th>
			<th>Price</th>
			<th>Total_Room</th>
			<th>Image1</th>
			<th>Image2</th>
			<th>Edit</th>
			<th>Delete</th>
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
        $sql = "SELECT * FROM rooms ORDER BY room_id DESC 
        		LIMIT {$offset},{$limit}";
       
        $result = $conn->query($sql);
        if($result->num_rows>0){

        while($row=$result->fetch_assoc()){
          ?>
		<tbody>
			<tr>
			 <td class="td"><?php echo $row['ROOM_ID']; ?></td>
			 <td class="td"><?php echo $row['ROOM_TYPE']; ?></td>
			 <td class="td"><?php echo $row['DESCRIPTION']; ?></td>
			 <td class="td"><?php echo $row['PRICE']; ?></td>
			 <td class="td"><?php echo $row['TOTAL_ROOM']; ?></td>
			 <td><img class="image" src="rooms/<?php echo $row['IMAGE1']; ?>"></td>
			 <td><img class="image" src="rooms/<?php echo $row['IMAGE2']; ?>"></td>
			 <td class="td" name="update"><a href="update.php?roomedit=<?php echo $row["ROOM_ID"]?>"><i class="fa fa-fw fa-edit"></i> Edit</a></td>
			 <td class="td"><a href="delete.php?roomdelete=<?php echo $row["ROOM_ID"]?>"><i class="fa fa-fw fa-trash"></i> Delete</a></td>
			</tr>
		</tbody>
	
		<?php }
	}?>
	</table>
	
	<?php 
			$sql1 = "SELECT * FROM rooms";
			$result1 = mysqli_query($conn,$sql1) or die("error");
			if (mysqli_num_rows($result1)>0) {
				$total_records = mysqli_num_rows($result1);

				$total_page = ceil($total_records/$limit);

				echo '<ul class="pagination">';
				if ($page>1) {
					echo '<li><a href="user.php?page='.($page - 1).'">Prev</a></li>';
				}
				for ($i=1; $i <=$total_page; $i++) { 
					if ($i == $page) {
						$active = "active";
					}
					else{
						$active = "";
					}

					echo '<li class="'.$active.'"><a href="user.php?page='.$i.'">'.$i.'</a></li>';
				}
				if ($total_page>$page) {
					echo '<li><a href="user.php?page='.($page + 1).'">Next</a></li>';
				}
				echo '</ul>';
			}
	      ?>
		</div>
	</div>
</body>
</html>