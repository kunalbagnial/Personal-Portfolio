<?php
  if(isset($_POST["send"])) {
      // get the form  fields, remove html tags and whitespaces.
      $name =  strip_tags(trim($_POST["name"]));
      $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
      $subject = strip_tags(trim($_POST["subject"]));
      $message = wordwrap($_POST["message"], 70);
      
      // check the data.
      if(empty($name) || empty($email) || empty($subject)) {
          header("Location: https://devkunal.000webhostapp.com/index.php?success=-1#form");
      } 
      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           header("Location: https://devkunal.000webhostapp.com/index.php?success=0#form");
      } 
      else {
          // set the recipient email address.
          $to = "kunal.bagnial@gmail.com";
          
          // build the email content.
          $email_content = "Name: ${name}\n";
          $email_content .= "Email: ${email}\n";
          $email_content .= "Message: \n${message}\n";
          
          // build the email headers.
          $email_headers = "From: $name <$email>";
          
          // send the mail.
          mail($to, $subject, $email_content, $email_headers);
          
          // redirect to form with success code.
          if(mail($to, $subject, $email_content, $email_headers)) {
              header("Location: https://devkunal.000webhostapp.com/index.php?success=1");
          }        
      }     
  } 
  else {
      header("Location: https://devkunal.000webhostapp.com/");
  }
?>
