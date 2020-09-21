<?php
if(isset($_POST['sendmail'])){
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
      
    // if(empty($name) || empty($visitor_email) || empty($subject) || empty($message)){
    //   header('location:contact.html?error');
    // }






    $email_from = "aakarsh.banthiya@gmail.com";

    if(isset($message)){
      $email_subject = $subject;
    }
    else{
      $email_subject = "JanakSewaSamiti - Contact Us Form";
    }

    $email_body = "User : $name \n".
                    "Email : $visitor_email \n".
                      "Subject : $subject".
                        "Message : $message";

    $to = 'akarshbanthiya@outlook.com';

    $headers = "From: ".$email_from;

    if(mail($to,$email_subject,$email_body,$headers)){
      echo "<h1> Sent Successfully! Thank You.".$name.", We will get back to you shortly :) </h1>";
    }
    else{
      echo "<h1>Something went Wrong!</h1>";
    }

}

    // header("Location : contact.html");

?>
