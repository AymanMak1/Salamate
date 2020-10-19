/*******************
 *
 * FILEDS Variables
 *
 * ****************/

var signUpForm = document.getElementById("signUpForm");
const pdp = document.querySelector("#pdp");
const fullname = document.getElementById("fullname");
const username = document.getElementById("username");
const gmail = document.getElementById("gmail");
const nationalite = document.getElementById("nationalite");
const tel = document.getElementById("tel");
const birthday = document.getElementById("birthday");
const motDePasse = document.getElementById("pwd");
const confirmation = document.getElementById("cpwd");
const checkTerms = document.querySelector("#checkTerms");
// variable to incerement while the field is valide
var cmptValide = 0;

/***********************
 *
 * SignUp Button Event
 *
 * *********************/

document.getElementById("inscrireBtn").addEventListener("click", (e) => {
  e.preventDefault();
  checkFields();
});

// turn the variable cmptOneTimeFullName to true when the field is valide and just in the first click of the button
var cmptOneTimePdp = false;
var cmptOneTimeFullName = false;
var cmptOneTimeUsername = false;
var cmptOneTimeGmail = false;
var cmptOneTimeNationalite = false;
var cmptOneTimeTel = false;
var cmptOneTimeBirthday = false;
var cmptOneTimeMotDePasse = false;
var cmptOneTimeConfirmation = false;
var cmptOneTimeUsername = false;
var cmptOneTimeCheckTerms = false;
var cmptOneTimeVerify = false;

/*******************
 *
 * HELP FUNCTIONS
 *
 * ****************/

// Set Error for fields : hide the success span and show the error span  (params : the input and the error message)
function setErrorFor(input, message) {
  input.nextElementSibling.nextElementSibling.style.display = "none";
  input.nextElementSibling.style.display = "flex";
  input.nextElementSibling.innerText = message;
}
// Set Success for fields : hide the error span and show the success span
function setSuccessFor(input) {
  input.nextElementSibling.style.display = "none";
  input.nextElementSibling.nextElementSibling.style.display = "flex";
}
// checking the white space
function hasNotWhiteSpace(str) {
  return str.indexOf(" ") <= 0;
}
function hasWhiteSpace(str) {
  return str.indexOf(" ") >= 0;
}

// pdp check, to inform the user that the image is selected

// check if the extension of the file is an image extension
const imgExtensionArr = new Array();
imgExtensionArr.push("png");
imgExtensionArr.push("PNG");
imgExtensionArr.push("jpg");
imgExtensionArr.push("JPG");
imgExtensionArr.push("jpeg");
imgExtensionArr.push("JPEG");
imgExtensionArr.push("gif");
imgExtensionArr.push("GIF");

pdp.onchange = function (e) {
  if (imgExtensionArr.includes(pdp.value.split(".").pop())) {
    Swal.fire({
      icon: "success",
      title: "Image has been Selected",
      showConfirmButton: false,
      timer: 1500,
    });
    if (cmptOneTimePdp == false) {
      cmptValide++;
      cmptOneTimePdp = true;
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text:
        "Would you please select a valid format such as jpg, jpeg, png, gif.",
    });
  }
};

/******************************
 *
 * Main Verification Function
 *
 * *****************************/

