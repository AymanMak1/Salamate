<?php

include_once 'config/Database.php';
$database = new Database();
$db = $database->connect();

session_start();
    
if($_SESSION["iduser"] === null){
    header("Location: ../SignUpLogin/loginSignUp.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Salamat-e Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="./dashboard/css/bootstrap.min.css" rel="stylesheet" />
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <!--script-- src="https://cdn.ckeditor.com/ckeditor5/19.1.1/classic/ckeditor.js"></script-->
    <link rel="stylesheet" href="./DataTables/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
    <!--Font Awesome Cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 
    <link href="./dashboard/css/style1.css" rel="stylesheet" />
  </head>
  <body>

  <?php require_once("./portions/headers/nav.php") ?>
  <?php require_once("./portions/headers/header.php") ?>
  <?php require_once("./portions/headers/breadcrumb.php") ?>


  <?php require_once("./portions/mainSection.php") ?>

  <!--Crud Tables-->
  <?php require_once("./portions/crudTables/crudUsersTable.php") ?>
  <?php require_once("./portions/crudTables/crudDiseasesTable.php") ?>
  <?php require_once("./portions/crudTables/crudVaccinesTable.php") ?>
  <?php require_once("./portions/crudTables/crudActualitesTable.php") ?>

  <?php require_once("./portions/footer.php") ?>

  <!-- Modals -->

  <?php require_once('./portions/modals/addActualiteModal.php'); ?>
  <?php require_once('./portions/modals/addUserModal.php'); ?>
  <?php require_once('./portions/modals/addDiseaseModal.php'); ?>
  <?php require_once('./portions/modals/addVaccineModal.php'); ?>


  <script>
          function editProfil(){
                  // $('.addUserdropdown').trigger('click'); 
                  $(".userModal .modal-title").text("Edit Your Profil");
                  $("#password").removeAttr("required");
                  $("#profilPic").removeAttr("required");
                  var iduser = <?php echo $_SESSION['iduser']; ?>;
                  $.ajax({
                      url:"./api/users/read_single.php",
                      type: "GET", // http method
                      data: { iduser: iduser },
                      success: function (data, status, xhr) {
                        var userToEdit = JSON.parse(xhr.responseText);
                        // set the values into the input fields
                        $("#username").val(userToEdit.username);
                        $("#fullName").val(userToEdit.fullName);
                        $("#phoneNumber").val(userToEdit.phoneNumber);
                        $("#phoneNumber").attr("required",true);
                        $("#gmail").val(userToEdit.gmail);
                        $("#nationality").val(userToEdit.nationality);
                        $("#birthday").val(userToEdit.birthday);
                        $("#password").attr('placeholder', 'empty field = old password');
                        // remove the password confirmation and its label
                        $("#Cpassword").css("display","none");
                        $("#CpasswordLabel").css("display","none");
                        // remove the role input, its label and its span
                        $("#role").css("display","none");
                        $("#roleLabel ").css("display","none");
                        $("#roleLabel span ").css("display","none");
                        // remove the class addUserBtn from the button and add a new class to give it another event listener
                        $(".changeBtn").removeClass( "addUserBtn" ).addClass( "editProfilBtn" );
                        $(".changeForm").attr("id","formEditProfil")
                        $(".userModal").attr("id","editProfil");
                        $("#editProfil").modal("show");
                      },
                      error: function (jqXhr, textStatus, errorMessage) {
                        Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: "Something went wrong!",
                        });
                      },
                });
              }
     CKEDITOR.replace("description");
      /* ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } ); */
    </script>

    <!--Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <!--Font Awesome CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!--Bootstrap js file-->
    <script src="dashboard/js/bootstrap.min.js"></script>
    <!--Datatable js file-->
    <script src="./DataTables/datatables.min.js"></script>
    <!--Datatables Cdn-->            
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <!--Section Anchors-->
    <script src="./dashboard/js/anchors.js"></script>
    <!--JS PHP API ONLOAD-->
    <script src="./api/js/onload2.js"></script>
    <!--Logout Request -->
    <script src="./api/js/logout.js"></script>
    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!--DATA TABLES API JS-->
    <script>
      $(document).ready(function () {
          var iduser = <?php echo $_SESSION['iduser']; ?>;
          var profilPic = '<?php echo $_SESSION['profilPic']; ?>';
          $.ajax({
            url: "./api/users/read_single.php",
            type: "GET", // http method
            data: { iduser: iduser },
            success: function (data, status, xhr) {
              var userInfos = JSON.parse(xhr.responseText);
              $("#welcomeUsername").text(userInfos.fullName);
              $("#welcomeProfilPic").attr('src',`../pdp/${profilPic}`);
            },
            error: function (jqXhr, textStatus, errorMessage) { 
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
              });
            },
          });
          $.getScript( "dashboard/js/getAuthentifiedUserInfos.js" );
          $.getScript( "dashboard/js/crudTables/crudTables2.js" );
          $.getScript( "dashboard/js/editProfil.js" );
          $.getScript( "dashboard/js/crudTables/usersCrud.js" );
          $.getScript( "dashboard/js/crudTables/maladiesCrud2.js" );
          $.getScript( "dashboard/js/crudTables/vaccinesCrud.js" );
          $.getScript( "dashboard/js/crudTables/actualitesCrud.js" );
        });  
    </script>

    <style>
        
        .swal2-popup{
          font-size: 1.6rem !important;
        }
        input[type="date"].form-control{
                  line-height:17px !important;
        }
        .latestUsersTable .panel-heading{
          color:white;
          background-color:#3f3d56;
        }
      </style>



        <!--
        <script src="dashboard/js/crudTables/crudTables2.js"></script>
        <script src="dashboard/js/editProfil.js "></script>
        <script src="dashboard/js/crudTables/usersCrud2.js "></script>
        <script src="dashboard/js/crudTables/maladiesCrud2.js "></script>
        <script src="dashboard/js/crudTables/vaccinesCrud.js "></script>
        <script src="dashboard/js/crudTables/actualitesCrud.js "></script>
        -->

  </body>
</html>
