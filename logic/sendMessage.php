<?php
session_start();
    include '../connection/connection.php';
    if(isset($_POST['send'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $mailRegex = '/^[A-z0-9-\.]{3,30}@[a-z]{2,8}\.(com|rs)$/';
        $nameRegex = '/^[A-Z][a-z]{2,14}$/';

        $errors = [];
        if(empty($name) || empty($email) || empty($subject) || empty($message)) {
            $errors[]='All fields are required';
        }
        if(!preg_match($mailRegex, $email)) {
            $errors[] = 'Incorect email';
        }
        if(!preg_match($nameRegex, $name)) {
            $errors[] = 'Incorect name: exemple(Miroslav)';
        }

        if(empty($errors)) {
            global $con;
            $sendMessage = $con->prepare("INSERT INTO messages (name, email, subject, message) VALUES(:name, :email, :subject, :message)");
            $sendMessage->bindParam(':name', $name);
            $sendMessage->bindParam(':email', $email);
            $sendMessage->bindParam(':subject', $subject);
            $sendMessage->bindParam(':message', $message);
            $send = $sendMessage->execute();
            if($send) {
                header("Location: ../contact.php?success=Your message is successfully sent");
                unset($_SESSION['errors']);
            } else {
                header("Location: ../contact.php?error=Something is wrong");
            }
        } else {
            header("Location: ../contact.php");
        }

    } else {
        header("Location: ../index.php");
    }




?>