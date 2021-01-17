
<?php
require_once 'vendor\mailer_settings.php';
//check if this page is accessed through request (post)
if ($_SERVER['REQUEST_METHOD']=='POST') {
//GET form data into variables
//filter sanitize form data to secure the form unwanted scripts
  $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
  $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
  $phone=filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
  $message=filter_var($_POST['message'],FILTER_SANITIZE_STRING);
  //form error handling create error array that conains all error messages
  $form_errors=array();
  //check name input to be larger than 3 characters
  if (strlen($name)<3) {
    $form_errors['name']='Name must be larger than 3 characters';
  }
  //validate email input
  if (!filter_var($email ,FILTER_VALIDATE_EMAIL)) {
    $form_errors['email']='Enter a valid email ex:name@domain.com';
  }
  //validate message larger than 20 charachters
  if (strlen($message)<20) {
    $form_errors['message']='Message must be larger than 20 characters';
  }
  //validate phone number as numbers only and if empty will give no error as it is not mandatory field
  if (!filter_var($phone ,FILTER_VALIDATE_INT)&&!empty($phone)) {
    $form_errors['phone']='Numbers from (0-9) only allowed in phone field';
  }
  //send mail using phpMailer if no errors in form
  if (empty($form_errors)) {
    //Recipients
    echo 'no errors and message is sent';
      $mail->setFrom($email, $name);
      $mail->addAddress('onelast2019@gmail.com');     // Add a recipient
      $mail->Subject = 'Message from Contact Form';       //add a subject
      $mail->Body= 'Message from : '.$email.'<br>'.$message;
      $mail->send();
  }

}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
  </head>
  <body style="background-color:#117a8b;">
    <div class="container">
      <!-- start form -->
      <h1 class=" text-center">Contact Form </h1>


      <form class="contact_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="jq_err name_err alert alert-danger">Name must be larger than 3 characters</div>
        <div class="jq_err mail_err alert alert-danger">Enter a valid email ex:name@domain.com</div>
        <div class="jq_err message_err alert alert-danger">Message must be larger than 20 characters</div>
        <!--adding class (alert alert-danger) to our error div to appear-->
        <div class="form-group">
          <div class="form_error <?php if (isset($form_errors['name'])) {echo ' alert alert-danger';}?>" style="padding:5px;"><?php if (isset($form_errors['name'])) {echo $form_errors['name'];}?></div>
          <!--get value from fields and send it back to the form-->
          <input id="name" type="text" name="name" value="<?php if ($_SERVER['REQUEST_METHOD']=='POST'&&!empty($form_errors)) {echo $name;} ?>" class="form-control" placeholder="Type your Name">
          <i class="fa fa-user fa-fw" aria-hidden="true"></i>
          <span class="astrisk">*</span>
        </div>
        <div class="form-group">
          <div style="padding:5px;" class="form_error <?php if (isset($form_errors['email'])) {echo ' alert alert-danger';}?>"><?php if (isset($form_errors['email'])) {echo $form_errors['email'];}?></div>
          <input id="email" type="email" name="email" value="<?php if ($_SERVER['REQUEST_METHOD']=='POST'&&!empty($form_errors)) {echo $email;} ?>" class="form-control" placeholder="Type your Email">
          <i class="fa fa-envelope fa-fw" aria-hidden="true"></i>
          <span class="astrisk">*</span>
       </div>
        <div style="padding:5px;" class="form_error <?php if (isset($form_errors['phone'])) {echo ' alert alert-danger';}?>"><?php if (isset($form_errors['phone'])) {echo $form_errors['phone'];}?></div>
        <input id="phone" type="text" name="phone" value="<?php if ($_SERVER['REQUEST_METHOD']=='POST'&&!empty($form_errors)) {echo $phone;} ?>" class="form-control" placeholder="Type your phone number">
        <i class="fa fa-phone fa-fw" aria-hidden="true"></i>
        <div style="padding:5px;" class="form_error <?php if (isset($form_errors['message'])) {echo ' alert alert-danger';}?>"><?php if (isset($form_errors['message'])) {echo $form_errors['message'];}?></div>
        <div class="group">
          <textarea id="message" class="form-control"name="message" rows="8" cols="80" placeholder="Type your Message" ><?php if ($_SERVER['REQUEST_METHOD']=='POST'&&!empty($form_errors)) {echo $message;} ?></textarea>
          <span class="astrisk" >*</span>
        </div>
        <input type="submit" name="submit" id="submit" value="Send Message" class="btn btn-success btn-block ">
        <i class="fa fa-paper-plane fa-fw" aria-hidden="true"></i>
      </form>
      <!--End form-->
    </div>







    <script src="js\jquery-3.5.1.min.js" charset="utf-8"></script>
    <script src="js\bootstrap.min.js" charset="utf-8"></script>
    <script src="js\custom.js" charset="utf-8"></script>

  </body>
</html>
