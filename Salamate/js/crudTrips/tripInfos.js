function tripInfos(idTrip) {
  $.ajax({
    url: "./api/voyages/read_single.php",
    type: "GET", // http method
    data: { idtrip: idTrip },
    success: function (data, status, xhr) {
      console.log(data);
      Swal.fire({
        title: data.tripName,
        html:
          "<br>Trip Departure : " +
          data.tripDeparture +
          "<br>" +
          "Trip Destination : " +
          data.tripDestination +
          "<br>" +
          "Trip Departure Date : " +
          data.tripStartDate +
          "<br>" +
          "Trip Arrival Data : " +
          data.tripEndDate,
        showCloseButton: true,
        confirmButtonColor: "#ff3b5f",
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
