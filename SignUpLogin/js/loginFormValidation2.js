document.getElementById("loginBtn").addEventListener("click", (e) => {
  e.preventDefault();
  checkLoginFields();
});

function checkLoginFields() {
  const usernameGmail = document.querySelector("#usernameGmail").value;
  const loginPassword = document.querySelector("#loginPassword").value;
  if (usernameGmail === "" || loginPassword === "") {
    Swal.fire({
      icon: "error",
      title: "Please fill out the fields",
    });
  } else {
    var form_dataLogin = new FormData();
    form_dataLogin.append("usernameGmail", usernameGmail);
    form_dataLogin.append("loginPassword", loginPassword);
    //Ajax to send file to upload
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/login.php", true);
    xhr.onload = function () {
      if (this.status == 200) {
        console.log(JSON.stringify(xhr.responseText));
        switch (xhr.responseText) {
          case "1":
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Check your gmail and activate your account first",
            });
            break;
          case "2":
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "You entered something wrong, try Again !",
            });
            break;
          case "3":
            Swal.fire({
              icon: "success",
              title: "Welcome Back",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              window.location.href = "../Salamate/salamate.php";
            });
            break;
          case "4":
            Swal.fire({
              icon: "success",
              title: "Welcome Back",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              window.location.href = "../SalamateDashboard/salamate.php";
            });
            break;
        }
      }
    };
    xhr.send(form_dataLogin);
  }
}