function checkFields() {
  /******************************
   *
   *       Fields Values
   *
   * *****************************/

  const pdpValue = $("#pdp").prop("files")[0];
  const fullnameValue = fullname.value;
  const usernameValue = username.value.trim();
  const gmailValue = gmail.value.trim();
  const nationaliteSelectedIndex = nationalite.selectedIndex;
  const nationaliteoptions = nationalite.options;
  const nationaliteValue = nationaliteoptions[nationaliteSelectedIndex].text;
  const birthdayValue = birthday.value;
  const telValue = tel.value.trim();
  const motDePasseValue = motDePasse.value.trim();
  const confirmationValue = confirmation.value.trim();

  /******************************
   *
   * Photo de profil 1/2 Check
   *
   * *****************************/
  if (pdp.value === "") {
    Swal.fire({
      icon: "warning",
      title: "Don't you want a profil pic",
      text: "Click the avatar above the form and select one from your device",
    });
    //$(".avatar").trigger("click");
  }
  /******************************
   *
   *      Full Name Check
   *
   * *****************************/

  if (fullnameValue === "") {
    setErrorFor(fullname, "Full Name cannot be empty");
  } else if (fullnameValue.indexOf(" ") <= 0) {
    setErrorFor(fullname, "put some space between");
  } else {
    setSuccessFor(fullname);
    if (cmptOneTimeFullName == false) {
      cmptValide++;
      cmptOneTimeFullName = true;
    }
  }

  /******************************
   *
   *      UserName Check
   *
   * *****************************/

  if (usernameValue === "") {
    setErrorFor(username, "Username cannot be empty");
  } else if (hasWhiteSpace(usernameValue)) {
    setErrorFor(username, "username must not have space");
  } else if (usernameValue.length < 6) {
    setErrorFor(username, "6 caracteres or more");
  } else {
    setSuccessFor(username);
    if (cmptOneTimeUsername == false) {
      cmptValide++;
      cmptOneTimeUsername = true;
    }
  }

  /******************************
   *
   *      Gmail Check
   *
   * *****************************/

  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

  if (gmailValue === "") {
    setErrorFor(gmail, "gmail cannot be empty");
  } else if (hasWhiteSpace(gmailValue)) {
    setErrorFor(gmail, "gmail must not have space");
  } else if (reg.test(gmailValue) == false) {
    setErrorFor(gmail, "this gmail is invalid");
  } else {
    setSuccessFor(gmail);
    if (cmptOneTimeGmail == false) {
      cmptValide++;
      cmptOneTimeGmail = true;
    }
  }

  /******************************
   *
   *      Nationalite
   *
   * *****************************/

  if (nationalite.selectedIndex <= 0) {
    setErrorFor(nationalite, "chose your nationality");
  } else {
    setSuccessFor(nationalite);
    if (cmptOneTimeNationalite == false) {
      cmptValide++;
      cmptOneTimeNationalite = true;
    }
  }

  /******************************
   *
   *      Tel Check
   *
   * ****************************/

  var telNotMatchedCase = new Array();
  telNotMatchedCase.push("[$@$!%*#?&.,^=/*`~]"); // Special Charecter
  telNotMatchedCase.push("[A-Z]"); // Uppercase Alpabates
  telNotMatchedCase.push("[a-z]"); // Uppercase Alpabates
  if (telValue === "") {
    setErrorFor(tel, "tel cannot be empty");
  } else if (telValue.length < 10) {
    setErrorFor(tel, "tel has more than 10 digits");
  } else {
    // Check the conditions
    var ctr = 0;
    for (var i = 0; i < telNotMatchedCase.length; i++) {
      if (new RegExp(telNotMatchedCase[i]).test(telValue)) {
        ctr++;
      }
    }
    if (ctr >= 1) {
      setErrorFor(tel, "phone number is invalid");
    } else {
      setSuccessFor(tel);
      if (cmptOneTimeTel == false) {
        cmptValide++;
        cmptOneTimeTel = true;
      }
    }
  }

  /******************************
   *
   *      Birthday Check
   *
   * ****************************/

  if (birthdayValue == "") {
    setErrorFor(birthday, "birthday cannot be empty");
  } else {
    setSuccessFor(birthday);
    if (cmptOneTimeBirthday == false) {
      cmptValide++;
      cmptOneTimeBirthday = true;
    }
  }

  /******************************
   *
   *      Password Check
   *
   * ****************************/

  if (motDePasseValue === "") {
    setErrorFor(motDePasse, "password cannot be empty");
  } else if (hasWhiteSpace(motDePasseValue)) {
    setErrorFor(motDePasse, " password must not have space");
  } else if (motDePasseValue.length <= 8) {
    setErrorFor(motDePasse, " 8 caracteres or more ");
  } else {
    // Create an array and push all possible values that you want in password
    var matchedCase = new Array();
    matchedCase.push("[$@$!%*#?&]"); // Special Charecter
    matchedCase.push("[A-Z]"); // Uppercase Alpabates
    matchedCase.push("[0-9]"); // Numbers
    matchedCase.push("[a-z]"); // Lowercase Alphabates

    // Check the conditions
    var ctr = 0;
    for (var i = 0; i < matchedCase.length; i++) {
      if (new RegExp(matchedCase[i]).test(motDePasseValue)) {
        ctr++;
      }
    }
    // Display it
    var strength = "";
    switch (ctr) {
      case 0:
      case 1:
      case 2:
        strength = "Weak";
        setErrorFor(motDePasse, strength);
        break;
      case 3:
        setSuccessFor(motDePasse);
        if (cmptOneTimeMotDePasse == false) {
          strength = "Medium";
          cmptValide++;
          cmptOneTimeMotDePasse = true;
        }
        break;
      case 4:
        setSuccessFor(motDePasse);
        if (cmptOneTimeMotDePasse == false) {
          strength = "Strong";
          cmptValide++;
          cmptOneTimeMotDePasse = true;
        }
        break;
    }
  }

  /******************************
   *
   * Password Confirmation Check
   *
   * ****************************/

  if (confirmationValue === "") {
    setErrorFor(confirmation, "Confirm your password");
  } else if (hasWhiteSpace(confirmationValue)) {
    setErrorFor(confirmation, "password cannot have space");
  } else if (motDePasseValue != confirmationValue) {
    setErrorFor(confirmation, "password does not match");
  } else {
    setSuccessFor(confirmation);
    if (cmptOneTimeConfirmation == false) {
      cmptValide++;
      cmptOneTimeConfirmation = true;
    }
  }

  /******************************
   *
   *      Terms Check
   *
   * ****************************/

  if (checkTerms.checked == false) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "you did not checked our privacy policy",
      footer: "<a href='../privacy.php'>Check our privacy policy?</a>",
    });
  } else {
    if (cmptOneTimeCheckTerms == false) {
      cmptValide++;
      cmptOneTimeCheckTerms = true;
    }
  }

  /*************************************
   *
   *  AJAX FORM DATA SENT TO PHP FUNCTION
   *
   * *************************************/
  function sendEmail() {
    Email.send({
      //Host: "smtp.gmail.com",
      //Username: "smtpjssalamte@gmail.com",
      //Password: "smtpjssalamte20",
      SecureToken: "2dc0e343-eae4-4cb5-a8c1-c10da96d49db",
      To: "ayman.makhoukhi@gmail.com",
      From: "smtpjssalamte@gmail.com",
      Subject: "Salamat-e Verification Account",
      Body: "verifi akiki",
    }).then((message) => alert(message));
  }

  function sendFormData() {
    var form_data = new FormData();
    form_data.append("pdp", pdpValue);
    form_data.append("fullName", fullnameValue);
    form_data.append("username", usernameValue);
    form_data.append("gmail", gmailValue);
    form_data.append("nationalite", nationaliteValue);
    form_data.append("tel", telValue);
    form_data.append("birthday", birthdayValue);
    form_data.append("pwd", motDePasseValue);
    form_data.append("cpwd", confirmationValue);
    console.log(form_data.get("tel"));
    //Ajax to send file to upload
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/signUp.php", true);
    xhr.onload = function () {
      if (this.status == 200) {
        console.log(JSON.parse(xhr.responseText));
        sendEmail();
        Swal.fire({
          icon: "success",
          title: "Your account has been created successfuly",
          showConfirmButton: false,
          timer: 3000,
        });
        $(".showLoginForm").trigger("click");
      }
    };
    xhr.send(form_data);
  }

  /************************************************
   *
   * Check if the gmail or username already exist
   *
   ***********************************************/

  function verify() {
    var form_data = new FormData();
    form_data.append("username", usernameValue);
    form_data.append("gmail", gmailValue);
    form_data.append("tel", telValue);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/verify.php", true);
    xhr.onload = function () {
      if (this.status == 200) {
        var error = JSON.parse(xhr.responseText);
        if (error == "success" && cmptOneTimeVerify == false) {
          cmptValide++;
          cmptOneTimeCheckTerms = true;
          sendFormData();
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error,
          });
        }
      }
    };
    xhr.send(form_data);
  }

  /******************************************
   *  checking if all the fields are valides
   *  + case of no pdp
   *
   * ****************************************/

  if (cmptValide == 10) {
    verify();
  } else {
    console.log("cmpt:" + cmptValide);
  }
}
