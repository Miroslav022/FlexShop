<?php
session_start();
include 'includes/html.php';
include 'functions/functions.php';
include "connection/connection.php";
$poll = getPoll();

?>

    <body>
        <?php include "includes/navigation.php"; ?>
        <?php
            if(isset($_SESSION['user']) && $isAnswered):?>
        <div class="poll">
        <h1 class="h3 text-center mt-5 mb-4">Poll</h1>
        <form action="">
                <div class="msg"></div>
                <div class="registration-input inputs">
                    <div class="poll-ct" data-user="<?php echo $_SESSION['user']['user_id']?>">
                        <?php foreach($poll as $question):?>
                           
                        <div class="poll-form">
                            <label for=""><?php echo $question['question']?></label>
                                    <?php
                                    global $con;
                                    $pollChoice = $con->prepare("SELECT * FROM poll_choices WHERE question_id =:id");
                                    $pollChoice->bindParam(":id", $question['question_id']);
                                    $pollChoice->execute();
                                    $pollChoice = $pollChoice->fetchAll(PDO::FETCH_ASSOC);

                                    ?>
                                <div class="choice">
                                    <?php foreach($pollChoice as $choice):?>
                                        <div class="single-choice">
                                            <input type="radio" name="<?php echo $question['question_id']?>" class="choice" value="<?php echo $choice['choice_id']?>">
                                            <label for="gender"><?php echo $choice['choice']?></label
                                    ></div>
                                    
                                    <?php endforeach; ?>
                                </div>
                           
                        </div>
                    <?php endforeach; ?>
                    
                    </div>
                    <div class="greske radioGreske"></div>
                </div>
                
                <div class="registration-input inputs text-center mt-4">
                    <input type="button" value="Submit" class="btn btn-success" id="submitPoll">
                </div>
            </form>
    </div>
        <?php endif;?>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="assets/mojJS/main.js"></script>
    <!--Kraj MOG JS FAJL -->
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    </body>
</html>


