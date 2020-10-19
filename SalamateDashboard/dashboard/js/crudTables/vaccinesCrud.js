/****************************
          Vaccines Crud
 * ************************ */

// Update Vaccine Btn
var idvaccine = 0;
var btnEditVaccine;
$(document).on("click", "#crudVaccinesTable .btnEdit", function () {
  btnEditVaccine = $(this);
  idvaccine = parseInt(btnEditVaccine.closest("tr").find("td:eq(0)").text());
  $.ajax("./api/vaccines/read_single.php", {
    type: "GET",
    data: { idvaccine: idvaccine },
    success: function (data) {
      console.log(data);
      // Set the values into the fields
      $("#vaccineName").val(data.vaccineName);
      $("#vaccineDisease").val(data.iddisease);
      $("#vaccineInfos").val(data.vaccineInfos);
      $("#nbrDoses").val(data.nbrDoses);
      $("#daysBetween").val(data.daysBetween);
      // Change the form ID to and an edit form so it can help us on submit
      $(".changeForm").attr("id", "formEditVaccine");
      // Change the class of the confirmation Button from an add button to an edit one
      $("#formEditVaccine .changeBtn")
        .removeClass("addVaccineBtn")
        .addClass("editVaccineBtn");
      // Change the Vccine Modal ID to and edit Modal and its title
      $(".vaccineModal").attr("id", "editVaccine");
      $("#editVaccine .modal-title").text("Edit Vaccine");
      $("#editVaccine").modal({
        show: "true",
      });
    },
    error: function (jqXhr, textStatus, errorMessage) {
      console.log(`${jqXhr} ${textStatus}  ${errorMessage} `);
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
      });
    },
  });
});

// Add Vaccine & update Vaccine
$("#formAddVaccine").submit(function (e) {
  e.preventDefault();
  vaccineDisease = document.getElementById("vaccineDisease");
  var form_data = new FormData();
  vaccineName = $.trim($("#vaccineName").val());
  diseaseName = $.trim($("#vaccineDisease option:selected").text());
  iddisease = $.trim($("#vaccineDisease").val());
  vaccineInfos = $.trim($("#vaccineInfos").val());
  nbrDoses = $.trim($("#nbrDoses").val());
  daysBetween = $.trim($("#daysBetween").val());

  if (vaccineDisease.selectedIndex <= 0) {
    alert("Select a Disease");
  } else {
    form_data.append("vaccineName", vaccineName);
    form_data.append("iddisease", iddisease);
    form_data.append("vaccineInfos", vaccineInfos);
    form_data.append("nbrDoses", nbrDoses);
    form_data.append("daysBetween", daysBetween);
    var xhr = new XMLHttpRequest();
    if ($("#addVaccine").css("display") == "block") {
      xhr.open("POST", "./api/vaccines/create.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          Swal.fire({
            icon: "success",
            title: "Vaccine has been added with success",
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            location.reload();
          });
        } else {
          console.log(this.responseText);
        }
      };
      xhr.send(form_data);
    } else if ($("#editVaccine").css("display") == "block") {
      form_data.append("idvaccine", idvaccine);
      xhr.open("POST", "./api/vaccines/update.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          btnEditVaccine.closest("tr").find("td:eq(1)").text(vaccineName);
          btnEditVaccine.closest("tr").find("td:eq(2)").text(diseaseName);
          if (vaccineInfos.length > 50) {
            btnEditVaccine
              .closest("tr")
              .find("td:eq(3)")
              .text(vaccineInfos.substr(0, 50).concat("..."));
          } else {
            btnEditVaccine.closest("tr").find("td:eq(3)").text(vaccineInfos);
          }

          btnEditVaccine.closest("tr").find("td:eq(4)").text(nbrDoses);
          btnEditVaccine.closest("tr").find("td:eq(5)").text(daysBetween);
          Swal.fire({
            icon: "success",
            title: "Vaccine has been successfully updated",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          console.log(this.responseText);
        }
      };
      xhr.send(form_data);
    } else {
      console.log("wal3jeb");
    }
  }
});

// Delete Vaccine
$(document).on("click", "#crudVaccinesTable .btnDelete", function () {
  fila = $(this);
  idvaccine = parseInt($(this).closest("tr").find("td:eq(0)").text());
  var resquesta = Swal.fire({
    title: "Are you sure to delete this vaccine?",
    text: "You will not be able to revert this !",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Delete",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/vaccines/delete.php", {
        type: "GET",
        data: { idvaccine: idvaccine },
        success: function () {
          vaccinesTable.row(fila.parents("tr")).remove().draw();
        },
      });
      Swal.fire("Deleted !", "the vaccine has been deleted !", "success");
    }
  });
});
