//  idvaccine = parseInt($(this).closest("tr").find("td:eq(0)").text());
function editTrip(idTrip) {
  $.ajax({
    url: "./api/voyages/read_single.php",
    type: "GET", // http method
    data: { idtrip: idTrip },
    success: function (data, status, xhr) {
      $("#editTripModal").modal("show");
      $("#editTripName").val(data.tripName);
      $("#editTripDeparture").val(data.tripDeparture);
      $("#editTripDestination").val(data.tripDestination);
      $("#editTripStartDate").val(data.tripStartDate);
      $("#editTripEndDate").val(data.tripEndDate);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
      });
    },
  });

  $("#editTripForm").submit(function (e) {
    e.preventDefault();
    // get contents of form fields
    tripName = document.getElementById("editTripName").value;
    tripDeparture = document.getElementById("editTripDeparture").value;
    tripDepartureSelectedIndex = document.getElementById("editTripDeparture")
      .selectedIndex;
    tripDestination = document.getElementById("editTripDestination").value;
    tripDestinationSelectedIndex = document.getElementById(
      "editTripDestination"
    ).selectedIndex;
    tripStartDate = document.getElementById("editTripStartDate").value;
    tripEndDate = document.getElementById("editTripEndDate").value;
    var form_data = new FormData();
    form_data.append("tripName", tripName);
    form_data.append("tripDeparture", tripDeparture);
    form_data.append("tripDestination", tripDestination);
    form_data.append("tripStartDate", tripStartDate);
    form_data.append("tripEndDate", tripEndDate);
    form_data.append("idtrip", idTrip);
    if (tripStartDate >= tripEndDate) {
      Swal.fire({
        icon: "warning",
        title: "Check the trip dates",
      });
    } else if (tripDepartureSelectedIndex <= 0) {
      Swal.fire({
        icon: "error",
        title: "Select your trip departure",
      });
    } else if (tripDestinationSelectedIndex <= 0) {
      Swal.fire({
        icon: "error",
        title: "Select your trip destination",
      });
    } else if (tripDeparture == tripDestination) {
      Swal.fire({
        icon: "warning",
        title: "Where are you travelling",
      });
    } else {
      $.ajax({
        url: "api/voyages/update.php",
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR) {
          Swal.fire({
            icon: "success",
            title: "trip Modified",
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            location.reload();
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          var message = JSON.parse(jqXHR.responseText);
          console.log(message.code);
        },
      });
    }
  });
}
