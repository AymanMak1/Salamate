const navlinks = document.querySelectorAll(".navlink");
const crudAnchors = document.querySelectorAll(".crudAnchor");
// hiding all the tables at first everytime the admin click an anchor to a table, so he can be able to display the table he desired

/* ****************
  Functions To Use
***************** */
function hideAllCrudTables() {
  document.querySelectorAll(".crudTable").forEach((item) => {
    item.style.display = "none";
  });
}
// smooth scrolling
function smoothScroll(id) {
  $("html, body").animate(
    {
      scrollTop: $(id).offset().top,
    },
    1000
  );
}
// to remove the default style of jquery datatables
function removeInlineStyle(table, th) {
  $(table).removeAttr("style");
  document.querySelectorAll(th).forEach((item) => {
    item.removeAttribute("style");
  });
}

// Nav Links Anchors
navlinks[0].addEventListener("click", hideAllCrudTables);

navlinks[1].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudActualites").style.display = "block";
  smoothScroll("#crudActualites");
  //console.log(navlinks[1].parent());
});

navlinks[2].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudUsers").style.display = "block";
  smoothScroll("#crudUsers");
  removeInlineStyle("#crudUsersTable", "#crudUsersTable th");
});

navlinks[3].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudDiseases").style.display = "block";
  smoothScroll("#crudDiseases");
});

navlinks[4].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudVaccines").style.display = "block";
  smoothScroll("#crudVaccines");
});

// Crud Anchors

crudAnchors[0].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudActualites").style.display = "block";
  smoothScroll("#crudActualites");
});

crudAnchors[1].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudUsers").style.display = "block";
  smoothScroll("#crudUsers");
  removeInlineStyle("#crudUsersTable", "#crudUsersTable th");
});

crudAnchors[2].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudDiseases").style.display = "block";
  smoothScroll("#crudDiseases");
  removeInlineStyle("#crudDiseasesTable", "#crudDiseasesTable th");
});

crudAnchors[3].addEventListener("click", function () {
  hideAllCrudTables();
  document.querySelector("#crudVaccines").style.display = "block";
  smoothScroll("#crudVaccines");
  removeInlineStyle("#crudVaccinesTable", "#crudVaccinesTable th");
});
