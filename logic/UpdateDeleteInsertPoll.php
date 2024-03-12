<?php
    include '../connection/connection.php';
    if(isset($_POST["removeAnswer"])) {
            $table = $_POST['table'];
            $id = $_POST['id'];
            
            $choiceid = $_POST['choiceRemove'];
            global $con;
            $remove = $con->prepare("UPDATE poll_choices set is_deleted=1 WHERE choice_id=:id");
            $remove->bindParam(":id", $choiceid);

            $isRemove =  $remove->execute();

            
            if($isRemove){
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Succesful");
            } else {
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Something is wrong");
            }
            
            
            
        } else if(isset($_POST['addAnswer'])) {
            $table = $_POST['table'];
            $id = $_POST['id'];
            if(!empty($_POST['choice'])) {
                global $con;
                $choice = $_POST['choice'];
                $addChoice = $con->prepare("INSERT INTO poll_choices(choice, question_id) VALUES(:choice, :question)");
                $addChoice->bindParam(':choice', $choice);
                $addChoice->bindParam(':question', $id);
                $addChoice = $addChoice->execute();
                if($addChoice) {
                    header("Location: ../adminpanel/editPage.php?table=$table&id=$id&message=Succesful");
                } 
            }else {
                header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Please set choice input");
            }
            



        } else if(isset($_POST['insertQuestion'])){
            $newQuestion = $_POST['newQuestion'];
            if(!empty($newQuestion)) {
                $table = $_POST['table'];
                global $con;
                $insertNewQuestion = $con->prepare("INSERT INTO poll_questions(question) VALUES(:question);");
                $insertNewQuestion->bindParam(':question', $newQuestion);
                $insert = $insertNewQuestion->execute();
                if($insert) {
                    header("Location: ../adminpanel/addProduct.php?table=$table&message=Succesful");
                }
            } else {
                header("Location: ../adminpanel/addProduct.php?table=poll&error=Please enter question");
            }
        } else if(isset($_POST['removeQuestion'])) {

            $id = $_POST['questionRemove'];
            global $con;
            $idQuestion = $_POST['questionRemove'];
            $remove = $con->prepare("DELETE FROM poll_questions WHERE question_id=:id");
            $remove->bindParam(":id", $idQuestion);
            $remove->execute();
            header("Location: ../adminpanel/poll.php");
        }
        else {
            header("Location: ../adminpanel/editPage.php?table=$table&id=$id&error=Something is wrong, please try again");
        }