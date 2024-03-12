<?php
  include '../functions/functions.php';
  include "../connection/connection.php";
  session_start();
  $user = $_SESSION["user"];
  checkUsers();;

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
                <?php if($_GET['table']=='brands'):?>
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Deleted brands</h1>            
                        <!-- Content Row -->
                        <div class="row">

                        <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Brand name</th>
                                        <th scope="col">Return</th>
                                    </tr>
                                    </thead>
                                
                                    <tbody id="brandDeletedBody">
                                    
                                    
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php elseif($_GET['table']=='products'):?>
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Deleted products</h1>            
                        <!-- Content Row -->
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
                                        <th scope="col">Return</th>
                                    </tr>
                                    </thead>
                                    <tbody id="productDeletedBody">

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php elseif($_GET['table']=='categories'):?>
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Deleted categories</h1>            
                        <!-- Content Row -->
                        <div class="row">

                        <div class="col-lg-12">
                                <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category name</th>
                                            <th scope="col">Return</th>
                                        </tr>
                                        </thead>
                                    
                                        <tbody id="categoryDeletedBody">
                                        
                                        
                                        
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php elseif($_GET['table']=='users'):?>
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Deleted users</h1>            
                        <!-- Content Row -->
                        <div class="row">

                        <div class="col-lg-12">
                                        <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Fisrt name</th>
                                                    <th scope="col">Last name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Profile image</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Return</th>
                                                </tr>
                                                </thead>
                                                <?php
                                                    $users = getUsers();
                                                    $i=1;
                                                ?>
                                                <tbody id="userDeletedBody">
                                                
                                                
                                                
                                                </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>    
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