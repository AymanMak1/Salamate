<?php require_once('../conn/conn.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salamat-e LogIn/SignUp</title>
    <!--External CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!--External POPPINS-->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap"
      rel="stylesheet"
    />
    <!--FONT AWESOME CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" 
    integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!--script src="https://kit.fontawesome.com/a81368914c.js"></script-->
  </head>
  <body>

      <?php require_once('./portions/FormsLinks.php'); ?>
      <?php require_once('./portions/SignUpForm.php'); ?>
      <?php require_once('./portions/LoginForm.php'); ?>

    <!--Jquery Cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--TEL INPUT JS CDN-->
    <!--FONT AWESOME JS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" 
    integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!--SweetAlert Cdn-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="js/design.js"></script>
     <!--smtp Cdn-->
    <script type="text/javascript" src="js/smtp.js"></script>
    <!--Lading Countries JS-->
    <script type="text/javascript" src="js/loadCountries.js"></script>
     <!--Sign Up Form Validation JS-->
    <script type="text/javascript" src="js/signUpFormValidation2.js"></script>
     <!--Sign Up Form Validation JS-->
     <script type="text/javascript" src="js/loginFormValidation2.js"></script>



    <script>
              $('.avatar').click(function(){ $('#pdp').trigger('click'); });
    </script>
    <style>
      .swal2-popup{
        transform:scale(1) !important;
        /*font-size: 1.6rem !important;*/
      }
    
    </style>
    
  </body>
</html>