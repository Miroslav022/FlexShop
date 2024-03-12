<?php session_start();?>
<?php
    
    include 'includes/html.php';
    include "connection/connection.php";
   
    
?>

<body>


    <!-- Header -->
    <?php include "includes/navigation.php"; ?>
    <!-- Close Header -->
    
    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last carousel-container">
                            <img class="img-fluid" src="./assets/img/productImg/G185B_Black_FF.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>F</b> eCommerce</h1>
                                <h3 class="h2">Most popular eCommerce store</h3>
                                <p>
                                    Welcome to the ultimate destination for sports enthusiasts! Our online store is your one-stop-shop for high-quality sports equipment that will help you take your game to the next level. Whether you're a seasoned athlete or just starting out, we have everything you need to succeed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last carousel-container">
                            <img class="img-fluid" src="./assets/img/productImg/701G_1.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Best quality</h1>
                                <p>
                                   From top-of-the-line fitness gear to specialized equipment for specific sports, we offer a wide range of products to suit your needs. Our selection includes everything from basketballs, soccer balls, and footballs to running shoes, weightlifting equipment, and yoga mats..
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last carousel-container">
                            <img class="img-fluid" src="./assets/img/productImg/940616_00.png.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Believe in your dreamss</h1>
                                <p>
                                   We believe that sports have the power to change lives, and we're proud to be a part of that journey. So whether you're training for a marathon, hitting the gym, or just looking to stay active, we're here to help you reach your full potential. Shop with us today and discover why we're the go-to destination for sports enthusiasts everywhere
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                   Top 3 categories this month
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shop.php"><img src="assets/img/productImg/0fc309eb995e428d990caf020103774f_9366.webp" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Hoodies & Sweatshirts</h5>
                <p class="text-center"><a href="shop.php" class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shop.php"><img src="assets/img/productImg/93c61227689547e4892aac9100c37ca9_9366.webp" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Sheakers</h2>
                <p class="text-center"><a href="shop.php" class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="shop.php"><img src="assets/img/productImg/s-l640.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Pants</h2>
                <p class="text-center"><a href="shop.php" class="btn btn-success">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
                <?php
                    global $con;
                    $upit = $con->prepare("SELECT * FROM `products` prod INNER JOIN prices pr ON prod.id = pr.product_id WHERE prod.is_deleted=0 ORDER BY pr.price DESC LIMIT 3");
                    $upit->execute();
                    $products = $upit->fetchAll(PDO::FETCH_ASSOC); 
                
                ?>
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Featured Product</h1>
                    <p>
                        No matter what your sport or fitness goals are, our featured products are sure to give you the edge you need to succeed. Shop now and experience the ultimate in sports equipment performance and quality.
                    </p>
                </div>
            </div>
            <div class="row justify-content-around">
                <?php foreach($products as $product):?>
                    <div class="card" style="width: 20em; padding: 0;">
                    <a href="shop-single.php?id=<?php echo $product['product_id']?>" class="img-ct" >
                            <img src="assets/img/productImg/<?php echo $product['main_img']?>" class="card-img-top" alt="...">
                        </a>
                    <div class="card-body content-ct">
                        <h5 class="card-title"><?php echo $product['name']?></h5>
                        <div class="position-absolute bottom-0 mb-2 mt-3">
                        <p class="card-text">$<?php echo $product['price']?></p>
                        <a href="shop-single.php?id=<?php echo $product['product_id']?>" class="btn btn-success">Go Shop</a>
                        </div>
                    </div>
                    </div>

                <?php endforeach;?>    
              
            </div>
        </div>
    </section>
    <!-- End Featured Product -->
    

    <!-- Start Footer -->
    <?php include "includes/footer.php"; ?>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>