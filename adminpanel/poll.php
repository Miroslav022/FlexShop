<?php
  include '../functions/functions.php';
  include "../connection/connection.php";
  $poll = getPoll();
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Poll</h1>
                    <a href="addProduct.php?table=poll" class="btn btn-primary mb-3">Add new poll question</a>                
                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Total responses</th>
                                    <th scope="col">choise 1</th>
                                    <th scope="col">choise 2</th>
                                    <th scope="col">choise 3</th>
                                    <th scope="col">choise 4</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Remove</th>
                                </tr>
                                </thead>
                               
                                <tbody id="pollBody">
                                    <?php $i=1;?>
                                    <?php foreach($poll as $question):?>
                                        <tr>
                                        <th scope="col"><?php echo $i++?></th>
                                        <td scope="col" data-title="Question"><?php echo $question['question']?></td>
                                        <?php 
                                             global $con;
                                             $pollChoice = $con->prepare("SELECT COUNT(pc.choice_id) FROM poll_results pr INNER JOIN poll_choices pc ON pr.choice_id=pc.choice_id WHERE pc.question_id=:qID");
                                             $pollChoice->bindParam(":qID", $question['question_id']);
                                             $pollChoice->execute();
                                             $pollChoice = $pollChoice->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <td scope="col" data-title="Total responses"><?php echo $pollChoice[0]['COUNT(pc.choice_id)']?></td>
                                            <?php
                                                global $con;
                                                $pollChoice = $con->prepare("SELECT * FROM poll_choices WHERE question_id =:id AND is_deleted=0");
                                                $pollChoice->bindParam(":id", $question['question_id']);
                                                $pollChoice->execute();
                                                $pollChoice = $pollChoice->fetchAll(PDO::FETCH_ASSOC);

                                                
            
                                                ?>
                                            
                                                <?php foreach($pollChoice as $choice):?>
                                                    <?php
                                                        global $con;
                                                        $resultForOneChoice = $con->prepare("SELECT COUNT(choice_id) FROM poll_results WHERE choice_id=:cID");
                                                        $resultForOneChoice->bindParam(":cID", $choice['choice_id']);
                                                        $resultForOneChoice->execute();
                                                        $resultForOneChoice = $resultForOneChoice->fetchAll(PDO::FETCH_ASSOC);    
                                                        
                                                    ?>
                                                    <td scope="col" data-title="Choice"><?php echo $choice['choice']; echo ' - '.$resultForOneChoice[0]['COUNT(choice_id)'].' votes';?></td>
                                                       
                                                
                                                
                                                <?php endforeach; ?>
                                                <th scope="col"><a href="editPage.php?table=poll&id=<?php echo $question['question_id']?>" class="btn btn-warning">Edit</a></th>
                                                
                                                <th scope="col">
                                                    <form  method="POST" action="../logic/UpdateDeleteInsertPoll.php">
                                                    <input type="submit" value="Remove"  name="removeQuestion" class="btn btn-danger mr-3">
                                                    <input type="hidden" name="questionRemove" value="<?php echo $question['question_id']?>">
                                                    </form>
                                                
                                        </tr>
                                        
                                        
                                    
                                    <?php endforeach; ?>
                                            
                                
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

    <?php include 'includes/logout&scripts.php'?>

</body>

</html>