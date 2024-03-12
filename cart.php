<?php
session_start();
include 'includes/html.php';
include 'functions/functions.php';
include "connection/connection.php";


?>

    <body>
        <?php include "includes/navigation.php"; ?>
        <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                <div class="card-body p-4">

                    <div class="row">

                    <div class="col-lg-7 ">
                        <h5 class="mb-3"><a href="shop.php" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <p class="mb-1">Shopping cart</p>
 
                        </div>
                        </div>

                        <div class="cart-product-ct"></div>
                        


                    </div>
                    <?php
                     if(isset($_SESSION['user'])):
                    ?>
                        <div class="col-lg-5">

                            <div class="card bg-primary text-white rounded-3">
                            <div class="card-body " id="user" data-id="<?php echo $_SESSION['user']['user_id']?>">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Details</h5>
                                <img src="<?php if(isset($_SESSION['user']['profile_img']))
                                {echo substr($_SESSION['user']['profile_img'], 3, strlen($_SESSION['user']['profile_img']));
                                } else {
                                    echo 'https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp';
                                }
                                ?>"
                                    class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                </div>

                                
                                
                                <?php
                                    global $con;
                                    $userLocation = $con->prepare("SELECT * from locations l INNER JOIN users u ON l.id=u.location_id WHERE u.user_id =:id ");
                                    $userLocation->bindParam(":id", $_SESSION['user']['user_id']);
                                    $userLocation->execute();
                                    $location = $userLocation->fetch(PDO::FETCH_ASSOC);
                                    
                                ?>
                                <?php if($_SESSION['user']['location_id']==NULL):?>
                                    <p class="small mb-2 text-white">Location</p>
                                    <?php if(isset($_GET['successLoc'])){
                                        echo '<p class="alert alert-success">'.$_GET['successLoc'].'</p>';
                                    }?>
                                    <?php if(isset($_GET['errors'])){
                                        echo '<p class="alert alert-danger">'.$_GET['errors'].'</p>';
                                    }?>
                                        
                                    
                                    <form action="logic/addlocation.php" id='editForma' method="post" onSubmit="return addLocation()">
                                    <div class="form-group my-3">
                                            <label for="exampleInputEmail1">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" aria-describedby="emailHelp" value="<?php if(isset($location['country'])) echo $location['country']?>">
                                            <input type="hidden" name="locId" value="<?php if(isset($location['id'])) echo $location['id']?>">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="ULName">City</label>
                                            <input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" value="<?php if(isset($location['city']))echo $location['city']?>">
                                        </div>
                                        <div class="form-group my-3">
                                            <label for="UEmail">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" value="<?php if(isset($location['addresses']))echo $location['addresses']?>">
                                        </div>
                                        
                                        <button type="submit" name="addLocationCart" class="btn btn-outline-light my-3 editUser">Add location</button>
                                    </form>  
                                <?php endif?>
                                <hr class="my-4">

                                <div class="d-flex justify-content-between">
                                <p class="mb-2 text-white fw-bold">Subtotal</p>
                                <p class="mb-2 subtotal text-white fw-bold">$0.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                <p class="mb-2 text-white fw-bold">Shipping</p>
                                <p class="mb-2 text-white fw-bold">$20.00</p>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                <p class="mb-2 text-white fw-bold">Total(Incl. taxes)</p>
                                <p class="mb-2 total text-white fw-bold">$0.00</p>
                                </div>

                                <button type="button" class="btn btn-info btn-block btn-lg checkout-btn">
                                <div class="d-flex justify-content-between">
                                    <span class="checkout">Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                </div>
                                </button>

                            </div>
                            </div>

                        </div>
                    <?php else:?>
                        <p class="alert alert-danger">You must log in to make a purchase</p>
                    <?php endif;?>            
                    </div>

                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <script src="assets/mojJS/main.js"></script>
    <!--Kraj MOG JS FAJL -->
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    </body>
</html>