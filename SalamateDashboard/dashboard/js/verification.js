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
    } else if (imgExtensionArr.includes(profilPicExtension) == false) {
      alert(
        "! select a valid image format: png/PNG, jpeg/JPEG, jpg/JPG, gif/GIF "
      );
    } else if (cpassword != password) {
      alert("The Passwords do not match");
    } else {