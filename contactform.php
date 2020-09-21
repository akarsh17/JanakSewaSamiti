<?php
if(isset($_POST['sendmail']))
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $email_from = 'aakarsh.banthiya@gmail.com'

    if(isset($message)){
      $email_subject = $subject;
    }
    else{
      $email_subject = "New Form Submmission from $name";
    }

    $email_body = "User Name : $name \n".
                    "User Email : $visitor_email \n".
                      "User Message : $message";

    $to = 'akarshbanthiya@outlook.com';

    $headers = "From : $email_from";
    $headers .= "Reply-To: $visitor_email \r\n";

    if(mail($to,$email_subject,$email_body,$headers)}{
      echo"<h1> Sent Successfully! Thank You.".$name.", We will get back to you shortly :) </h1>";
    }
    else{
      echo"<h1>Something went Wrong!</h1>";
    }



    header("Location : contact.html");

?>
