<?php 
require('stripe-php-master/init.php');

$publishableKey="pk_test_51JQu86SAqwIwgmCpsqxFlKBmouRKQ6eMuxdjXGcs1iJcoYffs2Bug6Q97dK7I0l4JLZGLjw2igAuKfpgIhf2BwKr00dZeNTlOf";

$secretKey="sk_test_51JQu86SAqwIwgmCpFq5wTixHO2qOxO8fbi6sAGxwfFR7YefcsPEfh3eRb5RxcL60eUbKkm1nKg64gUBEqEst0COj0035Od7swQ";

\Stripe\Stripe::setApiKey($secretKey);

  include('header.php');
?>

<style type="text/css">
  .hotel{
  margin-left: 20pc;
  font-size:25px;
  color: black;
  }
  .pay{
  margin-bottom:35px;
  margin-top:25px;
  margin-left:4pc;
  font-size: 30px;
  }
  .stripe-button-el{
  margin-left:7pc !important;
  margin-top: 15px;
  }
</style>

<div class="container">
  <div class="row">
    <div class="hotel">
      <h1 class="pay">Payment Please !</h1>
     <form action="" method="post">
      <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $publishableKey;?>"
        data-amount="<?php echo $_SESSION['p']* 100;?>"
        data-name="Hotel Dream"
        data-description="Please Fill Details"
        data-image="image/logos.png"
        data-currency="INR"
      >
      </script>
    </form>
</div>
</div>
</div>

<?php    
  $p =  $_SESSION['p'];
  $conn = new mysqli("localhost","root","","hotelsystem");
    
     if(isset($_POST['stripeToken'])){
      \Stripe\Stripe::setVerifySslCerts(false);
      $token = $_POST['stripeToken'];
      
      $data=Stripe\Charge::create(array(
        "amount"=>"$p",
        "currency"=>"inr",
        "description"=>"Hotel Dream Payment",
        "source"=>$token,
      ));

      $tid = $data->payment_method;
      $owner = $data->billing_details->name;
      $paiddate = date("Y-m-d");
      $sql1 ="INSERT INTO reservations(customer_id,contact,
             address,gender,dob,room_id,number_of_rooms,check_in,paid_amount,transaction_id,reserved_date,status)
            VALUES('".$_SESSION['customerID']."','".$_SESSION['phone']."','".$_SESSION['address']."',
             '".$_SESSION['gender']."','".$_SESSION['dob']."','".$_SESSION['room']."','".$_SESSION['number']."','".$_SESSION['checkin']."','$p','$tid','$paiddate',1)";

      if($conn->query($sql1)==TRUE){
      echo "<script>alert('Room is booked successfully');
       window.location='home.php';</script>";
        }
      else{
          "Error".$sql."<br>".$conn->error;
    }


    $to= "$owner";
    $subject = "Reservation Details";
    $body="You have booked room successfully";
    $headers = "From: hoteldream221@gmail.com";
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
        if (mail($to, $subject, $body, $headers)) {
            echo "";
        } else {
            echo "";
        }
  }
}
}
?>