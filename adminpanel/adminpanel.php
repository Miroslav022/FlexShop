<?php
include '../functions/functions.php';
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
            <h1>WELCOME TO ADMIN PANEL</h1>
            <h3>Now you can manage all data in site</h3>
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
