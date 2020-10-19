// Nothing to do with crud table , edit Profil verfication

function editProfilSubmission(formData) {
  $.ajax("../SalamateDashboard/api/users/editProfil.php", {
    type: "POST",
    contentType: false,
    processData: false,
    cache: false,
    data: formData,
    dataType: "JSON",
    success: function (data) {
      Swal.fire({
        icon: "success",
        title: "Votre compte a été bien modifié",
        showConfirmButton: false,
        timer: 1500,
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
}

$(document).on("click", ".editProfilBtn ", function (e) {
  // $("#formEditProfil").submit(function (e) {
  e.preventDefault();
  // remove the required attribute from the password and profil image inputs
  //**************** variables for the verification ***********************//
  // for nationality verification
  nationalitySelect = document.getElementById("nationality");
  // for phone verification
  telNotMatchedCase = new Array();
  telNotMatchedCase.push("[$@$!%*#?&.,^=/*`~]"); // Special Charecter
  telNotMatchedCase.push("[A-Z]"); // Uppercase Alpabates
  telNotMatchedCase.push("[a-z]"); // Uppercase Alpabates
  var ctr = 0;
  // for gmail verification
  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  // for image verification
  imgExtensionArr = new Array();
  imgExtensionArr.push("png");
  imgExtensionArr.push("PNG");
  imgExtensionArr.push("jpg");
  imgExtensionArr.push("JPG");
  imgExtensionArr.push("jpeg");
  imgExtensionArr.push("JPEG");
  imgExtensionArr.push("gif");
  imgExtensionArr.push("GIF");

  // getting the form fields values and append them to the form data that we are going to send on post ajax request

  username = $.trim($("#username").val());
  fullName = $.trim($("#fullName").val());
  nationality = $.trim($("#nationality").val());

  phoneNumber = $.trim($("#phoneNumber").val());

  for (var i = 0; i < telNotMatchedCase.length; i++) {
    if (new RegExp(telNotMatchedCase[i]).test(phoneNumber)) {
      ctr++;
    }
  }

  birthday = $.trim($("#birthday").val());
  gmail = $.trim($("#gmail").val());
  profilPic = $("input[type=file]").val().split("\\").pop();

  profilPicExtension = profilPic.split(".").pop();
  password = $.trim($("#password").val());

  if (nationalitySelect.selectedIndex <= 0) {
    alert("Select a Nationality for the user");
  } else if (ctr >= 1) {
    alert("Phone Number is not valid");
  } else if (phoneNumber == "") {
    alert("Type your Phone Number");
  } else if (phoneNumber.length < 10) {
    alert("10 digits please");
  } else if (reg.test(gmail) == false) {
    alert("Gmail is not valid");
  } else if (
    profilPic != "" &&
    imgExtensionArr.includes(profilPicExtension) == false
  ) {
    alert(
      "! select a valid image format: png/PNG, jpeg/JPEG, jpg/JPG, gif/GIF "
    );
  } else {
    var form_data = new FormData();
    form_data.append("username", username);
    form_data.append("fullName", fullName);
    form_data.append("nationality", nationality);
    form_data.append("phoneNumber", phoneNumber);
    form_data.append("birthday", birthday);
    form_data.append("gmail", gmail);
    form_data.append("profilPic", profilPic);
    form_data.append("password", password);
    editProfilSubmission(form_data);
    $(".welcome").html(username);
    $(".welcomeAccueil").html(username);
    /* 
        var xhr = new XMLHttpRequest();
      xhr.open("POST", "./api/users/editProfil.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          var output = JSON.parse(this.responseText);
          console.log(output);
          //$("#welcomeUsername").text();
          Swal.fire({
            icon: "success",
            title: "Votre compte a été bien modifié",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          console.log(this.status);
        }
      };
      xhr.send(formData);
    
    */
  }
});
