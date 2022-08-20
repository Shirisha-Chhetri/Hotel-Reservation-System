  <?php include('header.php');?>

<link rel="stylesheet" type="text/css" href="css/info.css">   
<div id="sec4">
  <div class="container">
    <div class="row">
      <div class="hotel">
        <h2 class="pay">Cancellation Process</h2>

    <?php
       if (isset($_SESSION['user1'])){
        $conn = new mysqli("localhost","root","","hotelsystem");

        $sq="SELECT * FROM reservations WHERE customer_id =
        '".$_SESSION['customerID']."' " ;

        $re= $conn->query($sq);
        if ( $re !== false && $re->num_rows > 0) {
          while($r = $re->fetch_assoc()) {
            $_SESSION['id'] = $r['RES_ID'];

         $s = "SELECT * FROM cancellations WHERE reservation_id =
           '".$_SESSION['id']."'";
        $result1 = $conn->query($s);

        if ( $result1!==false && $result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
            echo '<div class="room">Room is cancelled.<div>';
              }
           }
         }
       }   
       else
      {
        echo '<div class="room">Room is not booked yet.<div>';
      }

        $sql = "SELECT r.res_id, CONCAT(c.firstname,' ',c.lastname) AS name, r.contact,r.address,r.number_of_rooms , r.paid_amount, r.check_in,ro.room_type, ro.price,r.status
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          WHERE c.username = '".$_SESSION['user1']."' ";
          
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $_SESSION['room'] = $row['res_id'];
          if($row['status'] == 1 ){
             $id = $row['res_id'];

             $cancel = "SELECT count(reservation_id) as res
            FROM reservations_rooms
            WHERE reservation_id = $id
            GROUP BY reservation_id";
        $cancelresult = $conn->query($cancel);

        if ($cancelresult !== false && $cancelresult->num_rows > 0) {
          while($row5 = $cancelresult->fetch_assoc()) {
            $r = $row5['res'];
            
            echo '<div class="room">Already checked out from the room. So, you cannot cancel the room.<div>';
                
              }
              }
              else{
          ?>
           <form method="POST" action="cancel.php">
          <input type="hidden" name="session" value="<?php echo $row['res_id']; ?>">
          <div class="data">
          <b>RES_ID:</b> <?php echo $row['res_id']; ?><br>
          <b>Customer Name: </b><?php echo $row['name'];?><br>
          <b> Contact:</b> <?php echo $row['contact'];?><br>
          <b>Address:</b> <?php echo $row['address'];?><br>
          <b>Room_Type:</b><?php echo $row['room_type'];?><br>
          <b>Number of rooms:</b> <?php echo $row['number_of_rooms'];?><br>
          <?php 
          $price = $row['number_of_rooms'] *  $row['price'];
          ?>
          <b>Total Price: </b> Rs.<?php echo $price?><br>
          <b>Check-In date:</b> <?php echo $row['check_in'];?><br>
          
          <button name="submit">Cancel Reservation</button><br><br>
           </div>
        </form>
          
            <?php
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
   if(isset($_POST['submit'])){
      $cancel = $_POST['session'];
     
        $sql = "SELECT r.*, c.*,ro.*
          FROM customers c
          INNER JOIN reservations r
          ON c.cus_id = r.customer_id
          INNER JOIN rooms ro
          ON r.room_id = ro.room_id
          WHERE RES_ID = $cancel";
          
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
              $price = $row['PRICE'] * $row['NUMBER_OF_ROOMS'];
              $p = 0.2 * $price;

        $paiddate = date("Y-m-d");
        $sq = "INSERT INTO CANCELLATIONS(reservation_id,cancelled_date,paid_amount)
            VALUES('".$row['RES_ID']."','$paiddate','$p')";
            
            if ($conn->query($sq) === TRUE) {
               echo '';
              }        
            else{
               echo "Error".$conn->error;
              }
            }
          }
        
          $upcus = "UPDATE reservations SET STATUS ='{0}' WHERE RES_ID = $cancel";
          $result = mysqli_query($conn,$upcus);
        
          if($result){
            echo '<script type="text/javascript">
              alert("reservation is cancelled");
               window.location="home.php";
            </script>';
           }
          }
      $conn->close();
    ?> 