<?php

if(isset($_POST['Email'])){

  $email_to = 'vig.viswa@gmail.com';
  $email_subject = "New Contact Message";

  function problem($error){

    echo "Hey! Your wish to contact me had some bug(s)";
    echo "The bugs appear below. <br><br>";
    echo $error. "<br><br>";
    die();
  }

  if(
    !isset($_POST['Firstname']) ||
    !isset($_POST['Lastname']) ||
    !isset($_POST['Email']) ||
    !isset($_POST['Message'])
  ){
    problem('There Appears to be a problem with the filled fields');
  }
  $fname = $_POST['Firstname'];
  $lname = $_POST['Lastname'];
  $message = $_POST['Message'];
  $email = $_POST['Email'];
  $error_message = "";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }
  
  $string_exp = "/^[A-Za-z .'-]+$/";
  if (!preg_match($string_exp, $fname)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br>';
    }
  
  if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

  $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($fname) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
}

?>
