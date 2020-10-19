/****************************
          Maladies Crud
 * ************************ */

// Update Disease Btn
var iddisease = 0;
var btnEditDisease;
$(document).on("click", "#crudDiseasesTable .btnEdit", function () {
  btnEditDisease = $(this);
  iddisease = parseInt(btnEditDisease.closest("tr").find("td:eq(0)").text());
  $.ajax("./api/maladies/read_single.php", {
    type: "GET",
    data: { iddisease: iddisease },
    success: function (data) {
      console.log(data);
      // Set the values into the fields
      $("#diseaseName").val(data.diseaseName);
      $("#country").val(data.idcountry);
      // Change the form ID to and an edit form so it can help us on submit
      $(".changeForm").attr("id", "formEditDisease");
      // Change the class of the confirmation Button from an add button to an edit one
      $("#formEditDisease .changeBtn")
        .removeClass("addDiseaseBtn")
        .addClass("editDiseaseBtn");
      // Change the Vccine Modal ID to and edit Modal and its title
      $(".diseaseModal").attr("id", "editDisease");
      $("#editDisease .modal-title").text("Edit Disease");
      $("#editDisease").modal({
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

// Add Disease & Update Disease
$("#formAddDisease").submit(function (e) {
  e.preventDefault();

  CountrySelect = document.getElementById("country");

  var form_data = new FormData();
  diseaseName = $.trim($("#diseaseName").val());
  idcountry = $.trim($("#country").val());
  countryName = $.trim($("#country option:selected").html());
  if (CountrySelect.selectedIndex <= 0) {
    alert("Select a country");
  } else {
    form_data.append("diseaseName", diseaseName);
    form_data.append("idcountry", idcountry);
    var xhr = new XMLHttpRequest();
    if ($("#addDisease").css("display") == "block") {
      xhr.open("POST", "./api/maladies/create.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          Swal.fire({
            icon: "success",
            title: "Disease has been successfully added !",
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
    } else if ($("#editDisease").css("display") == "block") {
      form_data.append("iddisease", iddisease);
      xhr.open("POST", "./api/maladies/update.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          btnEditDisease.closest("tr").find("td:eq(1)").text(countryName);
          btnEditDisease.closest("tr").find("td:eq(2)").text(diseaseName);
          Swal.fire({
            icon: "success",
            title: "Disease has been successfully added !",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          console.log(this.responseText);
        }
      };
      xhr.send(form_data);
    }
  }
});

// Delete Disease
$(document).on("click", "#crudDiseasesTable .btnDelete", function () {
  fila = $(this);
  iddisease = parseInt($(this).closest("tr").find("td:eq(0)").text());
  var resquesta = Swal.fire({
    title: "Are you sure to delete this disease?",
    text: "You will not be able to revert this !",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Deleted !",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/maladies/delete.php", {
        type: "GET",
        data: { iddisease: iddisease },
        success: function () {
          diseasesTable.row(fila.parents("tr")).remove().draw();
        },
      });
      Swal.fire("Deleted !", "the disease has been deleted !", "success");
    }
  });
});
