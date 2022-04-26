<?php include('header.php');?>

<style type="text/css">
  /*sec4*/
.ima{
  width: 98%;
  height: 550px;
  margin:6px 15px 0px 15px;
}
img{
  max-width: 100%;
}
.centered{
  position: absolute;
  text-align: center;
  top:24pc;
  right:12pc;
  color:#fff ;
  padding-left: 20px;
  padding-right: 75px;
}
.centered h1{
  font-size: 50px;
}
.h1{
  text-align: center;
  font-size: 50px;
  margin-top: 10px;
}
/*sec5*/
.h3{
  text-align: center;
  margin-top:8pc;
  color: #ce735ae3;
  font-size: 40px;
}
.image{
  height: 20pc;
  width: 31pc;
  margin-top: 14px;
}
.h2{
  margin-top: 15px;
  color: #ce735ae3;
}
.p{
  margin-top: 5pc;
  margin-left: 5pc;
  font-size:23px;
}
.detail{
  font-size: 20px;
}
</style>
	
	<div class="container-fluid" id="sec4">
    <img src="css/ima/9.jpg" class="ima">
    <div class="centered">
    <h1 class="title">Hotel Dream Rooms & Suites</h1><br>
    </div>
  </div>

  <p class="h1"><u>Room Price and Selection</u></p>

  <div class="container-fluid" id="sec5">
    <div class="row">
      <?php 
        $conn = new mysqli("localhost","root","","hotelsystem");
        $sql = "SELECT * FROM rooms ORDER BY room_id DESC";
       ?>
       <div class="col-md-2">
        <h2 class="h3">Rooms</h2>
      </div>
      <div class="col-md-10">
        <div class="row">
      <?php 
         $result = $conn->query($sql);    
              
        if($result->num_rows>0){ 
        while($row=$result->fetch_assoc()){
         ?>

        <div class="col-md-6">
            <img class="image" src="admin/allrooms/rooms/<?php echo $row['IMAGE1']; ?>" >
            <h3 class="h2"><?php echo $row['ROOM_TYPE']; ?></h3><br>
            <p class="detail">Bed: <?php echo $row['DESCRIPTION']; ?></p>
          <?php
            $q = "SELECT *,SUM(NUMBER_OF_ROOMS) as no FROM reservations WHERE room_id =
            '".$row['ROOM_ID']."' ";
          
            $t = $conn->query($q);

            if ($t !== false && $t->num_rows > 0) {
            while($row8 = $t->fetch_assoc()) {
              $r=$row['TOTAL_ROOM']-$row8['no'];
               // $r=$row['TOTAL_ROOM']-$row8['NUMBER_OF_ROOMS'];
               
              ?>
            <p class="detail">Available Rooms: <?php echo $r; ?></p>
          <?php 
        }
        
      }
          else{?>
            <p class="detail">Available Rooms: <?php echo $row['TOTAL_ROOM'];?></p>
          <?php }
          ?>
      </div>
      <div class="col-md-6">
        <img class="image" src="admin/allrooms/rooms/<?php echo $row['IMAGE2']; ?>">
        <p class="p">Price: Rs.<?php echo $row['PRICE']; ?>/night </p>
      </div>
   <?php 
 }
 }
else{
  echo"No room available";
}
$conn->close();
?>
    </div>
    </div>
  </div>
</div>
</div>
  </div>

<?php include('footer.html');?>