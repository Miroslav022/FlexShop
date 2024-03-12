<?php
    
    include ("connection/connection.php");
    include ("functions/ispisNavigacije.php");
    
    $rezultat = $con -> prepare("Select * from navigation");
    $rezultat -> execute();
    $rezultat = $rezultat->fetchAll(PDO::FETCH_ASSOC);

   if(isset($_SESSION['user'])) {
    $pollShow = $con ->prepare("SELECT * FROM poll_results WHERE user_id=:id");
    $pollShow->bindParam(":id", $_SESSION['user']['user_id']);
    $pollShow->execute();
    $isAnswered = $pollShow->fetchAll(PDO::FETCH_ASSOC);
    $isAnswered = count($isAnswered)==0;
   }
    
?>
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">020-0340</a>
                </div>
                <div class="d-flex">
                    <?php if(isset($_SESSION['user'])):?>
                        <p class="my-0 mx-2 preNavText text-light">Welcome <?php echo $_SESSION['user']['first_name'];?></p>
                    <?php endif;?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role_id']==2):?>
                            <a class="nav-icon position-relative text-decoration-none text-light" href="adminpanel/adminpanel.php">Admin panel</a>
                        <?php else:?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>
<nav class="navbar navbar-expand-lg navbar-light shadow">
<div class="container d-flex justify-content-between align-items-center">

    <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
        F-fashion
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
        <div class="flex-fill">
            <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                <?php echo ispisNavigacije($rezultat);?>
            </ul>
        </div>
        <div class="navbar align-self-center d-flex">
            <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                    <div class="input-group-text">
                        <i class="fa fa-fw fa-search"></i>
                    </div>
                </div>
            </div>
            <?php
                if(strpos($_SERVER["REQUEST_URI"], 'shop.php')):
            ?>
            <a class="nav-icon d-none d-lg-inline searchBtn" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                <i class="fa fa-fw fa-search text-dark mr-2"></i>
            </a>
            <?php endif;?>
            <a class="nav-icon position-relative text-decoration-none" href="cart.php">
                <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
            </a>
            <?php if(!isset($_SESSION['user'])):?>
                <a class="nav-icon position-relative text-decoration-none" href="login-registration.php">
                <i class="fa fa-fw fa-user text-dark mr-3"></i>
            </a>
            
            <?php endif; ?>
            
            <?php if(isset($_SESSION['user'])):?>
                <div class="user d-flex align-items-center">
                    <img src="<?php if(isset($_SESSION['user']['profile_img'])){echo substr($_SESSION['user']['profile_img'], 3);} else { echo 'assets/img/man.png';}?>" alt="">
                    
                    
                </div>
                <a href="logic/logout.php" class="logoutBtn">Logout</a>
                <a href="editAccount.php" class="logoutBtn">Edit account</a>
            <?php endif; ?>
            <?php if(isset($_SESSION['user']) && $isAnswered):?>
                <a class="nav-link fw-bold" href="poll.php">
                Poll
            </a>
            <?php endif; ?>
        </div>
    </div>

</div>
</nav>

