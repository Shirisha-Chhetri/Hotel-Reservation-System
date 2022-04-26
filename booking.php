  <?php include('header.php');?>
<link rel="stylesheet" type="text/css" href="css/booking.css">

     <?php
    $erc=$era=$erg=$erd=$ercid="";
    
    if(isset($_POST['reserves'])){      
      $phone = $_POST['contact'];
      $address = $_POST['address'];
      $birth = $_POST['dob'];
      $room = $_POST['rooms'];
      $num= $_POST['number'];
      $cid = $_POST['check_in'];
      $conn = new mysqli("localhost","root","","hotelsystem");

      if (empty($phone)) {
        $erc= "Contact cannot be empty";
      }
      else{
        if (!is_numeric($phone)) {
             $erc = "Contact must be numeric";
            }
         else  if(strlen($phone)<10){
              $erc= "Contact must be of 10 digits";
            }
      }
      
      if (empty($address)) {
        $era= "Address cannot be empty";
      }

      $date = date('Y-m-d');
      $diff = date_diff(date_create($birth),date_create($date));
      if (empty($birth)) {
        $erd= "DOB cannot be empty";
      }
      else if ($diff->format('%y')<18){
           $erd="Must be greater than 18";
      }

      if (empty($cid)) {
        $ercid= "Specify check in date";
      }
      else if ($cid<$date) {
            $ercid = "Not valid date";
      }
      if (empty($_POST['gender'])){
        $erg= "Choose gender";
      }
      
      else{
          $gender = $_POST['gender'];
           if (isset($_SESSION['user1'])){
          
          if($phone && $address && $gender && $birth &&
             $num && $cid && $room){
             $_SESSION['phone'] = $phone;
              $_SESSION['address'] = $_POST['address'];
              $_SESSION['dob'] = $birth;
              $_SESSION['room'] = $_POST['rooms'];
              $_SESSION['number']= $_POST['number'];
              $_SESSION['checkin']= $_POST['check_in'];
              $_SESSION['gender']= $_POST['gender'];
           
            $query="SELECT * FROM rooms WHERE ROOM_ID = $room";
            $result = $conn->query($query);
          
           if($result->num_rows>0){ 
            while($row=$result->fetch_assoc()){
              $price = $row['PRICE'] * $num;
              $_SESSION['p'] = $price;
                }
              }
              header("location:pay.php");
            }
          }
            else{
              mysqli_error($conn); 
              header("location:login.php");
             }
          }
        }
    ?> 

    <div id="sec4">
      <div class="container">
        <div class="row">
      <div class="col-md-12">
    <form id="bookroom" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="fill">
    <table>
      <tbody>
        <tr>
          <td colspan="2">
            <h2 class="heading" align="center">Reserve Your Stay</h2>
          </td>
        </tr>
        <tr>
          <td>
            <label for="contact">Contact:</label>
          </td>
          <td>
            <input type="text" name="contact" placeholder="<?php echo $erc;?>" >
          </td>
        </tr>
          <tr>
          <td>
            <label for="address">Address:</label>
          </td>
          <td>
            <input type="text" name="address" placeholder="<?php echo $era;?>">
          </td>
        </tr>       
        <tr>
          <td>
            <label for="gender">Gender:</label>
          </td>         
          <td>
            <input type="radio" name="gender" value="male">Male  
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="others"> Others
            <p class="room"><?php echo $erg;?></p>
          </td>
        </tr>
        <tr>
          <td>
            <label for="dob">DOB:</label>
          </td>
          <td>
            <input type="date" id="dob" name="dob">
            <span class="error"><?php echo $erd;?></span>
          </td>
        </tr>
        <tr>
          <td valign="top" >
            <label>Rooms:</label>
          </td>
          <td>
            <table>
              <tr>
                <?php 
              $conn = new mysqli("localhost","root","","hotelsystem");                                  
                    $sql = "SELECT * FROM rooms ORDER BY room_id DESC";
                   ?>
                   <td class="td">
                    <select name="rooms">
                      <option value="-1">Select room</option>
                    <?php 
                    $result = $conn->query($sql);
                      
                    if($result->num_rows>0){
                    while($row = mysqli_fetch_assoc($result)){
                      $_SESSION['room']=$row['ROOM_ID'];
                      
                    $q = "SELECT *,SUM(NUMBER_OF_ROOMS) as no FROM reservations WHERE room_id ='".$row['ROOM_ID']."' ";
                        $t = $conn->query($q);

                        if ($t !== false && $t->num_rows > 0) {
                        while($row8 = $t->fetch_assoc()) {
                          $r=$row['TOTAL_ROOM']-$row8['no']; 
                        if($r>=1){?>
                   <option value="<?php echo $row['ROOM_ID'];?>">
                  
                        <?php    echo $row['ROOM_TYPE'];?></option>
                   <?php 
                 }
               }
               }
             }
                //}
              // }
              // }
                       }
                  ?>
            </select>
        </td>
                <td>
                  <select name="number">
                    <option value="-1">Num of rooms</option>
                    <option value="1 room">1 room</option>
                    <option value="2 room">2 rooms</option>
                    <option value="3 room">3 rooms</option>
                    <option value="4 room">4 rooms</option>
                    <option value="5 room">5 rooms</option>
                  </select>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <label for="checkin">Check-in-date:</label>
          </td>
          <td>
            <input type="date" id="check-in-date" name="check_in">
            <span class="error"><?php echo $ercid;?></span>
          </td>
        </tr>
         <tr>
          <td colspan="2"  align="center">
            <button name="reserves" onclick="return reserve()">Reserve</button>
          </td>
        </tr> 
      </tbody>
    </table>
  </form>
</div>
</div>
</div>
</div>
<?php include('js.html');?> 
<?php include('footer.html');?>