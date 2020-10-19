$("#addTripForm").submit(function (e) {
  e.preventDefault();
  // get contents of form fields
  tripName = document.getElementById("tripName").value;
  tripDeparture = document.getElementById("tripDeparture").value;
  tripDepartureSelectedIndex = document.getElementById("tripDeparture")
    .selectedIndex;
  tripDestination = document.getElementById("tripDestination").value;
  tripDestinationSelectedIndex = document.getElementById("tripDestination")
    .selectedIndex;
  tripStartDate = document.getElementById("tripStartDate").value;
  tripEndDate = document.getElementById("tripEndDate").value;
  var form_data = new FormData();
  form_data.append("tripName", tripName);
  form_data.append("tripDeparture", tripDeparture);
  form_data.append("tripDestination", tripDestination);
  form_data.append("tripStartDate", tripStartDate);
  form_data.append("tripEndDate", tripEndDate);
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
      url: "api/voyages/create.php",
      type: "POST",
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data, textStatus, jqXHR) {
        Swal.fire({
          icon: "success",
          title: "trip Created",
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
