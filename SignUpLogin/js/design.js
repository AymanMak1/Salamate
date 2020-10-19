const inputs = document.querySelectorAll(".input");

function addcl() {
  let parent = this.parentNode.parentNode;
  parent.classList.add("focus");
}

function remcl() {
  let parent = this.parentNode.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", addcl);
  input.addEventListener("blur", remcl);
  input.setAttribute("autocomplete", "off");
});

// show and hide forms

let showLoginForm = document.querySelector(".showLoginForm");
let showSignUpForm = document.querySelector(".showSignUpForm");
let logInContent = document.querySelector("#login-content");
let SignUpContent = document.querySelector("#signUp-content");

showLoginForm.addEventListener("click", function () {
  // hide the sign up form
  SignUpContent.style.display = "none";
  // hide the span of loginForm
  showLoginForm.style.display = "none";
  // show the span of SignUpForm
  showSignUpForm.style.display = "flex";
  // show the login form
  logInContent.style.display = "flex";
});
showSignUpForm.addEventListener("click", function () {
  // show the sign up form
  SignUpContent.style.display = "flex";
  // hide the span of loginForm
  showSignUpForm.style.display = "none";
  // show the span of SignUpForm
  showLoginForm.style.display = "flex";
  // show the sign up form
});

// Change the avatar image on the sign up and login forms

var i = 0;
var images = [];
var time = 8000;
var avatars = document.querySelectorAll(".loginAvatar");
//images list
images[0] = "imgs/femaleAvatar.png";
images[1] = "imgs/maleAvatar.png";

function autoslider() {
  if (i < images.length - 1) {
    i++;
    avatars.forEach((avatar) => {
      avatar.setAttribute("src", images[i]);
    });
  } else {
    i = 0;
    avatars.forEach((avatar) => {
      avatar.setAttribute("src", images[i]);
    });
  }
  setTimeout("autoslider()", time);
}

autoslider();
