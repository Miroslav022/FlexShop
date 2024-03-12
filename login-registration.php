<?php session_start();?>
<?php
    
    
    include "connection/connection.php";
    $genders = $con->prepare("select * from genders");
    $genders->execute();
    $genders = $genders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'includes/html.php';
?>

<body>

    <!-- Start Top Nav -->
    <?php include "includes/pre-nav.php"; ?>
    <!-- Close Top Nav -->

    <!-- Start Navigation-->
    <?php include "includes/navigation.php"; ?>
    <!--End navigation-->

    <!--SUCCESS REGISTER BLOCK-->
    <div class="hidden">
        <h3>You are successfully registered, please log in</h3>
    </div>
    
    <?php if(isset($_GET['message'])){echo "<div class='message alert alert-danger text-center'>".$_GET['message']."</div>";}?>
    
    <!--SUCCESS REGISTER BLOCK-->

    <div class="login-registration container">
        <div class="registration-block RL-container">
            <h2>Registration</h2>
            <form action="">
                <div class="registration-input inputs">
                    <label for="Fname">First Name *</label>
                    <input type="text" name="Fname" id="Fname" placeholder="First Name">
                    <div class="greske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <label for="Lname">Last Name *</label>
                    <input type="text" name="Lname" id="Lname" placeholder="Last Name">
                    <div class="greske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <label for="email">Email *</label>
                    <input type="text" name="email" id="email" placeholder="Email">
                    <div class="greske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <label for="email">Gender</label>
                    <div class="gender-ct">
                        <?php foreach($genders as $gender):?>
                        <div class="gender-form">
                            <input type="radio" name="gender" id="<?php echo $gender['gender']?>" value="<?php echo $gender['id']?>">
                            <label for="gender"><?php echo $gender['gender']?></label>
                        </div>
                    <?php endforeach; ?>
                    
                    </div>
                    <div class="greske radioGreske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" class="gender" placeholder="Password">
                    <div class="greske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <label for="confirmPass">Confirm password *</label>
                    <input type="password" name="confirmPass" id="confirmPass" class="gender" placeholder="Confirm password">
                    <div class="greske text-danger"></div>
                </div>
                <div class="registration-input inputs">
                    <input type="button" value="Register" class="btn btn-success" id="registerBtn">
                </div>
            </form>
        </div>
        <div class="login-block RL-container">
            <h2>Login</h2>
            <form action="logic/login.php" method="POST">
               
                    <?php 
                     
                        if(isset($_GET['errors'])){
                            echo "<div class='greske alert alert-danger'><p>".$_GET['errors']."</p></div>";
                        }
                        
                    ?>
                
                <div class="login-input inputs">
                    <label for="loginMail">Email</label>
                    <input type="text" name="loginMail" id="loginMail" placeholder="Email">
                    <div class="greske"></div>
                </div>
                <div class="login-input inputs">
                    <label for="loginPassword">Password</label>
                    <input type="password" name="loginPassword" id="passLogin" placeholder="Password">
                    <div class="greske"></div>
                </div>
                
                <div class="login-input inputs">
                    <input type="submit" name="btnLogin" value="Login" class="btn btn-success" id="loginBtn">
                </div>
            </form>
        </div>
    </div>
    
    <!-- Start Footer -->
    <?php include "includes/footer.php"; ?>
    <!-- End Footer -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/mojJS/main.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>


