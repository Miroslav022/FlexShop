<?php session_start();?>
<?php
    
    include "connection/connection.php";
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        global $con;
        $single_prod = $con->prepare('SELECT * FROM products prod INNER JOIN prices pr ON prod.id = pr.product_id INNER JOIN brands b ON prod.brand_id = b.id where prod.id=:id');
        $single_prod->bindParam(':id', $id);
        $single_prod->execute();
        $single_prod = $single_prod->fetch(PDO::FETCH_ASSOC);
        
        $specifications = $con->prepare('SELECT * FROM specifications s INNER JOIN prod_spec p ON s.id = p.specification_id WHERE p.product_id=:id');
        $specifications->bindParam(':id', $id);
        $specifications->execute();
        $specifications = $specifications->fetchAll(PDO::FETCH_ASSOC);

        $sizes = $con->prepare('SELECT * FROM sizes s INNER JOIN product_size p ON s.id = p.size_id where p.product_id=:id');
        $sizes->bindParam(':id', $id);
        $sizes->execute();
        $sizes = $sizes->fetchAll(PDO::FETCH_ASSOC);
        
        $cat_id = $single_prod['category_id'];
        $relatedProducts = $con->prepare('SELECT * FROM products prod INNER JOIN prices pr ON prod.id = pr.product_id where prod.category_id =:category_id AND is_deleted=0');
        $relatedProducts->bindParam(':category_id', $cat_id);
        $relatedProducts->execute();
        $relatedProducts = $relatedProducts->fetchAll(PDO::FETCH_ASSOC);
        
        $images = $con->prepare('SELECT * FROM images where product_id=:prodId');
        $images->bindParam(':prodId', $id);
        $images->execute();
        $images=$images->fetchAll(PDO::FETCH_ASSOC);
        
    }else {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product Detail Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">


    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <?php include "includes/pre-nav.php"; ?>
    <!-- Close Top Nav -->


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



    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="assets/img/productImg/<?php echo $single_prod['main_img']?>" alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <?php foreach($images as $image):?>
                                        <div class="col-4">
                                            <a href="#">
                                                <img class="card-img img-fluid" src="assets/img/productImg/<?php echo $image['src']?>" alt="Product Image 1">
                                            </a>
                                        </div>
                                        <?php endforeach;?>
                                        
                                    </div>
                                </div>


                                
                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        
                        <div class="card-body" id="product-container" data-id='<?php echo $single_prod['product_id']?>' data-userID='<?php echo $_SESSION['user']['user_id']?>'>
                            <h1 class="h2"><?php echo $single_prod['name']?></h1>
                            <p class="h3 py-2">$<?php echo $single_prod['price']?></p>
                            <p class="py-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $single_prod['brand_name']?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p><?php echo $single_prod['description']?></p>

                            <h6>Specification:</h6>
                            <ul class="list-unstyled pb-3">
                                <?php foreach($specifications as $specification):?>
                                <li><?php echo $specification['type'].": "; echo $specification['value']; ?></li>
                                
                                <?php endforeach; ?>
                            </ul>

                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                <div id="errors"></div>
                                    <div class="col-auto">
                                    
                                        <ul class="list-inline pb-3">
                                        <li class="list-inline-item"><span>Avalible sizes:</span></li>
                                            <?php foreach($sizes as $size):?>
                                           
                                            <li class="list-inline-item"><span class="btn btn-success btn-size" data-sizeID='<?php echo $size['id']; ?>'><?php echo $size['size']; ?></span></li>
                                           
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    
                                    <div class="col d-grid">
                                        <button type="submit" id="addToCart" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Related Products</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">
                <?php foreach($relatedProducts as $relatedProduct):?>
                <div class="p-2 pb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card img-ct rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="assets/img/productImg/<?php echo $relatedProduct['main_img']?>">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                
                                <ul class="list-unstyled">
                                       
                                        <li id="<?php echo $relatedProduct['product_id']?>"><a class="btn btn-success text-white mt-2" href="shop-single.php?id=<?php echo $relatedProduct['product_id']?>"><i class="far fa-eye"></i></a></li>
                                        
                                    </ul>
                            </div>
                        </div>
                        <div class="card-body card-ct">
                            <a href="shop-single.html" class="h3 text-decoration-none"><?php echo $relatedProduct['name']?></a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">$<?php echo $relatedProduct['price']?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
               

            </div>
            


        </div>
    </section>
    <!-- End Article -->
    <div class="container mb-5">
  <div class="row">
    <div class="col-md-12 course-details-content">
      <div class="course-details-card mt--40">
        <div class="course-content" data-product="<?php echo $_GET['id']?>">
            <?php if(isset($_SESSION['user'])):?>
          <div class="row">
            <div class="report"></div>
            <h5 class="mb--25">Write rewiew</h5>
                <form>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Rewiew</label>
                        <textarea class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" data-id="<?php echo $_SESSION['user']['user_id']?>" id="sendRewies">Send rewiew</button>
                </form>
                </div>
                <?php endif;?>
          <div class="comment-wrapper pt--40 rewiews-block">
            <div class="section-title">
              <h5 class="mb--25">Reviews</h5>
            </div>
              <!--  Comment Box start--->
           
              <!--  Comment Box end--->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    
    <div class="atc atc-hidden">dadsa</div>
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

    <!--Pocetak MOG JS FAJL -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/mojJS/main.js"></script>
    <!--Kraj MOG JS FAJL -->

    <!-- Start Slider Script -->
    <script src="assets/js/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->

</body>

</html>