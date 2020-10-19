$.ajax({
  url: "./api/users/read_single.php",
  type: "GET", // http method
  data: { iduser: iduser },
  success: function (data, status, xhr) {
    var userInfos = JSON.parse(xhr.responseText);
    console.log(userInfos);
  },
  error: function (jqXhr, textStatus, errorMessage) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
    });
  },
});
