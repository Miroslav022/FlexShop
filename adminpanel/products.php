<?php
  include '../functions/functions.php';
  include "../connection/connection.php";
  session_start();
  $user = $_SESSION["user"];
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
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Products</h1>
            <a href="addProduct.php?table=product" class="btn btn-primary mb-3">Add new Product</a>
            <div class="row">
            <div class="col-lg-9">
            <div class="table-responsive-sm">
                <form action="">
                <div class="row">
                      
                      <div class="col-md-5 pb-4">
                          <h2 class="h5 mb-2 text-gray-800">Category</h2>
                          <div class="d-flex">
                          
                              <select class="form-control" id="ddlCat">
                                <option value="0">Choose category</option>
                                  <?php $categories = getCategories();
                                  foreach($categories as $category){?>
                                  <option value='<?php echo $category['id']?>'><?php echo $category['category_name']?></option>
                                  <?php } ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-5 pb-4">
                          <h2 class="h5 mb-2 text-gray-800">Brands</h2>
                          <div class="d-flex">
                          
                              <select class="form-control" id="ddlBrand">
                                <option value="0">Choose brand</option>
                              <?php $brands = getBrands(); foreach($brands as $brand){ ?>
                                  <option value='<?php echo $brand['id']?>'><?php echo $brand['brand_name']?></option>
                              <?php } ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-2 d-flex align-items-center">
                          <input type="button" value="Filter" class="btn btn-primary filterBtn">
                      </div>
                  </div>
                </form>
            </div>
            </div>
            <div class="row">
            
              <div class="col-lg-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Remove</th>
                      </tr>
                    </thead>
                    <tbody id="productBody">

                    </tbody>
                  </table>
                
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'includes/footer.php'?>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    
    <?php include 'includes/logout&scripts.php'?>
  </body>
</html>
