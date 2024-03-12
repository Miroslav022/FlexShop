<?php
  include '../functions/functions.php';
  include "../connection/connection.php";
  session_start();
  $user = $_SESSION["user"];
  $categories = getCategories();
  $brands = getBrands();
  $genders = getGenders();
  checkUsers();
?>
<!DOCTYPE html>
<html lang="en">
  <?php include 'includes/head.php'?>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include 'includes/sidebar.php'?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?php include 'includes/topbar.php'?>
          <!-- End of Topbar -->
          
            <?php if($_GET['table']=='product'):?>
              <div class="container-fluid">
              <h1 class="h3 mb-2 text-gray-800 my-3">Add product</h1>
              <form class="editFormPage" method="POST" action="../logic/addProduct.php"  enctype="multipart/form-data">
                  <?php 
                    if(isset($_GET['error'])) {
                      echo "<p class='text-danger'>".$_GET['error']."</p>";
                    } else if (isset($_GET['message'])) {
                      echo "<p class='text-success'>".$_GET['message']."</p>";
                    }
                    ?>
                    <div class="form-group">
                        <label for="productName">Product name</label>
                        <input type="text" class="form-control" name="productName" id="productName" data-id='<?php echo $_GET['id']?>'>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose category</label>
                        <select class="form-control" name="categoryId">
                        <?php foreach($categories as $category):?>
                        <option value="<?php echo $category['id']?>"><?php echo $category['category_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Choose brand</label>
                        <select class="form-control" name="brandId">
                        <?php foreach($brands as $brand):?>
                        <option value="<?php echo $brand['id']?>"><?php echo $brand['brand_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Choose gender</label>
                        <div class="cbgender">
                          <input type="checkbox" name="men" value="1">
                          <label for="Men">Men</label>
                        </div>
                        <div class="cbgender">
                          <input type="checkbox" name="women" value="2">
                          <label for="Women">Women</label>
                        </div>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productName">Set price</label>
                        <input type="text" class="form-control" name="price" id="productName">
                    </div>
                    <div class="form-group">
                        <label for="profileImg">Upload new profile image</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control-file" name="profileImg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="6"></textarea>
                    </div>
                    <div class="form-group d-flex">
                      <input type="submit" value="Add product" name="addProduct" class="btn btn-primary mr-3">
                      <input type="hidden" value="$_GET['table']" name="table">
                    </div>
                </form>
                </div>
                <?php elseif($_GET['table']=='categories'):?>
                  <div class="container-fluid">
                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">Category</h1>
                  <div class="row">
                    <div class="col-lg-12">    
                    <form class="editFormPage" method="POST" action="../logic/UpdateDeleteInsertCategory.php">
                    <?php 
                      if(isset($_GET['error'])) {
                        echo "<p class='text-danger'>".$_GET['error']."</p>";
                      } else if (isset($_GET['message'])) {
                        echo "<p class='text-success'>".$_GET['message']."</p>";
                      }
                    ?>

                          <div class="form-group">
                              <label for="productName">Category name</label>
                              <input type="text" class="form-control" name="newCategory" placeholder="Insert category name">
                              
                          </div>
                          <div class="form-group">
                            <input type="submit" value="Insert new category" name="insertCategory" class="btn btn-primary mr-3">

                          </div>
                          <div class="form-group">
                                  <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                          </div>
                      </form>
                      
                    </div>
                    </div>
                  </div>
                  <?php elseif($_GET['table']=='poll'):?>
                  <div class="container-fluid">
                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">Poll question</h1>
                  <div class="row">
                    <div class="col-lg-12">    
                    <form class="editFormPage" method="POST" action="../logic/UpdateDeleteInsertPoll.php">
                    <?php 
                      if(isset($_GET['error'])) {
                        echo "<p class='text-danger'>".$_GET['error']."</p>";
                      } else if (isset($_GET['message'])) {
                        echo "<p class='text-success'>".$_GET['message']."</p>";
                      }
                    ?>

                          <div class="form-group">
                              <label for="productName">Question</label>
                              <input type="text" class="form-control" name="newQuestion" placeholder="Insert poll question">
                              
                          </div>
                          <div class="form-group">
                            <input type="submit" value="Insert new question" name="insertQuestion" class="btn btn-primary mr-3">

                          </div>
                          <div class="form-group">
                                  <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                          </div>
                      </form>
                      
                    </div>
                    </div>
                  </div>
                  <?php elseif($_GET['table']=='brand'):?>
                  <div class="container-fluid">
                      <!-- Page Heading -->
                      <h1 class="h3 mb-2 text-gray-800">Brand</h1>
                      <div class="row">
                        <div class="col-lg-12">    
                        <form class="editFormPage" method="POST" action="../logic/UpdateDeleteInsertBrand.php">
                        <?php 
                          if(isset($_GET['error'])) {
                            echo "<p class='text-danger'>".$_GET['error']."</p>";
                          } else if (isset($_GET['message'])) {
                            echo "<p class='text-success'>".$_GET['message']."</p>";
                          }
                        ?>

                              <div class="form-group">
                                  <label for="productName">Brand name</label>
                                  <input type="text" class="form-control" name="newBrand" placeholder="Insert Brand name">
                                  
                              </div>
                              <div class="form-group">
                                <input type="submit" value="Insert new Brand" name="insertBrand" class="btn btn-primary mr-3">

                              </div>
                              <div class="form-group">
                                      <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                              </div>
                          </form>
                          
                        </div>
                        </div>
                  </div>
                  <?php elseif($_GET['table']=='users'):?>
                  <div class="container-fluid">
                      <!-- Page Heading -->
                      <h1 class="h3 mb-2 text-gray-800">Add user</h1>
                      <div class="row">
                        <div class="col-lg-12">    
                        <form class="editFormPage" enctype="multipart/form-data" method="POST" action="../logic/UpdateDeleteInsertUser.php">
                                <?php 
                                  if(isset($_GET['error'])) {
                                    echo "<p class='text-danger'>".$_GET['error']."</p>";
                                  } else if (isset($_GET['message'])) {
                                    echo "<p class='text-success'>".$_GET['message']."</p>";
                                  }
                                ?>
                                
                                      <div class="form-group my-3">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" id="UFName" name="UFName" aria-describedby="emailHelp" placeholder="First name">
                                    
                                </div>
                                <div class="form-group my-3">
                                    <label for="ULName">Last Name</label>
                                    <input type="text" class="form-control" id="ULName" name="ULName" aria-describedby="emailHelp" placeholder="Last name">
                                </div>
                                <div class="form-group my-3">
                                    <label for="UEmail">Email address</label>
                                    <input type="text" class="form-control" id="UEmail" name="UEmail" aria-describedby="emailHelp" placeholder="Email">
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
                                    <label for="exampleInputPassword1">Role</label>
                                    <?php $roles = getRoles();?>
                                    <select name="roles" id="ddlrole" class="form-control">
                                        <?php foreach($roles as $role):?>
                                            <option value="<?=$role['id']?>"><?php echo $role['role']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group my-3">
                                    <label for="exampleInputPassword1">Gender</label>
                                    <?php $genders = getGenders();?>
                                    <select name="genders" id="ddlGenders" class="form-control">
                                        <?php foreach($genders as $gender):?>
                                            <option value="<?=$gender['id']?>" ><?php echo $gender['gender']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group my-3">
                                    <label for="exampleInputPassword1">Upload profile img</label>
                                    <input type="file" class="form-control-file" name="profileImg">
                                </div>
                                <div class="form-group">
                                        <input type="submit" value="Add user" name="insertUser" class="btn btn-primary mr-3">
                                      </div>
                                
                                  </form>
                          
                        </div>
                        </div>
                  </div>
                <?php endif;?>
                  </div>
        </div>
      </div>
    </div>
     
          
              
          <!-- Begin Page Content -->
         
        </div>
      </div>
    </div>
    
    
        <!-- Footer -->
        <?php include 'includes/footer.php'?>
        <!-- End of Footer -->
                      
    
    <?php include 'includes/logout&scripts.php'?>
  </body>
</html>
