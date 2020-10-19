/****************************
          Users Crud
 * ************************ */

// Update User Btn
var iduser = 0;
var btnEditUser;
$(document).on("click", "#crudUsersTable .btnEdit", function () {
  btnEditUser = $(this);
  iduser = parseInt(btnEditUser.closest("tr").find("td:eq(0)").text());
  $.ajax("./api/users//read_single.php", {
    type: "GET",
    data: { iduser: iduser },
    success: function (data) {
      console.log(data);
      $("#Cpassword").css("display", "none");
      $("#CpasswordLabel").css("display", "none");
      $("#role").css("display", "block");
      $("#roleLabel").css("display", "block");
      $("#roleLabel span ").css("display", "block");
      // Set the values into the fields
      $("#username").val(data.username);
      $("#fullName").val(data.fullName);
      $("#phoneNumber").val(data.phoneNumber);
      $("#phoneNumber").attr("required", true);
      $("#gmail").val(data.gmail);
      $("#nationality").val(data.nationality);
      $("#birthday").val(data.birthday);
      $("#password").attr("placeholder", "empty field = old password");
      $("#role").val(data.role);
      // Change the form ID to and an edit form so it can help us on submit
      $(".changeForm").attr("id", "formEditUser");
      // Change the class of the confirmation Button from an add button to an edit one
      $("#formEditUser .changeBtn")
        .removeClass("addUserBtn")
        .addClass("editUserBtn");
      // Change the Vccine Modal ID to and edit Modal and its title
      $(".userModal").attr("id", "editUser");
      $("#editUser .modal-title").text("Edit User");
      $("#editUser").modal({
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

$(".userModal .changeForm").submit(function (e) {
  e.preventDefault();

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

  var form_data = new FormData();
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
  // console.log(profilPicExtension);
  password = $.trim($("#password").val());
  cpassword = $.trim($("#Cpassword").val());
  role = $.trim($("#role").val());

  if (nationalitySelect.selectedIndex <= 0) {
    alert("Select a Nationality for the user");
  } else if (ctr >= 1) {
    alert("Phone Number is not valid");
  } else if (reg.test(gmail) == false) {
    alert("Gmail is not valid");
  } else if (
    imgExtensionArr.includes(profilPicExtension) == false &&
    $("#addUser").css("display") == "block"
  ) {
    alert(
      "! select a valid image format: png/PNG, jpeg/JPEG, jpg/JPG, gif/GIF "
    );
  } else if (cpassword != password) {
    alert("The Passwords do not match");
  } else {
    verified = 0;
    form_data.append("username", username);
    form_data.append("fullName", fullName);
    form_data.append("nationality", nationality);
    form_data.append("phoneNumber", phoneNumber);
    form_data.append("birthday", birthday);
    form_data.append("gmail", gmail);
    form_data.append("profilPic", profilPic);
    form_data.append("password", password);
    form_data.append("role", role);
    var xhr = new XMLHttpRequest();
    if ($("#addUser").css("display") == "block") {
      xhr.open("POST", "./api/users/create.php", true);
      xhr.onload = function () {
        if (this.status == 200) {
          Swal.fire({
            icon: "success",
            title: "User successfully added",
            showConfirmButton: false,
            timer: 1500,
          }); /*.then(() => {
            location.reload();
          });*/
        } else {
          console.log(this.responseText);
        }
      };
      xhr.send(form_data);
    } else {
      if ($("#editUser").css("display") == "block") {
        xhr.open("POST", "./api/users/update.php", true);
        xhr.onload = function () {
          if (this.status == 200) {
            //btnEditVaccine.closest("tr").find("td:eq(1)").text(vaccineName);
            Swal.fire({
              icon: "success",
              title: "L'utilisateur a été bien modifiée",
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
  }
});

// Delete User
$(document).on("click", ".btnDelete", function () {
  fila = $(this);
  iduser = parseInt($(this).closest("tr").find("td:eq(0)").text());
  var resquesta = Swal.fire({
    title: "Are you sure to delete this user ?",
    text: "You will not be able to revert this !",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Delete",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/users/delete.php", {
        type: "GET",
        data: { iduser: iduser },
        success: function () {
          usersTable.row(fila.parents("tr")).remove().draw();
        },
      });
      Swal.fire("Deleted !", "the user has been deleted.", "success");
    }
  });
});

// Verify a user account

$(document).on("click", ".btnVerify", function () {
  fila = $(this);
  iduser = parseInt($(this).closest("tr").find("td:eq(0)").text());
  verified = parseInt($(this).closest("tr").find("td:eq(7)").text());
  verifiedToChange = $(this).closest("tr").find("td:eq(7)");
  console.log($(this).closest("tr").find("td:eq(7)"));
  if (verified == 1) {
    return alert("Already verified");
  }
  console.log(verified);
  var resquesta = Swal.fire({
    title: "Are you sure to confirm the registration of this user ?",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonColor: "#ff3b5f",
    cancelButtonColor: "#3f3d56",
    confirmButtonText: "Confirm",
  }).then((result) => {
    if (result.value) {
      $.ajax("./api/users/verify.php", {
        type: "GET",
        data: { iduser: iduser },
        success: function () {
          verifiedToChange.text("1");
        },
      });
      Swal.fire("Verified !", "user has been verified", "success");
    }
  });
});
