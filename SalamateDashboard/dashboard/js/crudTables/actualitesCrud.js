/****************************
      Actualites Crud
 * ************************ */

var idavis = 0;
var btnEditActualite;
$(document).on("click", "#crudActualitesTable .btnEdit", function () {
  btnEditActualite = $(this);
  idavis = parseInt(btnEditActualite.closest("tr").find("td:eq(0)").text());
  $.ajax("./api/actualites/read_single.php", {
    type: "GET",
    data: { idavis: idavis },
    success: function (data) {
      console.log(data);
      // Set the values into the fields
      $("#title").val(data.title);
      CKEDITOR.instances["description"].setData(data.description);
      if (
        parseInt(btnEditActualite.closest("tr").find("td:eq(4)").text()) == 1
      ) {
        document.getElementById("published").checked = true;
      } else {
        document.getElementById("published").checked = false;
      }

      $("#publicationDate").val(data.publicationDate);
      // Change the form ID to and an edit form so it can help us on submit
      $(".changeForm").attr("id", "formEditActualite");
      // Change the class of the confirmation Button from an add button to an edit one
      $("#formEditActualite .changeBtn")
        .removeClass("addActualiteBtn")
        .addClass("editActualiteBtn");
      // Change the Vccine Modal ID to and edit Modal and its title
      $(".actualiteModal").attr("id", "editActualite");
      $("#editActualite .modal-title").text("Edit Travel Notice");
      $("#editActualite").modal({
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
// Add Actualite & update actualite

$("#formAddActualite").submit(function (e) {
  e.preventDefault();
  option = 1;
  var form_data = new FormData();
  title = $.trim($("#title").val());
  description = $.trim($("#description").val());
  document.querySelector("#published:checked") !== null
    ? (published = 1)
    : (published = 0);
  publicationDate = $.trim($("#publicationDate").val());
  if (description == "") {
    alert("something went wrong, confirm again");
  } else {
    form_data.append("title", title);
    form_data.append("description", description);
    form_data.append("published", published);
    form_data.append("publicationDate", publicationDate);

    var xhr = new XMLHttpRequest();
    if ($("#addActualite").css("display") == "block") {
      xhr.open("POST", "./api/actualites/create.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          Swal.fire({
            icon: "success",
            title: "Travel Notice has been successfully added !",
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
    } else if ($("#editActualite").css("display") == "block") {
      form_data.append("idavis", idavis);
      xhr.open("POST", "./api/actualites/update.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          btnEditActualite.closest("tr").find("td:eq(1)").text(title);
          btnEditActualite.closest("tr").find("td:eq(2)").text(publicationDate);
          if (description.length > 50) {
            btnEditActualite
              .closest("tr")
              .find("td:eq(3)")
              .text(description.substr(0, 50).concat("..."));
          } else {
            btnEditActualite.closest("tr").find("td:eq(3)").text(description);
          }

          btnEditActualite.closest("tr").find("td:eq(4)").text(published);
          Swal.fire({
            icon: "success",
            title: "Travel Notice has been successfully added !",
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

// Publish Actualite
$(document).on("click", ".btnPublish", function () {
  fila = $(this);
  idavis = parseInt($(this).closest("tr").find("td:eq(0)").text());
  published = parseInt($(this).closest("tr").find("td:eq(4)").text());
  publishedToChange = $(this).closest("tr").find("td:eq(4)");
  console.log(publishedToChange);
  console.log($(this).closest("tr").find("td:eq(7)"));
  if (published == 1) {
    return alert("already published");
  }
  var resquesta = Swal.fire({
    title: "Are you sure to publish this travel notice ?",
    text: "it will be visible to Salamat-e users",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Publish",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/actualites/publish.php", {
        type: "GET",
        data: { idavis: idavis },
        success: function () {
          publishedToChange.text("1");
          Swal.fire(
            "Published !",
            "Travel Notice has been published.",
            "success"
          );
        },
      });
    }
  });
});

// Delete Vaccine
$(document).on("click", "#crudActualitesTable .btnDelete", function () {
  fila = $(this);
  idavis = parseInt($(this).closest("tr").find("td:eq(0)").text());
  var resquesta = Swal.fire({
    title: "Are you sure to delete this travel notice ?",
    text: "You will not be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Deleted !",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/actualites/delete.php", {
        type: "GET",
        data: { idavis: idavis },
        success: function () {
          actualitesTable.row(fila.parents("tr")).remove().draw();
        },
      });
      Swal.fire("Deleted !", "Travel Notice has been deleted.", "success");
    }
  });
});
