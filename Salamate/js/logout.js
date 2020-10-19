const logout = document.getElementById("logoutBtn");

logout.addEventListener("click", function logout() {
  var xhr = new XMLHttpRequest();
  var resquesta = Swal.fire({
    title: "Are you sure to logout ?",
    //text: "Vous ne serez pas en mesure de revenir !",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.value) {
      xhr.open("POST", "../SalamateDashboard/api/users/logout.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (this.status == 200) {
          var redirectUrl = JSON.stringify(this.responseText);
          window.location.href = "../SignUpLogin/loginSignUp.php";
        } else {
          console.log("washa");
        }
      };
      xhr.send();
    }
  });
});
