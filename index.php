<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienvenue sur Salamat-e</title>
    <link rel="stylesheet" href="Accueil/css/reset.css" />
    <link rel="stylesheet" href="Accueil/css/style.css" />
    <!--Font Awesome CSS CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ="
      crossorigin="anonymous"
    />
    <!--POPPINS FONT AWESOME-->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!--Courgette FONT AWESOME-->
    <link
      href="https://fonts.googleapis.com/css2?family=Courgette&display=swap"
      rel="stylesheet"
    />
    <!--AOS LIBRARY CSS CDN (ANIMATION ON SCROLL)-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  </head>
  <body>
    <!--Loader-->
    <!--div class="loader">
      <div></div>
      <div></div>
      <div></div>
    </div-->

    <!---------------
      Main Content
    ----------------->

    <!--Header-->

    <?php require_once('./Accueil/portions/header.php'); ?>

    <!--Header Content-->

    <?php require_once('./Accueil/portions/headerContents.php'); ?>

    <!---------------
      About US Section
    ----------------->

    <?php require_once('./Accueil/portions/aboutUs.php'); ?>

    <!------------------
      Services Section
    -------------------->

    <?php require_once('./Accueil/portions/services.php'); ?>
    
    <!------------------
      Actualites Section
    -------------------->

    <?php require_once('./Accueil/portions/new.php'); ?>

    <!---------------------
      Pourquoi nous Section
    ----------------------->

    <?php require_once('./Accueil/portions/pourquoiNous.php'); ?>

    <!--------------------
        Clients Section
    --------------------->

    <?php require_once('./Accueil/portions/clients.php'); ?>
 
    <!---------------
        Contact
    ----------------->


    <?php require_once('./Accueil/portions/contact.php'); ?>


    <!---------------
        Footer
    ----------------->

    <?php require_once('./Accueil/portions/footer.php'); ?>
   
    <!---------------
      External JS
    ----------------->
    <!--Jquery Cdn-->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"
      integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
      crossorigin="anonymous"
    ></script>
    <!--Loader JS-->
    <script src="Accueil/js/loader.js"></script>
    <!--Nav JS-->
    <script src="Accueil/js/nav.js"></script>
    <!--Section Anchors-->
    <script src="Accueil/js/sectionAnchors.js"></script>
    <!--News Background Changer-->
    <script src="Accueil/js/newsBg.js"></script>
    <!--Scroll Animation-->
    <!--script src="Accueil/js/skrollr.min.js"></script-->
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!--AOS LIBRARY JS CDN ( ANIMATION ON SCROLL )-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!--In case the cdn of animation on scroll does not work-->
    <!--aos js file-->
    <script src="Accueil/js/aos.min.js"></script>
    <script type="text/javascript">
      // In case html behaviour does not work (internet explorer case)
      var scroll = new SmoothScroll('a[href*="#"]', {
        speed: 1000,
        speedAsDuration: true,
      });

      // initialize AOS
      AOS.init({
        offset: 300,
        duration: 1000,
      });
      
      $(document).ready(function(){
        $.get("./Accueil/php/newest.php", function(data){
          data = $.parseJSON(data)
          console.log(data[0].title);
          var actualiteHtmlSection = `
                <i class="fas fa-exclamation-circle" style="margin-right: 16px;"></i>
                <h1>
                  Latest News
                </h1>
                <h2 class="newsTitle">
                  ${data[0].title}
                </h2>
                <span class="publicationDate">  ${data[0].publicationDate}</span>
                <p class="description">
                     ${data[0].description}
                </p>
                <a href="" class="readMore">Read More</a> 
            `
          $('.new').append(actualiteHtmlSection);
        });
      })
      /*
      setTimeout(function () {
        $("#body").css("display","block !important");
      }, 3000);
      */

      // var s = skrollr.init();
    </script>
  <style>
    .servicesContainer{
      justify-content:space-around;
    }
  </style>
  </body>
</html>
