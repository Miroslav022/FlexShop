<?php
    session_start();
    include 'includes/navigation.php';
    include 'includes/html.php';
    include 'functions/functions.php';
    include 'connection/connection.php';
    $session = $_SESSION['user'];
    
?>
<body>
    <div class="container my-5 editUserCt">
        <div class="col-lg-8 editContainers">
            <h2>Edit Account</h2>
            <div class="successfulEdit">
                <p><?php if(isset($_GET['success'])) {echo $_GET['success']; } ?></p>
            </div>
            <form action="logic/editUser.php" id='editForma' method="post" enctype="multipart/form-data" onSubmit="return editUser()">
            <div class="form-group my-3">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" id="UFName" name="UFName" aria-describedby="emailHelp" value="<?=$session['first_name']?>">
                    
                </div>
                <div class="form-group my-3">
                    <label for="ULName">Last Name</label>
                    <input type="text" class="form-control" id="ULName" name="ULName" aria-describedby="emailHelp" value="<?=$session['last_name']?>">
                </div>
                <div class="form-group my-3">
                    <label for="UEmail">Email address</label>
                    <input type="text" class="form-control" id="UEmail" name="UEmail" aria-describedby="emailHelp" value="<?=$session['email']?>">
                </div>
                <div class="form-group my-3">
                    <label for="UNPass">New password</label>
                    <input type="password" class="form-control" id="pass" name="UNPass" aria-describedby="emailHelp" placeholder="New password">
                </div>
                <div class="form-group my-3">
                    <label for="UNCPass">Confirm new password</label>
                    <input type="password" class="form-control" id="confPass" name="UNCPass" aria-describedby="emailHelp" placeholder="Confirm new password">
                </div>
                <div class="form-group my-3">
                    <label for="exampleInputPassword1">Pol</label>
                    <?php $genders = getGenders();?>
                    <select name="genders" id="ddlGenders" class="form-control">
                        <?php foreach($genders as $gender):?>
                            <option value="<?=$gender['id']?>" <?php if($gender["id"]==$session['gender_id']) echo 'selected'; ?>><?php echo $gender['gender']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="exampleInputPassword1">Upload profile img</label>
                    <input type="file" class="form-control-file file-upload" name="profileImg">
                </div>
                
                <button type="submit" name="edit" class="btn btn-outline-light my-3 editUser">Submit</button>
            </form>  
        </div>
    </div>
    <div class="container my-5 editUserCt">
        <div class="col-lg-8 editContainers">
            <h2>Add location</h2>
            <div class="successfulEdit">
                <p><?php if(isset($_GET['successLoc'])) {echo $_GET['successLoc']; } ?></p>
            </div>
            <?php
                global $con;
                $userLocation = $con->prepare("SELECT * from locations l INNER JOIN users u ON l.id=u.location_id WHERE u.user_id =:id ");
                $userLocation->bindParam(":id", $_SESSION['user']['user_id']);
                $userLocation->execute();
                $location = $userLocation->fetch(PDO::FETCH_ASSOC);
            ?>
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
                
                <button type="submit" name="addLocation" class="btn btn-outline-light my-3 editUser">Add location</button>
                <button type="submit" name="updateLocation" class="btn btn-outline-light my-3 editUser">update location</button>
            </form>  
        </div>
    </div>
    <?php include 'includes/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <script src="assets/mojJS/main.js"></script>
        <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
