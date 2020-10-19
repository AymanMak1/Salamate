let header = document.querySelector(".header");
let hamburgerMenu = document.querySelector(".hamburger-menu");
let navItems = document.querySelectorAll(".nav-item");
var points = document.querySelector("div.points");
let salamateLogo = document.querySelector("#salamateLogo");
let signInBtn = document.querySelector(".hamburger-menu .SignIn");
let signInLink = document.querySelector(".signInLink");

// change the background color of the header and its elements on scroll

document.addEventListener("scroll", () => {
  document.documentElement.dataset.scroll = window.scrollY;
  //console.log(Math.floor(document.documentElement.dataset.scroll));
  if (Math.floor(document.documentElement.dataset.scroll) > 600) {
    salamateLogo.setAttribute(
      "src",
      "Accueil/imgs/Salamat-e Logo/whiteSalamateLogo.png"
    );
    header.style.backgroundImage = "var(--dark-salamate-gradient)";
    hamburgerMenu.style.setProperty("color", "#fff");
    signInBtn.style.backgroundImage = "var(--salamate-solid)";
  } else {
    header.style.setProperty("background", "");
    hamburgerMenu.style.setProperty("color", "#333");
    salamateLogo.setAttribute(
      "src",
      "Accueil/imgs/Salamat-e Logo/QREATIVESALAMATE3 copie 3100.png"
    );
    signInBtn.style.backgroundImage = "var(--dark-salamate-gradient)";
  }
});

// Hide the bullets sections anchors and show the full width menu
hamburgerMenu.addEventListener("click", function () {
  points.classList.toggle("hide");
  header.classList.toggle("menu-open");
  // hide the sign in button if the header has a class of menu open = if the menu is opened then hide the sign in button
  if (header.classList.contains("menu-open")) {
    signInBtn.classList.add("hideBtn");
  } else {
    signInBtn.classList.remove("hideBtn");
  }
});

// on click each nav item, remove the class menu open which is responsable for showing it = hiding the menu on navitem clik

navItemClick = () => {
  header.classList.remove("menu-open");
  points.classList.remove("hide");
};

for (navItem of navItems) {
  navItem.onclick = navItemClick;
}

// media queries on js If the viewport is less than, or equal to, 480 pixels wide, show the nav item (se connecter)

function showSignInLink(viewport) {
  if (viewport.matches) {
    // If media query matches
    signInLink.style.display = "flex";
  } else {
    signInLink.style.display = "none";
  }
}

var viewport = window.matchMedia("(max-width: 480px)");
showSignInLink(viewport); // Call listener function at run time
viewport.addListener(showSignInLink); // Attach listener function on state changes
