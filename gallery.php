<?php include('header.php');?>
<style type="text/css">
    .ima{
    height: 28pc;
    width: 33.5pc;
    margin-top: 14px;
    margin-left: 1pc;
}
    .h3{
    text-align: center;
    margin-top: 35px;
    margin-bottom: 15px;
}
</style>
    
	<div class="sec4">
   <div class="container-fluid">
    <div  class="row">
            <?php 
            $conn = new mysqli("localhost","root","","hotelsystem");
            $sql = "SELECT * FROM gallerys ORDER BY img_id DESC";
           ?>
      <div class="col-md-12">
        <h2 class="h3">TAKE A VIRTUAL TOUR OF THE HOTEL DREAM!</h2>
        <?php 
        $result = $conn->query($sql);
        
        if($result->num_rows>0){

        while($row=$result->fetch_assoc()){?>
            <img class="ima" src="Admin/allimages/image/<?php echo $row['IMAGE1']?>" alt="">
            <img class="ima" src="Admin/allimages/image/<?php echo $row['IMAGE2']?>" alt=""><br>

            <?php
        }
    }?>
           <!--  <img class="ima" src="image/r5.jpg" alt="">
            <img class="ima" src="image/food6.jpg" alt=""><br>
            
            <img class="ima" src="image/lobby1.jpg" alt="">
            <img class="ima" src="image/water.jpg" alt=""><br>
            <img class="ima" src="image/food.jpg" alt="">
            <img class="ima" src="image/lobby2.jpg" alt=""><br>
            
            <img class="ima" src="image/family2.jpg" alt="">
            <img class="ima" src="image/sit.jpg" alt=""><br>
            <img class="ima" src="image/g1.jpg" alt="">
            <img class="ima" src="image/r3.jpg" alt=""><br>
            <img class="ima" src="image/r2.jpg" alt="">
            <img class="ima" src="image/food1.jpg" alt=""><br>
            <img class="ima" src="image/g2.jpg" alt="">
            <img class="ima" src="image/pool2.jpg" alt=""><br>
            <img class="ima" src="image/pool.jpg" alt="">
            <img class="ima" src="image/food2.jpg" alt=""><br>
            <img class="ima" src="image/fountain.jpg" alt="">
            <img class="ima" src="image/vase2.jpg" alt=""><br> -->
            </div>
          </div>
      </div>
    </div>

<?php include('footer.html');?>