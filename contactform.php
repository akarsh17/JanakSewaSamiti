<?php

$template_file = "template_file_contactform.php";
error_reporting(0);
if(isset($_POST['sendmail'])){


  if (empty($_POST["name"])) {
  $nameErr = "Name is required";
} else {
  $name = test_input($_POST["name"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
    $nameErr = "Only letters and white space allowed";
  }
}

if (empty($_POST["email"])) {
   $emailErr = "Email is required";
 } else {
   $visitor_email = test_input($_POST["email"]);
   // check if e-mail address is well-formed
   if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
     $emailErr = "Invalid email format";
   }
 }

 if (empty($_POST["subject"])) {
   $subject = "";
 } else {
   $subject = test_input($_POST["subject"]);
   if (!filter_var($subject,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $subjectErr = "Invalid subject format";}
 }


 if (empty($_POST["message"])) {
   $message = "";
 } else {
   $message = test_input($_POST["message"]);
   if (!filter_var($message,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $subjectErr = "Invalid message format";}
 }

    $email_from = "aakarsh.banthiya@gmail.com";

    if(empty($subject)){
      $email_subject = "JanakSewaSamiti - Contact Us Form";
    }
    else{
      $email_subject = $subject;
    }

    if (file_exists($template_file))
        $email_body = file_get_contents($template_file);
    else
        die("Unable to locate the template file");


    // create a list of the variables to be swapped in the html template
    $swap_var = array(
      "{SITE_ADDR}" => "https://akarsh17.github.io/JanakSewaSamiti/",
      "{EMAIL_TITLE}" => "JanakSewaSamiti - Contact Us Form ",
      "{NAME}" => $name,
      "{EMAIL}" => $visitor_email,
      "{SUBJECT}" => $subject,
      "{MESSAGE}" => $message
    );
    foreach (array_keys($swap_var) as $key){
    if (strlen($key) > 2 && trim($swap_var[$key]) != '')
      $email_body = str_replace($key, $swap_var[$key], $email_body);
  }

    $to = 'akarshbanthiya@outlook.com';

    $headers = "From: JanakSewaSamiti <".$email_from.">\r\nReply-To: ".$name."<".$visitor_email.">\r\n";
    $headers.="MIME-Version: 1.0\r\n";
    $headers.= "Content-Type: text/html; charset=ISO-8859-1";

    if(mail($to,$email_subject,$email_body,$headers)){
      echo '<script>alert("Message Sent Successfully !\\nThank You !")</script>';
    }
    else{
      echo '<script>alert("Uhhoo, Some error occured.\\nPlease resend the message.")</script>';
    }
    // mail($to,$email_subject,$email_body,$headers);
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    // header("Refresh:3; contact.html");
    echo("<script>location.href = '/contact.html';</script>");
?>
