<?php include('header.php');?>

<link rel="stylesheet" type="text/css" href="css/info.css">   
<div id="sec4">
  <div class="container">
    <div class="row">
      <div class="hotel">
        <h2 class="pay">Chekout Process</h2>

    <?php
       
        if (isset($_SESSION['user1'])){
          $conn = new mysqli("localhost","root","","hotelsystem");

        $sq="SELECT * FROM reservations WHERE customer_id =
        '".$_SESSION['customerID']."' " ;

        $re= $conn->query($sq);
        if ( $re !== false && $re->num_rows > 0) {
          while($r = $re->fetch_assoc()) {
            $_SESSION['id'] = $r['RES_ID'];

         $s = "SELECT * FROM reservations_rooms WHERE reservation_id =
           '".$_SESSION['id']."'";
        $result1 = $conn->query($s);

        if ( $result1!==false && $result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
            echo '<div class="room">Already checked out from the room.<div>';
              }
           }
          
           $cancel = "SELECT * FROM cancellations WHERE reservation_id =
           '".$_SESSION['id']."'";
        $resultc = $conn->query($cancel);

        if ( $resultc !== false && $resultc->num_rows > 0) {
          while($row4 = $resultc->fetch_assoc()) {
            echo '<div class="room">Room is cancelled.<div>';
              }
           }
         }
       }
       else
      {
        echo '<div class="room">Room is not booked yet.<div>';
      }

        $sql = "SELECT r.res_id, CONCAT(c.firstname,' ',c.lastname) AS name, r.contact,r.address,r.number_of_rooms , r.paid_amount, r.check_in,ro.room_type, ro.price, r.status
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          WHERE c.username = '".$_SESSION['user1']."' ";
          
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if($row['status'] == 1){
            $id = $row['res_id'];
      
          $q = "SELECT count(reservation_id) as res,no_of_room
            FROM reservations_rooms
            WHERE reservation_id = $id
            GROUP BY reservation_id";
          
            $t = $conn->query($q);

            if ($t !== false && $t->num_rows > 0) {
            while($row8 = $t->fetch_assoc()) {
               $r = $row8['res'];

              if($row8['no_of_room'] !== $r ){
              $diff = ($row8['no_of_room'] - $r );
              
              for ($i=1; $i <= $diff; $i++) { ?>
          
              <div class="data">
              RES_ID: <?php echo $row['res_id']; ?><br>
              Customer Name: <?php echo $row['name'];?><br>
              Contact: <?php echo $row['contact'];?><br>
              Address: <?php echo $row['address'];?><br>
              Room_Type: <?php echo $row['room_type'];?><br>
              Number of rooms: <?php echo $row['number_of_rooms'];?><br>
              <?php 
              $price = $row['number_of_rooms'] *  $row['price'];
              ?>
              Total Price: Rs.<?php echo $price?><br>
              Check-In date: <?php echo $row['check_in'];?><br><br>
              <span>Your Room Number:</span>
               <form method="POST" action="checkout.php">
                  <input type="hidden" name="hidden" value="<?php echo $row['res_id']; ?>">
                  <input class="rows" type="checkbox" name="chk[]" value="<?php $a= "R".rand(100,150); echo $a;?>">&nbsp;<?php echo $a;
                  ?>
                  <button name="out">Checkout</button>
                </form>
                   </div>
          
                <?php
                  }
                }
              }
            }
            else
            {
              for ($i=1; $i <= $row['number_of_rooms']; $i++) { ?>
            <div class="data">
              RES_ID: <?php echo $row['res_id']; ?><br>
              Customer Name: <?php echo $row['name'];?><br>
              Contact: <?php echo $row['contact'];?><br>
              Address: <?php echo $row['address'];?><br>
              Room_Type: <?php echo $row['room_type'];?><br>
              Number of rooms: <?php echo $row['number_of_rooms'];?><br>
              <?php 
              $price = $row['number_of_rooms'] *  $row['price'];
              ?>
              Total Price: Rs.<?php echo $price?><br>
              Check-In date: <?php echo $row['check_in'];?><br><br>
              <span>Your Room Number:</span>
              <form method="POST" action="checkout.php">
                  <input type="hidden" name="hidden" value="<?php echo $row['res_id']; ?>">
                  <input class="rows" type="checkbox" name="chk[]" value="<?php $a= "R".rand(100,150); echo $a;?>">&nbsp;<?php echo $a;
                  ?>
                  <button name="out">Checkout</button>
                    </form>
                   </div>
                  <?php
                  }
                 }
                }
              }
            }
          }
            else{
            header("location:login.php");
          }

          ?>   
    </div>
   </div>
  </div>
</div>


    <?php
      $conn = new mysqli("localhost","root","","hotelsystem");
          

    if (isset($_POST['out'])) {
      $checkout = $_POST['hidden'];
     $sql = "SELECT r.res_id,r.number_of_rooms, ro.room_id,ro.room_type
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          WHERE res_id = $checkout";
          
            $result = $conn->query($sql);

            if ($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
             
                $checkbox1 = $_POST['chk']; 
                $chk="";  
                foreach($checkbox1 as $chk1)  
                   {  
                      $chk .= $chk1."  "; 
                    }
                    $checkoutdate = date("Y-m-d");
                     $sq = "INSERT INTO RESERVATIONS_ROOMS(reservation_id,room_id, no_of_room,checkout_room,checkout_date)
                VALUES('".$row['res_id']."','".$row['room_id']."','".$row['number_of_rooms']."','$chk',
                '$checkoutdate')";
                
                if ($conn->query($sq) === TRUE) {
                       echo '<script type="text/javascript">
                            alert("Checked out from the reserved room");
                            window.location="checkout.php";
                            </script>';
                  }          
                else{
                   echo "Error".$conn->error;
                  } 
                }
              }
            
          $sq= "SELECT count(reservation_id) as res,no_of_room
            FROM reservations_rooms
            WHERE reservation_id = $checkout
            GROUP BY reservation_id";
          
            $result1 = $conn->query($sq);

            if ($result1 !== false && $result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $r = $row1['res'];

            if($row1['no_of_room'] == $r ){
            $upcus = "UPDATE reservations SET STATUS ='2' WHERE RES_ID = 
            $checkout";
            $result2 = mysqli_query($conn,$upcus);
                  }
                }
              }
            }
        ?>        