<?php
  include '../functions/functions.php';
  include "../connection/connection.php";
  $categories = getCategories();
  session_start();
  $user = $_SESSION["user"];
  $brands = getBrands();
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

          <!-- Begin Page Content -->
          <?php if($_GET['table']=='products'):?>
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Products</h1>
            <div class="row">
              <div class="col-lg-12">    
              <form class="editFormPage" method="POST" action="../logic/updateProduct.php"  enctype="multipart/form-data">
              <?php 
                if(isset($_GET['error'])) {
                  echo "<p class='text-danger'>".$_GET['error']."</p>";
                } else if (isset($_GET['message'])) {
                  echo "<p class='text-success'>".$_GET['message']."</p>";
                }
              ?>
              <?php $singleProduct = getSingleProdcut($_GET['id']);?>
                    <div class="form-group">
                        <label for="productName">Product name</label>
                        <input type="text" class="form-control" name="productName" id="productName" data-id='<?php echo $_GET['id']?>' value="<?php echo $singleProduct['name'];?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose category</label>
                        <select class="form-control" name="categoryId">
                        <?php foreach($categories as $category):?>
                        <option value="<?php echo $category['id']?>" <?php if($category['id']==$singleProduct['category_id']) echo 'selected'; ?>><?php echo $category['category_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Choose brand</label>
                        <select class="form-control" name="brandId">
                        <?php foreach($brands as $brand):?>
                        <option value="<?php echo $brand['id']?>" <?php if($brand['id']==$singleProduct['brand_id']) echo 'selected' ?>><?php echo $brand['brand_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profileImg">Upload new profile image</label>
                        <div class="d-flex align-items-center">
                            <img src="../assets/img/productImg/<?php echo $singleProduct['main_img']?>" alt="product Image" class="editProductImg">
                            <input type="hidden" name="actualImg" value="<?php echo $singleProduct['main_img']?>">
                            <input type="file" class="form-control-file mx-3" name="profileImg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="6"><?=$singleProduct['description']?></textarea>
                    </div>
                    <div class="form-group d-flex">
                      <input type="submit" value="Update product" name="updateProduct" class="btn btn-primary mr-3">
                      <input type="submit" value="Remove product" name="removeProduct" class="btn btn-danger">
                    </div>
                    <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                            <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                    </div>
                </form>
                
              </div>
            </div>
            <h1 class="h3 mb-2 text-gray-800">Price</h1>
            <div class="row my-2">
                
                <div class="col-lg-12">
                <?php $price = getPrice($singleProduct['id'])?>
                <?php 
                if(isset($_GET['error'])) {
                  echo "<p class='text-danger'>".$_GET['error']."</p>";
                } else if (isset($_GET['message'])) {
                  echo "<p class='text-success'>".$_GET['message']."</p>";
                }
                ?>
                    <form action="../logic/setNewPrice.php" method="POST">
                        <label for="">Actuall price</label>
                        <div class="price-block">
                            <h3><?php echo $price['price'];?>$</h3>
                            <input type="text" name="newPrice" placeholder="Enter new price">
                            <input type="submit" name="priceBtn" class="btn btn-primary" value="Update price">
                            <input type="hidden" name="id" value="<?php echo $price['product_id'];?>">
                            <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                            
                        </div>
                    </form>
                </div>
            </div>
            
            <h1 class="h3 mb-2 text-gray-800 my-3">Sizes</h1>
            <div class="row my-2">
              <div class="col-lg-12">
                
                  
                <form class="editFormPage">
                    <?php $allSizes = getAllSizes()?>
                    <h4>Available sizes:</h4>
                    <div class="sizes">
                        
                        
                    </div>
                    <div class="form-group">
                        <p class="text-success"></p>
                        <label for="addSizeDdl">Add size for <?php echo $singleProduct['name']?></label>
                        <select class="form-control" id="addSizeDdl">
                        <?php foreach($allSizes as $size):?>
                        <option value="<?php echo $size['id']?>"><?php echo $size['size'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="" id="addSizeBtn" class="btn btn-primary">Add size</a>
                    </div>

                </form>

              </div>
            </div>

            <h1 class="h3 mb-2 text-gray-800 my-3">Product images</h1>
            <div class="row my-2">
              <div class="col-lg-12">
                <form action="../logic/addProductImg.php" method="POST" enctype="multipart/form-data">
                      <?php 
                    if(isset($_GET['error'])) {
                      echo "<p class='text-danger'>".$_GET['error']."</p>";
                    } else if (isset($_GET['message'])) {
                      echo "<p class='text-success'>".$_GET['message']."</p>";
                    }
                    ?>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Upload new image</label>
                        <input type="file" name='images' class="form-control-file" id="exampleFormControlFile1">
                        <input type="submit" name="submitUpload" value="Upload" class="my-2 btn btn-primary uploadImg">
                        <input type="hidden" name="id" value="<?php echo $singleProduct['id']?>">
                        <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                    </div>
                </form>
                <div class="img-container">
                    
                </div>
              </div>
            </div>

            <h1 class="h3 mb-2 text-gray-800 my-3">Specification</h1>
            <div class="row ">
              <div class="col-lg-12">
                <form action="#" method="POST">
                        <div class="specification-container">
                            
                        </div>
                        <div class="addSpecCt my-4">
                        <h5 class="my-2">Add specification</h5>
                            <?php $specifications = getProductSpecification()?>

                            <select id="specDdl">
                                <?php foreach($specifications as $specification):?>
                                <option value="<?php echo $specification['id']?>"><?php echo $specification['type']?></option>
                                <?php endforeach;?>
                            </select>
                            
                            <input type="text" name="" id="specificationValue" placeholder="Enter value">
                            <input type="button" id="addSpec" class="btn btn-sm btn-primary" value="Add specification">
                        </div>
                </form>
                
              </div>
            </div>
            
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
              <?php $category = getSingleCategory($_GET['id']);?>
                    <div class="form-group">
                        <label for="productName">Category name</label>
                        <input type="text" class="form-control" name="productName" id="productName" value="<?php echo $category['category_name'];?>">
                        <input type="hidden" name="categoryId" value="<?php echo $_GET['id']?>">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update category" name="updateCategory" class="btn btn-primary mr-3">

                    </div>
                    <div class="form-group">
                            <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                    </div>
                </form>
                
              </div>
            </div>
            </div>
            <?php elseif($_GET['table']=='brands'):?>
            <div class="container-fluid">
              <!-- Page Heading -->
              <h1 class="h3 mb-2 text-gray-800">Brands</h1>
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
                <?php $brand = getSingleBrand($_GET['id']);
                ?>
                      <div class="form-group">
                          <label for="productName">Brand name</label>
                          <input type="text" class="form-control" name="brandName" id="brandName" value="<?php echo $brand['brand_name'];?>">
                          <input type="hidden" name="brandId" value="<?php echo $_GET['id']?>">
                      </div>
                      <div class="form-group">
                        <input type="submit" value="Update brand" name="updateBrand" class="btn btn-primary mr-3">

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
              <h1 class="h3 mb-2 text-gray-800">Users</h1>
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
                <?php $user = getSingleUser($_GET['id']);
                ?>
                       <div class="form-group my-3">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" id="UFName" name="UFName" aria-describedby="emailHelp" value="<?php echo $user['first_name']?>">
                    
                </div>
                <div class="form-group my-3">
                    <label for="ULName">Last Name</label>
                    <input type="text" class="form-control" id="ULName" name="ULName" aria-describedby="emailHelp" value="<?php echo $user['last_name']?>">
                </div>
                <div class="form-group my-3">
                    <label for="UEmail">Email address</label>
                    <input type="text" class="form-control" id="UEmail" name="UEmail" aria-describedby="emailHelp" value="<?php echo $user['email']?>">
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
                            <option value="<?=$role['id']?>" <?php if($role["id"]==$user['role_id']) echo 'selected'; ?>><?php echo $role['role']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="exampleInputPassword1">Gender</label>
                    <?php $genders = getGenders();?>
                    <select name="genders" id="ddlGenders" class="form-control">
                        <?php foreach($genders as $gender):?>
                            <option value="<?=$gender['id']?>" <?php if($gender["id"]==$user['gender_id']) echo 'selected'; ?>><?php echo $gender['gender']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="exampleInputPassword1">Upload profile img</label>
                    <input type="file" class="form-control-file" name="profileImg">
                </div>
                <div class="form-group">
                        <input type="submit" value="Update user" name="updateUser" class="btn btn-primary mr-3">
                        <input type="hidden" name="userId" value="<?php echo $_GET['id']?>">
                      </div>
                
                  </form>
                  
                </div>
              </div>  
            
            </div>
            <?php elseif($_GET['table']=='poll'):?>
            <div class="container-fluid">
              <!-- Page Heading -->
              <h1 class="h3 mb-2 text-gray-800">Question</h1>
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
                <?php $question = getSingleQuestion($_GET['id']);
                ?>
                      <div class="form-group my-3">
                          <h1 class="h3"><?php echo $question['question']?></h1>
                    
                      </div>
                      <div class="form-group my-3">
                        <label for="exampleInputEmail1">Choice</label>
                        <input type="text" class="form-control"  name="choice" aria-describedby="emailHelp">
                          
                      </div>
                
                      <div class="form-group">
                        <input type="submit" value="Add new answer" name="addAnswer" class="btn btn-primary mr-3">
                        <input type="hidden" name="table" value="<?php echo $_GET['table']?>">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                      </div>
                      <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Answer</th>
                              <th scope="col">Remove</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                               global $con;
                               $result = $con->prepare("SELECT * FROM poll_choices WHERE question_id=:qID AND is_deleted = 0");
                               $result->bindParam(":qID", $_GET['id']);
                               $result->execute();
                               $result = $result->fetchAll(PDO::FETCH_ASSOC); 
                            
                            ?>
                            
                              <?php $i = 1?>
                              <?php foreach($result as $rez):?>
                              <tr>
                              <th scope="row"><?php echo $i++?></th>
                              <td><?php echo $rez["choice"]?></td>
                              
                              <td>
                                <input type="submit" value="Remove"  name="removeAnswer" class="btn btn-danger mr-3">
                                <input type="hidden" name="choiceRemove" value="<?php echo $rez["choice_id"]?>">
                                
                              </td>
                              </tr>
                              <?php endforeach;?>
                            
                            
                          </tbody>
                </table>
                  </form>
                  
                </div>
              </div>  
            
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    
        <!-- Footer -->
        <?php include 'includes/footer.php'?>
        <!-- End of Footer -->
                      
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    
    <?php include 'includes/logout&scripts.php'?>
  </body>
</html>
