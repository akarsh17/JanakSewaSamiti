<?php
if(isset['sendmail'])
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

    $email_body = "User Name : $name \n"
                    "User Email : $visitor_email \n"
                      "User Message : $message"

    $to = 'akarshbanthiya@outlook.com';

    $headers = "From : $email_from";
    $headers .= "Reply-To: $visitor_email \r\n";

    mail($to,$email_subject,$email_body,$headers);
    header("Location : contact.html");

?>
