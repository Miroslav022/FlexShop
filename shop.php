<?php
session_start();
include 'includes/html.php';
include 'functions/functions.php';
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
                    <input type="text" class="form-control search" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="button" class="input-group-text bg-success text-light submitSearch">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="prikaz"></div>
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Gender
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <form class="collapse show list-unstyled pl-3">
                            <div class="gender-ct">
                            <input type="checkbox" name="genderM" data-category="1" class="gender">
                            <label class="text-decoration-none">Men</a>
                            </div>
                            <div class="gender-ct">
                            <input type="checkbox" name="genderW" data-category="2" class="gender">
                            <label class="text-decoration-none">Women</a>
                            </div>
                            
                        </form>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Categories
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <form id="collapseTwo" class="collapse list-unstyled pl-3">
                            <?php
                            
                                $categories = getCategories();
                                foreach($categories as $category){
                            ?>
                            <div class="category-ct">
                            <input type="checkbox" class="category" name="<?php echo $category['id']?>" data-category="<?php echo $category['id']?>">
                            <label class="text-decoration-none" href="#"><?php echo $category['category_name']?></a>
                            </div>
                            <?php } ?>
                            
                        </form>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Brands
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <form id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php
                                $brands = getBrands();
                                foreach($brands as $brand){
                            ?>
                            
                            <div class="brand-cb">
                            <input type="checkbox" class="brands" name="<?php echo $brand['id']?>" data-category="<?php echo $brand['id']?>">
                            <label for="<?php echo $brand['id']?>" class="text-decoration-none" href="#"><?php echo $brand['brand_name']?></label>
                            </div>
                            <?php } ?>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control" id="ddlSort">
                                <option value='0'>Sort by:</option>
                                <option value='name_asc'>Name ascending</option>
                                <option value='name_desc'>Name descending</option>
                                <option value='price_asc'>Price ascending</option>
                                <option value='price_desc'>Price descending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row products-container">
                   
                </div>
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <!-- <?php 
                        $allProducts = getAllProducts();
                        $allProductCount = count($allProducts)/9;
                        $pages = ceil($allProductCount);
                        ?>
                        <?php for($i=1; $i<=$pages; $i++):?>
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 " href="shop.php?page=<?php echo $i ?>"><?php echo $i?></a>
                        
                        <?php endfor; ?> -->                      
                        <button id="back" class="btn btn-success">back</button>
                        <button id="next" class="btn btn-success">next</button>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->


    <!-- Start Footer -->
    <?php include "includes/footer.php"; ?>
    <!-- End Footer -->
    <!--Pocetak MOG JS FAJL -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/mojJS/main.js"></script>
    <!--Kraj MOG JS FAJL -->
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>