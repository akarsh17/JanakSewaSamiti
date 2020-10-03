<?php
$template_file = "template_file.php";
$template_file_REPLY = "template_file_REPLY.php";

error_reporting(0);
if(isset($_POST['sendform'])){


  if (empty($_POST["fname"])) {
  $fnameErr = "Name is required";
} else {
  $fname = test_input($_POST["fname"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
    $fnameErr = "Only letters and white space allowed";
    $fname = '';
  }
}

if (empty($_POST["lname"])) {
$lnameErr = "Name is required";
} else {
$lname = test_input($_POST["lname"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed";
  $lname = '';
}
}

if (empty($_POST["email"])) {
   $visitor_emailErr = "Email is required";
 } else {
   $visitor_email = test_input($_POST["email"]);
   // check if e-mail address is well-formed
   if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
     $visitor_emailErr = "Invalid email format";
     $visitor_email = '';
   }
 }

 if (empty($_POST["phone"])) {
   $phone = "";
 } else {
   $phone = test_input($_POST["phone"]);
   if (!preg_match('/^[0-9]{10}+$/', $phone)) {
     $phoneErr = "Invalid subject format";
     $phone = '';
   }
 }

 if (empty($_POST["address"])) {
   $address = "";
 } else {
   $address = test_input($_POST["address"]);
   if (!filter_var($address,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $addressErr = "Invalid subject format";
     $address = '';
   }
 }

 if (empty($_POST["city"])) {
   $city = "";
 } else {
   $city = test_input($_POST["city"]);
   if (!filter_var($city,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $cityErr = "Invalid subject format";
     $city = '';
   }
 }

 if (empty($_POST["qualification"])) {
   $qualification = "";
 } else {
   $qualification = test_input($_POST["qualification"]);
   if (!filter_var($qualification,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $qualificationErr = "Invalid subject format";
     $qualification = '';
   }
 }

 if (empty($_POST["volunteeringfor"])) {
   $volunteeringfor = "";
 } else {
   $volunteeringfor = test_input($_POST["volunteeringfor"]);
   if (!filter_var($volunteeringfor,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $volunteeringforErr = "Invalid subject format";
     $volunteeringfor = '';
   }
 }

 if (empty($_POST["message"])) {
   $message = "";
 } else {
   $message = test_input($_POST["message"]);
   if (!filter_var($message,  FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP)) {
     $subjectErr = "Invalid message format";}
 }


    if(empty($subject)){
      $email_subject = "JanakSewaSamiti -Volunteer Form";
    }
    else{
      $email_subject = $subject;
    }
if (file_exists($template_file))
    $email_body = file_get_contents($template_file);
else {
  die() ;
  echo '<script>alert("Uhhoo, Some error occured.\\nPlease resend the message.")</script>';
}

if (file_exists($template_file_REPLY))
    $reply_body = file_get_contents($template_file_REPLY);
else {
  die() ;
  echo '<script>alert("Uhhoo, Some error occured.\\nPlease resend the message.")</script>';
}

    // create a list of the variables to be swapped in the html template
    $swap_var = array(
      "{SITE_ADDR}" => "https://akarsh17.github.io/JanakSewaSamiti/",
      "{EMAIL_TITLE}" => "Volunteer Form Details : ",
      "{NAME}" => $fname." ".$lname,
      "{EMAIL}" => $visitor_email,
      "{ADDRESS}" => $address,
      "{CITY}" => $city,
      "{QUALIFICATION}" => $qualification,
      "{VOLUNTEERING_FOR}" => $volunteeringfor,
      "{MESSAGE}" => $message,
      "{PHONE}" => $phone,
      "{REPLY_TITLE}" => "Application Recieved"
    );
    foreach (array_keys($swap_var) as $key){
		if (strlen($key) > 2 && trim($swap_var[$key]) != '')
			$email_body = str_replace($key, $swap_var[$key], $email_body);
	}

  foreach (array_keys($swap_var) as $key){
  if (strlen($key) > 2 && trim($swap_var[$key]) != '')
    $reply_body = str_replace($key, $swap_var[$key], $reply_body);
  }


    $email_from = "aakarsh.banthiya@gmail.com";
    $to = 'akarshbanthiya@outlook.com';

    $headers = "From: JanakSewaSamiti<".$email_from.">\r\nReply-To: ".$name."<".$visitor_email.">\r\n";
    $headers.="MIME-Version: 1.0\r\n";
    $headers.= "Content-Type: text/html; charset=ISO-8859-1";


    if(mail($to,$email_subject,$email_body,$headers)){
      $headers = "From: JanakSewaSamiti <".$email_from.">\r\nReply-To: JanakSewaSamiti <".$email_from.">\r\n";
      $headers.="MIME-Version: 1.0\r\n";
      $headers.= "Content-Type: text/html; charset=ISO-8859-1";
      mail($visitor_email,$swap_var['{REPLY_TITLE}'],$reply_body,$headers);
      echo '<script>alert("Volunteer Application Sent Successfully !\\nSomeone will get back to you shortly.")</script>';
    }
    else{
      echo '<script>alert("Uhhoo, Some error occured.\\nPlease resend the Application.")</script>';
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
    echo("<script>location.href = '/volunteer.html';</script>");
?>
