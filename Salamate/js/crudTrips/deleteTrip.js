function removeTripDiv(tripDivID) {
  // Removes an element from the document
  var tripDiv = document.getElementById(tripDivID);
  tripDiv.parentNode.removeChild(tripDiv);
}

function deleteTrip(idTrip) {
  Swal.fire({
    title: "Are you sure to remove this trip from your list?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "./api/voyages/delete.php",
        type: "POST", // http method
        data: { idtrip: idTrip },
        success: function (data, status, xhr) {
          removeTripDiv(`trip${idTrip}`);
          Swal.fire("Deleted!", "Your trip has been canceled.", "success");
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
  });
}
