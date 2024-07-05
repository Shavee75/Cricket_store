<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

  <!--     <div class="swiper hero-slider"> --> 

    <div class="swiper-wrapper">  

      <div class="swiper-slide slide">
            <div class="content">
               <span>Softball Items</span>
               <h3>Reserve Your items</h3>
               <a href="menu.php" class="btn">See Categories</a>
            </div>
            <div class="image">
               <img src="images/pexels-yogendra-singh-4747326.jpg" alt="">
            </div>
         </div>



      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">categories </h1>

   <div class="box-container">

      <a href="category_bats.php?category= bats" class="box">
         <img src="images/img20220308124505-500x500.webp" alt="">
         <h3>Soft-ball Bats</h3>
      </a>

      <a href="category_balls.php?category= balls" class="box">
         <img src="images/86d9139eb69db8939de983db340a98ce.jpg_750x750.jpg_.webp" alt="">
         <h3> Balls</h3>
      </a>

      <a href="category_equipments.php?category=equipments" class="box">
         <img src="images/image (1).webp" alt=""> 
         <h3>Sport equipments </h3>
      </a>
     

     

   </div>

</section>




<section class="products">

   <h1 class="title">Latest Items</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE role IS NULL LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="avai_quan" value="<?= $fetch_products['quantity']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <?php if(!empty($fetch_products['quantity']) || $fetch_products['quantity'] != 0){ ?> 
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
      <?php } ?>

         
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <?php if(empty($fetch_products['quantity']) || $fetch_products['quantity'] == 0){ ?> 
            <div><h2 style="color: red">Out of Stock</h2></div>
         <?php }else{ ?>
            <div><h2 style="color: green">Available Quantity : <?= $fetch_products['quantity']; ?></h2></div>
         <?php } ?>
         
         <div class="name"><?= $fetch_products['name']; ?></div>
         
         <div class="flex">
            <div class="price"><span>LKR</span><?= $fetch_products['price']; ?></div>
            <!-- <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"> -->
            <?php if(!empty($fetch_products['quantity']) || $fetch_products['quantity'] != 0){ ?>
            <input type="number" name="qty" class="qty" min="1" max="<?= $fetch_products['quantity']; ?>" value="1" maxlength="<?= $fetch_products['quantity']; ?>">
         <?php } ?>
         </div>

         
      </form>











      
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
   </div>

</section>


















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
<<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>