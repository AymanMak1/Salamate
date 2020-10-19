<?php

include_once '../SalamateDashboard/config/Database.php';
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salamat-e</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" integrity="sha256-IyR33qBiUXj7Clf/BpIUivtGnpIpLIL0XOCEGSQPZxg=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet"> 
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <script-- src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js" integrity="sha256-+Q/z/qVOexByW1Wpv81lTLvntnZQVYppIL1lBdhtIq0=" crossorigin="anonymous"></script-->
    <script src="https://kit.fontawesome.com/f4943323d7.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php require_once('./portions/sideBar.php') ?>
    <?php require_once('./portions/trialAndBg.php') ?>
    <?php require_once('./portions/accueil.php') ?>
    <?php require_once('./portions/Sections/addTripSection.php') ?>
    <?php require_once('./portions/Sections/listTripsSection.php') ?>
    <?php require_once('./portions/Sections/listTripsForVaccinesSection.php') ?>
    <?php require_once('./portions/Sections/avisVoyagesSection.php') ?>
    <?php require_once('./portions/Modals/editProfilModal.php') ?>
    <?php require_once('./portions/Modals/editTripModal.php') ?>
    <?php require_once('./portions/Modals/recommendedVaccinesModal.php') ?>
    <?php require_once('./portions/Modals/vaccineScheduleModal.php') ?>
    <?php require_once('./portions/Modals/travelNoticesModal.php') ?>


     <!--JQUERY-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!--Bootstrap js file-->
    <script src="js/bootstrap.min.js"></script>
    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js" integrity="sha256-vVnwgKyq3pIb4XdL91l1EC8j7URqDRK8BAWvSnKX0U8=" crossorigin="anonymous"></script>
    <script src="js/menu2.js"></script>
    <script src="js/showModal.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/onload.js"></script>
    <!--Crud trips JS-->
    <script src="js/crudTrips/addTrip.js"></script>
    <script src="js/crudTrips/deleteTrip.js"></script>
    <script src="js/crudTrips/tripInfos.js"></script>
    <script src="js/crudTrips/editTrip.js"></script>
    <script src="js/crudTrips/travelNotices.js"></script>

    <!--Edit User JS-->
    <script src="js/editProfil.js"></script>
    <script>

        $(document).mousemove(function(e){
            $('.pointer').css({left:e.pageX, top:e.pageY});
        })

        $(document).ready(function () {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            if(dd<10) 
            {
                dd='0'+dd;
            } 
            if(mm<10) 
            {
                mm='0'+mm;
            } 
            today = yyyy+'-'+mm+'-'+dd;
            today = new Date(today);

            $.getScript( "./js/readyFunction/getCountries.js" );
            var iduser = <?php echo $_SESSION['iduser']; ?>;
            $.ajax({
                    url: "./api/vaccines/notifyMe.php",
                    type: "GET", // http method
                    data: { iduser: iduser },
                    success: function (data, status, xhr) {
                        var i;
                        var count = 0;
                        var html='';
                        for( i in data){
                            html += `${parseInt(i)+1}. ${data[i].vaccineName}<br>`
                            count++;
                        }
                        if(count >=2){
                            Swal.fire({
                            icon: "warning",
                            title:  `${count == 1 ? `${count} Uncompleted Vaccine` : `${count} Uncompleted Vaccines` }`,
                            html: html
                            });
                        }

                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        });
                    },
            });
            $.ajax({
                    url: "../SalamateDashboard/api/users/read_single.php",
                    type: "GET", // http method
                    data: { iduser: iduser },
                    success: function (data, status, xhr) {
                        var infos = JSON.parse(xhr.responseText);
                        console.log(infos);
                        //console.log(infos.nationality);
                        document
                        .querySelector("#profilPic")
                        .setAttribute("src", "../pdp/" + infos.profilPic);
                        document.querySelector(".welcome").innerHTML = infos.username;
                        document.querySelector(".welcomeAccueil").innerHTML = infos.username;
                        document.querySelector("#username").value = infos.username;
                        document.querySelector("#fullName").value = infos.fullName;
                        document.querySelector("#nationality").value = infos.nationality;
                        document.querySelector("#phoneNumber").value = infos.phoneNumber;
                        document.querySelector("#birthday").value = infos.birthday;
                        document.querySelector("#gmail").value = infos.gmail;
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        });
                    },
                });
                $.ajax({
                        url: "./api/voyages/read.php",
                        type: "GET", // http method
                        data: { iduser: iduser },
                        success: function (data, status, xhr) {
                            var trips = JSON.parse(xhr.responseText);
                            var appendTrips = '';
                            var appendTripsForVaccines = '';
                            var i;
                            if (trips["Message"] == undefined) {
                            $("#noTrips").addClass("noTripsHide");
                            $("#noTripsForVaccines").addClass("noTripsForVaccinesHide");
                            for (i in trips) {
                                appendTrips += `
                                            <div class="trip" id="trip${trips[i].idtrip}">
                                                <div class="tripName">${trips[i].tripName}</div>
                                                    <div class="crudTripIcons">
                                                        <i class="fas fa-trash-alt" onclick="deleteTrip(${trips[i].idtrip})" id="deleteTrip"></i>
                                                        <i class="fas fa-edit"  onclick="editTrip(${trips[i].idtrip})"></i>
                                                        <i class="fas fa-info-circle"  onclick="tripInfos(${trips[i].idtrip})" ></i>
                                                    </div>
                                                    <hr>
                                            </div>
                                            `;
                                var date = new Date(trips[i].tripStartDate); 
                                // To calculate the time difference of two dates 
                                var Difference_In_Time = date.getTime() - today.getTime();
                                // To calculate the no. of days between two dates 
                                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

                                appendTripsForVaccines += `
                                    <div class="tripForVaccines">
                                        <span> <i class="fas fa-suitcase"></i> ${trips[i].tripName}</span>
                                        <span> <i class="fas fa-plane-departure"></i> ${trips[i].tripDeparture} | <i class="fas fa-plane-arrival"></i> ${trips[i].tripDestination} </span>
                                        <span> <i class="fas fa-calendar-alt"></i> ${trips[i].tripStartDate} |  <i class="fas fa-calendar-alt"></i> ${trips[i].tripEndDate} </span>
                                        <hr>
                                        <span class="daysUntil"> 
                                            ${Difference_In_Days > 0 ? `${Difference_In_Days} days until the trip` :
                                                ( Difference_In_Days == 0 ? "Your trip is today" :"Past Trip") } 
                                        </span>
                                        <button class="btn" 
                                        onclick="recommendedVaccines(${iduser},${trips[i].idtrip})">
                                        <img src="./imgs/syringe.png" width="16" alt=""> Recommended Vaccines
                                        </button>
                                    </div>
                                    
                                    
                                `;
                                //data-izimodal-open=".recommendedVaccinesModal"    
                            
                            }
                            } else {
                                $("#noTrips").addClass("noTripsShow");
                                $("#noTripsForVaccines").addClass("noTripsForVaccinesShow");
                            }

                            $(".listTripsContainer").append(appendTrips);
                            $(".rowTripsForVaccines").append(appendTripsForVaccines);
                                                        
                 
                        },

                        error: function (jqXhr, textStatus, errorMessage) {
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            });
                        },
                    });

        });

    </script>
    <!--Vaccines JS -->
    <script src="js/izimodal/izimodals.js"></script>
    <script src="js/recommendedVaccines2.js"></script>
    <script src="js/vaccineSchedule.js"></script>
    <style>
            .modal-header{
                background-color:#ff3b5f;
                color:white;
            }
            #vaccineScheduleModal{
                z-index:99999;
                border-radius:20px;
            }
            #vaccineScheduleModal h4{
                color:#ff3b5f;
                font-weight:700;
                margin-bottom:16px;
            }
            hr{
                margin: 8px 0 8px 0;
            }
            input[type="date"].form-control{
                line-height:17px !important;
            }
            .swal2-container {
                z-index: 100000000;
            };
            .containerListTripsForVaccinesSection
            .tripForVaccinesContainer
            .rowTripsForVaccines
            div.tripForVaccines {
            background-color: rgba(0, 0, 0, 0.2);
            background-image: url("../imgs/bgVaccines.jpg"),
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: overlay;
            height: 275px;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
            letter-spacing: 2px;
            }

    </style>

   
</body>
</html>