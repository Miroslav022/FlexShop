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
            <h1 class="h3 mb-2 text-gray-800">Users</h1>
            <a href="addProduct.php?table=users" class="btn btn-primary mb-3">Add new user</a>       

            <!-- Content Row -->
            <div class="row">
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
                                    <th scope="col">Edit</th>
                                    <th scope="col">Remove</th>
                                </tr>
                                </thead>
                                <?php
                                    $users = getUsers();
                                    $i=1;
                                ?>
                                <tbody id="userBody">
                                
                                
                                
                                </tbody>
                            </table>
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

    <!-- Scroll to Top Button-->
    <?php include 'includes/logout&scripts.php'?>
  </body>
</html>
