function recommendedVaccines(iduser, idtrip) {
  $.ajax({
    url: "./api/vaccines/read.php",
    type: "GET", // http method
    data: {
      iduser: iduser,
      idtrip: idtrip,
    },
    success: function (data, status, xhr) {
      var recommendedVaccines = JSON.parse(xhr.responseText);
      var html = "";

      if (recommendedVaccines["Message"] == undefined) {
        for (var i in recommendedVaccines) {
          //console.log(recommendedVaccines[i]);
          html += `
                    <div class="recommendedVaccine" id="vaccine${
                      recommendedVaccines[i].idvaccine
                    }">
                      <div class="vaccineName">${
                        recommendedVaccines[i].vaccineName
                      }</div>
                      <div class="diseaseName"> ${
                        recommendedVaccines[i].diseaseName
                      }</div>
                      <div class="tripDestination">${
                        recommendedVaccines[i].tripDestination
                      }</div>
                      <div class="vaccineInfos"> ${
                        recommendedVaccines[i].vaccineInfos
                      }</div>
                      <div class="nbrDoses">Number of Doses : ${
                        recommendedVaccines[i].nbrDoses
                      }</div>
                      ${
                        recommendedVaccines[i].nbrDoses > 1
                          ? `<div class="daysBetween">Days Between : ${recommendedVaccines[i].daysBetween} </div>`
                          : " "
                      }
  
                      <button class="btn" onclick="
                      $('.setUpScheduleBtn').attr('id','${
                        recommendedVaccines[i].idvaccine
                      }')
                      $('#vaccineScheduleForm .modal-body').html('');
                      scheduleForm(
                        ${recommendedVaccines[i].nbrDoses},
                        ${recommendedVaccines[i].daysBetween}, 
                        '${recommendedVaccines[i].firstDoseDate}');
                      $('#vaccineScheduleModal').modal('show');"> View or set up a vaccine schedule <i class="fas fa-calendar-alt"></i> </button>
  
                      ${
                        parseInt(recommendedVaccines[i].status) == 0
                          ? `
                            <button class="btn btn-salamate completeVaccineBtn" id="completeVaccineBtn${recommendedVaccines[i].idvaccine}" onclick="completeVaccine(${recommendedVaccines[i].idvaccine},'#completeVaccineBtn${recommendedVaccines[i].idvaccine}')"> I have completed this vaccine <img src="./imgs/syringe.png" width="16" alt="">  </button>
                          `
                          : `
                            <button class="btn completedVaccineBtn" > this vaccine has been completed <i class="fas fa-check-double"></i> </button>
                          `
                      }
                    </div> <br> <hr size="30">
  
                `;
          // if (parseInt(recommendedVaccines[i].status) == 1) {
          //$(".completeVaccineBtn").addClass("hideit");
          //}
        }
        $(".recommendedVaccinesModal .iziModal-content").html(html);
        $(".recommendedVaccinesModal").iziModal("open");
      } else {
        Swal.fire({
          icon: "warning",
          title: "No Vaccines Recommended for this trip !",
          text:
            "Forward planning, appropriate preparation and careful precautions can protect your  health and minimize the risks of accident and of acquiring disease.",
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
}

function dosesDates(nbrDoses, daysBetween) {
  var firstDose = document.querySelector("#firstDose").value;
  // console.log(firstDose);
  var firstDoseDate = new Date(firstDose);
  var dosesInputs = document.querySelectorAll(".dosesInputs");
  var i = 0;
  while (nbrDoses != i && daysBetween > 0) {
    firstDoseDate.setDate(firstDoseDate.getDate() + daysBetween);

    let dd = firstDoseDate.getDate();
    let mm = firstDoseDate.getMonth() + 1;
    let yyyy = firstDoseDate.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    let dosesDate = yyyy + "-" + mm + "-" + dd;

    document.querySelectorAll(".dosesInputs")[i].value = dosesDate;
    console.log(dosesDate);
    //console.log(firstDoseDate);
    i++;
  }
}

function scheduleForm(nbrDoses, daysBetween, firstDoseDate) {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1;
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = "0" + dd;
  }
  if (mm < 10) {
    mm = "0" + mm;
  }
  today = yyyy + "-" + mm + "-" + dd;
  var inputs;
  var alreadySetUp;
  if (firstDoseDate != null) {
    inputs = `
          <div class="form-group">
          <label for="firstDose" class="col-form-label"  >FirstDose </label>
          <input type="date" name="" class="form-control" id="firstDose" min="${today}" value=${firstDoseDate} onchange="dosesDates(${nbrDoses},${daysBetween})" required>
          </div>  <br>  
      `;
    alreadySetUp = true;
  } else {
    inputs = `
          <div class="form-group">
          <label for="firstDose" class="col-form-label"  >FirstDose </label>
          <input type="date" name="" class="form-control" id="firstDose" min="${today}" onchange="dosesDates(${nbrDoses},${daysBetween})" required>
          </div>  <br>  
      `;
    console.log("null");
    alreadySetUp = false;
  }
  firstDoseDate = new Date(firstDoseDate);
  var nextDoseDaysBetween = 0;
  var i = 0;
  while (nbrDoses != i && daysBetween > 0) {
    if (alreadySetUp == true) {
      firstDoseDate.setDate(firstDoseDate.getDate() + daysBetween);

      let dd = firstDoseDate.getDate();
      let mm = firstDoseDate.getMonth() + 1;
      let yyyy = firstDoseDate.getFullYear();
      if (dd < 10) {
        dd = "0" + dd;
      }
      if (mm < 10) {
        mm = "0" + mm;
      }

      let dosesDate = yyyy + "-" + mm + "-" + dd;
      inputs += `
        <div class="form-group">
        <label for="editTripName" class="col-form-label">${
          daysBetween + nextDoseDaysBetween
        } Days After the first dose </label>
         <input type="date" name="" value="${dosesDate}" class="form-control dosesInputs" readonly>
         </div>   <br>  
        `;
      nextDoseDaysBetween = daysBetween;
      i++;
    } else {
      inputs += `
        <div class="form-group">
        <label for="editTripName" class="col-form-label">${
          daysBetween + nextDoseDaysBetween
        } Days After the first dose </label>
         <input type="date" name="" value="${dosesDate}" class="form-control dosesInputs" readonly>
         </div>   <br>  
        `;
      nextDoseDaysBetween = daysBetween;
      i++;
    }
  }

  $("#vaccineScheduleForm .modal-body").append(inputs);
}

$("#vaccineScheduleForm").submit(function (e) {
  e.preventDefault();
  var firstDoseDate = document.querySelector("#firstDose").value;
  var dosesInput = document.querySelectorAll(".dosesInputs");
  var idvaccine = document.querySelectorAll(".setUpScheduleBtn")[0].id;
  console.log(idvaccine);
  var i;
  var inputs = [];
  for (i = 0; i < dosesInput.length; i++) {
    inputs.push(dosesInput[i].value);
  }

  $.ajax({
    url: "./api/vaccines/setSchedule.php",
    type: "POST", // http method
    data: {
      idvaccine: idvaccine,
      firstDoseDate: firstDoseDate,
    },
    success: function (data, status, xhr) {
      Swal.fire({
        icon: "success",
        title: "Schedule has been set",
        showConfirmButton: false,
        timer: 2000,
      });
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

function completeVaccine(vaccineId, btnID) {
  $.ajax({
    url: "./api/vaccines/completedVaccine.php",
    type: "POST", // http method
    data: {
      idvaccine: vaccineId,
    },
    success: function (data, status, xhr) {
      $(btnID).addClass("completedVaccineBtn");
      $(btnID).html(
        " this vaccine has been completed <i class='fas fa-check-double'></i>"
      );
      Swal.fire({
        icon: "success",
        title: "Vaccine has been completed",
        showConfirmButton: false,
        timer: 2000,
      });
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
