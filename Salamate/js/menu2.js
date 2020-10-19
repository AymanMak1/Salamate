$(".burger").click(function () {
  $(this).toggleClass("click");
  $(".sidebar").toggleClass("show");
});

$(".profil-btn").click(function () {
  $("nav ul .profil-dropdown").toggleClass("show");
  $("nav ul .first").toggleClass("rotate");
});

$(".voyages-btn").click(function () {
  $("nav ul .voyages-dropdown").toggleClass("show");
  $("nav ul .second").toggleClass("rotate");
});

$(".vaccins-btn").click(function () {
  $("nav ul .vaccins-dropdown").toggleClass("show");
  $("nav ul .third").toggleClass("rotate");
});

$("nav ul li").click(function () {
  $(this).addClass("active").siblings().removeClass("active");
});

const navLinks = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll(".section");

console.log(navLinks);

function hideAllSections() {
  sections.forEach((section) => {
    section.style.display = "none";
  });
}

hideAllSections();
sections[0].style.display = "grid";

navLinks.forEach((navLink) => {
  navLink.addEventListener("click", hideAllSections);
});

navLinks[0].addEventListener("click", function () {
  sections[0].style.display = "grid";
});

navLinks[1].addEventListener("click", function () {
  sections[1].style.display = "flex";
});

navLinks[2].addEventListener("click", function () {
  sections[2].style.display = "flex";
});

navLinks[3].addEventListener("click", function () {
  sections[3].style.display = "flex";
});

navLinks[4].addEventListener("click", function () {
  sections[4].style.display = "flex";
});
